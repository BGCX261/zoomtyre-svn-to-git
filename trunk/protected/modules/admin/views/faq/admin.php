<?php
$this->breadcrumbs=array(
	'Вопросы'=>array('index'),
	'Управление вопросами',
);

$this->menu=array(
	array('label'=>'Обзор вопросов', 'url'=>array('index')),
	array('label'=>'Добавить вопрос', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('faq-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление вопросами</h1>

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
	'id'=>'faq-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'part',
		'question',
		'alias',
		'answer',
		'rating',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
