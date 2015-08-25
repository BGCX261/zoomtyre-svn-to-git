<div class='comments-form form' id='<?php echo $this->id; ?>'>
	<a name='comments-form'></a>
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-from-form',
	'enableAjaxValidation'=>false,
	'action'=>'#comments-form',
)); ?>

	<?php echo $form->hiddenField($this->form,'parent', array('class'=>'parent', 'id'=>$this->id)); ?>

	<div class="row">
		<?php echo $form->labelEx($this->form,'author'); ?>
		<?php echo $form->textField($this->form,'author',array('size'=>60,'maxlength'=>80, 'class'=>'input')); ?>
		<?php echo $form->error($this->form,'author'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($this->form,'text'); ?>
		<?php echo $form->textArea($this->form,'text',array('cols'=>60,'rows'=>8, 'class'=>'input')); ?>
		<?php echo $form->error($this->form,'text'); ?>
	</div>
	
	<?php if(extension_loaded('gd')): ?>
	<div class="row">
		<?php echo $form->labelEx($this->form,'verifyCode'); ?>
		<?php $this->widget('CCaptcha', array('captchaAction'=>$this->options['captchaAction'], 'clickableImage'=>true, 'buttonLabel'=>false)); ?>
		<?php echo $form->textField($this->form,'verifyCode', array('class'=>'comment-verify')); ?>
		<?php echo $form->error($this->form,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<a class='noans' href='#' style='display:none;'>Не хочу ни кому отвечать</a> <?php echo CHtml::submitButton('Добавить'); ?>
	</div>
	
	

<?php $this->endWidget(); ?>
</div>

<a class='noans' href='#' style='display:none;'>Не хочу ни кому отвечать</a>