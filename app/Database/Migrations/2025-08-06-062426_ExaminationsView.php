<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExaminationsView extends Migration
{
    public function up()
    {
        // Представление для удобства формирования данных
        $this->db->query('
            CREATE VIEW examinations_view AS
                SELECT EX1.id, EX1.from, EX1.to, EX1.duration
                       , SBS1.id AS subject_id, SBS1.name AS subject_name
                       , SV1.id AS supervisor_id, SV1.name AS supervisor_name
                  FROM examinations AS EX1
                  JOIN small_business_subjects AS SBS1 ON EX1.subject = SBS1.id
                  JOIN supervisors AS SV1 ON EX1.supervisor = SV1.id
        ');
    }

    public function down()
    {
        $this->db->query('DROP VIEW examinations_view');
    }
}
