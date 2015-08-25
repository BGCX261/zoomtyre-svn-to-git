<?php
$this->breadcrumbs=array(
	'Псевдонимы',
);

$this->menu=array(
	array('label'=>'Добавить псевдоним', 'url'=>array('create')),
	array('label'=>'Управление псевдонимами', 'url'=>array('admin')),
);
?>

<h1>Псевдонимы</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
