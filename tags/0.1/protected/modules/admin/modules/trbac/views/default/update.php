<?php
$this->menu=array(
	array('label'=>'Обзор элементов авторизации', 'url'=>array('index')),
	array('label'=>'Просмотр', 'url'=>array('view', 'name'=>$item->name)),
	array('label'=>'Управление пользователями', 'url'=>array('manage', 'name'=>$item->name)),
);
?>

<h1>Редактирование элемента авторизации #<?php echo $item->name; ?></h1>

<?
echo $this->renderPartial('_form', array('model'=>$item, 'update'=>true));
?>