<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recovery-form',
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->textField($model, 'password'); ?>
		<?php echo $form->error($model, 'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password_confirm'); ?>
		<?php echo $form->textField($model,'password_confirm'); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Отправить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->