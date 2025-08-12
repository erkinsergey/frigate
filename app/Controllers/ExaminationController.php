<?php

  /**
   * Контроллер проверок предприятий малого бизнеса со стороны контролирующих органов
   */

  declare(strict_types=1);

  namespace App\Controllers;

  use \CodeIgniter\API\ResponseTrait;
  use \CodeIgniter\HTTP\{ResponseInterface, DownloadResponse};
  
  use \PhpOffice\PhpSpreadsheet\Spreadsheet;
  use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  class ExaminationController extends BaseController
  {
      use ResponseTrait;

      /**
       * Поиск проверок с фильтрацией по некоторым полям,
       * возвращает JSON-список
       */
      public function search(): ResponseInterface
      {
          // Должен быть только метод POST
          if (!$this->request->is('post')) {
              return $this->failForbidden('Forbidden');
          }

          $examinationModel = model('ExaminationModel');

          $postData = $this->request->getJSON($assoc = true);
          
          $params = [
              'smallBusinessSubject' => [
                  'value' => trim($postData['sbsubject'] ?? ''),
                  'isUsed' => ('' === trim($postData['sbsubject'] ?? '')) ? false : true
              ],
              'supervisor' => [
                  'value' => trim($postData['supervisor'] ?? ''),
                  'isUsed' => ('' === trim($postData['supervisor'] ?? '')) ? false : true
              ]
          ];

          return $this->response->setJSON(
              $examinationModel->search($params)
          );
      }
      
      /**
       * Создание проверки (макет)
       */
      public function create(): ResponseInterface
      {
          // Должен быть только метод POST
          if (!$this->request->is('post')) {
              return $this->failForbidden('Forbidden');
          }
          
          $data = $this->request->getJSON($assoc = true);
          $rules = [
              'sbsubject' => 'required|max_length[255]',
              'supervisor' => 'required|max_length[255]',
              'from' => 'required|valid_date',
              'to' => 'required|valid_date',
              'duration' => 'required|integer'
          ];
          
          if (!$this->validateData($data, $rules)) {
              return $this->failValidationErrors($this->validator->getErrors());
          }
          
          return $this->response->setJSON(
              // TODO: ExaminationModel->create($data)
              $data
          );
      }
      
      /**
       * Экспорт проверок с заданными идентификаторами в файл Excel
       */
      public function export(): DownloadResponse
      {
          $examinationIds = $this->request->getPostGet('ids') ?? [];
          
          $tempFileName = $this->createTempExcelFileAndReturnName(
              /**
               * Если список идентификаторов не пустой - обратиться к модели за поиском проверок,
               * если пустой - создать пустой файл без обращения к модели
               */
              count($examinationIds)
                    ? model('ExaminationModel')->find($examinationIds)
                    : []
          );
          
          return
              $this->response
                  ->download($tempFileName, null)
                  ->setFileName('examinations.xlsx');
      }
      
      /**
       * Создает временный файл Excel, заполняет его данными и возвращает имя (путь)
       */
      private function createTempExcelFileAndReturnName(array $examinations): string
      {
          $spreadsheet = new Spreadsheet();
          $activeWorksheet = $spreadsheet->getActiveSheet();
          
          // Заголовки
          $activeWorksheet
                ->setCellValue('A1', 'Проверяемый СМП')
                ->setCellValue('B1', 'Контролирующий орган')
                ->setCellValue('C1', 'Период с')
                ->setCellValue('D1', 'Период по')
                ->setCellValue('E1', 'Плановая длительность');
          
          array_walk($examinations, function (array $examination, int $index) use ($activeWorksheet) {
              $rowIndex = $index + 2;
              
              $activeWorksheet
                  ->setCellValue("A$rowIndex", $examination['subject_name'])
                  ->setCellValue("B$rowIndex", $examination['supervisor_name'])
                  ->setCellValue("C$rowIndex", $examination['from'])
                  ->setCellValue("D$rowIndex", $examination['to'])
                  ->setCellValue("E$rowIndex", $examination['duration']);
          });
          
          $tempFileName = tempnam(sys_get_temp_dir(), 'ci4_spreadsheet');
          $writer = new Xlsx($spreadsheet);
          $writer->save($tempFileName);
          
          return $tempFileName;
      }
  }
