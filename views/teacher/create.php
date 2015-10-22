<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;

	$this->title = 'Создание учителя';
?>

<div class="row">
	<div class="col-lg-5">
		<?php $form = ActiveForm::begin(['id' => 'create-teacher-form']); ?>

			<?= $form->field($model, 'name') ?>
			<?= $form->field($model, 'phone') ?>
			<?= $form->field($model, 'sex')->radioList($model->sexLabels) ?>

			<div class="form-group">
				<?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
			</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>