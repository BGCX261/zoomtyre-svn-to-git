<?php
$this->menu=array(
	array('label'=>'Обзор элементов авторизации', 'url'=>array('index')),
);
?>

<h1>Добавление потомка элемента авторизации к #<?php echo $parent->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$item, 'parent'=>$parent, 'item_child'=>$item_child, 'update'=>false));
?>