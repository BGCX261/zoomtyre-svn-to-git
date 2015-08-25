<?php
$this->breadcrumbs=array(
	'Вопросы'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обновить вопрос',
);

$this->menu=array(
	array('label'=>'Обзор вопросов', 'url'=>array('index')),
	array('label'=>'Добавить вопрос', 'url'=>array('create')),
	array('label'=>'Подробнее о вопросе', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Управление вопросами', 'url'=>array('admin')),
);
?>

<h1>Обновить вопрос - <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>