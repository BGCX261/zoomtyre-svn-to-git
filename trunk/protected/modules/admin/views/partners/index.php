<?php
$this->breadcrumbs=array(
	'Партнёры',
);

$this->menu=array(
	array('label'=>'Добавить партнёра', 'url'=>array('create')),
	array('label'=>'Управление партнёрами', 'url'=>array('admin')),
);
?>

<h1>Партнёры</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
