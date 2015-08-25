<?php
$this->breadcrumbs=array(
	'Менеджеры'=>array('index'),
	$model->username,
);

$this->menu=array(
	array('label'=>'Добавить менеджера', 'url'=>array('create')),
	array('label'=>'Обновить менеджера', 'url'=>array('update', 'id'=>$model->username)),
	array('label'=>'Удалить менеджера', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->username),'confirm'=>'Вы уверены что хотите удалить менеджера?')),
	array('label'=>'Управление менеджерами', 'url'=>array('index')),
);
?>

<h1>Подробнее о менеджере #<?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'phone',
		'email:email',
		'priority',
		array(
			'name'=>'avatar',
			'type'=>'image',
			'value'=>$model->avatar?Image::getFile($model->avatar):null
		),
		'online',
	),
)); ?>
