<?php
$this->breadcrumbs=array(
	'Контакты'=>array('index'),
	'Добавить контакт',
);

$this->menu=array(
	array('label'=>'Обзор контактов', 'url'=>array('index')),
	array('label'=>'Управление контактами', 'url'=>array('admin')),
);
?>

<h1>Добавить контакт</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>