<?php
$this->breadcrumbs=array(
	'Производители шин'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить производителя шин',
);

$this->menu=array(
	array('label'=>'Обзор производителей шин', 'url'=>array('index')),
	array('label'=>'Добавить производителя шин', 'url'=>array('create')),
	array('label'=>'Подробнее о производителе шин', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление производителями шин', 'url'=>array('admin')),
);
?>

<h1>Обновить производителя шин - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>