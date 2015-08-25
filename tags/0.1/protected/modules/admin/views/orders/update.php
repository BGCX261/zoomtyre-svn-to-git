<?php
$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Обновить заказ',
);

$this->menu=array(
	array('label'=>'Подробнее о заказе', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление заказами', 'url'=>array('index')),
);
?>

<h1>Обновить заказ - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>