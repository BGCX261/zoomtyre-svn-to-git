<?php
$this->breadcrumbs=array(
	'Кусты'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить куст',
);

$this->menu=array(
	array('label'=>'Добавить лист', 'url'=>array('createNode', 'id'=>$model->id)),
	array('label'=>'Подробнее о листе', 'url'=>array('viewNode', 'id'=>$model->id)),
	array('label'=>'Управление кустами', 'url'=>array('admin')),
	array('label'=>'Весь куст', 'url'=>array('tree', 'id'=>$root->id)),
);
?>

<h1>Обновить потомка - <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>