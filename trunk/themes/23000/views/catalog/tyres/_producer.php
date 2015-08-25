<?php
	$params = array('catalog/tyres', 'aliasProducer'=>$data->alias);
	!empty($season)?$params['season']=$season:false;
	!empty($stud)?$params['stud']=$stud:false;
?>
<h3 class='grid_4 <?php echo $index%2?'omega':'alpha'; ?> tcenter catalog-producers'>
	<?php if(!empty($data->logo)): ?>
	<div><a href='<?php echo CHtml::normalizeUrl($params); ?>'><?php echo CHtml::image( Image::getFile($data->logo), 'Логотип производителя шин '.$data->title, array('title'=>'Производитель шин '.$data->title) ); ?></a></div>
	<?php else: ?>
	<?php echo CHtml::link($data->title, $params); ?>
	<?php endif; ?>
</h3>
<?php echo $index%2?'<div class="clear"></div>':''; ?>