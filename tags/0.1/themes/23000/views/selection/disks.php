<?php
$this->pageTitle=Yii::app()->name . ' - Продажа шин, дисков, автозапчастей';
$this->breadcrumbs=array(
	'Подбор дисков',
);
?>

<?php 
#d($selection);
?>

<div class='grid_8 alpha selection-result'>
	<h2 class="title3"><span><span>Поиск дисков &mdash; <?php echo empty($selection->width)?'*':$selection->width; ?>x<?php echo empty($selection->diameter)?'*':$selection->diameter; ?>/<?php echo empty($selection->PCD)?'*':$selection->PCD; ?> ET<?php echo empty($selection->ET)?'*':$selection->ET; ?></span></span></h2>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$data,
		'itemView'=>'_disk',
		'ajaxUpdate' => false,
		'sortableAttributes'=>array(
			'price',
			'rest',
		),
		'pager'=>array(
			'cssFile'=>false,
			'header'=>'',
			'prevPageLabel'=>'&larr; сюда',
			'nextPageLabel'=>'туда &rarr;',
		),
	
	)); ?>

</div>
<div class='grid_4 omega'>
	<h2 class="title2"><span><span>Подбор дисков</span></span></h2>
	<?php $this->widget('widgets.selection.disksWidget', array( 'model'=>$selection ))?>
</div>