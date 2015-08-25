<?php
$this->breadcrumbs=array(
	'Клиенты'=>array('index'),
	$model->name=>array('view','id'=>$model->username),
	'Обновить клиента',
);

$this->menu=array(
	array('label'=>'Добавить клиента', 'url'=>array('create')),
	array('label'=>'Подробнее о клиенте', 'url'=>array('view', 'id'=>$model->username)),
	array('label'=>'Управление клиентами', 'url'=>array('index')),
);
?>

<h1>Обновить клиента - <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>