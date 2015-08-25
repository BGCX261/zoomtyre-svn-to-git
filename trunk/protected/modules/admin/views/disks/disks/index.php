<?php
$this->breadcrumbs=array(
	'Диски',
);

$this->menu=array(
	array('label'=>'Добавить диск', 'url'=>array('create')),
	array('label'=>'Управление дисками', 'url'=>array('admin')),
);
?>

<h1>Диски</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
