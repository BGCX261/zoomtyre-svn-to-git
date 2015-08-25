<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Шины - '.CHtml::encode($dataProvider->data[0]->producer->title);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Шины'=>array('catalog/tyres'),
	$dataProvider->data[0]->producer->title => array('catalog/tyres', 'aliasProducer'=>$dataProvider->data[0]->producer->alias),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'tyres/_model',
	'ajaxUpdate' => false,
	'viewData'=>array('season'=>$season, 'stud'=>$stud),
)); ?>