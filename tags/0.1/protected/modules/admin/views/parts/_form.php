<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'part-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные здёздочкой (<span class="required">*</span>) должны быть обязательно заполненны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'alias'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url_part'); ?>
		<?php echo $form->textField($model,'url_part',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url_part'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'main'); ?>
		<?php echo $form->dropDownList($model,'main', L::items('boolean')); ?>
		<?php echo $form->error($model,'main'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visible'); ?>
		<?php echo $form->dropDownList($model,'visible', L::items('boolean')); ?>
		<?php echo $form->error($model,'visible'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'htmlOptions'); ?>
		<?php echo $form->textField($model,'htmlOptions',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'htmlOptions'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'template'); ?>
		<?php echo $form->textField($model,'template',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'template'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_title'); ?>
		<?php echo $form->textArea($model,'page_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'page_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_description'); ?>
		<?php echo $form->textArea($model,'page_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'page_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_keywords'); ?>
		<?php echo $form->textArea($model,'page_keywords',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'page_keywords'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->