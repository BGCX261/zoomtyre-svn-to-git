<?php
$this->pageTitle=Yii::app()->name . ' - Каталог - Диски - '.CHtml::encode($dataProvider->data[0]->disk->producer->title).' - '.CHtml::encode($dataProvider->data[0]->disk->title);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Диски'=>array('catalog/disks'),
	$dataProvider->data[0]->disk->producer->title => array('catalog/disks', 'aliasProducer'=>$dataProvider->data[0]->disk->producer->alias),
	$dataProvider->data[0]->disk->title => array('catalog/disks', 'aliasProducer'=>$dataProvider->data[0]->disk->producer->alias, 'aliasModel'=>$dataProvider->data[0]->disk->alias),
);
?>

<?php echo CHtml::image(Image::getFile($dataProvider->data[0]->disk->photo, 'big'));?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'disks/_size',
	'ajaxUpdate' => false,
	'viewData'=>array('construct'=>$construct),
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