<div id='footer'>
	<div class='container_12 tcenter'>
		<p>
			<a href='mailto:<?php echo Yii::app()->params['email']; ?>' class='extra'><?php echo Yii::app()->name; ?></a> 
			&copy; <?php echo date('Y'); ?> 
			<a href='/index/contact.html'><?php echo Yii::app()->params['phone']; ?></a>
			<a href='mailto:<?php echo Yii::app()->params['email']; ?>' class='extra'>info@sevenparts.ru</a>
			<?php
			#$dbStats = Yii::app()->db->getStats();
			#echo 'Выполнено запросов: '.$dbStats[0].' (за '.round($dbStats[1], 5).' сек)';
			?>
		</p>
	</div>
</div>
<!-- Google.Analytics counter -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18804204-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- /Google.Analytics counter -->
<!-- Yandex.Metrika counter -->
<div style="display:none;"><script type="text/javascript">
(function(w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter5680726 = new Ya.Metrika(5680726);
             yaCounter5680726.clickmap(true);
             yaCounter5680726.trackLinks(true);
        
        } catch(e) { }
    });
})(window, 'yandex_metrika_callbacks');
</script></div>
<script src="//mc.yandex.ru/metrika/watch.js" type="text/javascript" defer="defer"></script>
<noscript><div><img src="//mc.yandex.ru/watch/5680726" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->