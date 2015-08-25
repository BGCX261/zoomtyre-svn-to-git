<?php
$this->breadcrumbs=array(
	'Cars'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Управление', 'url'=>array('admin')),
	#array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Добавить', 'url'=>array('create')),
	array('label'=>'Обновить', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить эту запись?')),
);
?>

<h1>Просмотр модели - <?php echo $model->brand->title; ?> <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'brand_id',
			'value'=>$model->brand->title,
		),
		array(
			'name'=>'archive',
			'value'=>L::item('ArchiveStatus', $model->archive),
		),
		'title',
		'alias',
		'description_marked:html',
	),
)); ?>
