<?php
$this->breadcrumbs=array(
	'Производители дисков',
);

$this->menu=array(
	array('label'=>'Добавить производителя дисков', 'url'=>array('create')),
	array('label'=>'Управление производителями дисков', 'url'=>array('admin')),
);
?>

<h1>Производители дисков</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
