<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modification_id'); ?>
		<?php echo $form->textField($model,'modification_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fuel_capacity'); ?>
		<?php echo $form->textField($model,'fuel_capacity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'body'); ?>
		<?php echo $form->textField($model,'body',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doors'); ?>
		<?php echo $form->textField($model,'doors'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'seats'); ?>
		<?php echo $form->textField($model,'seats',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weight_loaded'); ?>
		<?php echo $form->textField($model,'weight_loaded'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'top_speed_at'); ?>
		<?php echo $form->textField($model,'top_speed_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'acceleration_at'); ?>
		<?php echo $form->textField($model,'acceleration_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'top_speed_mt'); ?>
		<?php echo $form->textField($model,'top_speed_mt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'acceleration_mt'); ?>
		<?php echo $form->textField($model,'acceleration_mt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'turn_radius'); ?>
		<?php echo $form->textField($model,'turn_radius'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'trunk_capacity'); ?>
		<?php echo $form->textField($model,'trunk_capacity',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'length'); ?>
		<?php echo $form->textField($model,'length'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'width'); ?>
		<?php echo $form->textField($model,'width'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'height'); ?>
		<?php echo $form->textField($model,'height'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tyres_front'); ?>
		<?php echo $form->textField($model,'tyres_front'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tyres_rear'); ?>
		<?php echo $form->textField($model,'tyres_rear'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wheelbase'); ?>
		<?php echo $form->textField($model,'wheelbase'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'engine_type'); ?>
		<?php echo $form->textField($model,'engine_type',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'volume'); ?>
		<?php echo $form->textField($model,'volume'); ?>
	</div>

	<div class="row"> 
		<?php echo $form->label($model,'displacement'); ?>
		<?php echo $form->textField($model,'displacement',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cylinders'); ?>
		<?php echo $form->textField($model,'cylinders',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valves'); ?>
		<?php echo $form->textField($model,'valves'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_power'); ?>
		<?php echo $form->textField($model,'max_power'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_power_rpm'); ?>
		<?php echo $form->textField($model,'max_power_rpm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_torque'); ?>
		<?php echo $form->textField($model,'max_torque'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'max_torque_rpm'); ?>
		<?php echo $form->textField($model,'max_torque_rpm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transmission_at'); ?>
		<?php echo $form->textField($model,'transmission_at',array('size'=>45,'maxlength'=>45)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'gears_at'); ?>
		<?php echo $form->textField($model,'gears_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transmission_mt'); ?>
		<?php echo $form->textField($model,'transmission_mt',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gears_mt'); ?>
		<?php echo $form->textField($model,'gears_mt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drive'); ?>
		<?php echo $form->textField($model,'drive',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'suspension_front'); ?>
		<?php echo $form->textField($model,'suspension_front',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'suspension_rear'); ?>
		<?php echo $form->textField($model,'suspension_rear',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tyres_front'); ?>
		<?php echo $form->textField($model,'tyres_front',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tyres_rear'); ?>
		<?php echo $form->textField($model,'tyres_rear',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'brakes_front'); ?>
		<?php echo $form->textField($model,'brakes_front',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'brakes_rear'); ?>
		<?php echo $form->textField($model,'brakes_rear',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fuel_consumption_urban_at'); ?>
		<?php echo $form->textField($model,'fuel_consumption_urban_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fuel_consumption_country_at'); ?>
		<?php echo $form->textField($model,'fuel_consumption_country_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fuel_consumption_combined_at'); ?>
		<?php echo $form->textField($model,'fuel_consumption_combined_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fuel_consumption_urban_mt'); ?>
		<?php echo $form->textField($model,'fuel_consumption_urban_mt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fuel_consumption_country_mt'); ?>
		<?php echo $form->textField($model,'fuel_consumption_country_mt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fuel_consumption_combined_mt'); ?>
		<?php echo $form->textField($model,'fuel_consumption_combined_mt'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fuel_type'); ?>
		<?php echo $form->textField($model,'fuel_type',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Искать'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->