<?php
$this->breadcrumbs=array(
	'Кусты'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Добавить корневой элемент', 'url'=>array('create')),
	array('label'=>'Добавить потомка', 'url'=>array('createNode', 'id'=>$model->id)),
	array('label'=>'Обновить корневой элемент', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить куст', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить куст?')),
	array('label'=>'Управление кустами', 'url'=>array('admin')),
	array('label'=>'Куст ёлкой', 'url'=>array('tree', 'id'=>$model->id)),
	array('label'=>'Куст списком', 'url'=>array('list', 'id'=>$model->id)),
);
?>

<h1>Подробнее о кусте #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'level',
		'title',
		'alias',
		array(
			'name' => 'url',
			'type' => 'url',
			'value' => Yii::app()->request->hostInfo.$model->url,
		),
		array(
			'name'=>'main',
			'value' => L::item('boolean', $model->main),
		),
		array(
			'name'=>'visible',
			'value' => L::item('boolean', $model->visible),
		),
		'htmlOptions',
		'template',
		#'path:raw',
		'page_title',
		'page_description',
		'page_keywords',
	),
)); ?>
