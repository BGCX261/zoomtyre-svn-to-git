<?php
$this->breadcrumbs=array(
	'Кусты'=>array('index'),
	'Управление кустами',
);

$this->menu=array(
	array('label'=>'Добавить корневой элемент', 'url'=>array('create')),
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

<h1>Управление кустами</h1>

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
	'dataProvider'=>$model->searchRoots(),
	'filter'=>$model,
	'columns'=>array(
		#'id',
		'title',
		'alias',
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
			'template' => '{descendants} {list}',
			'buttons'=>array(
				'descendants' => array(
					'label' => 'Иерархически',
					'imageUrl'=>$this->assets.'/images/tree.png',
					'url' => 'CHtml::normalizeUrl(array("tree", "id"=>$data->primaryKey))',
				),
				'list' => array(
					'label' => 'Списком',
					'imageUrl'=>$this->assets.'/images/list.png',
					'url' => 'CHtml::normalizeUrl(array("list", "id"=>$data->primaryKey))',
				),
			),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
