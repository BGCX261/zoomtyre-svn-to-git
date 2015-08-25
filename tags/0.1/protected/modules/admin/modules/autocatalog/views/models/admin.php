<?php
$this->breadcrumbs=array(
	'Cars'=>array('index'),
	'Manage',
);

$this->menu=array(
#	array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Добавить', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('car-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление моделями</h1>

<p class="hint">
Можно использовать операторы сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) в начале запроса.
</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'car-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'brand_id'=>array(
			'name'=>'brand_id',
			'value'=>'$data->brand->title',
			'filter'=>CHtml::listData( Brand::model()->findAll(array('order'=>'title')), 'id', 'title'),
		),
		'archive'=>array(
			'name'=>'archive',
			'value'=>'L::item(\'ArchiveStatus\', $data->archive)',
			'filter'=>L::items('ArchiveStatus'),
		),
		'title',
		'alias',
		/*
		'description',
		'manufacture_start',
		'manufacture_end',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
