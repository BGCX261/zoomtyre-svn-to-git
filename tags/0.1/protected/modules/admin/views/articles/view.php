<?php
$this->breadcrumbs=array(
	'Статьи'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Обзор статей', 'url'=>array('index')),
	array('label'=>'Добавить статью', 'url'=>array('create')),
	array('label'=>'Обновить статью', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить статью', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить статью?')),
	array('label'=>'Управление статьями', 'url'=>array('admin')),
);
?>

<h1>Подробнее о статье #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'status',
			'value'=>L::item('publicationStatus', $model->status),
		),
		'title',
		'alias',
		array(
			'name'=>'url',
			'type'=>'html',
			'value'=>CHtml::link($model->url, $model->url),
		),
		array(
			'name'=>'photo',
			'type'=>'image',
			'value'=>Image::getFile($model->photo, 'normal'),
		),
		'author',
		'publicated',
		'preamble_marked:html',
		'text_marked:html',
		'source',
		'source_link',
	),
)); ?>
