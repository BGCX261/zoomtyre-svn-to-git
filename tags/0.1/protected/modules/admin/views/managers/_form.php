<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manager-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' =>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Поля отмеченные здёздочкой (<span class="required">*</span>) должны быть обязательно заполненны.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class='row'>
		<?php echo $form->labelEx($model,'username'); ?>
		<?php $this->widget('CAutoComplete', array(
				'name'=>get_class($model).'[username]',
				'url'=>array('managers/ajaxUsers'), 
				'max'=>10,
				'minChars'=>1, 
				'delay'=>500,
				'matchCase'=>false,
	 			'htmlOptions'=>array('size'=>60, 'maxlength'=>64),
				'mustMatch'=>true,
				'autoFill'=>true,
				'multiple'=>false,
				'value'=>$model->username,
		)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->textField($model,'priority',array('size'=>60,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php
		$this->widget('admin.widgets.upload.imageUpload', array(
			'model' => $model,
			'field' => 'avatar'
		));
		?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'online'); ?>
		<?php echo $form->textField($model,'online',array('size'=>60,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'online'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->