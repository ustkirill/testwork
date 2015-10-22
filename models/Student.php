<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $birthday
 * @property string $skill
 * @property string $skill_status
 *
 * @property TeacherStudent[] $teacherStudents
 */
class Student extends \yii\db\ActiveRecord
{
    const SKILL_BASIC = 'basic';
    const SKILL_INDEPENDENT = 'independent';
    const SKILL_PROFICIENT = 'proficient';

    const SKILL_LEVEL_1 = 1;
    const SKILL_LEVEL_2 = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['birthday'], 'safe'],
            [['skill', 'skill_status'], 'string'],
            [['name', 'email'], 'string', 'max' => 250]
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
            'email' => 'Email',
            'birthday' => 'Дата рождения',
            'skill' => 'Уровень знания языка',
            'skill_status' => 'Дополнительный уровень знания языка',
        ];
    }

    public static function getSkillLabels()
    {
        return [
            self::SKILL_BASIC => 'Basic user',
            self::SKILL_INDEPENDENT => 'Independent user',
            self::SKILL_PROFICIENT => 'Proficient user',
        ];
    }

    public static function getSkillLevelLabel($skill, $lvl)
    {
        $skills = self::getSkillLevelLabels();
        return $skills[$skill][$lvl];
    }

    public static function getSkillLevelLabels()
    {
        return [
            self::SKILL_BASIC => [
                self::SKILL_LEVEL_1 => 'Breakthrough or beginner',
                self::SKILL_LEVEL_2 => 'Way stage or elementary',
            ],
            self::SKILL_INDEPENDENT => [
                self::SKILL_LEVEL_1 => 'Threshold or intermediate',
                self::SKILL_LEVEL_2 => 'Vantage or upper intermediate',
            ],
            self::SKILL_PROFICIENT => [
                self::SKILL_LEVEL_1 => 'Effective operational proficiency or advanced',
                self::SKILL_LEVEL_2 => 'Mastery or proficiency',
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherStudents()
    {
        return $this->hasMany(TeacherStudent::className(), ['student_id' => 'id']);
    }
}
