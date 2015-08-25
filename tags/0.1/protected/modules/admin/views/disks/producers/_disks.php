<?php 
if(empty($disks)): 
?>
<span class="null">Нет</span>
<?php 
else :
	foreach($disks as $model):
?>
	<div>
		<?php echo CHtml::link($model->title, array('disks/disks/view', 'id'=>$model->id)); ?>
	</div>
<?php 
	endforeach;
endif;
?>
