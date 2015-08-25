<?php
$this->breadcrumbs=array(
	'Диски'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить диск',
);

$this->menu=array(
	array('label'=>'Обзор дисков', 'url'=>array('index')),
	array('label'=>'Добавить диск', 'url'=>array('create')),
	array('label'=>'Подробнее о диске', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление дисками', 'url'=>array('admin')),
);
?>

<h1>Обновить диск - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>