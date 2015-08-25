<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Добавить пользователя',
);

$this->menu=array(
	array('label'=>'Обзор пользователей', 'url'=>array('index')),
	array('label'=>'Управление пользователями', 'url'=>array('admin')),
);
?>

<h1>Добавить пользователя</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>