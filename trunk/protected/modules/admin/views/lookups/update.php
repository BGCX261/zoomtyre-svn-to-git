<?php
$this->breadcrumbs=array(
	'Псевдонимы'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Обновить псевдоним',
);

$this->menu=array(
	array('label'=>'Обзор псевдонимов', 'url'=>array('index')),
	array('label'=>'Добавить псевдоним', 'url'=>array('create')),
	array('label'=>'Подробнее о псевдониме', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление псевдонимами', 'url'=>array('admin')),
);
?>

<h1>Обновить псевдоним - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>