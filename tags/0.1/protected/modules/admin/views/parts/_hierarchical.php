<?php if(!empty($tree)): ?>
<ul>
<?php
foreach($tree as $node):
?>
	<li>
		<?php echo CHtml::link($node->title, array($node->lft > 1?'viewNode':'view', 'id'=>$node->id)); ?>
		<?php 
		if($node->url) 
			echo CHtml::link(CHtml::image($this->assets.'/images/el.png'), $node->url); 
		?>
		<?php if(!empty($node->childs))
				$this->renderPartial('_hierarchical', array('tree'=>$node->childs));
		?>
	</li>
<?php 
endforeach;
?>
</ul>
<?php endif; ?>