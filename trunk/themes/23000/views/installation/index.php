<?php
$this->pageTitle=Yii::app()->name . ' - Шиномонтаж и установка';
$this->breadcrumbs=array(
	'Шиномонтаж',
);
?>

<div class='grid_8 alpha'>
	<h2 class="title2"><span><span>Шиномонтаж</span></span></h2>
	<?php 
	Yii::app()->getClientScript()->
	registerScriptFile('http://api-maps.yandex.ru/1.1/index.xml?key='.Yii::app()->params['yandexApiKey']);
	?>
	<p>Всю информацию о установке, балансировке и шиномонтажу Вы можете узнать у наших менеджеров по телефону <?php echo Yii::app()->params['phone']; ?></p>
	<p>Рекомендуем Вам обратиться к нашим статьям посвещенным подбору и установке шин и дисков, например к этой <a href='/articles/view/Osobennosti_shinomotazha.html'>Особенности шиномотажа</a></p>
	<p>Так же Вы можете обратиться в любой из наших партнёрских шиномонтажных центров, для получения качественных услуг со скидкой!</p>
	
	<ul id='tire_fittings'>
		<li><h3>Докукина ул., д.16, стр.1 (на территории автокомбината мос-почтампт)</h3>
		<div id='map1' class='map'></div>
		<script type="text/javascript">

		var map1 = new YMaps.Map(document.getElementById('map1'));
		map1.addControl(new YMaps.Zoom());
		map1.addControl(new YMaps.ScaleLine());
		map1.enableScrollZoom();
		map1.setCenter(new YMaps.GeoPoint(37.649576,55.841884), 16);
		var placemark1 = new YMaps.Placemark(new YMaps.GeoPoint(37.649576,55.841884));
		placemark1.name = "Шиномонтаж на Докукина";
		map1.addOverlay(placemark1);
		placemark1.openBalloon();
		</script>
		<b>График работы ежедневно с 9:00-21:00</b><br />
		Контактный телефон для предварительной записи +7(926)480-0202 Геннадий 
		</li> 
		<li><h3>Самокатная ул., д.2А</h3>
		<div id='map2' class='map'></div>
		<script type="text/javascript">
		var map2 = new YMaps.Map(document.getElementById('map2'));
		map2.addControl(new YMaps.Zoom());
		map2.addControl(new YMaps.ScaleLine());
		map2.enableScrollZoom();
		map2.setCenter(new YMaps.GeoPoint(37.677337,55.758706), 16);
		var placemark2 = new YMaps.Placemark(new YMaps.GeoPoint(37.677337,55.758706));
		placemark2.name = "Шиномонтаж на Самокатной";
		map2.addOverlay(placemark2);
		placemark2.openBalloon();
		</script>
		<b>График работы ежедневно с 10:00-23:00</b><br />
		Контактный телефон для предварительной записи +7(903)142-8626 и +7(963)653-7942 Алексей
		</li>
	</ul>	
</div>
<div class='grid_4 omega services'>
	<h2 class="title1"><span><span>Подбор шин</span></span></h2>
	<?php $this->widget('widgets.selection.tyresWidget')?>
	<?php $this->renderPartial('//modules/info');?>
</div>