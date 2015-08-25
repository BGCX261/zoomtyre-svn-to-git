<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Шины';
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Шины',
);
?>

<div class='grid_8 alpha'>
	<h2 class="title1"><span><span>Каталог шин</span></span></h2>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'tyres/_producer',
	'viewData'=>array('season'=>$season, 'stud'=>$stud),
	/*
	'sortableAttributes'=>array(
		'title',
	),
	*/
)); ?>
</div>
<div class='grid_4 omega'>
	<h2 class="title1"><span><span>Подбор шин</span></span></h2>
	<?php $this->widget('widgets.selection.tyresWidget')?>
</div>