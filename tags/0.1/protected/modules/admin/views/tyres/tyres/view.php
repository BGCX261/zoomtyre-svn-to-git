<?php
$this->breadcrumbs=array(
	'Шины'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Обзор шин', 'url'=>array('index')),
	array('label'=>'Добавить шину', 'url'=>array('create')),
	array('label'=>'Обновить шину', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить шину', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить шину?')),
	array('label'=>'Управление шинами', 'url'=>array('admin')),
);
?>

<h1>Подробнее о шине #<?php echo $model->id; ?></h1>

<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'=>'producer_id',
			'type'=>'html',
			'value'=>CHtml::link($model->producer->title, array( 'producers/tyres/view', 'id'=>$model->producer_id)),
		),
		'title',
		'alias',
		array(
			'name'=>'photo',
			'type'=>'image',
			'value'=>Image::getFile($model->photo, 'big'),
		),
		'description_marked:html',
		array(
			'name'=>'new',
			'value'=>L::ruitem('boolean', $model->new),
		),
		array(
			'name'=>'sale',
			'value'=>L::ruitem('boolean', $model->sale),
		),
		array(
			'name'=>'currency',
			'value'=>L::item('tyreCurrency', $model->currency),
		),
		array(
			'name'=>'season',
			'value'=>L::item('tyreSeason', $model->season),
		),
		array(
			'name'=>'stud',
			'value'=>L::ruitem('boolean', $model->stud),
		),
		array(
			'name'=>'construction_type',
			'value'=>L::item('tyreConstructionType', $model->construction_type),
		),
		array(
			'name'=>'runflat_type',
			'value'=>L::ruitem('boolean', $model->runflat_type),
		),
		array(
			'name'=>'sizes',
			'type'=>'html',
			'value'=>$this->renderPartial('_sizes', array('sizes'=>$model->sizes), true),
		),
	),
)); ?>
