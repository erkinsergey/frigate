<?php

  /**
   * Модель плановых проверок
   */

  declare(strict_types=1);
  
  namespace App\Models;

  use CodeIgniter\Model;

  class ExaminationModel extends Model
  {
      protected $table = 'examinations_view';

      /**
       *
       */
      public function findExaminations(): array
      {
          $result = $this->db->query('
            SELECT *
              FROM "examinations_view"
          ');

          return
              array_map(
                  fn (array $rawRecord) => [
                      'id' => $rawRecord['id'],
                      'from' => $rawRecord['from'],
                      'to' => $rawRecord['to'],
                      'duration' => $rawRecord['duration'],
                      'supervisor' => [
                          'id' => $rawRecord['supervisor_id'],
                          'name' => $rawRecord['supervisor_name']
                      ],
                      'smallBusinessSubject' => [
                          'id' => $rawRecord['subject_id'],
                          'name' => $rawRecord['subject_name']
                      ]
                  ],
                  $result->getResultArray()
              );
      }

      //protected $returnType = \App\Entities\Examination::class;
      //protected $useTimestamps = true;
  }
