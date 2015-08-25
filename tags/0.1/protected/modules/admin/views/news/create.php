<?php
$this->breadcrumbs=array(
	'Статьи'=>array('index'),
	'Добавить статью',
);

$this->menu=array(
	array('label'=>'Обзор новостей', 'url'=>array('index')),
	array('label'=>'Управление новостями', 'url'=>array('admin')),
);
?>

<h1>Добавить новость</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>