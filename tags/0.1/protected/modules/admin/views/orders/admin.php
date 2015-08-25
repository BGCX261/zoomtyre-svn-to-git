<?php
$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	'Управление заказами',
);

$this->menu=array(
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление заказами</h1>

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
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'status',
			'value'=>'L::ruitem("orderStatus", $data->status)',
			'filter'=>L::ruitems('orderStatus'),
		),
		array(
			'name'=>'created',
			'value'=>'$data->created',
		),
		array(
			'name'=>'manager',
			'filter'=>CHtml::listData(Manager::model()->findAll(), 'username', 'username'),
		),
		'client',
		'name',
		'email',
		'phone',
		'city',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
