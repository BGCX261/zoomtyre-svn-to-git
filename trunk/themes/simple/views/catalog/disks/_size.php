<?php
$params = array('catalog/disks', 'aliasProducer'=>$data->disk->producer->alias, 'aliasModel'=>$data->disk->alias, 'aliasSize'=>$data->alias);
!empty($construct)?$params['construct']=$construct:false;

#echo CHtml::link($data->size, $params);
echo CHtml::link($data->size, $params).' остаток '.$data->rest.' цена '.$data->price;

$this->widget('widgets.shopping.buy', array( 'model'=>$data ));
?><Br />