<?php
$this->pageTitle=Yii::app()->name . ' - Контакты - Продажа шин, дисков, автозапчастей';
$this->breadcrumbs=array(
	'Контакты',
);
?>

<div class='grid_6 alpha'>

<h2 class="title2"><span><span>Связаться с нами</span></span></h2>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<p>
Если у Вас есть деловые предложения или вопросы, пожалуйста, заполните форму для связи с нами. Спасибо.
</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>

	<p class="note">Поля отмеченые <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<?php if(extension_loaded('gd')): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Отправить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>
</div>

<div class='grid_6 omega'>
	<h2 class="title1"><span><span>Наш адрес</span></span></h2>
	<?php 
	Yii::app()->getClientScript()->
	registerScriptFile('http://api-maps.yandex.ru/1.1/index.xml?key='.Yii::app()->params['yandexApiKey']);
	?>
	<h3><?php echo Yii::app()->params['address'];?></h3>
	<p>Телефон:<br /> <strong><?php echo Yii::app()->params['phone']; ?></strong></p>
	<p>Время работы:<br /> <strong>Понедельник &mdash; Пятница с 8:00 до 19:00</strong><br /> <strong>Суббота &mdash; Воскресенье c 10:00 до 18:00</strong></p>
	<p>Здесь, по предварительной договоренности, Вы сможете забрать свои заказы, в любой день недели с 10:00 до 18:00</p>
	<div class='map' id='map'></div>
	<script type="text/javascript">
	var map = new YMaps.Map(document.getElementById('map'));
	map.addControl(new YMaps.Zoom());
	map.addControl(new YMaps.ScaleLine());
	map.enableScrollZoom();
	map.setCenter(new YMaps.GeoPoint(37.662093,55.750834), 16);
	var placemark = new YMaps.Placemark(new YMaps.GeoPoint(37.662093,55.750834));
	placemark.name = "SevenParts.ru";
	placemark.description = "Здесь Вы сможете забрать свои покупки!";
	map.addOverlay(placemark);
	placemark.openBalloon();
	</script>
</div>