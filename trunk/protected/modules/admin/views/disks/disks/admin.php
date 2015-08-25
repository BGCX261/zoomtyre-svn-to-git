<?php
$this->breadcrumbs=array(
	'Диски'=>array('index'),
	'Управление дисками',
);

$this->menu=array(
	array('label'=>'Обзор дисков', 'url'=>array('index')),
	array('label'=>'Добавить диск', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('disk-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление дисками</h1>

<p>
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
	'id'=>'disk-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'producer_id',
			'value'=>'$data->producer->title',
			'filter'=>CHtml::listData( DiskProducers::model()->findAll(), 'id', 'title'),
		),
		'title',
		'alias',
		array(
			'name'=>'new',
			'value'=>'L::ruitem(\'boolean\', $data->new)',
			'filter'=>L::ruitems('boolean'),
		),
		array(
			'name'=>'sale',
			'value'=>'L::ruitem(\'boolean\', $data->sale)',
			'filter'=>L::ruitems('boolean'),
		),
		array(
			'name'=>'construction_type',
			'value'=>'L::ruitem(\'diskConstructionType\', $data->construction_type)',
			'filter'=>L::ruitems('diskConstructionType'),
		),
		array(
			'name'=>'color',
			'value'=>'L::item(\'color\', $data->color)',
			'filter'=>L::items('color'),
		),
		'model_id',
		/*
		'photo',
		'description',
		'description_marked',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
