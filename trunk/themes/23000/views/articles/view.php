<?php
$this->pageTitle=Yii::app()->name . ' - Новости - '.CHtml::encode($model->title);
$this->breadcrumbs=array(
	'Новости' => array('articles/index'),
	$model->title,
);
?>

<!-- id <?php echo $model->id; ?> -->

<h2><?php echo $model->title; ?></h2>
<?php echo EString::getBackTime($model->publicated); ?>
<hr  class='space'/>

<?php echo $model->photo?CHtml::image(Image::getFile($model->photo, 'main'), $model->title, array('align'=>'left','style'=>'margin-right:1em;border:1px solid #eee;')):''; ?>
<?php echo $model->preamble_marked; ?>
<?php 
$this->widget('widgets.socials.socials', array( 'model'=>$model, 'options'=>array(
	'title' => $model->title,
	'url' => CHtml::normalizeUrl(array('articles/view', 'alias'=>$model->alias)),
	'description' => CHtml::encode($model->preamble),
	'printUrl' => CHtml::normalizeUrl(array('articles/print', 'alias'=>$model->alias)),
)));
?>
<hr class='space clear' />

<?php echo $model->text_marked; ?>

<hr class='space clear'/>

<?php 
	$this->widget('widgets.comments.comments', array(
		'model'=>$model,
	));
?>