<?php
$this->breadcrumbs=array(
	'Типоразмеры'=>array('index'),
	'Управление типоразмерами',
);

$this->menu=array(
	array('label'=>'Обзор типоразмеров', 'url'=>array('index')),
	array('label'=>'Добавить типоразмер', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tyre-sizes-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление типоразмерами</h1>

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
	'id'=>'tyre-sizes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'code',
		array(
			'name'=>'producer',
			'value'=>'$data->disk->producer->title',
			'filter'=>CHtml::listData( DiskProducers::model()->findAll(), 'id', 'title'),
		),
		array(
			'name'=>'disk_id',
			'value'=>'$data->disk->title',
			'filter'=>CHtml::listData( Disk::model()->findAll('producer_id=:id', array(':id'=>$model->producer)), 'id', 'title'),
		),
		'width',
		'diameter',
		'PCD_screws',
		'PCD_diameter',
		'ET',
		'DIA',
		'price',
		'rest',

		/*
		'discount',
		'discount_max',
		'diameter',
		'load_index',
		'speed_rating',
		'price',
		'rest',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
