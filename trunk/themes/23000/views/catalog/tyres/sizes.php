<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Шины - '.CHtml::encode($dataProvider->data[0]->tyre->producer->title).' - '.CHtml::encode($dataProvider->data[0]->tyre->title);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Шины'=>array('catalog/tyres'),
	$dataProvider->data[0]->tyre->producer->title => array('catalog/tyres', 'aliasProducer'=>$dataProvider->data[0]->tyre->producer->alias),
	$dataProvider->data[0]->tyre->title,
);
?>

<div class='grid_8 alpha catalog-card'>
	<h2 class="title1"><span><span>Каталог шин</span></span></h2>

	<div class='grid_2 alpha'>
		<?php 
		$small = Image::getFile($dataProvider->data[0]->tyre->photo, 'small');
		$small = CHtml::image($small, 'Шина '.CHtml::encode($dataProvider->data[0]->tyre->producer->title.' '.$dataProvider->data[0]->tyre->title));
		if($big = Image::getFile($dataProvider->data[0]->tyre->photo, 'big'))
			echo CHtml::link( $small, $big, array('class'=>'fancybox', 'title'=>'Шина '.CHtml::encode($dataProvider->data[0]->tyre->producer->title.' '.$dataProvider->data[0]->tyre->title)) );
		else
			echo $small;
		?>
	</div>
	<div class='grid_6 omega item'>
		<h3><?php echo CHtml::encode($dataProvider->data[0]->tyre->producer->title.' '.$dataProvider->data[0]->tyre->title); ?></h3>
		<div class='description'><?php echo $dataProvider->data[0]->tyre->description_marked; ?></div>
		<?php 
		$this->widget('widgets.socials.socials', array( 'model'=>$model, 'options'=>array(
			'title' => $model->title,
			'url' => CHtml::normalizeUrl(array('articles/view', 'alias'=>$model->alias)),
			'description' => CHtml::encode($model->description),
			'printUrl' => CHtml::normalizeUrl(array('articles/print', 'alias'=>$model->alias)),
		)));
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
					'value'=>'$data->tyre->producer->title." ".$data->tyre->title." ".CHtml::link($data->size, array("catalog/tyres", "aliasProducer"=>$data->tyre->producer->alias, "aliasModel"=>$data->tyre->alias, "aliasSize"=>$data->alias))',
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


	<h3>Отзывы и комментарии о <?php echo CHtml::encode($dataProvider->data[0]->tyre->producer->title.' '.$dataProvider->data[0]->tyre->title); ?></h3>
	<?php 
		$this->widget('widgets.comments.comments', array(
			'model'=>$model,
		));
	?>

</div>

<div class='grid_4 omega'>
	<h2 class="title1"><span><span>Подбор шин</span></span></h2>
	<?php $this->widget('widgets.selection.tyresWidget')?>
</div>