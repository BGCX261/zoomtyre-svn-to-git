<?php
$this->breadcrumbs=array(
	'Шины',
);

$this->menu=array(
	array('label'=>'Добавить шину', 'url'=>array('create')),
	array('label'=>'Управление шинами', 'url'=>array('admin')),
);
?>

<h1>Шины</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
