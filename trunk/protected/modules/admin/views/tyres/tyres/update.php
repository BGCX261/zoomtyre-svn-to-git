<?php
$this->breadcrumbs=array(
	'Шины'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить шину',
);

$this->menu=array(
	array('label'=>'Обзор шин', 'url'=>array('index')),
	array('label'=>'Добавить шину', 'url'=>array('create')),
	array('label'=>'Подробнее о шине', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление шинами', 'url'=>array('admin')),
);
?>

<h1>Обновить шину - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>