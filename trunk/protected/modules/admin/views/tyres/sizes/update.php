<?php
$this->breadcrumbs=array(
	'Типоразмеры'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обновить типоразмер',
);

$this->menu=array(
	array('label'=>'Обзор типоразмеров', 'url'=>array('index')),
	array('label'=>'Добавить типоразмер', 'url'=>array('create')),
	array('label'=>'Подробнее о типоразмере', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление типоразмерами', 'url'=>array('admin')),
);
?>

<h1>Обновить типоразмер - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>