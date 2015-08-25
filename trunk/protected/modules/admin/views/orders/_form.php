<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные здёздочкой (<span class="required">*</span>) должны быть обязательно заполненны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<label>Номер заказа</label>
		<?php echo $model->id; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $model->created; ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'manager'); ?>
		<?php $this->widget('CAutoComplete', array(
				'name'=>get_class($model).'[manager]',
				'url'=>array('managers/ajaxManagers'), 
				'max'=>10,
				'minChars'=>1, 
				'delay'=>500,
				'matchCase'=>false,
	 			'htmlOptions'=>array('size'=>60, 'maxlength'=>64),
				'mustMatch'=>true,
				'autoFill'=>true,
				'multiple'=>false,
				'value'=>$model->manager?$model->manager:Yii::app()->user->name,
		)); ?>
		<?php echo $form->error($model,'manager'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', L::ruitems('orderStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order'); ?>
		<div class='input'>
			<?php $this->renderPartial('_order', array('model'=>$model,'order'=>CJSON::decode($model->order))); ?>
		</div>
		<?php echo $form->error($model,'order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->