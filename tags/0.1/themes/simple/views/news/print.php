<center>
<font size=2><a href='/tape' />Статьи</a>: 
<i><a href='/'><?php echo Yii::app()->name; ?></a> <?php echo CHtml::link($model->url, $model->url); ?></i></font><br>
<font size=2><b><?php echo EString::ucfirst(EString::getBackTime($model->publicated));?></b></font><br>
<h3><?php echo $model->title; ?></h3>
</center>

<?php echo $model->preamble_marked; ?> 

<?php echo strip_tags($model->text_marked, '<p><strong><b><a>'); ?>