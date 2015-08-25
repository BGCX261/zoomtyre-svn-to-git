<?php
$this->breadcrumbs=array(
	'Партнёры'=>array('index'),
	'Управление партнёрами',
);

$this->menu=array(
	array('label'=>'Обзор партнёров', 'url'=>array('index')),
	array('label'=>'Добавить партнёра', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('partner-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление партнёрами</h1>

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
	'id'=>'partner-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'alias',
		array(
			'name'=>'type',
			'value'=>'L::item(\'partnerType\', $data->type)',
			'filter'=>L::items('partnerType'),
		),
		'username',
		'phone',
		'address',
		'email',
		'url',
		/*
		'description',
		'description_marked',
		'phone',
		'address',
		'email',
		'url',
		'map_x',
		'map_y',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
