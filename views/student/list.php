<?php
	use yii\grid\GridView;
	use yii\data\ActiveDataProvider;
	use yii\helpers\Html;

	$this->title = 'Список учеников';
?>

<div class="btn-group pull-right" role="group">
	<?= Html::a('Создать ученика', ['/student/create'], ['class' => 'btn btn-default btn-primary']) ?>
</div>
<br><br><br>

<?= GridView::widget([
	'dataProvider' => new ActiveDataProvider([
		'query' => $dataProvider,
		'pagination' => [
			'pageSize' => 20,
		],
        'sort' => [
            'attributes' => ['id', 'name', 'birthday'],
        ],
	]),
	'layout' => "{items}\n{summary}\n{pager}",
	'columns' => [
		'id',
	    [
	        'attribute' => 'name',
	        'content' => function ($model) {
	        	return Html::a($model->name, ['/student/view', 'id' => $model->id]);
	        }
	    ],
		'email',
		[
			'attribute' => 'birthday',
			'format' => 'text',
			'content' => function ($model) {
				return date('d/m/Y', strtotime($model->birthday));
			}
		],
		[
			'attribute' => 'skill',
			'format' => 'text',
			'content' => function ($model) {
				return $model->skillLabels[$model->skill];
			}
		],
		[
			'attribute' => 'skill_status',
			'format' => 'text',
			'content' => function ($model) {
				return $model->skillLevelLabels[$model->skill][$model->skill_status];
			}
		],
	],
]); ?>