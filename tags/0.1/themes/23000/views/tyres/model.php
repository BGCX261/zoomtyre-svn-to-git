<?php
$this->breadcrumbs=array(
	'Каталог шин'=>array('tyres/index'),
	$tyre->producer->title=>array('tyres/viewProducer', 'alias'=>$tyre->producer->alias),
	$tyre->title=>array('tyres/viewModel', 'alias'=>$tyre->alias, 'producerAlias'=>$tyre->producer->alias),
);?>

<div class='span-18'>
<h2 class="title1"><span><span>Каталог шин</span></span></h2>
<ul>
<?php 
	foreach($tyre->sizes as $model):
?>
	<li>
		<?php echo CHtml::link($model->size, array('tyres/viewSize', 'alias'=>$model->alias, 'modelAlias'=>$model->tyre->alias, 'producerAlias'=>$model->tyre->producer->alias)); ?>
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