<?php
$this->breadcrumbs=array(
	'Комментарии'=>array('index'),
	'Добавить комментарий',
);

$this->menu=array(
	#array('label'=>'Обзор комментариев', 'url'=>array('index')),
	array('label'=>'Управление комментариями', 'url'=>array('admin')),
);
?>

<h1>Добавить комментарий</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>