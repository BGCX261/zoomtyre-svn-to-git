<ul class="logIn right">
	<?php 
	$c = count($options['items']);
	foreach($options['items'] as $k=>$item):
		if($k == $c-1) $class='extra';

		if(isset($item['class']))
			$class .= ' '.$item['class'];

		if(!(isset($item['visible']) && $item['visible']==false)):
	?>
	<li<?php echo (isset($class)?(' class="'.$class.'"'):''); ?>>
		<a href="<?php echo CHtml::normalizeUrl($item['url']); ?>"><?php echo $item['title']; ?></a></li>
	<?php endif; ?>
	<?php endforeach; ?>
</ul> 