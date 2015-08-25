<?php
$this->breadcrumbs=array(
	'Контакты'=>array('index'),
	'Управление контактами',
);

$this->menu=array(
	array('label'=>'Обзор контактов', 'url'=>array('index')),
	array('label'=>'Добавить контакт', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contact-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление контактами</h1>

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
	'id'=>'contact-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'alias',
		'email',
		'phone',
		'address',
		'url',
		/*
		'address',
		'url',
		'map_x',
		'map_y',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
