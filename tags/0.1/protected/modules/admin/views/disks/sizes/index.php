<?php
$this->breadcrumbs=array(
	'Типоразмеры',
);

$this->menu=array(
	array('label'=>'Добавить типоразмер', 'url'=>array('create')),
	array('label'=>'Управление типоразмерами', 'url'=>array('admin')),
);
?>

<h1>Типоразмеры</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
