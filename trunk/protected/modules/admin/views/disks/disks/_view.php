<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('producer_id')); ?>:</b>
	<?php echo CHtml::encode($data->producer->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alias')); ?>:</b>
	<?php echo CHtml::encode($data->alias); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('photo')); ?>:</b>
	<?php echo CHtml::image(Image::getFile($data->photo, 'small')); ?>
	<br />
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description_marked')); ?>:</b>
	<?php echo CHtml::encode($data->description_marked); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('new')); ?>:</b>
	<?php echo CHtml::encode($data->new); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale')); ?>:</b>
	<?php echo CHtml::encode($data->sale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('construction_type')); ?>:</b>
	<?php echo CHtml::encode($data->construction_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('color')); ?>:</b>
	<?php echo CHtml::encode($data->color); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('model_id')); ?>:</b>
	<?php echo CHtml::encode($data->model_id); ?>
	<br />

	*/ ?>

</div>