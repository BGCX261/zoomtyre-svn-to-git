<div id='footer'>
	<div class='container_12'>
		<p>
			<a href='mailto:<?php echo Yii::app()->params['email']; ?>' class='extra'><?php echo Yii::app()->name; ?></a> 
			&copy; 
			<?php echo date('Y'); ?><?php echo CHtml::link('Политика конфиденциальности', array('index/page', 'view'=>'privacy_policy')); ?>
			<?php
			$dbStats = Yii::app()->db->getStats();
			echo 'Выполнено запросов: '.$dbStats[0].' (за '.round($dbStats[1], 5).' сек)';
			?>
		</p>
	</div>
</div>