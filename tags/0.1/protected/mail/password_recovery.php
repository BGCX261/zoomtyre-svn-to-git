<?php echo CHtml::link('ссылке', Yii::app()->request->hostInfo.CHtml::normalizeUrl(array('users/password_recovery', 'hash'=>$hash, 'date'=>$date))); ?>


<p><?php echo $hash; ?></p>
