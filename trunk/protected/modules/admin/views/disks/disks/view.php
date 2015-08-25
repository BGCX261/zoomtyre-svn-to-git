<?php
$this->breadcrumbs=array(
	'Диски'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Обзор дисков', 'url'=>array('index')),
	array('label'=>'Добавить диск', 'url'=>array('create')),
	array('label'=>'Обновить диск', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить диск', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить диск?')),
	array('label'=>'Управление дисками', 'url'=>array('admin')),
);
?>

<h1>Подробнее о диске #<?php echo $model->id; ?></h1>

<?php 
Yii::import('autocatalog.models.*');

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'producer_id',
			'type'=>'html',
			'value'=>CHtml::link($model->producer->title, array( 'disks/producers/view', 'id'=>$model->producer_id)),
		),
		'title',
		'alias',
		array(
			'name'=>'photo',
			'type'=>'image',
			'value'=>Image::getFile($model->photo, 'big'),
		),
		'description_marked:html',
		array(
			'name'=>'new',
			'value'=>L::ruitem('boolean', $model->new),
		),
		array(
			'name'=>'sale',
			'value'=>L::ruitem('boolean', $model->sale),
		),
		array(
			'name'=>'construction_type',
			'value'=>L::item('diskConstructionType', $model->construction_type),
		),
		array(
			'name'=>'color',
			'value'=>L::item('color', $model->color),
		),
		array(
			'name'=>'model_id',
			'type'=>'html',
			'value'=>$model->model?CHtml::link($model->model->title, array('autocatalog/models/view', 'id'=>$model->model_id)):null,
		),
		array(
			'name'=>'sizes',
			'type'=>'html',
			'value'=>$this->renderPartial('_sizes', array('sizes'=>$model->sizes), true),
		),
	),
)); ?>
