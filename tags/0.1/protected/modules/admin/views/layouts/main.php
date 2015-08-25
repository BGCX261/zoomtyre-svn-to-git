<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="ru" />
<title><?php echo Yii::app()->name; ?> - Административный раздел<?php echo $this->pageTitle?' - '.$this->pageTitle:''; ?></title>
</head>

<body>
<div class="main">
	<div class='logout'>
		<div class='logo'><a href='/'><?php echo Yii::app()->name; ?></a></div>
		<?php echo CHtml::link(Yii::app()->user->name, array('show'=>Yii::app()->user->id)); ?>
		<?php echo CHtml::link('выход', array('/logout')); ?>
	</div>
	<?php #$this->widget('admin.widgets.MainMenu'); ?>
	<?php 
		$this->widget('admin.widgets.menu2.menu2',array(
			'items' => Part::model()->tree('admin'),
			#'active' => '/admin/regions/view?id=199',
		));
	?>
	
	<div class="content">
		<?php if(!empty($this->menu)): ?>
			<div class="operations">
			<?php
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
				));
			?>
			<br clear="both" />
			</div>
		<?php endif; ?>
		<?php echo $content; ?>
	</div>
</div>

<div class="footer">
<small>
<?php
	$dbStats = Yii::app()->db->getStats();
	echo 'Выполнено запросов: '.$dbStats[0].' (за '.round($dbStats[1], 5).' сек)';
?>
</small>
</div><!-- footer -->

</body>

</html>