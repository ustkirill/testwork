<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Student;
use yii\helpers\Url;
use yii\db\Query;

class StudentController extends Controller
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
        $dataProvider = Student::find();

        return $this->render('list', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Student;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->birthday = date('Y-m-d', strtotime($model->birthday));
            if ($model->save())
                return $this->redirect(Url::to(['/student/view', 'id' => $model->id]));
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id = null)
    {
        if (!$id)
            return $this->render('/site/error', ['name' => 'Bad request', 'message' => 'id is not defined']);

        $dataProvider = Student::find()->where(['id' => (int) $id]);

        return $this->render('view', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSearch($q = null)
    {
        if (!$q)
            return $this->render('/site/error', ['name' => 'Bad request', 'message' => 'q is not defined']);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];

        $query = new Query;
        $query->select('id, name AS text')
            ->from('student')
            ->where(['like', 'name', $q])
            ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out['results'] = array_values($data);

        return $out;
    }
}
