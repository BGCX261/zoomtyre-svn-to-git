<?php
	$params = array('catalog/tyres', 'aliasProducer'=>$data->alias);
	!empty($season)?$params['season']=$season:false;
	!empty($stud)?$params['stud']=$stud:false;

	echo CHtml::link($data->title, $params);
?><br />