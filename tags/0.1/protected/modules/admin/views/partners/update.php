<?php
$this->breadcrumbs=array(
	'Партнёры'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить партнёра',
);

$this->menu=array(
	array('label'=>'Обзор партнёров', 'url'=>array('index')),
	array('label'=>'Добавить партнёра', 'url'=>array('create')),
	array('label'=>'Подробнее о партнёре', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление партнёрами', 'url'=>array('admin')),
);
?>

<h1>Обновить партнёра - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>