<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Шины - '.CHtml::encode($dataProvider->data[0]->producer->title);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Шины'=>array('catalog/tyres'),
	$dataProvider->data[0]->producer->title,
);
?>

<div class='grid_8 alpha'>
	<h2 class="title1"><span><span>Каталог шин - <?php echo $dataProvider->data[0]->producer->title; ?></span></span></h2>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'tyres/_model',
	'ajaxUpdate' => false,
	'viewData'=>array('season'=>$season, 'stud'=>$stud),
	'pager'=>array(
		'cssFile'=>false,
		'header'=>'<div class="clear"></div>',
		'prevPageLabel'=>'&larr; сюда',
		'nextPageLabel'=>'туда &rarr;',
	),
)); ?>
</div>
<div class='grid_4 omega'>
	<h2 class="title1"><span><span>Подбор шин</span></span></h2>
	<?php $this->widget('widgets.selection.tyresWidget')?>
</div>