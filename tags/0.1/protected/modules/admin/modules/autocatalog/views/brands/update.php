<?php
$this->breadcrumbs=array(
	'Brands'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Управление', 'url'=>array('admin')),
	#array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Добавить', 'url'=>array('create')),
	array('label'=>'Подробнее', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Обновление бренда <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>