<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Диски - '.CHtml::encode($dataProvider->data[0]->producer->title);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Диски'=>array('catalog/disks'),
	$dataProvider->data[0]->producer->title,
);
?>

<div class='grid_8 alpha'>
	<h2 class="title2"><span><span>Каталог дисков - <?php echo $dataProvider->data[0]->producer->title; ?></span></span></h2>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'disks/_model',
	'ajaxUpdate' => false,
	'viewData'=>array('construct'=>$construct),
	'pager'=>array(
		'cssFile'=>false,
		'header'=>'<div class="clear"></div>',
		'prevPageLabel'=>'&larr; сюда',
		'nextPageLabel'=>'туда &rarr;',
	),
)); ?>
	
</div>

<div class='grid_4 omega'>
	<h2 class="title2"><span><span>Подбор дисков</span></span></h2>
	<?php $this->widget('widgets.selection.disksWidget')?>
</div>