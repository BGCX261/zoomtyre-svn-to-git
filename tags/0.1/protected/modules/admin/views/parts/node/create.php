<?php
$this->breadcrumbs=array(
	'Кусты'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить куст',
);

$this->menu=array(
	array('label'=>'Управление кустами', 'url'=>array('admin')),
	array('label'=>'Весь куст', 'url'=>array('tree', 'id'=>$root->id)),
);
?>

<h1>Добавить потомка</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>