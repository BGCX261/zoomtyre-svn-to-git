<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'password_recovery-form',
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'username'); ?>
		<?php echo $form->textField($model, 'username', array('class'=>( !empty($model->errors)?'error':'' ))); ?>
		<?php echo $form->error($model, 'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('class'=>( !empty($model->errors)?'error':'' ))); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<?php if(extension_loaded('gd')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<?php $this->widget('CCaptcha', array('captchaAction'=>'index/captcha', 'clickableImage'=>true, 'buttonLabel'=>false)); ?>
		<?php echo $form->textField($model,'verifyCode', array('class'=>'comment-verify')); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Отправить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->