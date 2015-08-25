<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<link rel="shortcut icon" href="/favicon.ico"/>
	
	<link rel="stylesheet" type="text/css" href="/themes/simple/css/main.css" />
	<link rel="stylesheet" type="text/css" href="/themes/simple/css/form.css" />

	<?php Yii::app()->clientScript
			->registerCoreScript('jquery')
            ->registerScriptFile('/themes/simple/js/jquery.watermark.min.js')
            ->registerScript('watermark', 'jQuery(".watermark").each(function(){ $(this).watermark( $(this).attr("title"), {"class": "watermark"}); });');
	?>
</head>
<body>
<!-- Yandex.Metrika counter -->
<div style="display:none;"><script type="text/javascript">
(function(w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter4445782 = new Ya.Metrika(4445782);
             yaCounter4445782.clickmap(true);
             yaCounter4445782.trackLinks(true);
        
        } catch(e) { }
    });
})(window, 'yandex_metrika_callbacks');
</script></div>
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script>

<noscript><div style="position:absolute"><img src="//mc.yandex.ru/watch/4445782" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<div id="header">
	<div class='container_12'>
		<div id='auth' class='grid_8 alpha'>
			<?php $this->widget('widgets.auth.authWidget'); ?>
		</div>
		<div id="search" class="grid_4 omega">
			<?php $this->widget('widgets.search.searchWidget'); ?>
		</div>
		<div class='clear'></div>
	</div>
</div>
<div id='top' class='container_12'>
	<h1 class='grid_4 alpha' id='logo'><?php echo CHtml::link(Yii::app()->name, Yii::app()->request->hostInfo);?></h1>
	<div class='grid_8 omega'>
	<?php $this->widget('widgets.menu.EMenu',array(
		'items'=>$this->menu,
		'hideEmptyItems'=>true,
	)); ?>
	</div>
	<div class='clear'></div>
</div>

<div id="content" class="container_12">
	<?php $this->widget('widgets.shopping.cart'); ?>
	
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->
	
	<?php echo $content;?>
</div>
<div id="footer">
	<div class='container_12'>
		<p><?php
			$dbStats = Yii::app()->db->getStats();
			echo 'Выполнено запросов: '.$dbStats[0].' (за '.round($dbStats[1], 5).' сек)';
		?></p>
	</div>
</div>
</body>
</html>
