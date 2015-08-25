<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Управление пользователями',
);

$this->menu=array(
	array('label'=>'Обзор пользователей', 'url'=>array('index')),
	array('label'=>'Добавить пользователя', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление пользователями</h1>

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
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'username',
		'email',
		'avatar',
		array(
			'name'=>'status',
			'value'=>'L::item("userStatus", $data->status)',
			'filter'=>L::items('userStatus'),
		),
		'created',
		/*
		'activated',
		'name',
		'birthday',
		'country',
		'city',
		'last_login',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
