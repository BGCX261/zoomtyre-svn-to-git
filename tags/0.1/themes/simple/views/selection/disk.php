<?php
$this->pageTitle=Yii::app()->name . ' - Продажа шин, дисков, автозапчастей';
$this->breadcrumbs=array(
	'Подбор дисков',
);
?>


<div class='container_12 selection-result'>
	<?php if(!empty($model)):?>
	<div class='grid_8 alpha'>
	<?php 
	foreach($model as $size): 
		$tb = Image::getFile($size->disk->photo, 'small');
	?>
		<div class='item'>
			<ul>
				<li>
					<a href='<?php echo $tb?Image::getFile($size->disk->photo, 'big'):CHtml::normalizeUrl( array('catalog/disks', 'aliasProducer'=>$size->disk->producer->alias, 'aliasModel'=>$size->disk->alias, 'aliasSize'=>$size->alias)); ?>'><div class='tb'><?php 
					echo CHtml::image(
						$tb?$tb:Yii::app()->params['disk.emptyPhoto.tb'], 
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
					<h3><i><?php echo CHtml::link($size->disk->producer->title, array('catalog/disks', 'aliasProducer'=>$size->disk->producer->alias))?></i> <?php echo CHtml::link($size->disk->title, array('catalog/disks', 'aliasProducer'=>$size->disk->producer->alias, 'aliasModel'=>$size->disk->alias)); ?></h3>
					<b class='size'><?php echo CHtml::link($size->size, array('catalog/disks', 'aliasProducer'=>$size->disk->producer->alias, 'aliasModel'=>$size->disk->alias, 'aliasSize'=>$size->alias)); ?></b>
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
		<h2 class="title1"><span><span>Подбор дисков</span></span></h2>
		<?php $this->widget('widgets.selection.disksWidget', array('model'=>$selection))?>
	</div>
	<div class='clear'></div>	
</div>

