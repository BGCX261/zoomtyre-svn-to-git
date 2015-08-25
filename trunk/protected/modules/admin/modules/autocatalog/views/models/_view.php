<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('brand_id')); ?>:</b>
	<?php echo CHtml::encode($data->brand->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('archive')); ?>:</b>
	<?php echo CHtml::encode(L::item('ArchiveStatus', $data->archive)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('classmate_id')); ?>:</b>
	<?php echo CHtml::encode($data->class->title); ?>
	<br />

	<?php /*
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('alias')); ?>:</b>
	<?php echo CHtml::encode($data->alias); ?>
	<br />
	
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manufacture_start')); ?>:</b>
	<?php echo CHtml::encode($data->manufacture_start); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manufacture_end')); ?>:</b>
	<?php echo CHtml::encode($data->manufacture_end); ?>
	<br />

	*/ ?>

</div>