<?php
$this->pageTitle=Yii::app()->name . ' - Редактирование профиля';
$this->breadcrumbs=array(
	'Редактирование профиля',
);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' =>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Поля отмеченные здёздочкой (<span class="required">*</span>) должны быть обязательно заполненны.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'email'); ?>
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
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php
		$this->widget('widgets.timepicker.timepicker', array(
			'id'=>'birthday',
			'model'=>$model,
			'name'=>'birthday',
			'select'=>'date',
			'options'=>array(
				'changeMonth'=>true,
				'changeYear'=>true,
			),
		));
		?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<div class='input'>
			<?php echo $form->radioButtonList($model,'gender', L::ruitems('gender')); ?>
		</div>
		<?php echo $form->error($model,'gender'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->client,'phone'); ?>
		<?php echo $form->textField($model->client,'phone',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model->client,'phone'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->client,'city'); ?>
		<?php echo $form->textField($model->client,'city',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model->client,'city'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model->client,'address'); ?>
		<?php echo $form->textArea($model->client,'address',array('cols'=>45,'rows'=>8)); ?>
		<?php echo $form->error($model->client,'address'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'password_confirm'); ?>
		<?php echo $form->passwordField($model,'password_confirm',array('size'=>45,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->