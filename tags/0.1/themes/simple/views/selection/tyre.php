<?php
$this->pageTitle=Yii::app()->name . ' - Продажа шин, дисков, автозапчастей';
$this->breadcrumbs=array(
	'Подбор шин',
);
?>

<div class='container_12 selection-result'>
	<?php if(!empty($model)):?>
	<div class='grid_8 alpha'>
	<?php 
	foreach($model as $size): 
		$tb = Image::getFile($size->tyre->photo, 'small');
	?>
	<div class='item'>
		<ul>
			<li>
				<a href='<?php echo $tb?Image::getFile($size->tyre->photo, 'big'):CHtml::normalizeUrl( array('catalog/tyres', 'aliasProducer'=>$size->tyre->producer->alias, 'aliasModel'=>$size->tyre->alias, 'aliasSize'=>$size->alias)); ?>'><div class='tb'><?php 
				echo CHtml::image(
					$tb?$tb:Yii::app()->params['tyre.emptyPhoto.tb'], 
					$size->title,
					array(
						'title'=>$size->title,
						'width'=>120,
						'height'=>120,
					)
				);
				?></div></a>
			</li>
			<li>
				<h3><i><?php echo CHtml::link($size->tyre->producer->title, array('catalog/tyres', 'aliasProducer'=>$size->tyre->producer->alias))?></i> <?php echo CHtml::link($size->tyre->title, array('catalog/tyres', 'aliasProducer'=>$size->tyre->producer->alias, 'aliasModel'=>$size->tyre->alias)); ?></h3>
				<b class='size'><?php echo CHtml::link($size->size, array('catalog/tyres', 'aliasProducer'=>$size->tyre->producer->alias, 'aliasModel'=>$size->tyre->alias, 'aliasSize'=>$size->alias)); ?></b>
				<a class='short_info' href='<?php echo CHtml::normalizeUrl( array('catalog/tyres', 'aliasProducer'=>$size->tyre->producer->alias, 'aliasModel'=>$size->tyre->alias, 'aliasSize'=>$size->alias)); ?>'><span class='<?php echo L::item('tyreSeason', $size->tyre->season); ?>'><?php echo L::ruitem('tyreSeason', $size->tyre->season); ?></span>
				<?php echo $size->tyre->stud?'шипованая':''; ?> шина
				<?php echo $size->tyre->producer->title.' '.$size->tyre->title.' '.$size->size; ?><?php if($size->tyre->currency): ?>,
				 применяемая на <?php echo L::ruitem('tyreCurrency', $size->tyre->currency); endif; ?>.</a>
			</li>
			<li>
				<span class='price'><big><?php echo number_format($size->price, 2, ',', ' '); ?></big> руб.</span>
				<hr class='space'/>
				<?php $this->widget('widgets.shopping.buy', array( 'model'=>$size )); ?>
			</li>
		</ul>
		<div class='clear'></div>
	</div>
	<?php endforeach; ?>
	<?php
	$this->widget('CLinkPager', array(
	    'pages' => $pages,
		'header'=>'',
		'prevPageLabel'=>'&larr; сюда',
		'nextPageLabel'=>'туда &rarr;',
	));
	?>	
	
	</div>
	<?php endif; ?>
	<div class='grid_4 omega'>
		<h2 class="title1"><span><span>Подбор шин</span></span></h2>
		<?php $this->widget('widgets.selection.tyresWidget', array('model'=>$selection))?>
	</div>
	<div class='clear'></div>	
</div>