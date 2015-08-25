<?php
$this->breadcrumbs=array(
	'Комментарии'=>array('index'),
	$model->id,
);

$this->menu=array(
	#array('label'=>'Обзор комментариев', 'url'=>array('index')),
	#array('label'=>'Добавить комментарий', 'url'=>array('create')),
	array('label'=>'Обновить комментарий', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить комментарий', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить комментарий?')),
	array('label'=>'Управление комментариями', 'url'=>array('admin')),
);
?>

<h1>Подробнее о комментарии #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'object_type',
			'value'=>L::ruitem('CommentType', $model->object_type),
		),
		array(
			'name'=>'parentTitle',
			'value'=>$model->object->title,
		),
		array(
			'name'=>'url',
			'type'=>'raw',
			'value'=>CHtml::link(@$model->object->url, @$model->object->url),
		),
		array(
			'name'=>'author',
			'type'=>'raw',
			'value'=>$model->author,
		),
		'text_marked:raw',
		array(
			'name'=>'created',
			'type'=>'text',
			'value'=>EString::getBackTime($model->created),
		),
		'rating',
		array(
			'name'=>'status',
			'value'=>L::ruitem('CommentStatus', $model->status),
		),
	),
));
?>
