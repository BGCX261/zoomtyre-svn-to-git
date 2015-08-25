<?php
$this->breadcrumbs=array(
	'Шины'=>array('index'),
	'Управление шинами',
);

$this->menu=array(
	array('label'=>'Обзор шин', 'url'=>array('index')),
	array('label'=>'Добавить шину', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tyre-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление шинами</h1>

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
	'id'=>'tyre-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'producer_id',
			'value'=>'$data->producer->title',
			'filter'=>CHtml::listData( TyreProducers::model()->findAll(), 'id', 'title'),
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
			'name'=>'currency',
			'value'=>'L::item(\'tyreCurrency\', $data->currency)',
			'filter'=>L::items('tyreCurrency'),
		),
		array(
			'name'=>'season',
			'value'=>'L::item(\'tyreSeason\', $data->season)',
			'filter'=>L::items('tyreSeason'),
		),
		array(
			'name'=>'stud',
			'value'=>'L::ruitem(\'boolean\', $data->stud)',
			'filter'=>L::ruitems('boolean'),
		),
		array(
			'name'=>'construction_type',
			'value'=>'EString::substr(L::item(\'tyreConstructionType\', $data->construction_type), 0, 1)',
			'filter'=>L::items('tyreConstructionType'),
		),
		array(
			'name'=>'runflat_type',
			'value'=>'L::ruitem(\'boolean\', $data->runflat_type)',
			'filter'=>L::ruitems('boolean'),
		),
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
