<?php
$this->breadcrumbs=array(
	'Каталог шин'=>array('tyres/index'),
	$size->tyre->producer->title=>array('tyres/viewProducer', 'alias'=>$size->tyre->producer->alias),
	$size->tyre->title=>array('tyres/viewModel', 'alias'=>$size->tyre->alias, 'producerAlias'=>$size->tyre->producer->alias),
	$size->size=>array('tyres/viewSize', 'alias'=>$size->alias, 'modelAlias'=>$size->tyre->alias, 'producerAlias'=>$size->tyre->producer->alias),
);?>

<div class='span-18'>
<h2 class="title1"><span><span>Каталог шин</span></span></h2>
<ul>
	<li>
		<?php echo $size->size; ?>
	</li>
</ul>
</div>

<div class='span-8 last'>
	<h2 class="title1"><span><span>Подбор шин</span></span></h2>
	<?php $this->widget('widgets.producers.tyresWidget', array( 'model'=>$tyreSelection, ))?>
</div>

<hr class='space' />