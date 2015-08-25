<div class="form selection-widget disks">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id' => 'diskSelectionForm',
	'enableAjaxValidation'=>true,
	'action'=>$action,
)); ?>
	<div class="row prices">
		<label>Цена</label>
		от <?php echo $form->textField($diskSelection,'price_from'); ?> до <?php echo $form->textField($diskSelection,'price_until'); ?> руб.
		
		<?php echo $form->error($diskSelection,'price_until'); ?>		
		<?php echo $form->error($diskSelection,'price_from'); ?>
	</div>
	
	<div class="row producers">
		<label><b>Производители дисков</b> <i class='control'>все</i></label>
		<?php echo $form->checkBoxList($diskSelection,'producers', CHtml::listData(DiskProducers::model()->alphabetically()->with('disks.sizes:inSight')->findAll(), 'alias', 'title'), array('template'=>'<span>{input} {label}</span>', 'separator'=>'' )); ?>
		<?php echo $form->error($diskSelection,'producers'); ?>
		<div class='clear'></div>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($diskSelection,'width'); ?>
		<?php echo $form->dropDownList($diskSelection,'width', CHtml::listData(DiskSizes::model()->inSight()->findAll(array('group'=>'width')), 'width', 'width'), array( 'empty'=>'' )); ?>
		<?php echo $form->error($diskSelection,'width'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($diskSelection,'diameter'); ?>
		<?php echo $form->dropDownList($diskSelection,'diameter', CHtml::listData(DiskSizes::model()->inSight()->findAll(array('group'=>'diameter')), 'diameter', 'diameter'), array( 'empty'=>'' )); ?>
		<?php echo $form->error($diskSelection,'diameter'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($diskSelection,'PCD'); ?>
		<?php echo $form->dropDownList($diskSelection,'PCD', CHtml::listData(DiskSizes::model()->inSight()->findAll(array('select'=>'CONCAT(PCD_screws, "x", PCD_diameter) as PCD0', 'group'=>'PCD0')), 'PCD0', 'PCD0'), array( 'empty'=>'' )); ?>
		<?php echo $form->error($diskSelection,'PCD'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($diskSelection,'ET'); ?>
		<?php echo $form->dropDownList($diskSelection,'ET', CHtml::listData(DiskSizes::model()->inSight()->findAll(array('group'=>'ET')), 'ET', 'ET'), array( 'empty'=>'' )); ?>
		<?php echo $form->error($diskSelection,'ET'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Найти'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->