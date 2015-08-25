<?php
$this->breadcrumbs=array(
	'Менеджеры'=>array('index'),
	'Управление менеджерами',
);

$this->menu=array(
	array('label'=>'Добавить менеджера', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('manager-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление менеджерами</h1>

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
	'id'=>'manager-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'username',
		'priority',
		'phone',
		'email',
		'online',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
