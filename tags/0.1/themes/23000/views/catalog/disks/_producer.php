<?php
	$params = array('catalog/disks', 'aliasProducer'=>$data->alias);
	!empty($construct)?$params['construct']=$construct:false;
?>
<h3 class='grid_4 <?php echo $index%2?'omega':'alpha'; ?> tcenter catalog-producers'>
	<?php if(!empty($data->logo)): ?>
	<div><a href='<?php echo CHtml::normalizeUrl($params); ?>'><?php echo CHtml::image( Image::getFile($data->logo), 'Логотип производителя дисков '.$data->title, array('title'=>'Производитель шин '.$data->title) ); ?></a></div>
	<?php else: ?>
	<?php echo CHtml::link($data->title, $params); ?>
	<?php endif; ?>
</h3>
<?php echo $index%2?'<div class="clear"></div>':''; ?>