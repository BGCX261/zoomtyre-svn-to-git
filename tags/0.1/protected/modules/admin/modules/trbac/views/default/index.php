<script type="text/javascript">
function makeActive(t){
	$('#trbac a').removeClass('selected');
	$(t).toggleClass('selected');
}
</script>

<div class='colmask leftmenu'> 
	<div class='colleft'> 
		<div class='col1'> 
			<!-- Column 1 start -->
			<div class='view' id='ajaxView'>Выберете элемент авторизации...</div>
			<!-- Column 1 end --> 
		</div> 
		<div class='col2'> 
			<!-- Column 2 start --> 
		 	<div id="sidetreecontrol"><a href="#">Свернуть все</a> | <a href="#">Развернуть все</a></div>
			<?php 
			$this->widget('CTreeView', array(
				'id'=>'trbac',
				'data'=>$tree,
				'persist'=>'cookie',
				'collapsed'=>true,
				'control'=>'#sidetreecontrol',
				#'unique'=>true,
				'animated'=>'fast',
				'cookieId'=>'treerbac',
			));
			?>
			<!-- Column 2 end --> 
		</div> 
	</div> 
</div> 
