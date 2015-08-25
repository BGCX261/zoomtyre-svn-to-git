<?php 
	$tb = Image::getFile($data->disk->photo, 'small');
	$s = $data->size;
?>
<div class='item'>
	<ul>
		<li class='grid_2 alpha photo tcenter'>
			<a href='<?php echo CHtml::normalizeUrl( array('catalog/disks', 'aliasProducer'=>$data->disk->producer->alias, 'aliasModel'=>$data->disk->alias, 'aliasSize'=>$data->alias)); ?>'><div class='tb tcenter'><?php 
			echo CHtml::image(
				$tb?$tb:Yii::app()->params['disk.emptyPhoto.tb'], 
				$data->disk->producer->title.' '.$data->disk->title.' '.$s,
				array( 'title'=>$data->disk->producer->title.' '.$data->disk->title.' '.$s)
			);
			?></div></a>
		</li>
		<li class='grid_4'>
			<h3><i><?php echo CHtml::link($data->disk->producer->title, array('catalog/disks', 'aliasProducer'=>$data->disk->producer->alias))?></i> <?php echo CHtml::link($data->disk->title, array('catalog/disks', 'aliasProducer'=>$data->disk->producer->alias, 'aliasModel'=>$data->disk->alias)); ?></h3>
			<b class='size'><?php echo CHtml::link($data->size, array('catalog/disks', 'aliasProducer'=>$data->disk->producer->alias, 'aliasModel'=>$data->disk->alias, 'aliasSize'=>$data->alias)); ?></b>
			<a class='short_info' href='<?php echo CHtml::normalizeUrl( array('catalog/disks', 'aliasProducer'=>$data->disk->producer->alias, 'aliasModel'=>$data->disk->alias, 'aliasSize'=>$data->alias)); ?>'>
				<?php echo L::ruitem('diskConstructionType', $data->disk->construction_type); ?> 
				 диск 
				<?php echo $data->disk->producer->title.' '.$data->disk->title.' '.$s; ?>.</a>
			<p class='<?php echo $data->rest>=4?'lot':'few';   ?>'><?php echo $data->rest>=4?'Более четырёх.':'Под заказ, уточняйте наличие у менеджера.'; ?></p>
		</li>
		<li class='grid_2 omega'>
			<span class='price'><big><?php echo number_format($data->price, 2, ',', ' '); ?> <i class='rub'>Р</i></big></span>
			
			<hr class='space'/>
			<?php $this->widget('widgets.shopping.buy', array( 'model'=>$data )); ?>
		</li>
	</ul>
	<div class='clear'></div>
</div>