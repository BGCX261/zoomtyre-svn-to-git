<?php
$this->breadcrumbs=array(
	'Производители дисков'=>array('index'),
	'Добавить производителя дисков',
);

$this->menu=array(
	array('label'=>'Обзор производителей дисков', 'url'=>array('index')),
	array('label'=>'Управление производителями дисков', 'url'=>array('admin')),
);
?>

<h1>Добавить производителя дисков</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>