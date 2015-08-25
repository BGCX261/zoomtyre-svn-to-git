<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'disk-sizes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные здёздочкой (<span class="required">*</span>) должны быть обязательно заполненны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php Yii::app()->clientScript->registerScriptFile( $this->assets.'/js/jquery.selectboxes.min.js' ); ?>
		<?php echo $form->labelEx($model,'disk_id'); ?>
		<div class='input'>
			<div>Производитель<br />
			<?php 
			echo CHtml::dropDownList(null, $model->isNewRecord?null:$model->disk->producer_id , CHtml::listData(DiskProducers::model()->findAll(), 'id', 'title'), 
					array(
						'id'=>'diskProducersList',
						'ajax'=>array(
							'url'=>CHtml::normalizeUrl(array('disks/sizes/ajaxDisks')),
							'dataType'=>'json',
							'data'=>'js:"producer_id="+$(this).val()',
							'success'=>'function(data){ jQuery(\'#'.get_class($model).'_disk_id\').html("").addOption(data, false); }',
						),
			)); ?>
			</div>
			<div>Диск<br />
			<?php echo $form->dropDownList($model, 'disk_id', $model->isNewRecord?array():CHtml::listData(Disk::model()->findAll('producer_id='.$model->disk->producer_id), 'id', 'title') ); ?>
			</div>
			<?php 
			if($model->isNewRecord)
 				Yii::app()->clientScript->registerScript(get_class($model).'#diskProducersList', '$("#'.get_class($model).'_disk_id").ajaxAddOption("'.CHtml::normalizeUrl(array('disks/sizes/ajaxDisks')).'", {producer_id: $("#diskProducersList").val()});');
			?>
		</div>
		<?php echo $form->error($model,'disk_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>45,'maxlength'=>45)); ?>
		<p class='hint'>Уникальный идентификатор</p>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diameter'); ?>
		<?php echo $form->textField($model,'diameter',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'diameter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ET'); ?>
		<?php echo $form->textField($model,'ET',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ET'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'DIA'); ?>
		<?php echo $form->textField($model,'DIA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'DIA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PCD_screws'); ?>
		<?php echo $form->textField($model,'PCD_screws',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'PCD_screws'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PCD_diameter'); ?>
		<?php echo $form->textField($model,'PCD_diameter',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'PCD_diameter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rest'); ?>
		<?php echo $form->textField($model,'rest',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'rest'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->