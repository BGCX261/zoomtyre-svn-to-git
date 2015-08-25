<?php
$this->breadcrumbs=array(
	'Контакты'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Обзор контактов', 'url'=>array('index')),
	array('label'=>'Добавить контакт', 'url'=>array('create')),
	array('label'=>'Обновить контакт', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить контакт', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить контакт?')),
	array('label'=>'Управление контактами', 'url'=>array('admin')),
);
?>

<h1>Подробнее о контакте #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'alias',
		'description_marked:html',
		'phone',
		'address',
		'email',
		'url',
		'created',
		array(
			'name'=>'map',
			'type'=>'raw',
			'value'=>$this->widget('ext.yandex.EYandexMaps', array(
				'model'=>$model,
				'x_field'=>'map_x',
				'y_field'=>'map_y',
				'key'=>Yii::app()->params['yandex_maps_api_key'],
				'options'=>array(
					'width'=>'745px',
					'editable'=>false
				),
			), true),
		),
	),
)); ?>
