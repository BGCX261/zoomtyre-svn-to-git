<div class='row' id='<?php echo $this->id; ?>'>
	<lable><?php echo CHtml::activeLabelEx($model, $name); ?></label>
	<div class='input'>
		<div id='<?php echo $this->id; ?>_brand'>
			<label for='brand_id'><?php echo Car::model()->getAttributeLabel('brand_id'); ?></label><br />
			<?php echo CHtml::dropDownList(get_class($model).'[brand_id]','',array()); ?>
			<img src='/images/loader.gif' class='loader' style='display: none;'>
		</div>
		<?php if($options['select'] != 'Brand' ): ?>
		
		<div id='<?php echo $this->id; ?>_model' style='display: none;'>
			<label for='model_id'><?php echo Modification::model()->getAttributeLabel('model_id'); ?></label><br />
			<?php echo CHtml::dropDownList(get_class($model).'[model_id]','',array()); ?>
			<img src='/images/loader.gif' class='loader' style='display: none;'>
		</div>
		
		<?php endif; ?>

		<?php if($options['select'] != 'Brand' && $options['select'] != 'Car'): ?>
		
		<div id='<?php echo $this->id; ?>_modification' style='display: none;'>
			<label for='model_id'><?php echo Characteristic::model()->getAttributeLabel('modification_id'); ?></label><br />
			<?php echo CHtml::dropDownList(get_class($model).'[modification_id]','',array()); ?>
			<img src='/images/loader.gif' class='loader' style='display: none;'>
		</div>
		
		<?php endif ;?>
	
		<?php 	
		Yii::app()->getClientScript()->registerScript(
			$this->id,
			"jQuery('#{$this->id}').catalogSelect({
				id:'{$this->id}', 
				model_id:'".($model->{$name})."', 
				select: '".EString::strtolower($options['select'])."',
				model:'{$options['select']}',
				brandSelect: $('#".get_class($model)."_brand_id'),
				modelSelect: $('#".get_class($model)."_model_id'),
				modificationSelect: $('#".get_class($model)."_modification_id'),
				urlCatalog: '{$options['urlCatalog']}',
				urlBrand: '{$options['urlBrand']}',
				urlModel: '{$options['urlModel']}',
				allowEmpty: ".($options['allowEmpty']?'true':'false')."
			});"
		);
		?>
	</div>
	<?php echo CHtml::error($model, $name); ?>
</div>