<?php
$this->breadcrumbs=array(
	'Партнёры'=>array('index'),
	'Добавить партнёра',
);

$this->menu=array(
	array('label'=>'Обзор партнёров', 'url'=>array('index')),
	array('label'=>'Управление партнёрами', 'url'=>array('admin')),
);
?>

<h1>Добавить партнёра</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>