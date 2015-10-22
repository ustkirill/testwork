<?php
	use yii\grid\GridView;
	use yii\data\ActiveDataProvider;
	use yii\helpers\Html;

	$this->title = 'Список учителей';
?>

<div class="btn-group pull-right" role="group">
	<?= Html::a('Создать учителя', ['/teacher/create'], ['class' => 'btn btn-default btn-primary']) ?>
</div>
<br><br><br>

<?= GridView::widget([
	'dataProvider' => new ActiveDataProvider([
		'query' => $dataProvider,
		'pagination' => [
			'pageSize' => 20,
		],
        'sort' => [
            'attributes' => ['id', 'name'],
        ],
	]),
	'layout' => "{items}\n{summary}\n{pager}",
	'columns' => [
		'id',
	    [
	        'attribute' => 'name',
	        'content' => function ($model) {
	        	return Html::a($model->name, ['/teacher/view', 'id' => $model->id]);
	        }
	    ],
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