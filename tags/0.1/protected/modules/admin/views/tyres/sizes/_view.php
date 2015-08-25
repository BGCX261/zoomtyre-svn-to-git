<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tyre_id')); ?>:</b>
	<?php echo CHtml::encode($data->tyre->producer->title.' '.$data->tyre->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tyre_size')); ?>:</b>
	<?php echo CHtml::encode($data->width.'/'.$data->height.' R'.$data->diameter.' '.$data->load_index.$data->speed_rating); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('height')); ?>:</b>
	<?php echo CHtml::encode($data->height); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('diameter')); ?>:</b>
	<?php echo CHtml::encode($data->diameter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('load_index')); ?>:</b>
	<?php echo CHtml::encode($data->load_index); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('speed_rating')); ?>:</b>
	<?php echo CHtml::encode($data->speed_rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount')); ?>:</b>
	<?php echo CHtml::encode($data->discount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount_max')); ?>:</b>
	<?php echo CHtml::encode($data->discount_max); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rest')); ?>:</b>
	<?php echo CHtml::encode($data->rest); ?>
	<br />

	*/ ?>

</div>