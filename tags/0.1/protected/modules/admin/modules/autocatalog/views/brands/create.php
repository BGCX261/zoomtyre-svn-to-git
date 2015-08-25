<?php
$this->breadcrumbs=array(
	'Brands'=>array('index'),
	'Create',
);

$this->menu=array(
	#array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Добавление бренда</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>