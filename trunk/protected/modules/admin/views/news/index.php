<?php
$this->breadcrumbs=array(
	'Статьи',
);

$this->menu=array(
	array('label'=>'Добавить новость', 'url'=>array('create')),
	array('label'=>'Управление новостями', 'url'=>array('admin')),
);
?>

<h1>Новости</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
