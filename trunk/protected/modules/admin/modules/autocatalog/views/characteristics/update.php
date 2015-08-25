<?php
/*
$this->breadcrumbs=array(
	'Characteristics'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);
*/

$this->menu=array(
	array('label'=>'Управление', 'url'=>array('admin')),
	#array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Добавить', 'url'=>array('create')),
	array('label'=>'Подробнее', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Обновление характеристик <?php echo $model->modification->model->brand->title; ?> <?php echo $model->modification->model->title; ?> <?php echo $model->modification->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>