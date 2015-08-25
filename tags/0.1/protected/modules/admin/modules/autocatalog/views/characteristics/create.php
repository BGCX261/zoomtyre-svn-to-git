<?php
$this->breadcrumbs=array(
	'Characteristics'=>array('index'),
	'Create',
);

$this->menu=array(
	#array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Добавление характеристик</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>