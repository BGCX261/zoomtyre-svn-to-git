<ul>
<?php 
foreach($this->model->{$this->name} as $comment): ?>
	<li style='margin-left: <?php echo ($comment->level)*20;?>px;'>
		<a name='<?php echo 'comment-'.$comment->id; ?>'></a>
		<div class='comment'>
			<?php echo $comment->author; ?>, <?php echo EString::getBackTime($comment->created); ?>
			<a class='ans' href='#<?php echo 'comment-'.$comment->id; ?>' rel='<?php echo $comment->id; ?>' author='<?php echo $comment->author; ?>'>ответить</a>
			<hr style="border-bottom: 2px solid white;">
			<?php echo $comment->text_marked; ?>
		</div>
	</li>
<?php endforeach; ?>
</ul>