<div class='comments' id='<?php echo $this->id; ?>'>
	<a name='comments'></a>
	<?php $this->widget('widgets.comments.commentsList', array(
		'model'=>$this->model,
		'name'=>$this->name,
		'options'=>$this->options,
	)); ?>
	<hr />
	<?php $this->widget('widgets.comments.commentsForm', array(
		'options'=>$this->options,
	)); ?>
</div>