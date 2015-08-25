<?php
$this->breadcrumbs=array(
	'Каталог шин'=>array('tyres/index'),
	$producer->title=>array('tyres/viewProducer', 'alias'=>$producer->alias),
);?>

<div class='span-18'>
	<h2 class="title1"><span><span>Каталог шин</span></span></h2>
	<ul>
	<?php 
		foreach($producer->tyres as $model):
			$photo = $model->photo?Image::getFile($model->photo, 'small'):null;
	?>
		<li>
			<?php echo CHtml::link(CHtml::image($photo, $producer->title.' '.$model->title), array('tyres/viewModel', 'alias'=>$model->alias, 'producerAlias'=>$producer->alias)); ?>
			<?php echo CHtml::link($model->title, array('tyres/viewModel', 'alias'=>$model->alias, 'producerAlias'=>$producer->alias)); ?>
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