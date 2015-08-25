<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Диски - '.CHtml::encode($dataProvider->data[0]->producer->title);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Диски'=>array('catalog/disks'),
	$dataProvider->data[0]->producer->title => array('catalog/disks', 'aliasProducer'=>$dataProvider->data[0]->producer->alias),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'disks/_model',
	'ajaxUpdate' => false,
	'viewData'=>array('construct'=>$construct),
)); ?>