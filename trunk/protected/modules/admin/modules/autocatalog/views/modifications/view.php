<?php
$this->breadcrumbs=array(
	'Modifications'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Управление', 'url'=>array('admin')),
#	array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Добавить', 'url'=>array('create')),
	array('label'=>'Обновить', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить эту запись?')),
);
?>

<h1>Просмотр модификации <?php echo $model->model->brand->title; ?> <?php echo $model->model->title; ?> <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'model_id',
			'value'=>$model->model->title,
		),
		'title',
		'alias',
		array(
			'name'=>'archive',
			'value'=>L::item('ArchiveStatus', $model->archive),
		),
		'manufacture_start',
		'manufacture_end',
		'description_marked:html',
	),
)); ?>
