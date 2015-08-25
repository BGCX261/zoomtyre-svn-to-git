<div class='input' id='<?php echo $this->id; ?>'>
	<?php echo CHtml::activeFileField($this->model, $this->field, array('id'=>$this->id.$this->field)); ?>
	<?php if($this->allowDelete && !empty($this->model->{$this->field})): ?>
	<input type='button' value='Удалить' onclick='$("#<?php echo CHtml::ID_PREFIX; ?><?php echo $this->id.$this->field; ?>").val("delete");$("#img<?php echo $this->id.$this->field; ?>").remove();'>
	<?php endif; ?>
	<?php if(!empty($this->model->{$this->field})): ?>
	<p><?php echo CHtml::image( Image::getFile($this->model->{$this->field}, $this->defaultPreviewSize), '', array('id'=>'img'.$this->id.$this->field)); ?></p>
	<?php endif; ?>
</div>