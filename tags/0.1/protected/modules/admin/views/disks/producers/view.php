<?php
$this->breadcrumbs=array(
	'Производители шин'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Обзор производителей дисков', 'url'=>array('index')),
	array('label'=>'Добавить производителя дисков', 'url'=>array('create')),
	array('label'=>'Обновить производителя дисков', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить производителя дисков', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить производителя шин?')),
	array('label'=>'Управление производителями дисков', 'url'=>array('admin')),
);
?>

<h1>Подробнее о производителе дисков #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'alias',
		array(
			'name'=>'logo',
			'type'=>'image',
			'value'=>Image::getFile($model->logo,'big'),
		),
		'description_marked:html',
		array(
			'name'=>'disks',
			'type'=>'html',
			'value'=>$this->renderPartial('_disks', array('disks'=>$model->disks), true),
		),
	),
)); ?>
