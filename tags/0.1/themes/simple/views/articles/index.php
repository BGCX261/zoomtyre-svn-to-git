<div>
	<?php if(!empty($models) && count($models)>0): ?>
	<ul class='main-page-line'>
	<?php foreach($models as $model): ?>
	<li>
		<?php if($model->photo): ?>
		<a href='<?php echo $model->url;?>'>
			<img src='<?php echo (($tmp=Image::getFile($model->photo, 'normal'))?$tmp:('http://carclub.ru'.$model->photo)); ?>' title='<?php echo $model->title;?>' alt='Картинка: <?php echo $model->title;?>' align='left' />
		</a>
		<?php endif; ?>
		<h3><?php echo CHtml::link($model->title, $model->url);?></h3>
		<span class='time'><?php echo EString::getBackTime($model->publicated);?></span>
		<?php echo CHtml::link($model->preamble_marked, $model->url); ?>

		<div class='clear'></div>
	</li>
	<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	
	<?php
	$this->widget('CLinkPager', array(
	    'pages' => $pages,
	));
	?>
</div>