<?php
$this->breadcrumbs=array(
	'Brands'=>array('index'),
	'Manage',
);

$this->menu=array(
	#array('label'=>'Обзор', 'url'=>array('index')),
	array('label'=>'Добавить', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('brand-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление брендами</h1>

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
	'id'=>'brand-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'alias',
		'archive'=>array(
			'name'=>'archive',
			'value'=>'L::item(\'ArchiveStatus\', $data->archive)',
			'filter'=>L::items('ArchiveStatus'),
		),
		'country',
		#'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
