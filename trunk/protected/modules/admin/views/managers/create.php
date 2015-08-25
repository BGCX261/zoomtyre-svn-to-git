<?php
$this->breadcrumbs=array(
	'Менеджеры'=>array('index'),
	'Добавить менеджера',
);

$this->menu=array(
	array('label'=>'Управление менеджерами', 'url'=>array('index')),
);
?>

<h1>Добавить менеджера</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>