<?php

use yii\db\Schema;
use yii\db\Migration;

class m151021_183805_app_skeleton extends Migration
{
    public function safeUp()
    {
        $this->createTable('teacher', array(
            'id' => 'pk',
            'name' => 'VARCHAR(250) NOT NULL',
            'phone' => 'BIGINT(11)',
            'sex' => 'ENUM("F", "M")',
        ));

        $this->createTable('student', array(
            'id' => 'pk',
            'name' => 'VARCHAR(250) NOT NULL',
            'email' => 'VARCHAR(250)',
            'birthday' => 'DATE',
            'skill' => 'ENUM("basic", "independent", "proficient")',
            'skill_status' => 'ENUM("1", "2")',
        ));

        $this->createTable('teacher_student', array(
            'teacher_id' => 'INT NOT NULL',
            'student_id' => 'INT NOT NULL',
        ));

        $this->addForeignKey('FK_teacher_id', 'teacher_student', 'teacher_id', 'teacher', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_student_id', 'teacher_student', 'student_id', 'student', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function safeDown()
    {
        echo "m151021_183805_app_skeleton cannot be reverted.\n";

        return false;
    }
}
