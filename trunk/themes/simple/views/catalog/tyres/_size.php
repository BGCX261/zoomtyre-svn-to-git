<?php
$params = array('catalog/tyres', 'aliasProducer'=>$data->tyre->producer->alias, 'aliasModel'=>$data->tyre->alias, 'aliasSize'=>$data->alias);
!empty($season)?$params['season']=$season:false;
!empty($stud)?$params['stud']=$stud:false;

#echo CHtml::link($data->size, $params);
echo CHtml::link($data->size, $params).' остаток '.$data->rest.' цена '.$data->price;

$this->widget('widgets.shopping.buy', array( 'model'=>$data ));
?><Br />