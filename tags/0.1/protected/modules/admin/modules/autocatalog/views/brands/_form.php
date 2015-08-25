<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'brand-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array( 'enctype'=>'multipart/form-data' ),
)); ?>

	<p class="hint">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'alias'); ?>
	</div>
	
	<?php 
	$this->widget('ext.uploader.uploader', array(
		'model'=>$model,
		'name'=>'logo',
		'options'=>array(
			'skin'=>'simple',
			'allowDelete'=>false,
			'preview'=>Image::getFile($model->logo,'normal'),
		),
	));
	?>

	<div class="row">
		<?php echo $form->labelEx($model,'archive'); ?>
		<?php echo $form->dropDownList($model,'archive', L::items('ArchiveStatus')); ?>
		<?php echo $form->error($model,'archive'); ?>
	</div>
	
	<!--  
	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>
	-->

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php
			$this->widget('ext.markitup.EMarkitUp', array(
				'id'=>'description',
				'model'=>$model,
				'name'=>'description',
				'options'=>array(
					'set'=>'markdown',
				),
			));
		?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->