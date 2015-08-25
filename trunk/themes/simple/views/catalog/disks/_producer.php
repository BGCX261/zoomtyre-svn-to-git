<?php
	$params = array('catalog/disks', 'aliasProducer'=>$data->alias);
	!empty($construct)?$params['construct']=$construct:false;

	echo CHtml::link($data->title, $params);
?><br />