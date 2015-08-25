<?php
$this->breadcrumbs=array(
	'Characteristics'=>array('index'),
	'Manage',
);

$this->menu=array(
	#array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Добавить', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('characteristic-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление характеристиками</h1>

<p class="hint">
Можно использовать операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) в начале запроса.
</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'characteristic-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'brandTitle',
			'value'=>'$data->modification->model->brand->title',
		),
		array(
			'name'=>'modelTitle',
			'value'=>'$data->modification->model->title',
		),
		array(
			'name'=>'modificationTitle',
			'value'=>'$data->modification->title',
		),
		array(
			'name'=>'body',
			'value'=>'L::item(\'BodyTypes\', $data->body)',
			'filter'=>L::items('BodyTypes'),
		),
		/*
		'fuel_capacity',
		'doors',
		'seats',
		'weight',
		'weight_loaded',
		'drag_coefficient',
		'top_speed',
		'acceleration',
		'turn_radius',
		'trunk_capacity',
		'length',
		'width',
		'height',
		'track_front',
		'track_rear',
		'wheelbase',
		'engine_type',
		'volume',
		'displacement',
		'compression_ratio',
		'cylinders',
		'valves',
		'max_power',
		'max_power_rpm',
		'max_torque',
		'max_torque_rpm',
		'transmission',
		'drive',
		'suspension_front',
		'suspension_rear',
		'tyres_front',
		'tyres_rear',
		'brakes_front',
		'brakes_rear',
		'fuel_consumption_urban',
		'fuel_consumption_country',
		'fuel_consumption_combined',
		'fuel_type',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
