<?php
$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Обновить заказ', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить заказ', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить заказ?')),
	array('label'=>'Управление заказами', 'url'=>array('index')),
);
?>

<h1>Подробнее о заказе #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created',
		'status',
		array(
			'name'=>'order',
			'type'=>'raw',
			'value'=> $this->renderPartial('_order', array('model'=>$model,'order'=>CJSON::decode($model->order)), true),
		),
		'manager',
		'client',
		'name',
		'email',
		'phone',
		'city',
		'address',
		'comment',
	),
)); ?>
