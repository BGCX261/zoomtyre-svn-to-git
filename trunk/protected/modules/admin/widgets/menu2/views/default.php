<div class="nav" >
	<div class="main_menu menu">
		<ul class="">
			<?php $l=count($top);foreach($top as $n=>$t):?>
			<li><?php
			$class = $t['active']?$this->activeCssClass:'';
			$class .= ($n+1 == $l)?' last':'';
			echo CHtml::link($t['title'], CHtml::normalizeUrl( trim($t['url'], '\'') ), array('class'=>$class)); 
			?></li>
			<?php endforeach; ?>
		</ul>	
	</div>
	<div class="sub_menu menu">
		<ul class="crumble">
			<?php foreach($middle as $t):?>
			<li><?php echo CHtml::link($t['title'], CHtml::normalizeUrl( trim($t['url'],'\'') )); ?></li>
			<?php endforeach; ?>
		</ul>
		<ul class="level">
			<?php $l=count($bottom);foreach($bottom as $n=>$t):?>
			<li><?php
			$class = $t['active']?$this->activeCssClass:'';
			echo CHtml::link($t['title'], CHtml::normalizeUrl( trim($t['url'],'\'') ), array('class'=>$class)); 
			?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>