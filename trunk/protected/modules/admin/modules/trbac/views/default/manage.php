<?php
$this->menu=array(
	array('label'=>'Обзор элементов авторизации', 'url'=>array('index')),
	array('label'=>'Просмотр', 'url'=>array('view', 'name'=>$item->name)),
	array('label'=>'Редактировать элемент авторизации', 'url'=>array('update', 'name'=>$item->name)),
);
?>

<h1>Управление пользователями #<?php echo $item->name; ?></h1>

<?php if(!empty($assigned)): ?>
<div class="form">
	<p class="hint">Отметьте для удаления.</p>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'authassignment-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array( 'enctype'=>'multipart/form-data' ),
)); ?>

	<?php echo CHtml::hiddenField('delete_AuthAssignment', true);?>
	<?php foreach($assigned as $i=>$user): ?>
	<span>
		<?php echo $form->checkBox($user, '['.$i.']_delete'); ?>
		<?php echo $form->hiddenField($user, '['.$i.']userid'); ?>
		<?php echo $user->userid; ?>
	</span>
	<?php endforeach;?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Удалить'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
<?php endif; ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'authassignment-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array( 'enctype'=>'multipart/form-data' ),
)); ?>

	<p class="hint">Поля с <span class="required">*</span> обязательны для заполнения.</p>
	
	<?php echo $form->errorSummary($model); ?>
	
	<div class='row'>
		<?php echo $form->labelEx($model,'userid'); ?>
		<?php $this->widget('CAutoComplete', array(
				'name'=>get_class($model).'[userid]',
				'url'=>array('AutoCompleteLookup'), 
				'max'=>10,
				'minChars'=>1, 
				'delay'=>500,
				'matchCase'=>false,
	 			'htmlOptions'=>array('size'=>60, 'maxlength'=>64),
				#'mustMatch'=>true,
				'autoFill'=>true,
				'multiple'=>false,
		)); ?>
		<?php echo $form->error($model,'userid'); ?>
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