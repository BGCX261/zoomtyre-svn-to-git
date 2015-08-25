<?php
$this->breadcrumbs=array(
	'Комментарии',
);

$this->menu=array(
	#array('label'=>'Добавить комментарий', 'url'=>array('create')),
	array('label'=>'Управление комментариями', 'url'=>array('admin')),
);
?>

<h1>Комментарии</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
