<?php
$this->breadcrumbs=array(
	'Шины'=>array('index'),
	'Добавить шину',
);

$this->menu=array(
	array('label'=>'Обзор шин', 'url'=>array('index')),
	array('label'=>'Управление шинами', 'url'=>array('admin')),
);
?>

<h1>Добавить шину</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>