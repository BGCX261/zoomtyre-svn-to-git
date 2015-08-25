<?php
$this->breadcrumbs=array(
	'Вопросы'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Обзор вопросов', 'url'=>array('index')),
	array('label'=>'Добавить вопрос', 'url'=>array('create')),
	array('label'=>'Обновить вопрос', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить вопрос', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить вопрос?')),
	array('label'=>'Управление вопросами', 'url'=>array('admin')),
);
?>

<h1>Подробнее о вопросе #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'part',
		'question',
		'alias',
		'answer',
		'rating',
	),
)); ?>
