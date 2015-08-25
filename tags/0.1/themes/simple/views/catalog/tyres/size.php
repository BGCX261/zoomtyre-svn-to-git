<?php
$params = array('catalog/tyres', 'aliasProducer'=>$model->tyre->producer->alias, 'aliasModel'=>$model->tyre->alias, 'aliasSize'=>$model->alias);
!empty($season)?$params['season']=$season:false;
!empty($stud)?$params['stud']=$stud:false;

$this->pageTitle=Yii::app()->name . ' - Каталог - Шины - '.CHtml::encode($model->tyre->producer->title).' - '.CHtml::encode($model->tyre->title).' - '.CHtml::encode($model->size);
$this->breadcrumbs=array(
	'Каталог' => array('catalog/index'),
	'Шины'=>array('catalog/tyres'),
	$model->tyre->producer->title => array('catalog/tyres', 'aliasProducer'=>$model->tyre->producer->alias),
	$model->tyre->title => array('catalog/tyres', 'aliasProducer'=>$model->tyre->producer->alias, 'aliasModel'=>$model->tyre->alias),
	$model->size => $params
	
);

echo CHtml::link($model->size, $params).' остаток '.$model->rest.' цена '.$model->price;
$this->widget('widgets.shopping.buy', array( 'model'=>$model ));
?>

<?php 
$this->widget('widgets.socials.socials', array( 'model'=>$model->tyre, 'options'=>array(
	'title' => 'Шина '.$model->tyre->producer->title.' '.$model->tyre->title.' '.$model->size,
	'url' => CHtml::normalizeUrl($params),
	'description' => CHtml::encode($model->tyre->description),
	'printUrl' => CHtml::normalizeUrl($params),
)));
?>
<hr />
<?php 
	$this->widget('widgets.comments.comments', array(
		'model'=>$model->tyre,
	));
?>