<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Teacher;
use app\models\Student;
use app\models\TeacherStudent;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;

class TeacherController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = Teacher::find();

        return $this->render('list', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionFilter()
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => Teacher::findBySql("select t.* from teacher as t 
                    right join teacher_student as ts on (ts.teacher_id = t.id) 
                    left join student as s on (ts.student_id = s.id) 
                    where MONTH(s.birthday) = 4")->all(),
            'sort' => [
                'attributes' => ['id', 'name'],
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('filter', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionFilter2()
    {
        $teachers = [];
        $students = [];

        $teachers = Teacher::findBySql("
            select t.name, t.id from (
                select st2.teacher_id st2, st3.teacher_id st3, count(st3.student_id) cnt from teacher_student st2
                    left join teacher_student st3 on st3.student_id = st2.student_id and st2.teacher_id != st3.teacher_id
                    where st3.teacher_id is not null group by st3.teacher_id, st2.teacher_id
                    ) res 
                    left join teacher t on t.id=st2
                    left join teacher t2 on t2.id=st3
                    order by cnt DESC limit 2
        ")->all();

        if (count($teachers) == 2) {
            $students = Student::findBySql("
                select * from teacher_student st
                left join student t on t.id = st.student_id 
                left join teacher_student st2 on st2.teacher_id = :teacher1 and st2.student_id = st.student_id
                where st.teacher_id = :teacher2 and st2.teacher_id is not null
            ", [':teacher1' => $teachers[0]->id, ':teacher2' => $teachers[1]->id])->all();
        }

        return $this->render('filter2', [
            'teachers' => $teachers,
            'students' => $students,
        ]);
    }

    public function actionCreate()
    {
        $model = new Teacher;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save())
                return $this->redirect(Url::to(['/teacher/view', 'id' => $model->id]));
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id = null)
    {
        if (!$id)
            return $this->render('/site/error', ['name' => 'Bad request', 'message' => 'id is not defined']);

        $message['class'] = '';
        $message['text'] = '';

        $model = new TeacherStudent;
        $dataProvider = Teacher::find()->where(['id' => (int) $id]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (TeacherStudent::find()->where(['teacher_id' => $model->teacher_id, 'student_id' => $model->student_id])->count() == 0) {
                $result = $model->save();
            } else {
                $message['class'] = 'danger';
                $message['text'] = 'Ошибка. Пользователь с id ' . $model->student_id . ' уже назначен учителю с id ' . $model->teacher_id . '.';
            }

            if (isset($result) && $result === true) {
                $message['class'] = 'success';
                $message['text'] = 'Ваш запрос успешно выполнен. Пользователь с id ' . $model->student_id . ' назначен учителю с id ' . $model->teacher_id . '.';
            }
        }

        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'message' => $message
        ]);
    }
}
