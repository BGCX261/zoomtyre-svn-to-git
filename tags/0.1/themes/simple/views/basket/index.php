<div class='basket'>
<?php if(count($cart)>0):?>
<ul>
<?php foreach($cart as $position): ?>
	<li>
		<?php echo CHtml::link($position->getTitle(), $position->getUrl()); ?>
		<?php echo $position->getQuantity(); ?> шт.
		По цене <?php echo $position->getPrice(); ?>р. за штуку
		итого на: <?php echo $position->getSumPrice(); ?>р.
	</li>
<?php endforeach; ?>
</ul>

<div class='order form'>
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	#'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class='row'>
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>80, 'class'=>'input')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class='row'>
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>80, 'class'=>'input')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class='row'>
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>80, 'class'=>'input')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class='row'>
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>80, 'class'=>'input')); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class='row'>
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('cols'=>60,'rows'=>8, 'class'=>'input')); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class='row'>
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('cols'=>60,'rows'=>8, 'class'=>'input')); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>
	
	<?php if(extension_loaded('gd')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<?php $this->widget('CCaptcha', array('captchaAction'=>CHtml::normalizeUrl('index/captcha'), 'clickableImage'=>true, 'buttonLabel'=>false)); ?>
		<?php echo $form->textField($model,'verifyCode', array('class'=>'comment-verify')); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Оформить заказ'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div>

<?php ?>

<?php else: ?>
В Вашей корзинке нет товаров! Купите же что нибуть!
<?php endif; ?>
</div>