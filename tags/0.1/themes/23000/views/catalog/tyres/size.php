<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Шины - '.CHtml::encode($model->tyre->producer->title).' - '.CHtml::encode($model->tyre->title).' - '.CHtml::encode($model->size);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Шины'=>array('catalog/tyres'),
	$model->tyre->producer->title => array('catalog/tyres', 'aliasProducer'=>$model->tyre->producer->alias),
	$model->tyre->title => array('catalog/tyres', 'aliasProducer'=>$model->tyre->producer->alias, 'aliasModel'=>$model->tyre->alias),
	$model->size
);
?>

<div class='grid_8 alpha catalog-card'>
	<h2 class="title1"><span><span>Каталог шин</span></span></h2>

	<div class='grid_2 alpha'>
		<?php 
		$small = Image::getFile($model->tyre->photo, 'small');
		$small = CHtml::image($small, 'Шина '.CHtml::encode($model->tyre->producer->title.' '.$model->tyre->title));
		if($big = Image::getFile($model->tyre->photo, 'big'))
			echo CHtml::link( $small, $big, array('class'=>'fancybox', 'title'=>'Шина '.CHtml::encode($model->tyre->producer->title.' '.$model->tyre->title)) );
		else
			echo $small;
		?>
	</div>
	<div class='grid_6 omega item'>
		<h3><?php echo CHtml::encode($model->tyre->producer->title.' '.$model->tyre->title); ?></h3>
		<div class='description'><?php echo $model->tyre->description_marked; ?></div>
		<?php 
		$this->widget('widgets.socials.socials', array( 'model'=>$model, 'options'=>array(
			'title' => $model->title,
			'url' => CHtml::normalizeUrl(array('articles/view', 'alias'=>$model->alias)),
			'description' => CHtml::encode($model->tyre->description),
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
						<th>Шина</th>
						<th>Типоразмер</th>
						<th>Остаток</th>
						<th>Цена</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr class="odd">
						<td><?php echo CHtml::encode($model->tyre->producer->title.' '.$model->tyre->title); ?></td>
						<td><?php echo $model->size; ?></td>
						<td class='<?php echo $model->rest>=4?'lot':'few'; ?>'><?php echo $model->rest>=4?'Более четырёх.':'Под заказ, уточняйте наличие у менеджера.'; ?></td>
						<td><?php echo number_format($model->price, 2, ",", " "); ?> <i class="rub">Р</i></td>
						<td><?php $this->widget('widgets.shopping.buy', array( 'model'=>$model ));?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>


	<h3>Отзывы и комментарии о <?php echo CHtml::encode($model->tyre->producer->title.' '.$model->tyre->title); ?></h3>
	<?php 
		$this->widget('widgets.comments.comments', array(
			'model'=>$model->tyre,
		));
	?>

</div>

<div class='grid_4 omega'>
	<h2 class="title1"><span><span>Подбор шин</span></span></h2>
	<?php $this->widget('widgets.selection.tyresWidget')?>
</div>