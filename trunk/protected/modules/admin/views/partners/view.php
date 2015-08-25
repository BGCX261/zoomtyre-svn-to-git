<?php
$this->breadcrumbs=array(
	'Партнёры'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Обзор партнёров', 'url'=>array('index')),
	array('label'=>'Добавить партнёра', 'url'=>array('create')),
	array('label'=>'Обновить партнёра', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить партнёра', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить партнёра?')),
	array('label'=>'Управление партнёрами', 'url'=>array('admin')),
);
?>

<h1>Подробнее о партнёре #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'alias',
		array(
			'name'=>'type',
			'value'=>L::item('partnerType', $model->type),
		),
		array(
			'name'=>'username',
			'type'=>'html',
			'value'=>CHtml::link($model->username, array('users/view', 'id'=>$model->username)),
		),
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
