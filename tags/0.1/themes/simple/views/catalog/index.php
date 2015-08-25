<?php
$this->pageTitle=Yii::app()->name . ' - Каталог';
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
);
?>

<h2><?php echo CHtml::link('Шины', array('catalog/tyres'));?></h2>
<h2><?php echo CHtml::link('Диски', array('catalog/disks'));?></h2>