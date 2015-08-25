<?php
$this->breadcrumbs=array(
	'Кусты'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Добавить потомка', 'url'=>array('createNode', 'id'=>$model->id)),
	array('label'=>'Обновить лист', 'url'=>array('updateNode', 'id'=>$model->id)),
	array('label'=>'Удалить лист', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteNode','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить лист?')),
	array('label'=>'Управление кустами', 'url'=>array('admin')),
	array('label'=>'Куст ёлкой', 'url'=>array('tree', 'id'=>$root->id)),
	array('label'=>'Куст списком', 'url'=>array('list', 'id'=>$root->id)),
);
?>

<h1>Подробнее о потомке - <?php echo $model->title; ?></h1>

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
			'value' => $model->url?Yii::app()->request->hostInfo.$model->url:$model->url,
		),
		array(
			'name' => 'parent',
			'type' => 'html',
			'value' => CHtml::link($model->parent->title, array( $model->parent->lft!=1?'viewNode':'view', 'id'=>$model->parent->id )),
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
		'path:raw',
		'page_title',
		'page_description',
		'page_keywords',
	),
)); ?>
