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
		<?php echo $form->label($model,'producer_id'); ?>
		<?php echo $form->dropDownList($model,'producer_id', CHtml::listData( DiskProducers::model()->findAll(), 'id', 'title' )); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description', array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'new'); ?>
		<?php echo $form->dropDownList($model,'new', L::ruitems('boolean'), array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sale'); ?>
		<?php echo $form->dropDownList($model,'sale', L::ruitems('boolean'), array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'construction_type'); ?>
		<?php echo $form->dropDownList($model,'construction_type', L::items('diskConstructionType'), array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'color'); ?>
		<?php echo $form->dropDownList($model,'color', L::items('color'), array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'model_id'); ?>
		<?php echo $form->textField($model,'model_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Искать'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->