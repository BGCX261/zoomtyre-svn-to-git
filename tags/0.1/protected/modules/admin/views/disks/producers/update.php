<?php
$this->breadcrumbs=array(
	'Производители дисков'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить производителя дисков',
);

$this->menu=array(
	array('label'=>'Обзор производителей дисков', 'url'=>array('index')),
	array('label'=>'Добавить производителя дисков', 'url'=>array('create')),
	array('label'=>'Подробнее о производителе дисков', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление производителями дисков', 'url'=>array('admin')),
);
?>

<h1>Обновить производителя дисков - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>