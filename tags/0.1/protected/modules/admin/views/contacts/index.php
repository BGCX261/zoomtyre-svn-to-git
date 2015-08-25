<?php
$this->breadcrumbs=array(
	'Контакты',
);

$this->menu=array(
	array('label'=>'Добавить контакт', 'url'=>array('create')),
	array('label'=>'Управление контактами', 'url'=>array('admin')),
);
?>

<h1>Контакты</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
