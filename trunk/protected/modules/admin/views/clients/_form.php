<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'client-form',
	'enableAjaxValidation'=>false,
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
		<?php echo $form->labelEx($model,'card'); ?>
		<?php echo $form->textField($model,'card',array('size'=>60,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'card'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
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
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'discount'); ?>
		<?php echo $form->textField($model,'discount',array('size'=>60,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'discount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->