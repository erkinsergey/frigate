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
       *
       */
      public function search()
      {
          // Должен быть только метод POST
          if (!$this->request->is('post')) {
              return $this->failForbidden('Forbidden');
          }

          $examinationModel = model('ExaminationModel');

          $postData = $this->request->getJSON(true);

          return $this->response->setJSON(
              $examinationModel->findExaminations()
          );
      }

  }
