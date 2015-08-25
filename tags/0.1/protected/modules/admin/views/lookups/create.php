<?php
$this->breadcrumbs=array(
	'Псевдонимы'=>array('index'),
	'Добавить псевдоним',
);

$this->menu=array(
	array('label'=>'Обзор псевдонимов', 'url'=>array('index')),
	array('label'=>'Управление псевдонимами', 'url'=>array('admin')),
);
?>

<h1>Добавить псевдоним</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>