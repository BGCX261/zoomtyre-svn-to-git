<?php
$this->breadcrumbs=array(
	'Менеджеры'=>array('index'),
	$model->username=>array('view','id'=>$model->username),
	'Обновить менеджера',
);

$this->menu=array(
	array('label'=>'Добавить менеджера', 'url'=>array('create')),
	array('label'=>'Подробнее о менеджере', 'url'=>array('view', 'id'=>$model->username)),
	array('label'=>'Управление менеджерами', 'url'=>array('index')),
);
?>

<h1>Обновить менеджера - <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>