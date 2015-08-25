<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'modification-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="hint">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<!-- Выбор модели -->
	<?php $this->widget('autocatalog.extensions.catalog.ECatalog', array(
		'model'=>$model,
		'name'=>'model_id',
		'options'=>array(
			'select'=>'Car',
		)
	));?>
	<!-- /Выбор модели -->

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

	<div class="row">
		<?php echo $form->labelEx($model,'archive'); ?>
		<?php echo $form->dropDownList($model,'archive', L::items('ArchiveStatus')); ?>
		<?php echo $form->error($model,'archive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manufacture_start'); ?>
		<?php
		$this->widget('ext.timepicker.ETimePicker', array(
			'id'=>'manufacture_start',
			'model'=>$model,
			'name'=>'manufacture_start',
			'options'=>array(
				'duration'=>'',
				'showTime'=>false,
				'dateFormat'=>'yy-mm-dd',
				'firstDay' => 1,
				'showOn'=>'button',
				'changeMonth'=>true,
				'changeYear'=>true,
			),
		));
		?>
		<?php echo $form->error($model,'manufacture_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manufacture_end'); ?>
		<?php
		$this->widget('ext.timepicker.ETimePicker', array(
			'id'=>'manufacture_end',
			'model'=>$model,
			'name'=>'manufacture_end',
			'options'=>array(
				'duration'=>'',
				'showTime'=>false,
				'dateFormat'=>'yy-mm-dd',
				'firstDay' => 1,
				'showOn'=>'button',
				'changeMonth'=>true,
				'changeYear'=>true,
			),
		));
		?>
		<?php echo $form->error($model,'manufacture_end'); ?>
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