<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 *
 * @property TeacherStudent[] $teacherStudents
 */
class Teacher extends \yii\db\ActiveRecord
{
    public $count;

    const SEX_MALE = 'M';
    const SEX_FEMALE = 'F';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sex'], 'required'],
            [['phone'], 'integer'],
            [['name'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'sex' => 'Пол',
        ];
    }

    public static function getSexLabels()
    {
        return [
            self::SEX_MALE => 'Мужской',
            self::SEX_FEMALE => 'Женский',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherStudents()
    {
        return $this->hasMany(TeacherStudent::className(), ['teacher_id' => 'id']);
    }
}
