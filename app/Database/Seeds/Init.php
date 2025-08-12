<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Init extends Seeder
{
    public function run()
    {
        $subjectIds = $this->addSubjectsAndReturnIds([
            [
                'name' => 'ООО "Колосок"'
            ],
            [
                'name' => 'ООО "Васильев и К"'
            ]
        ]);

        $supervisorsIds = $this->addSupervisorsAndReturnIds([
            [
                'name' => 'Роспотребнадзор'
            ],
            [
                'name' => 'Налоговая'
            ],
            [
                'name' => 'Природнадзор'
            ],
            [
                'name' => 'Рыбнадзор'
            ]
        ]);

        $this->addExaminations([
            [
                'subject' => $subjectIds[0],
                'supervisor' => $supervisorsIds[0],
                'from' => date('Y-m-d H:i:s', mktime(0, 0, 0, 1, 15, 2025)),
                'to' => date('Y-m-d H:i:s', mktime(0, 0, 0, 1, 17, 2025)),
                'duration' => 2
            ],
            [
                'subject' => $subjectIds[0],
                'supervisor' => $supervisorsIds[1],
                'from' => date('Y-m-d H:i:s', mktime(0, 0, 0, 3, 25, 2025)),
                'to' => date('Y-m-d H:i:s', mktime(0, 0, 0, 3, 30, 2025)),
                'duration' => 3
            ],
            [
                'subject' => $subjectIds[0],
                'supervisor' => $supervisorsIds[2],
                'from' => date('Y-m-d H:i:s', mktime(0, 0, 0, 6, 1, 2025)),
                'to' => date('Y-m-d H:i:s', mktime(0, 0, 0, 6, 7, 2025)),
                'duration' => 4
            ],
            [
                'subject' => $subjectIds[1],
                'supervisor' => $supervisorsIds[0],
                'from' => date('Y-m-d H:i:s', mktime(0, 0, 0, 6, 1, 2025)),
                'to' => date('Y-m-d H:i:s', mktime(0, 0, 0, 6, 3, 2025)),
                'duration' => 3
            ],
            [
                'subject' => $subjectIds[1],
                'supervisor' => $supervisorsIds[1],
                'from' => date('Y-m-d H:i:s', mktime(0, 0, 0, 8, 16, 2025)),
                'to' => date('Y-m-d H:i:s', mktime(0, 0, 0, 8, 19, 2025)),
                'duration' => 4
            ],
            [
                'subject' => $subjectIds[1],
                'supervisor' => $supervisorsIds[2],
                'from' => date('Y-m-d H:i:s', mktime(0, 0, 0, 5, 20, 2025)),
                'to' => date('Y-m-d H:i:s', mktime(0, 0, 0, 5, 22, 2025)),
                'duration' => 6
            ]
        ]);
    }

    /**
     *
     */
    private function addSubjectsAndReturnIds(array $items): array
    {
        $this->db->query('TRUNCATE TABLE small_business_subjects RESTART IDENTITY CASCADE');

        $this->db->table('small_business_subjects')
            ->insertBatch($items);

        // Получаем идентификаторы новых записей
        return array_column(
            $this->db->table('small_business_subjects')
                ->select('id')
                ->get()
                ->getResultArray(),
            'id'
        );
    }

    /**
     *
     */
    private function addSupervisorsAndReturnIds(array $items): array
    {
        $this->db->query('TRUNCATE TABLE supervisors RESTART IDENTITY CASCADE');

        $this->db->table('supervisors')
            ->insertBatch($items);

        // Получаем идентификаторы новых записей
        return array_column(
            $this->db->table('supervisors')
                ->select('id')
                ->get()
                ->getResultArray(),
            'id'
        );
    }

    /**
     *
     */
    private function addExaminations(array $items): void
    {
        $this->db->table('examinations')
            ->insertBatch($items);
    }
}
