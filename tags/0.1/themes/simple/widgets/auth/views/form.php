<?php $form=$this->beginWidget('CActiveForm'); ?>
	<?php echo $form->textField($model,'username', array('class'=>'watermark text', 'title'=>'Логин')); ?>
	<?php echo $form->passwordField($model,'password', array('class'=>'watermark text password', 'title'=>'Пароль')); ?>
	<?php echo CHtml::submitButton('Вход'); ?>
	<?php /*<span><?php echo $form->checkBox($model,'rememberMe'); ?> Помнить меня</span> */ ?>
	<?php echo CHtml::link('Восстановить аккаунт', array('users/password_recovery'), array('class'=>'recovery'))?>
	<?php echo CHtml::link('Регистрация', array('users/registration'), array('class'=>'registration')); ?>
<?php $this->endWidget(); ?>