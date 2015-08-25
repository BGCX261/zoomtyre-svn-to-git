<?php
$this->breadcrumbs=array(
	'Клиенты'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Добавить клиента', 'url'=>array('create')),
	array('label'=>'Обновить клиента', 'url'=>array('update', 'id'=>$model->username)),
	array('label'=>'Удалить клиента', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->username),'confirm'=>'Вы уверены что хотите удалить клиента?')),
	array('label'=>'Управление клиентами', 'url'=>array('index')),
);
?>

<h1>Подробнее о клиенте #<?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'card',
		'discount',
		'name',
		'phone',
		'email',
		'city',
		'address',
	),
)); ?>
