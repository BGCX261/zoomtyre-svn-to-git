<?php
$params = array('catalog/disks', 'aliasProducer'=>$data->producer->alias, 'aliasModel'=>$data->alias);
!empty($construct)?$params['construct']=$construct:false;

echo CHtml::image(Image::getFile($data->photo, 'small'));
echo CHtml::link($data->title, $params);
?><Br />