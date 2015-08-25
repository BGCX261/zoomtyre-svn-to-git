<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'producer'); ?>
		<?php echo $form->dropDownList($model,'producer', CHtml::listData( TyreProducers::model()->findAll(), 'id', 'title')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'width'); ?>
		<?php echo $form->textField($model,'width',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'diameter'); ?>
		<?php echo $form->textField($model,'diameter',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PCD_screws'); ?>
		<?php echo $form->textField($model,'PCD_screws',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PCD_diameter'); ?>
		<?php echo $form->textField($model,'PCD_diameter',array('size'=>3,'maxlength'=>3)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'ET'); ?>
		<?php echo $form->textField($model,'ET',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DIA'); ?>
		<?php echo $form->textField($model,'DIA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rest'); ?>
		<?php echo $form->textField($model,'rest',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Искать'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->