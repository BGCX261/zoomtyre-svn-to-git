<?php
$this->breadcrumbs=array(
	'Кусты'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Добавить корневой элемент', 'url'=>array('create')),
	array('label'=>'Обновить корневой элемент', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить куст', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить куст?')),
	array('label'=>'Управление кустами', 'url'=>array('admin')),
	array('label'=>'Куст списком', 'url'=>array('list', 'id'=>$model->id)),
);
?>

<h1>Куст - <?php echo $model->root; ?>#<?php echo $model->title; ?></h1>

<?php $this->renderPartial('_hierarchical', array('tree'=>$tree));?>