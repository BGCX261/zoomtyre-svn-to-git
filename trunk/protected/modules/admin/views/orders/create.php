<?php
$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	'Добавить заказ',
);

$this->menu=array(
	array('label'=>'Управление заказами', 'url'=>array('index')),
);
?>

<h1>Добавить заказ</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>