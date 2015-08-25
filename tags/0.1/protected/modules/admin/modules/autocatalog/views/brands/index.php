<?php
$this->breadcrumbs=array(
	'Brands',
);

$this->menu=array(
	array('label'=>'Управление', 'url'=>array('admin')),
	array('label'=>'Добавить', 'url'=>array('create')),
);
?>

<h1>Обзор брендов</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
