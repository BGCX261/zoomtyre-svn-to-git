<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' =>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Поля отмеченные здёздочкой (<span class="required">*</span>) должны быть обязательно заполненны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'id'=>'title')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>60,'maxlength'=>255, 'id'=>'alias')); ?>
		<input type='button' value='Из названия' id='translitAlias' onclick='$("#alias").val(ru2en.translit($("#title").val().replace(/[^а-яa-z0-9-_\ ]+/ig,"")).replace(/[\ ]+/ig,"_"))' />
		<p class='hint'>Уникальный идентификатор</p>
		<?php echo $form->error($model,'alias'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php
		$this->widget('admin.widgets.upload.imageUpload', array(
			'model' => $model,
			'field' => 'photo',
			'defaultPreviewSize' => 'small',
		));
		?>
		<?php echo $form->error($model,'photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publicated'); ?>
		<?php 
		$this->widget('admin.widgets.timepicker.timepicker', array(
			'model'=>$model,
			'name'=>'publicated',
		));
		?>
		<?php echo $form->error($model,'publicated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'preamble'); ?>
		<?php
		$this->widget('ext.markitup.EMarkitUp', array(
			'model'=>$model,
			'name'=>'preamble',
		));
		?>
		<?php echo $form->error($model,'preamble'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php
		$this->widget('ext.markitup.EMarkitUp', array(
			'model'=>$model,
			'name'=>'text',
			'options'=>array(
				#'data'=>array('preid'=>$model->preid),
				'imageUpload'=>true,
				'imageUploadUrl'=>CHtml::normalizeUrl(array('articles/uploadImage')),
			),
		));
		?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'source'); ?>
		<?php echo $form->textField($model,'source',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'source'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'source_link'); ?>
		<?php echo $form->textField($model,'source_link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'source_link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', L::items('publicationStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->