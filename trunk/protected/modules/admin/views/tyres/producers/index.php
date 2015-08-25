<?php
$this->breadcrumbs=array(
	'Производители шин',
);

$this->menu=array(
	array('label'=>'Добавить производителя шин', 'url'=>array('create')),
	array('label'=>'Управление производителями шин', 'url'=>array('admin')),
);
?>

<h1>Производители шин</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
