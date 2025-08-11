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
       * Ищет проверки в специальном сводном представлении examinations_view,
       * форматирует результат в удобный для представления вид.
       */
      public function search(array $params): array
      {
          if ($params['smallBusinessSubject']['isUsed']) {
              $this->like($field = 'LOWER(subject_name)', mb_strtolower($params['smallBusinessSubject']['value']), $side = 'both', $escape = true);
          }
          
          if ($params['supervisor']['isUsed']) {
              $this->like($field = 'LOWER(supervisor_name)', mb_strtolower($params['supervisor']['value']), $side = 'both', $escape = true);
          }
          
          /**
           * Преобразует "плоский" результат в удобочитаемый
           */
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
                  $this->findAll()
              );
      }
  }
