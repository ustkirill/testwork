<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	use yii\web\View;

	$this->registerJs('
		var dataSkillsStatus = ' . json_encode($model->skillLevelLabels) . ';
		$("#student-skill").change(function() {
			$("#student-skill_status option").remove();
			var val = $(this).val();
			for(i in dataSkillsStatus[val]) {
				$("#student-skill_status").append("<option value=\"" + i + "\">" + dataSkillsStatus[val][i] + "</option>")
			}
		});
	', View::POS_END);

	$this->title = 'Создание ученика';
?>

<div class="row">
	<div class="col-lg-5">
		<?php $form = ActiveForm::begin(['id' => 'create-student-form']); ?>

			<?= $form->field($model, 'name') ?>
			<?= $form->field($model, 'email') ?>
			<?= $form->field($model, 'birthday')->widget(\kartik\date\DatePicker::className()) ?>
			<?= $form->field($model, 'skill')->dropDownList($model->skillLabels) ?>
			<?= $form->field($model, 'skill_status')->dropDownList($model->skillLevelLabels[$model::SKILL_BASIC]) ?>

			<div class="form-group">
				<?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
			</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>