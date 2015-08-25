<?php
$this->breadcrumbs=array(
	'Каталог шин',
);?>

<div class='span-18 catalog producers'>
	<h2 class="title1"><span><span>Каталог шин</span></span></h2>
	<ul>
	<?php 
		foreach($models as $model):
			$logo = $model->logo?Image::getFile($model->logo, 'big'):null;
	?>
		<li>
			<?php echo CHtml::link($model->title, array('tyres/viewProducer', 'alias'=>$model->alias)); ?>
		</li>
	<?php 
		endforeach; 
	?>
	</ul>
</div>

<div class='span-8 last'>
	<h2 class="title1"><span><span>Подбор шин</span></span></h2>
	<?php $this->widget('widgets.producers.tyresWidget', array( 'model'=>$tyreSelection, ))?>
</div>

<hr class='space' />