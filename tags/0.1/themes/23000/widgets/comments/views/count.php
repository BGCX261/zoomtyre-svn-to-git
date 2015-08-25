<?php if($this->model->{$this->name} > 0): ?>
<div class="comments-count">
	<div class="f_tt"></div>
	<div class="f_r"><div class="f_rr"></div>
		<div class="f_b"><div class="f_bb"><div></div></div>
			<div class="f_l"><div class="f_ll"><div></div></div>
				<div class="f_c"><?php echo CHtml::link($this->model->{$this->name}, $this->options['url'].'#comments', array('title'=>'Комментарии')); ?></div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>