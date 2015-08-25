<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'authitem-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array( 'enctype'=>'multipart/form-data' ),
)); ?>

	<p class="hint">Поля с <span class="required">*</span> обязательны для заполнения.</p>
	
	<?php echo $form->errorSummary($model); ?>
	
	<?php if(!$update): ?>
		<div class="row">
			<?php echo $form->labelEx($model,'name'); ?>
			<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
			<?php echo $form->error($model,'name'); ?>
		</div>
		<?php echo $form->hiddenField($item_child, 'parent', array('value'=>$parent->name)); ?>
	<?php endif; ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', L::items('AuthItemType')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model, 'description', array('cols'=>60, 'rows'=>8)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'bizrule'); ?>
		<?php echo $form->textArea($model, 'bizrule', array('cols'=>60, 'rows'=>8)); ?>
		<?php echo $form->error($model,'bizrule'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo $form->textArea($model, 'data', array('cols'=>60, 'rows'=>8)); ?>
		<?php echo $form->error($model,'data'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>