<?php 
if(empty($sizes)): 
?>
<span class="null">Нет</span>
<?php 
else :
	foreach($sizes as $model):
?>
	<div>
		<?php echo CHtml::link($model->size, array('disks/sizes/view', 'id'=>$model->id)); ?>
		Цена <b><?php echo $model->price; ?></b> р. </i>
		
		<?php
			if(intval($model->rest)<=0 && $model->rest != '*'){
				echo '- <i><span class="no"><b>Нет в наличии</b></i>';
			}elseif(intval($model->rest) < 4 && $model->rest != '*'){
				echo '- <i><span class="little"><b>Меньше четырёх ('.$model->rest.' шт.)</b></span></i>'; 				
			}elseif(intval($model->rest) <= 8 && $model->rest != '*'){
				echo '- <i><span class="normal"><b>Достаточно ('.$model->rest.' шт.)</b></span></i>';
			}else{
				echo '- <i><span class="many"><b>Много, надо продавать</b></span></i>';
			}
		?>
		
	</div>
<?php 
	endforeach;
endif;
?>
