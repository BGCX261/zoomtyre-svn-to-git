<!-- id <?php echo $model->id; ?> -->

<h2><?php echo $model->title; ?></h2>
<?php echo EString::getBackTime($model->publicated); ?>
<?php 
	$this->widget('widgets.comments.commentsCount', array(
		'model'=>$model,
	));
?>
<hr />

<?php echo $model->photo?CHtml::image(Image::getFile($model->photo, 'main'), $model->title):''; ?>
<?php echo $model->preamble_marked; ?>
<hr />

<?php echo $model->text_marked; ?>

<hr />
<?php 
$this->widget('widgets.socials.socials', array( 'model'=>$model, 'options'=>array(
	'title' => $model->title,
	'url' => CHtml::normalizeUrl(array('articles/view', 'alias'=>$model->alias)),
	'description' => CHtml::encode($model->preamble),
	'printUrl' => CHtml::normalizeUrl(array('articles/print', 'alias'=>$model->alias)),
)));
?>
<hr />
<?php 
	$this->widget('widgets.comments.comments', array(
		'model'=>$model,
	));
?>