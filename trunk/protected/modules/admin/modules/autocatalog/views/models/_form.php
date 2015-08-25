<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'car-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array( 'enctype'=>'multipart/form-data' ),
)); ?>

	<p class="hint">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<!-- Выбор бренда -->
	<?php $this->widget('autocatalog.extensions.catalog.ECatalog', array(
		'model'=>$model,
		'name'=>'brand_id',
		'options'=>array(
			'select'=>'Brand',
		)
	));?>
	<!-- /Выбор бренда -->

	<div class="row">
		<?php echo $form->labelEx($model,'archive'); ?>
		<?php echo $form->dropDownList($model,'archive', L::items('ArchiveStatus')); ?>
		<?php echo $form->error($model,'archive'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'concept'); ?>
		<?php echo $form->checkBox($model,'concept'); ?>
		<?php echo $form->error($model,'concept'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'alias'); ?>
	</div>

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