<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Шины - '.CHtml::encode($dataProvider->data[0]->tyre->producer->title).' - '.CHtml::encode($dataProvider->data[0]->tyre->title);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Шины'=>array('catalog/tyres'),
	$dataProvider->data[0]->tyre->producer->title => array('catalog/tyres', 'aliasProducer'=>$dataProvider->data[0]->tyre->producer->alias),
	$dataProvider->data[0]->tyre->title => array('catalog/tyres', 'aliasProducer'=>$dataProvider->data[0]->tyre->producer->alias, 'aliasModel'=>$dataProvider->data[0]->tyre->alias),
);
?>

<?php echo CHtml::image(Image::getFile($dataProvider->data[0]->tyre->photo, 'big'));?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'tyres/_size',
	'ajaxUpdate' => false,
	'viewData'=>array('season'=>$season, 'stud'=>$stud),
)); ?>

<?php 
$this->widget('widgets.socials.socials', array( 'model'=>$model, 'options'=>array(
	'title' => $model->title,
	'url' => CHtml::normalizeUrl(array('articles/view', 'alias'=>$model->alias)),
	'description' => CHtml::encode($model->description),
	'printUrl' => CHtml::normalizeUrl(array('articles/print', 'alias'=>$model->alias)),
)));
?>
<hr />
<?php 
	$this->widget('widgets.comments.comments', array(
		'model'=>$model,
	));
?>