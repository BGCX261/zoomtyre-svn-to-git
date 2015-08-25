<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Шины';
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Шины' => array('catalog/tyres'),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'tyres/_producer',
	'viewData'=>array('season'=>$season, 'stud'=>$stud),
)); ?>