<?php
$this->breadcrumbs=array(
	'Кусты'=>array('index'),
	'Добавить куст',
);

$this->menu=array(
	array('label'=>'Управление кустами', 'url'=>array('admin')),
);
?>

<h1>Добавить куст</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>