<?php 
if(empty($tyres)): 
?>
<span class="null">Нет</span>
<?php 
else :
	foreach($tyres as $model):
?>
	<div>
		<?php echo CHtml::link($model->title, array('tyres/view', 'id'=>$model->id)); ?> 
		<span class='many'><?php echo L::item('tyreSeason', $model->season); ?></span>
		<?php echo $model->stud?'шипованая':''; ?>
		<?php echo L::ruitem('tyreConstructionType', $model->construction_type); ?> шина
		<?php echo $model->runflat_type?'с технологией <i>RunFlat</i>':''; ?>,
		применяемая на <b><?php echo L::ruitem('tyreCurrency', $model->currency); ?></b>.
	</div>
<?php 
	endforeach;
endif;
?>
