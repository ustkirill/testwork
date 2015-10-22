<?php
	use yii\grid\GridView;
	use yii\data\ActiveDataProvider;
	use yii\helpers\Html;

	$this->title = 'Отфильтрованный список учителей';
?>

<div class="btn-group pull-right" role="group">
	<?= Html::a('Создать учителя', ['/teacher/create'], ['class' => 'btn btn-default btn-primary']) ?>
</div>
<br><br><br>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'layout' => "{items}\n{summary}\n{pager}",
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