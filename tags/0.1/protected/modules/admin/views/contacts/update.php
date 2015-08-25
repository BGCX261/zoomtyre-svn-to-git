<?php
$this->breadcrumbs=array(
	'Контакты'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить контакт',
);

$this->menu=array(
	array('label'=>'Обзор контактов', 'url'=>array('index')),
	array('label'=>'Добавить контакт', 'url'=>array('create')),
	array('label'=>'Подробнее о контакте', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление контактами', 'url'=>array('admin')),
);
?>

<h1>Обновить контакт - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>