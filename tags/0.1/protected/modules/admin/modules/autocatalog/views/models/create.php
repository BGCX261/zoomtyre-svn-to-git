<?php
$this->breadcrumbs=array(
	'Cars'=>array('index'),
	'Create',
);

$this->menu=array(
#	array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Управление', 'url'=>array('admin')),
);
?>

<h1>Добавление модели</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>