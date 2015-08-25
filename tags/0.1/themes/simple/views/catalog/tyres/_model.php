<?php
$params = array('catalog/tyres', 'aliasProducer'=>$data->producer->alias, 'aliasModel'=>$data->alias);
!empty($season)?$params['season']=$season:false;
!empty($stud)?$params['stud']=$stud:false;

echo CHtml::image(Image::getFile($data->photo, 'small'));
echo CHtml::link($data->title, $params);
?><Br />