<?php
	use yii\grid\GridView;
	use yii\data\ActiveDataProvider;
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use kartik\select2\Select2;

	$this->title = '';
?>

<br><br>

<?= GridView::widget([
	'dataProvider' => new ActiveDataProvider([
		'query' => $dataProvider,
		'pagination' => false,
        'sort' => false,
	]),
	'layout' => "{items}",
	'columns' => [
		'id',
		'name',
	    [
	        'attribute' => 'sex',
	        'content' => function ($model) {
	        	return $model->sexLabels[$model->sex];
	        }
	    ],
		'phone',
	    [
	        'attribute' => 'count',
	        'label' => 'Количество учеников',
	        'content' => function ($model) {
	        	return count($model->teacherStudents);
	        }
	    ],
	],
]); ?>
<br><br><br>
<h3>Назначить ученика</h3>

<div class="row">
	<div class="col-xs-12">
	<?php if (!empty($message['class'])): ?>
		<br>
		<p class="alert alert-<?= $message['class'] ?>"><?= $message['text'] ?></p>
	<?php endif; ?>
	</div>
	<div class="col-lg-5">
		<?php $form = ActiveForm::begin(['id' => 'add-student-form']); ?>

			<?= $form->field($model, 'teacher_id')->hiddenInput(['value' => \Yii::$app->request->get('id')])->label(false) ?>
			<?= $form->field($model, 'student_id')->widget(Select2::classname(), [
			    'initValueText' => '',
			    'options' => ['placeholder' => 'Выберите ученика ...'],
			    'pluginOptions' => [
			        'allowClear' => true,
			        'minimumInputLength' => 3,
			        'ajax' => [
			            'url' => '/student/search',
			            'dataType' => 'json'
			        ],
			    ],
			]); ?>

			<div class="form-group">
				<?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary', 'name' => 'add-button']) ?>
			</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>