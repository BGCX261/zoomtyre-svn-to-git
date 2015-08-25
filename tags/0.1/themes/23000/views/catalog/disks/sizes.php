<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Диски - '.CHtml::encode($dataProvider->data[0]->disk->producer->title).' - '.CHtml::encode($dataProvider->data[0]->disk->title);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Диски'=>array('catalog/disks'),
	$dataProvider->data[0]->disk->producer->title => array('catalog/disks', 'aliasProducer'=>$dataProvider->data[0]->disk->producer->alias),
	$dataProvider->data[0]->disk->title,
);
?>

<div class='grid_8 alpha catalog-card'>
	<h2 class="title1"><span><span>Каталог шин</span></span></h2>

	<div class='grid_2 alpha'>
		<?php 
		$small = Image::getFile($dataProvider->data[0]->disk->photo, 'small');
		$small = CHtml::image($small, 'Шина '.CHtml::encode($dataProvider->data[0]->disk->producer->title.' '.$dataProvider->data[0]->disk->title));
		if($big = Image::getFile($dataProvider->data[0]->disk->photo, 'big'))
			echo CHtml::link( $small, $big, array('class'=>'fancybox', 'title'=>'Диск '.CHtml::encode($dataProvider->data[0]->disk->producer->title.' '.$dataProvider->data[0]->disk->title)) );
		else
			echo $small;
		?>
	</div>
	<div class='grid_6 omega item'>
		<h3><?php echo CHtml::encode($dataProvider->data[0]->disk->producer->title.' '.$dataProvider->data[0]->disk->title); ?></h3>
		<div class='description'><?php echo $dataProvider->data[0]->disk->description_marked; ?></div>
		<?php 
		$this->widget('widgets.socials.socials');
		?>
	</div>
	
	<hr class='space clear' />
	<div class='sizes'>
		<h4>Доступные типоразмеры</h4>
	
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$dataProvider,
			'cssFile' => false,
			'summaryText'=>'',
			'columns' => array(
				array(
					'name'=>'size',
					'type'=>'raw',
					'value'=>'$data->disk->producer->title." ".$data->disk->title." ".CHtml::link($data->size, array("catalog/disks", "aliasProducer"=>$data->disk->producer->alias, "aliasModel"=>$data->disk->alias, "aliasSize"=>$data->alias))',
				),
				array(
					'name'=>'rest',
					'value'=>'$data->rest>=4?"Более четырёх":"Под заказ, уточняйте наличие у менеджера"',
					'cssClassExpression'=>'$data->rest>=4?"lot":"few"',
				),

				array(
					'name'=>'price',
					'type'=>'html',
					'value'=>'number_format($data->price, 2, ",", " ")." <i class=\"rub\">Р</i>"',
				),
				array(
					'name' => '',
					'type'=>'raw',
					'value' => 'Yii::app()->controller->widget("widgets.shopping.buy", array( "model"=>$data ), true)',
				)
			)
		)); ?>
	</div>


	<h3>Отзывы и комментарии о <?php echo CHtml::encode($dataProvider->data[0]->disk->producer->title.' '.$dataProvider->data[0]->disk->title); ?></h3>
	<?php 
		$this->widget('widgets.comments.comments', array(
			'model'=>$model,
		));
	?>

</div>

<div class='grid_4 omega'>
	<h2 class="title1"><span><span>Подбор дисков</span></span></h2>
	<?php $this->widget('widgets.selection.disksWidget')?>
</div>