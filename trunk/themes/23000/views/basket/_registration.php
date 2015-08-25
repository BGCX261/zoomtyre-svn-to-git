Вы можете продолжить регистрацию заплонив недостаю

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registration-form',
	'action'=>array('users/registration'),
)); ?>

	<p class="note">Поля отмеченный звездочкой (<span class="required">*</span>) должны быть заполнены обязательно.</p>

	<?php echo $form->errorSummary($registration_form); ?>

	<div class="row">
		<?php echo $form->labelEx($registration_form, 'username'); ?>
		<?php echo $form->textField($registration_form, 'username'); ?>
		<?php echo $form->error($registration_form, 'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($registration_form,'password'); ?>
		<?php echo $form->passwordField($registration_form,'password'); ?>
		<?php echo $form->error($registration_form,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($registration_form,'password_confirm'); ?>
		<?php echo $form->passwordField($registration_form,'password_confirm'); ?>
		<?php echo $form->error($registration_form,'password_confirm'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($registration_form,'name'); ?>
		<?php echo $form->textField($registration_form,'name'); ?>
		<?php echo $form->error($registration_form,'name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($registration_form,'phone'); ?>
		<?php echo $form->textField($registration_form,'phone'); ?>
		<?php echo $form->error($registration_form,'phone'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($registration_form,'email'); ?>
		<?php echo $form->textField($registration_form,'email'); ?>
		<?php echo $form->error($registration_form,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($registration_form,'city'); ?>
		<?php echo $form->textField($registration_form,'city'); ?>
		<?php echo $form->error($registration_form,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($registration_form,'address'); ?>
		<?php echo $form->textArea($registration_form,'address', array('cols'=>40, 'rows'=>8)); ?>
		<?php echo $form->error($registration_form,'address'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Отправить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->