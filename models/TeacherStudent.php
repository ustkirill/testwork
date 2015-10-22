<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher_student".
 *
 * @property integer $teacher_id
 * @property integer $student_id
 *
 * @property Student $student
 * @property Teacher $teacher
 */
class TeacherStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher_student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_id', 'student_id'], 'required'],
            [['teacher_id', 'student_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'teacher_id' => 'Выберите учителя',
            'student_id' => 'Выберите ученика',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacher_id']);
    }
}
