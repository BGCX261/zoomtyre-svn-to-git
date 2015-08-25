<?php
$this->breadcrumbs=array(
	'Вопросы'=>array('index'),
	'Добавить вопрос',
);

$this->menu=array(
	array('label'=>'Обзор вопросов', 'url'=>array('index')),
	array('label'=>'Управление вопросами', 'url'=>array('admin')),
);
?>

<h1>Добавить вопрос</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>