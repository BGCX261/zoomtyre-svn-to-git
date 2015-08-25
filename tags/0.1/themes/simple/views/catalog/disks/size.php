<?php
$params = array('catalog/disks', 'aliasProducer'=>$model->disk->producer->alias, 'aliasModel'=>$model->disk->alias, 'aliasSize'=>$model->alias);
!empty($season)?$params['season']=$season:false;
!empty($stud)?$params['stud']=$stud:false;

$this->pageTitle=Yii::app()->name . ' - Каталог - Диски - '.CHtml::encode($model->disk->producer->title).' - '.CHtml::encode($model->disk->title).' - '.CHtml::encode($model->size);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Диски'=>array('catalog/disks'),
	$model->disk->producer->title => array('catalog/disks', 'aliasProducer'=>$model->disk->producer->alias),
	$model->disk->title => array('catalog/disks', 'aliasProducer'=>$model->disk->producer->alias, 'aliasModel'=>$model->disk->alias),
	$model->size => $params
	
);

echo CHtml::link($model->size, $params).' остаток '.$model->rest.' цена '.$model->price;
$this->widget('widgets.shopping.buy', array( 'model'=>$model ));
?>

<?php 
$this->widget('widgets.socials.socials', array( 'model'=>$model->disk, 'options'=>array(
	'title' => 'Диск '.$model->disk->producer->title.' '.$model->disk->title.' '.$model->size,
	'url' => CHtml::normalizeUrl($params),
	'description' => CHtml::encode($model->disk->description),
	'printUrl' => CHtml::normalizeUrl($params),
)));
?>
<hr />
<?php 
	$this->widget('widgets.comments.comments', array(
		'model'=>$model->disk,
	));
?>