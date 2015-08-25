<?php 
echo CHtml::link(Yii::app()->user->name, array('users/view','username'=>Yii::app()->user->name));
 
if(Yii::app()->user->checkAccess( 'accessAdmin' ))
	echo CHtml::link('админка', array('/admin'));

echo CHtml::link('выход', array('index/logout')); ?>