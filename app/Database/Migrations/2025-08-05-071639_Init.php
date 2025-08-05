<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Init extends Migration
{
    public function up()
    {
        $this
            ->createSmallBusinessSubjectTable()
            ->createSupervisorsTable()
            ->createExaminationsTable();
    }

    public function down()
    {
        // Порядок важен!
        $this->forge->dropTable('examinations');
        $this->forge->dropTable('small_business_subjects');
        $this->forge->dropTable('supervisors');
    }

    /**
     * Таблица субъектов малого бизнеса
     */
    private function createSmallBusinessSubjectTable(): self
    {
        $this->forge
            ->addField([
                'id' => [
                    'type' => 'SERIAL'
                ],
                'name' => [
                    'type' => 'TEXT',
                    'null' => false,
                    'comment' => 'Название субъекта малого бизнеса'
                ]
            ])
            ->addKey('id', true)
            // Название субъекта должно быть уникальным
            ->addKey('name', false, true, 'sbs_name_uniq')
            ->createTable('small_business_subjects');

        return $this;
    }

    /**
     * Таблица надзорных органов
     */
    private function createSupervisorsTable(): self
    {
        $this->forge
            ->addField([
                'id' => [
                    'type' => 'SERIAL'
                ],
                'name' => [
                    'type' => 'TEXT',
                    'null' => false,
                    'comment' => 'Название надзорного органа'
                ]
            ])
            ->addKey('id', true)
            // Название контролирующего органа должно быть уникальным
            ->addKey('name', false, true, 'sv_name_uniq')
            ->createTable('supervisors');

        return $this;
    }

    /**
     * Таблица проверок
     */
    private function createExaminationsTable(): self
    {
        $this->forge
            ->addField([
                'id' => [
                    'type' => 'SERIAL'
                ],
                'subject' => [
                    'type' => 'INT',
                    'null' => false,
                    'comment' => 'Идентификатор субъект малого бизнеса'
                ],
                'supervisor' => [
                    'type' => 'INT',
                    'null' => false,
                    'comment' => 'Идентификатор надзорного органа'
                ],
                'from' => [
                    'type' => 'TIMESTAMP',
                    'null' => false,
                    'comment' => 'Дата начала проверки'
                ],
                'to' => [
                    'type' => 'TIMESTAMP',
                    'null' => false,
                    'comment' => 'Дата окончания проверки'
                ],
                'duration' => [
                    'type' => 'INT',
                    'null' => false,
                    'default' => 0,
                    'comment' => 'Плановая длительность'
                ]
            ])
            ->addKey('id', true)
            ->addForeignKey('subject', 'small_business_subjects', 'id', '', 'CASCADE', 'exam_sub_fk')
            ->addForeignKey('supervisor', 'supervisors', 'id', '', 'CASCADE', 'exam_spv_fk')
            /**
             * Понимать так: один и тот же орган в одно и то же время
             * не может проверять один и тот же субъект!
             */
            ->addUniqueKey(['subject', 'supervisor', 'from', 'to'])
            ->createTable('examinations');

        // Ограничение на значение дат: дата окончания интервала не должна быть меньше даты начала!
        $this->db->query('ALTER TABLE examinations ADD CONSTRAINT chk_interval CHECK ("to" >= "from")');

        return $this;
    }
}
