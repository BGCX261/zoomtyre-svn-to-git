<?php
$this->breadcrumbs=array(
	'Производители шин'=>array('index'),
	'Добавить производителя шин',
);

$this->menu=array(
	array('label'=>'Обзор производителей шин', 'url'=>array('index')),
	array('label'=>'Управление производителями шин', 'url'=>array('admin')),
);
?>

<h1>Добавить производителя шин</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>