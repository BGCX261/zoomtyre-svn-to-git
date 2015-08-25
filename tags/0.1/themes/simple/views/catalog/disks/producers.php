<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Диски';
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Диски' => array('catalog/disks'),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'disks/_producer',
	'viewData'=>array('construct'=>$construct),
)); ?>