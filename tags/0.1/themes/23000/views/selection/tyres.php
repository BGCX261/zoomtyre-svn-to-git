<?php
$this->pageTitle=Yii::app()->name . ' - Продажа шин, дисков, автозапчастей';
$this->breadcrumbs=array(
	'Подбор шин',
);
?>

<?php 
#d($selection);
?>

<div class='grid_8 alpha selection-result'>
	<h2 class="title3"><span><span>Поиск шин &mdash; <?php echo empty($selection->width)?'*':$selection->width; ?>/<?php echo empty($selection->height)?'*':$selection->height; ?>R<?php echo empty($selection->diameter)?'*':$selection->diameter; ?></span></span></h2>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$data,
		'itemView'=>'_tyre',
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
	<h2 class="title1"><span><span>Подбор шин</span></span></h2>
	<?php $this->widget('widgets.selection.tyresWidget', array( 'model'=>$selection ))?>
</div>