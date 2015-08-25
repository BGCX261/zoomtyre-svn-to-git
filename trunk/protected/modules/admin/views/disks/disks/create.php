<?php
$this->breadcrumbs=array(
	'Диски'=>array('index'),
	'Добавить диск',
);

$this->menu=array(
	array('label'=>'Обзор дисков', 'url'=>array('index')),
	array('label'=>'Управление дисками', 'url'=>array('admin')),
);
?>

<h1>Добавить диск</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>