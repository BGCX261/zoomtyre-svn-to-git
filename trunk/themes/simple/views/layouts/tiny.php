<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="/favicon.ico"/>
	
	
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
	<?php Yii::app()->clientScript
			->registerCoreScript('jquery')
            ->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.watermark.min.js')
            ->registerScript('watermark', 'jQuery(".watermark").each(function(){ $(this).watermark( $(this).attr("title"), {"class": "watermark"}); });');
	?>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<body>

<?php echo $content;?>

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

</body>
</html>
