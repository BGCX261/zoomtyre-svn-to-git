<div id='<?php echo $this->id; ?>'>
	<?php if(!empty($options['preview'])): ?>
	<div class='row'>
		<?php echo CHtml::activeLabelEx($model,$name); ?>
		<?php echo CHtml::image($options['preview']); ?>
		<?php echo CHtml::activeHiddenField($model,$name); ?>
		<?php echo CHtml::error($model,$name); ?>
	</div>
	<?php endif; ?>
	<?php if($options['allowDelete'] && !empty($options['preview'])): ?>
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,$options['deleteField']); ?>
		<?php echo CHtml::activeCheckBox($model,$options['deleteField']); ?>
		<?php echo CHtml::error($model,$options['deleteField']); ?>
	</div>
	<?php endif; ?>
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,$options['fileField']); ?>
		<?php echo CHtml::activeFileField($model,$options['fileField']); ?>
		<?php echo CHtml::error($model,$options['fileField']); ?>
		<?php echo CHtml::error($model,$name); ?>
	</div>
</div>