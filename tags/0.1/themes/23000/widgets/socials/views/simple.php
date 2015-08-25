<table class='text-controls block'>
	<tr>
		<?php if($options['rating']): ?>
		<td><?php 
			$this->widget('widgets.rating.rating', array( 'model'=>$model, 'url'=>$options['ratingUrl'], 'options'=>array( 'class'=>$options['ratingClass']))); 
		?></td>
		<?php endif;?>
		<td>
			<div class="yashare-auto-init" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,lj,friendfeed,moikrug"></div>  
		</td>
	</tr>
</table>