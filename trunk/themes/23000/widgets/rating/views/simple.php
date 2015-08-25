<div class='<?php echo $options['class'];?>' title='Рейтинг'>
	<?php echo CHtml::ajaxButton('-', $url, array('type'=>'get', 'data'=>array('rating'=>'dec'), 'update'=>'#'.$this->id), array('title'=>'Понизить рейтинг')); ?>
	<span id='<?php echo $this->id; ?>'><?php echo $options['model']->rating; ?></span>
	<?php echo CHtml::ajaxButton('+', $url, array('type'=>'get', 'data'=>array('rating'=>'inc'), 'update'=>'#'.$this->id), array('title'=>'Повысить рейтинг')); ?>
</div>