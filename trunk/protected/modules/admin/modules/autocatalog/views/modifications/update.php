<?php
$this->breadcrumbs=array(
	'Modifications'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Управление', 'url'=>array('admin')),
#	array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Добавить', 'url'=>array('create')),
	array('label'=>'Подробнее', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Обновление модификации <?php echo $model->model->brand->title; ?> <?php echo $model->model->title; ?>#<?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>