<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'disk-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' =>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Поля отмеченные здёздочкой (<span class="required">*</span>) должны быть обязательно заполненны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'producer_id'); ?>
		<?php echo $form->dropDownList($model,'producer_id', CHtml::listData( DiskProducers::model()->findAll(), 'id', 'title' ) ); ?>
		<?php echo $form->error($model,'producer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>45,'maxlength'=>45)); ?>
		<p class='hint'>Уникальный идентификатор.</p>
		<?php echo $form->error($model,'alias'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'photo'); ?>
		<?php
		$this->widget('admin.widgets.upload.imageUpload', array(
			'model' => $model,
			'field' => 'photo',
		));
		?>
		<?php echo $form->error($model,'photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php
		$this->widget('ext.markitup.EMarkitUp', array(
			'model'=>$model,
			'name'=>'description',
		));
		?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'new'); ?>
		<?php echo $form->checkBox($model,'new'); ?>
		<?php echo $form->error($model,'new'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sale'); ?>
		<?php echo $form->checkBox($model,'sale'); ?>
		<?php echo $form->error($model,'sale'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'construction_type'); ?>
		<?php echo $form->dropDownList($model,'construction_type', L::ruitems('diskConstructionType')); ?>
		<?php echo $form->error($model,'construction_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'color'); ?>
		<?php echo $form->dropDownList($model,'color', L::items('color')); ?>
		<?php echo $form->error($model,'color'); ?>
	</div>

	<!-- Выбор модели -->
	<?php $this->widget('autocatalog.extensions.catalog.ECatalog', array(
		'model'=>$model,
		'name'=>'model_id',
		'options'=>array(
			'select'=>'Car',
			'allowEmpty'=>true,
			'urlCatalog'=>CHtml::normalizeUrl(array('autocatalog/default/ajaxCatalog')),
			'urlBrand'=>CHtml::normalizeUrl(array('autocatalog/default/ajaxBrand')),
			'urlModel'=>CHtml::normalizeUrl(array('autocatalog/default/ajaxModel')),
		)
	));?>
	<!-- /Выбор модели -->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->