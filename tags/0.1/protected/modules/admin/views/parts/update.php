<?php
$this->breadcrumbs=array(
	'Кусты'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить куст',
);

$this->menu=array(
	array('label'=>'Добавить корневой элемент', 'url'=>array('create')),
	array('label'=>'Подробнее о корневом элементе', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление кустами', 'url'=>array('admin')),
	array('label'=>'Весь куст', 'url'=>array('tree', 'id'=>$model->id)),
);
?>

<h1>Обновить куст - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>