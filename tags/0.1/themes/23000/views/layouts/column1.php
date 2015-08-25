<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="/themes/23000/css/style.css" rel="stylesheet" type="text/css" />
	<?php 
	Yii::app()->getClientScript()
	->registerCoreScript('jquery')
	#->registerScriptFile('/themes/23000/js/fancybox/jquery.mousewheel-3.0.4.pack.js')
	->registerScriptFile('/themes/23000/js/fancybox/jquery.fancybox-1.3.4.pack.js')
	->registerCssFile('/themes/23000/js/fancybox/jquery.fancybox-1.3.4.css', 'screen')
	->registerScript('fancybox', '$("a.fancybox").fancybox({"titlePosition":"inside"});');
	?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
	<div class='container_12'>
    <!--header -->
    <?php $this->beginContent('//layouts/header'); ?>
	<?php $this->endContent(); ?>
    <!--header end-->
    	<div id="content">
    		<?php echo $content; ?>
    		<div class='clear'></div>
    	</div>
	</div>
    <!--footer -->
    <?php $this->beginContent('//layouts/footer'); ?>
	<?php $this->endContent(); ?>
	<!--footer end-->
</body>
</html>