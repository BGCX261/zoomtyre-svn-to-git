<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->name=>array('view','id'=>$model->username),
	'Обновить пользователя',
);

$this->menu=array(
	array('label'=>'Обзор пользователей', 'url'=>array('index')),
	array('label'=>'Добавить пользователя', 'url'=>array('create')),
	array('label'=>'Подробнее о пользователе', 'url'=>array('view', 'id'=>$model->username)),
	array('label'=>'Управление пользователями', 'url'=>array('admin')),
);
?>

<h1>Обновить пользователя - <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>