<?php
/*
$this->breadcrumbs=array(
	'Characteristics'=>array('index'),
	$model->name,
);
*/

$this->menu=array(
	array('label'=>'Управление', 'url'=>array('admin')),
#	array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Добавить', 'url'=>array('create')),
	array('label'=>'Обновить', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить эту запись?')),
);
?>

<h1>Просмотр характеристик <?php echo $model->modification->model->brand->title; ?> <?php echo $model->modification->model->title; ?> <?php echo $model->modification->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'bandTitle',
			'value'=>$model->modification->model->brand->title,
		),
		array(
			'name'=>'modelTitle',
			'value'=>$model->modification->model->title,
		),
		array(
			'name'=>'modificationTitle',
			'value'=>$model->modification->title,
		),
		'fuel_capacity',
		'body',
		'doors',
		'seats',
		'weight',
		'weight_loaded',
		'top_speed_mt',
		'acceleration_mt',
		'acceleration_at',
		'top_speed_at',
		'turn_radius',
		'trunk_capacity',
		'length',
		'width',
		'height',
		'wheelbase',
		'engine_type',
		'volume',
		'displacement',
		'cylinders',
		'valves',
		'max_power',
		'max_power_rpm',
		'max_torque',
		'max_torque_rpm',
		'transmission_at',
		'transmission_mt',
		'drive',
		'suspension_front',
		'suspension_rear',
		'tyres_front',
		'tyres_rear',
		'disks_front',
		'disks_rear',
		'brakes_front',
		'brakes_rear',
		'fuel_consumption_urban_at',
		'fuel_consumption_country_at',
		'fuel_consumption_combined_at',
		
		'fuel_consumption_urban_mt',
		'fuel_consumption_country_mt',
		'fuel_consumption_combined_mt',

		'fuel_type',
	),
)); ?>
