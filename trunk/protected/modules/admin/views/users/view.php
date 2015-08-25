<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Обзор пользователей', 'url'=>array('index')),
	array('label'=>'Добавить пользователя', 'url'=>array('create')),
	array('label'=>'Обновить пользователя', 'url'=>array('update', 'id'=>$model->username)),
	array('label'=>'Удалить пользователя', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->username),'confirm'=>'Вы уверены что хотите удалить пользователя?')),
	array('label'=>'Управление пользователями', 'url'=>array('admin')),
);
?>

<h1>Подробнее о пользователе #<?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'password',
		'email',
		'avatar',
		array(
			'name'=>'status',
			'value'=>L::item('userStatus', $model->status),
		),
		'created',
		'activated',
		'name',
		'birthday',
		'gender',
		'country',
		'city',
		'last_login',
	),
)); ?>
