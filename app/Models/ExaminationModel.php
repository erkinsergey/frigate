<?php

  /**
   * Модель (репозиторий) проверок
   */

  declare(strict_types=1);

  namespace App\Models;

  use CodeIgniter\Model;
  use App\Entities\Examination;

  class ExaminationModel extends Model
  {
      protected $table = 'examinations';

      protected $returnType = \App\Entities\Examination::class;
      protected $useTimestamps = true;
  }
