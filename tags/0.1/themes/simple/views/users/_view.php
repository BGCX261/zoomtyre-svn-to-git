<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$data,
	'attributes'=>array(
		'id',
		array(
			'name'=>'type',
			'value'=>Lookup::ruitem('CommentType', $data->type),
		),
		array(
			'name'=>'parentTitle',
			'value'=>$data->parent->title,
		),
		array(
			'name'=>'url',
			'type'=>'raw',
			'value'=>CHtml::link(@$data->parent->url, @$data->parent->url),
		),
		array(
			'name'=>'author',
			'type'=>'raw',
			'value'=>$data->_author,
		),
		'text_marked:raw',
		array(
			'name'=>'created',
			'type'=>'text',
			'value'=>$data->back_time.' ('.$data->created.')',
		),
		'rating',
		array(
			'name'=>'status',
			'value'=>Lookup::item('CommentStatus', $data->status),
		),
	),
));
?>

<br /><hr />
