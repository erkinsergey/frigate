<?php

  /**
   * Контроллер проверок надзорными органами предприятий
   */

  declare(strict_types=1);

  namespace App\Controllers;

  use \CodeIgniter\API\ResponseTrait;
  use \CodeIgniter\HTTP\ResponseInterface;

  class ExaminationController extends BaseController
  {
      use ResponseTrait;

      /**
       * Поиск проверок с фильтрацией по некоторым полям
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
       * Создание проверки
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
  }
