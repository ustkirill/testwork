<?php
	use yii\grid\GridView;
	use yii\data\ActiveDataProvider;
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;

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