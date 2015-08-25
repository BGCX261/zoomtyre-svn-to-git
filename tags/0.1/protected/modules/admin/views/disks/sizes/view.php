<?php
$this->breadcrumbs=array(
	'Типоразмеры'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Обзор типоразмеров', 'url'=>array('index')),
	array('label'=>'Добавить типоразмер', 'url'=>array('create')),
	array('label'=>'Обновить типоразмер', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить типоразмер', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить типоразмер?')),
	array('label'=>'Управление типоразмерами', 'url'=>array('admin')),
);
?>

<h1>Подробнее о типоразмере #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'producer',
			'type'=>'html',
			'value'=>CHtml::link($model->disk->producer->title, array('disks/producers/view', 'id'=>$model->disk->producer->id)),
		),
		array(
			'name'=>'disk_id',
			'type'=>'html',
			'value'=>CHtml::link($model->disk->title, array('disks/disks/view', 'id'=>$model->disk->id)),
		),
		'code',
		array(
			'name'=>'size',
			'value'=>$model->size
		),
		'price',
		'rest',
	),
)); ?>
