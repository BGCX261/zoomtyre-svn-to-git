<?php
$this->breadcrumbs=array(
	'Комментарии'=>array('index'),
	'Управление комментариями',
);

$this->menu=array(
	#array('label'=>'Обзор комментариев', 'url'=>array('index')),
	#array('label'=>'Добавить комментарий', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('comment-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление комментариями</h1>

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

<?php 
Yii::app()->getClientScript()->registerScript('comments', "
jQuery('#comment-grid a.blockComment, #comment-grid a.approveComment').live('click',function() {
	$.fn.yiiGridView.update('comment-grid', {
		type:'POST',
		url:$(this).attr('href'),
		success:function() {
			$.fn.yiiGridView.update('comment-grid');
		}
	});
	return false;
});");


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name'=>'object_type',
			'type'=>'raw',
			'value'=>'CHtml::link(L::ruitem(\'CommentType\', $data->object_type), isset($data->object->url)?$data->object->url:"", array("title"=>$data->object->title));',
			'filter'=>L::ruitems('CommentType'),
		),
		/*
		array(
			'name'=>'parentTitle',
			'type'=>'raw',
			'value'=>'CHtml::link(@$data->object->title, @$data->object->url);',
			'filter'=>false,
		),
		*/
		'author',
		'text_marked:raw',
		'created',
		'rating',
		array(
			'name'=>'status',
			'value'=>'L::ruitem(\'CommentStatus\', $data->status)',
			'filter'=>L::ruitems('CommentStatus'),
		),
		/*
		'text_marked',
		'created',
		'rating',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
			'template' => '{approve} {block}',
			'buttons'=>array(
				'approve' => array(
					'label' => 'Проверен',
					'imageUrl'=>$this->assets.'/images/accept.png',
					'url' => 'CHtml::normalizeUrl(array("approve", "id"=>$data->primaryKey))',
					'options' => array('class'=>'approveComment'),
				),
				'block' => array(
					'label' => 'Заблокирован',
					'imageUrl'=>$this->assets.'/images/stop.png',
					'url' => 'CHtml::normalizeUrl(array("block", "id"=>$data->primaryKey))',
					'options' => array('class'=>'blockComment'),
				),
			),
		),
		array(
			'class'=>'CButtonColumn',
			
		),
	),
)); ?>
