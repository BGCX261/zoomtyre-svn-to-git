<?php
$this->breadcrumbs=array(
	'Статьи'=>array('index'),
	'Добавить статью',
);

$this->menu=array(
	array('label'=>'Обзор статей', 'url'=>array('index')),
	array('label'=>'Управление статьями', 'url'=>array('admin')),
);
?>

<h1>Добавить статью</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>