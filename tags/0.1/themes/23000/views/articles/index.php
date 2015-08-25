<?php
$this->pageTitle=Yii::app()->name . ' - Новости';
$this->breadcrumbs=array(
	'Новости',
);
?>
<div class='grid_8 alpha'>
	<h2 class="title3"><span><span>Новости</span></span></h2>
	<?php if(!empty($models) && count($models)>0): ?>
	<ul id='news'>
	<?php foreach($models as $model): ?>
	<li>
		<h3><?php echo CHtml::link($model->title, $model->url);?></h3>
		<span class='time'><?php echo $model->publicated;?></span>
		<div class='clear'></div>
	</li>
	<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	
	<?php
	$this->widget('CLinkPager', array(
	    'pages' => $pages,
		'cssFile'=>false,
		'header'=>'<div class="clear"></div>',
		'prevPageLabel'=>'&larr; сюда',
		'nextPageLabel'=>'туда &rarr;',
	));
	?>
</div>
<div class='grid_4 omega services'>
	<h2 class="title2"><span><span>Подбор дисков</span></span></h2>
	<?php $this->widget('widgets.selection.disksWidget')?>
	<?php $this->renderPartial('//modules/info');?>
</div>