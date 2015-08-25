<?php 
	$tb = Image::getFile($data->tyre->photo, 'small');
	$s = $data->width.'/'.$data->height.'R'.$data->diameter.' '.$data->load_index.$data->speed_rating;
?>
<div class='item'>
	<ul>
		<li class='grid_2 alpha photo tcenter'>
			<a href='<?php echo CHtml::normalizeUrl( array('catalog/tyres', 'aliasProducer'=>$data->tyre->producer->alias, 'aliasModel'=>$data->tyre->alias, 'aliasSize'=>$data->alias)); ?>'><div class='tb tcenter'><?php 
			echo CHtml::image(
				$tb?$tb:Yii::app()->params['tyre.emptyPhoto.tb'], 
				$data->tyre->producer->title.' '.$data->tyre->title.' '.$s,
				array( 'title'=>$data->tyre->producer->title.' '.$data->tyre->title.' '.$s)
			);
			?></div></a>
		</li>
		<li class='grid_4'>
			<h3><i><?php echo CHtml::link($data->tyre->producer->title, array('catalog/tyres', 'aliasProducer'=>$data->tyre->producer->alias))?></i> <?php echo CHtml::link($data->tyre->title, array('catalog/tyres', 'aliasProducer'=>$data->tyre->producer->alias, 'aliasModel'=>$data->tyre->alias)); ?></h3>
			<b class='size'><?php echo CHtml::link($data->size, array('catalog/tyres', 'aliasProducer'=>$data->tyre->producer->alias, 'aliasModel'=>$data->tyre->alias, 'aliasSize'=>$data->alias)); ?></b>
			<span class='<?php echo L::item('tyreSeason', $data->tyre->season); ?> sign'></span>
			<?php echo $data->tyre->stud?'<span class="stud sign"></span>':''; ?>
			<a class='short_info' href='<?php echo CHtml::normalizeUrl( array('catalog/tyres', 'aliasProducer'=>$data->tyre->producer->alias, 'aliasModel'=>$data->tyre->alias, 'aliasSize'=>$data->alias)); ?>'><?php echo L::ruitem('tyreSeason', $data->tyre->season); ?> <?php echo $data->tyre->stud?'шипованая':''; ?> шина <?php echo $data->tyre->producer->title.' '.$data->tyre->title.' '.$s; ?>.</a>
			<p class='<?php echo $data->rest>=4?'lot':'few'; ?>'><?php echo $data->rest>=4?'Более четырёх.':'Под заказ, уточняйте наличие у менеджера.'; ?></p>
		</li>
		<li class='grid_2 omega'>
			<span class='price'><big><?php echo number_format($data->price, 2, ',', ' '); ?> <i class='rub'>Р</i></big></span>
			
			<hr class='space'/>
			<?php $this->widget('widgets.shopping.buy', array( 'model'=>$data )); ?>
		</li>
	</ul>
	<div class='clear'></div>
</div>