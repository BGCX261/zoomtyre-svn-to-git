<?php
$this->breadcrumbs=array(
	'Типоразмеры'=>array('index'),
	'Добавить типоразмер',
);

$this->menu=array(
	array('label'=>'Обзор типоразмеров', 'url'=>array('index')),
	array('label'=>'Управление типоразмерами', 'url'=>array('admin')),
);
?>

<h1>Добавить типоразмер</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>