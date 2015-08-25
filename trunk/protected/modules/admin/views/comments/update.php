<?php
$this->breadcrumbs=array(
	'Комментарии'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обновить комментарий',
);

$this->menu=array(
	#array('label'=>'Обзор комментариев', 'url'=>array('index')),
	#array('label'=>'Добавить комментарий', 'url'=>array('create')),
	array('label'=>'Подробнее о комментарии', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление комментариями', 'url'=>array('admin')),
);
?>

<h1>Обновить комментарий - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>