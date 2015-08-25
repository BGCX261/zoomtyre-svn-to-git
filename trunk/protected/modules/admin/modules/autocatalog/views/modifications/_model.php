<fieldset id='<?php echo $this->id; ?>'>
	<legend>Выбор модели *</legend>
	<?php echo $form->error($model,'model_id'); ?>
	<div class='row' id='<?php echo $this->id; ?>_brand'>
		<label for='brand_id'><?php echo Family::model()->getAttributeLabel('brand_id'); ?></label>
		<?php echo CHtml::dropDownList('brand_id','',array()); ?>
		<img src='/images/loader.gif' class='loader' style='display: none;'>
	</div>
	
	<div class='row' id='<?php echo $this->id; ?>_model' style='display: none;'>
		<label for='model_id'><?php echo Modification::model()->getAttributeLabel('model_id'); ?></label>
		<?php echo CHtml::dropDownList('Modification[model_id]','',array()); ?>
		<img src='/images/loader.gif' class='loader' style='display: none;'>
	</div>
	
	<div class='row' id='<?php echo $this->id; ?>_modification' style='display: none;'>
		<label for='modification_id'><?php echo Characteristic::model()->getAttributeLabel('modification_id'); ?></label>
		<?php echo CHtml::dropDownList('modification_id','', array()); ?>
		<img src='/images/loader.gif' class='loader' style='display: none;'>
	</div>
	
	<div class="errorMessage" style='display: none;'>Данных нет!</div>
</fieldset>
<?php 	
Yii::app()->getClientScript()->registerScript(
	$this->id,
	"jQuery('#{$this->id}').catalogSelect({id:'{$this->id}', model_id:'{$model->id}', select: 'model', modelSelect: $('#Modification_model_id')});"
);
?>