<?php
$this->breadcrumbs=array(
	'Псевдонимы'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Обзор псевдонимов', 'url'=>array('index')),
	array('label'=>'Добавить псевдоним', 'url'=>array('create')),
	array('label'=>'Обновить псевдоним', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить псевдоним', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить псевдоним?')),
	array('label'=>'Управление псевдонимами', 'url'=>array('admin')),
);
?>

<h1>Подробнее о псевдониме #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'ru',
		'code',
		'type',
		'ord',
	),
)); ?>
