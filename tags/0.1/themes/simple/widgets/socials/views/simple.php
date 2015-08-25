<table class='text-controls block'>
	<tr>
		<?php if($options['rating']): ?>
		<td><?php 
			$this->widget('widgets.rating.rating', array( 'model'=>$model, 'url'=>$options['ratingUrl'], 'options'=>array( 'class'=>$options['ratingClass']))); 
		?></td>
		<?php endif;?>
		<td>
			<script type="text/javascript">
			var addthis_share =
			{
				"title": <?php echo CJavaScript::encode(CHtml::encode($options['title'])); ?>,
				"url": '<?php echo Yii::app()->request->hostInfo.$options['url']; ?>',
				"description": <?php echo CJavaScript::encode(CHtml::encode($options['description'])); ?>
			}
			</script>
			<div class='addthis_toolbox addthis_32x32_style addthis_default_style'>
				<?php if( $options['printUrl'] !== false || $options['print'] == false): ?>
			    <a class='at300b' href='<?php echo $options['printUrl']; ?>' title='Версия для печати'>
			    	<span class='at300bs at15t_print'></span>
			    </a>
			    <?php endif; ?>
			    <a class='addthis_button_vk' title='Сохранить в ВКонтакте'></a>
			    <a class='addthis_button_facebook' title='Сохранить в FaceBook'></a>
			    <a class='addthis_button_twitter' title='Добавить сообщение в Twitter'></a>
			    <a class='addthis_button_bobrdobr' title='Добавить закладку в БобрДобр'></a>
			    <a class='addthis_button_google' title='Добавить ссылку в Закладки Google'></a>
			    <a class='addthis_button_email' title='Оправить ссылку по поче'></a>
			    <a class='addthis_button_compact' title='Остальные сервисы'></a>
			</div>
		</td>
	</tr>
</table>