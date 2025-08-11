<?php

  /**
   * Контроллер проверок надзорными органами предприятий
   */

  declare(strict_types=1);

  namespace App\Controllers;

  use CodeIgniter\API\ResponseTrait;

  class ExaminationController extends BaseController
  {
      use ResponseTrait;

      /**
       * Поиск проверок с фильтрацией по некоторым полям
       */
      public function search()
      {
          // Должен быть только метод POST
          if (!$this->request->is('post')) {
              return $this->failForbidden('Forbidden');
          }

          $examinationModel = model('ExaminationModel');

          $postData = $this->request->getJSON(true);
          
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

  }
