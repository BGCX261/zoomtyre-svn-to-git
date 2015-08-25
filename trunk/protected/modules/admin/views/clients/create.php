<?php
$this->breadcrumbs=array(
	'Клиенты'=>array('index'),
	'Добавить клиента',
);

$this->menu=array(
	array('label'=>'Управление клиентами', 'url'=>array('index')),
);
?>

<h1>Добавить клиента</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>