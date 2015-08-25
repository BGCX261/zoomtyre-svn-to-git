<?php
$this->breadcrumbs=array(
	'Статьи'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить статью',
);

$this->menu=array(
	array('label'=>'Обзор статей', 'url'=>array('index')),
	array('label'=>'Добавить статью', 'url'=>array('create')),
	array('label'=>'Подробнее о статье', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление статьями', 'url'=>array('admin')),
);
?>

<h1>Обновить статью - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>