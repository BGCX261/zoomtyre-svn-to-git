<?php
$this->pageTitle=Yii::app()->name . ' - Корзина';
$this->breadcrumbs=array(
	'Корзина',
);
?>
<h2 class="title3"><span><span>Корзина</span></span></h2>

<div id='basket'>
<?php if(count($cart)>0):?>
<h3>Ваш заказ: </h3>
<table class='basket-items'>
	<tr>
		<th>Товар</th>
		<th>Количество</th>
		<th>Цена за одну единицу</th>
		<th>Сумма по позиции</th>
	</tr>
<?php foreach($cart as $position): ?>
	<tr>
		<td><?php echo CHtml::link($position->getTitle(), $position->getUrl()); ?></td>
		<td><?php echo $position->getQuantity(); ?> шт.</td>
		<td>По цене <?php echo $position->getPrice(); ?> <i class='rub'>Р</i> за штуку</td>
		<td>на: <?php echo $position->getSumPrice(); ?> <i class='rub'>Р</i></td>
	</tr>
<?php endforeach; ?>
</table>
<p><?php echo CHtml::link('Очистить корзину', '#', array('class'=>'clearBasket') ); ?></p>
<p align="right">Итого в корзине товаров на сумму <strong><?php echo $cart->getCost(); ?> <i class='rub'>Р</i></strong></p>
<hr class='space' />
<h3>Оформление заказа</h3>
<hr class='space' />
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