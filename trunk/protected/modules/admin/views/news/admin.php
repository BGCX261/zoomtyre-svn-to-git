<?php
$this->breadcrumbs=array(
	'Статьи'=>array('index'),
	'Управление статьями',
);

$this->menu=array(
	array('label'=>'Обзор новостей', 'url'=>array('index')),
	array('label'=>'Добавить новость', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('article-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление новостями</h1>

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
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'publicated',
		/*
		'created',
		'preamble',
		'preamble_marked',
		'text',
		'text_marked',
		'source',
		'source_link',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
