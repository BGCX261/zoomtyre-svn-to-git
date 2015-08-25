<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Диски';
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Диски',
);
?>

<div class='grid_8 alpha'>
	<h2 class="title2"><span><span>Каталог дисков</span></span></h2>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'disks/_producer',
	'viewData'=>array('construct'=>$construct),
)); ?>
</div>
<div class='grid_4 omega'>
	<h2 class="title2"><span><span>Подбор дисков</span></span></h2>
	<?php $this->widget('widgets.selection.disksWidget')?>
</div>