<div class="form selection-widget tyres">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'tyreSelectionForm',
	'enableAjaxValidation'=>true,
	'action'=>$action,
)); ?>

	<div class="row prices">
		<label>Цена</label>
		от <?php echo $form->textField($tyreSelection,'price_from'); ?> до <?php echo $form->textField($tyreSelection,'price_until'); ?> руб.
		
		<?php echo $form->error($tyreSelection,'price_until'); ?>		
		<?php echo $form->error($tyreSelection,'price_from'); ?>
	</div>

	<div class="row producers">
		<label><b>Производители шин</b> <i class='control'>все</i></label>
		<?php echo $form->checkBoxList($tyreSelection,'producers', CHtml::listData(TyreProducers::model()->alphabetically()->with('tyres.sizes:inSight')->findAll(), 'alias', 'title'), array('template'=>'<span>{input} {label}</span>', 'separator'=>'' )); ?>
		<?php echo $form->error($tyreSelection,'producers'); ?>
		<div class='clear'></div>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($tyreSelection,'width'); ?>
		<?php echo $form->dropDownList($tyreSelection,'width', CHtml::listData(TyreSizes::model()->inSight()->findAll(array('group'=>'width')), 'width', 'width'), array( 'empty'=>'' )); ?>
		<?php echo $form->error($tyreSelection,'width'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($tyreSelection,'height'); ?>
		<?php echo $form->dropDownList($tyreSelection,'height', CHtml::listData(TyreSizes::model()->inSight()->findAll(array('group'=>'height')), 'height', 'height'), array( 'empty'=>'' )); ?>
		<?php echo $form->error($tyreSelection,'height'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($tyreSelection,'diameter'); ?>
		<?php echo $form->dropDownList($tyreSelection,'diameter', CHtml::listData(TyreSizes::model()->inSight()->findAll(array('group'=>'diameter')), 'diameter', 'diameter'), array( 'empty'=>'' )); ?>
		<?php echo $form->error($tyreSelection,'diameter'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($tyreSelection,'season'); ?>
		<?php echo $form->dropDownList($tyreSelection,'season', L::ruitems('tyreSeason'), array( 'empty'=>'Неважно' )); ?>
		<?php echo $form->error($tyreSelection,'season'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($tyreSelection,'puncture'); ?>
		<?php echo $form->dropDownList($tyreSelection,'puncture', L::ruitems('boolean'), array('empty'=>'Неважно')); ?>
		<?php echo $form->error($tyreSelection,'puncture'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Найти'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->