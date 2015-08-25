<?php
$this->breadcrumbs=array(
	'Статьи'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Обновить статью',
);

$this->menu=array(
	array('label'=>'Обзор новостей', 'url'=>array('index')),
	array('label'=>'Добавить новость', 'url'=>array('create')),
	array('label'=>'Подробнее о новости', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление новостями', 'url'=>array('admin')),
);
?>

<h1>Обновить новость - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>