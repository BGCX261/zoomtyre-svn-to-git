<?php
$this->breadcrumbs=array(
	'Кусты'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Добавить корневой элемент', 'url'=>array('create')),
	array('label'=>'Обновить корневой элемент', 'url'=>array('update', 'id'=>$root->id)),
	array('label'=>'Удалить куст', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$root->id),'confirm'=>'Вы уверены что хотите удалить куст?')),
	array('label'=>'Управление кустами', 'url'=>array('admin')),
	array('label'=>'Куст ёлкой', 'url'=>array('tree', 'id'=>$root->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('part-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Куст - <?php echo $root->root; ?>#<?php echo $root->title; ?></h1>

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
	'id'=>'part-grid',
	'dataProvider'=>$model->searchList($root->id),
	'filter'=>$model,
	'columns'=>array(
		array(
			'class'=>'CLinkColumn',
			'label'=>'▲',
			'linkHtmlOptions'=>array('style'=>'text-decoration:none;'),
			'urlExpression'=>'"javascript:$.fn.yiiGridView.update(\'part-grid\', {\'type\':\'post\', \'data\': \'node=".$data->id."&operation=moveUp\' });"',
		),
		array(
			'class'=>'CLinkColumn',
			'label'=>'▼',
			'linkHtmlOptions'=>array('style'=>'text-decoration:none;'),
			'urlExpression'=>'"javascript:$.fn.yiiGridView.update(\'part-grid\', {\'type\':\'post\', \'data\': \'node=".$data->id."&operation=moveDown\' });"',
		),
		#'id',
		array(
			'name'=>'title',
			'value'=>'str_repeat(" . ", $data->level).$data->title',
			'type'=>'raw',
		),
		'alias',
		'level',
		'path:raw',
		/*
		'url',
		'main',
		'visible',
		'htmlOptions',
		'template',
		'page_title',
		'page_description',
		'page_keywords',
		*/
		array(
			'class'=>'CButtonColumn',
			'updateButtonUrl' => '$data->lft>1?CHtml::normalizeUrl(array("updateNode", "id"=>$data->id)):CHtml::normalizeUrl(array("update", "id"=>$data->id))',
			'viewButtonUrl' => '$data->lft>1?CHtml::normalizeUrl(array("viewNode", "id"=>$data->id)):CHtml::normalizeUrl(array("view", "id"=>$data->id))',
			'buttons' =>array(
				'delete' => array(
					'visible' => '$data->lft<=1?false:true',
				),
			),
		),
	),
)); ?>
