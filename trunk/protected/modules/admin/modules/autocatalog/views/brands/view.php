<?php
$this->breadcrumbs=array(
	'Brands'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Управление', 'url'=>array('admin')),
	#array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Добавить', 'url'=>array('create')),
	array('label'=>'Подробнее', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Обновить', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить эту запись?')),
);
?>

<h1>Просмотр бренда <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'alias',
		array(
			'name'=>'logo',
			'type'=>'image',
			'value'=>Image::getFile($model->logo, 'big')
		),
		array(
			'name'=>'archive',
			'value'=>L::item('ArchiveStatus', $model->archive),
		),
		'country',
		'description_marked:html',
	),
)); ?>
