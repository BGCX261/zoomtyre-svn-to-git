<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Диски - '.CHtml::encode($model->disk->producer->title).' - '.CHtml::encode($model->disk->title).' - '.CHtml::encode($model->size);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Диски'=>array('catalog/disks'),
	$model->disk->producer->title => array('catalog/disks', 'aliasProducer'=>$model->disk->producer->alias),
	$model->disk->title => array('catalog/disks', 'aliasProducer'=>$model->disk->producer->alias, 'aliasModel'=>$model->disk->alias),
	$model->size
);
?>

<div class='grid_8 alpha catalog-card'>
	<h2 class="title2"><span><span>Каталог дисков</span></span></h2>

	<div class='grid_2 alpha'>
		<?php 
		$small = Image::getFile($model->disk->photo, 'small');
		$small = CHtml::image($small, 'Шина '.CHtml::encode($model->disk->producer->title.' '.$model->disk->title));
		if($big = Image::getFile($model->disk->photo, 'big'))
			echo CHtml::link( $small, $big, array('class'=>'fancybox', 'title'=>'Шина '.CHtml::encode($model->disk->producer->title.' '.$model->disk->title)) );
		else
			echo $small;
		?>
	</div>
	<div class='grid_6 omega item'>
		<h3><?php echo CHtml::encode($model->disk->producer->title.' '.$model->disk->title); ?></h3>
		<div class='description'><?php echo $model->disk->description_marked; ?></div>
		<?php 
		$this->widget('widgets.socials.socials', array( 'model'=>$model, 'options'=>array(
			'title' => $model->title,
			'url' => CHtml::normalizeUrl(array('articles/view', 'alias'=>$model->alias)),
			'description' => CHtml::encode($model->disk->description),
			'printUrl' => CHtml::normalizeUrl(array('articles/print', 'alias'=>$model->alias)),
		)));
		?>
	</div>
	
	<hr class='space clear' />
	<div class='sizes'>
		<h4>Выбранный типоразмер</h4>

		<div class="grid-view" id="yw0">
			<table class="items">
				<thead>
					<tr>
						<th>Диск</th>
						<th>Типоразмер</th>
						<th>Остаток</th>
						<th>Цена</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr class="odd">
						<td><?php echo CHtml::encode($model->disk->producer->title.' '.$model->disk->title); ?></td>
						<td><?php echo $model->size; ?></td>
						<td class='<?php echo $model->rest>=4?'lot':'few'; ?>'><?php echo $model->rest>=4?'Более четырёх.':'Под заказ, уточняйте наличие у менеджера.'; ?></td>
						<td><?php echo number_format($model->price, 2, ",", " "); ?> <i class="rub">Р</i></td>
						<td><?php $this->widget('widgets.shopping.buy', array( 'model'=>$model ));?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>


	<h3>Отзывы и комментарии о <?php echo CHtml::encode($model->disk->producer->title.' '.$model->disk->title); ?></h3>
	<?php 
		$this->widget('widgets.comments.comments', array(
			'model'=>$model->disk,
		));
	?>

</div>

<div class='grid_4 omega'>
	<h2 class="title2"><span><span>Подбор дисков</span></span></h2>
	<?php $this->widget('widgets.selection.disksWidget')?>
</div>
