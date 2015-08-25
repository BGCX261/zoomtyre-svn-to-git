<?php
$this->pageTitle=Yii::app()->name . ' - Продажа шин, дисков, автозапчастей';
$this->breadcrumbs=array(
	'Главная страница',
);
?>
<div class='container_12'>
	<div class='grid_4 alpha'>
		<h2 class="title1"><span><span>Подбор шин</span></span></h2>
		<?php $this->widget('widgets.selection.tyresWidget')?>
	</div>
	<div class='grid_4 omega'>
		<h2 class="title2"><span><span>Подбор дисков</span></span></h2>
		<?php $this->widget('widgets.selection.disksWidget')?>
	</div>
</div>

<div class='services grid_4 omega'>
	<?php $this->renderPartial('//modules/info');?>
	
	<?php if(count($news) > 0): ?>
	<h2 class="title3"><span><span>Новости</span></span></h2>
	<ul>
	<?php 
		foreach($news as $i=>$article):
		if($i>5) continue; 
	?>
		<li>
			<h3><?php echo CHtml::link($article->title, array('news/view', 'alias'=>$article->alias)); ?></h3>
		</li>
	<?php endforeach; ?>
	</ul>
	<?php if($i>5): ?>
	<?php echo CHtml::link('Остальные новости', array('news/index')); ?>
	
	<?php endif; ?>
	<?php endif; ?>
</div>

<hr class='space' />
<?php /*
<div class="box2 span-26">
	<div class="box-right">
		<div class="wrapper">
			<a href='<?php echo CHtml::normalizeUrl(array('catalog/view', 'part'=>'accessory')); ?>'>
				<img class="img-indent" alt="АвтоАксессуары" title='Аксессуары' src='/themes/23000/images/page-1-img1.jpg' />
			</a>
			<div class="inner">
				<ul class="left accessory">
					<li><a href="#">BIGSON S-1021DVD beige</a></li>
					<li><a href="#">µ-Dimension EL-A54</a></li>
					<li><a href="#">BFGoodrich All-Terrain T/A</a></li>
					<li><a href="#">OZ Racing Superleggera Race Gold</a></li>
					<li><a href="#">BFGoodrich All-Terrain T/A</a></li>
				</ul>
				<ul class="left accessory">
					<li><a href="#">BIGSON S-1021DVD beige</a></li>
					<li><a href="#">µ-Dimension EL-A54</a></li>
					<li><a href="#">BFGoodrich All-Terrain T/A</a></li>
					<li><a href="#">OZ Racing Superleggera Race Gold</a></li>
					<li><a href="#">BFGoodrich All-Terrain T/A</a></li>
				</ul>
				<ul class="left accessory">
					<li><a href="#">BIGSON S-1021DVD beige</a></li>
					<li><a href="#">µ-Dimension EL-A54</a></li>
					<li><a href="#">BFGoodrich All-Terrain T/A</a></li>
					<li><a href="#">OZ Racing Superleggera Race Gold</a></li>
					<li><a href="#">BFGoodrich All-Terrain T/A</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<hr class='space' />
*/ ?>

<div class='container_12 info'>
	<h2 class="title3"><span><span>www.SevenParts.ru</span></span></h2>
<p>Интернет-магазин <a href='/'><?php echo Yii::app()->name; ?></a> готов предложить <b>большой ассортимент летних и зимних шин</b>, 
 <b>мотошин</b>, <b>автомобильных дисков</b>, <b>аккумуляторов</b>, а также <b>горюче-смазочных материалов</b> от именитых производителей, 
 на выгодных условиях и по низким ценам. <b>Интернет-магазин <a href='/'><?php echo Yii::app()->name; ?></a></b> занимается <b>оптовой</b>,
 <b>мелкооптовой</b> и <b>розничной продажей</b> продукции  известных отечественных и зарубежных производителей.</p>
<p><b>Автомобильные колеса</b>, одно из важнейших связующих звеньев одной большой цепи, имя которой автомобиль, 
 поэтому правильный выбор шин во многом зависит от квалифицированного подхода к покупке. 
 Ведь это напрямую связанно с Вашей безопасностью на дороге и безопасностью других участников движения.</p> 
<p>Для удобства на сайте <a href='/'><?php echo Yii::app()->name; ?></a> есть <b>электронный каталог для подбора зимних или летних шин</b>,
 а так же <b>автомобильных дисков</b> специально для Вашего авто.</p>
<p>Чтобы учесть пожелания наших клиентов, интернет-магазин <a href='/'><?php echo Yii::app()->name; ?></a> постоянно обновляет
 ассортимент своей продукции и предлагает, как уже зарекомендовавшие себя, так и <b>совершенно новые модели ведущих мировых производителей</b> 
 таких как <b><a href='/catalog/tyres/nokian1.html'>Nokian</a></b>,
 <b><a href='/catalog/tyres/michelin1.html'>Michelin</a></b>,
 <b><a href='/catalog/tyres/bridgestone1.html'>Bridgestone</a></b>,
 <b><a href='/catalog/tyres/pirelli1.html'>Pirelli</a></b>,
 <b><a href='/catalog/tyres/continental1.html'>Continental</a></b>,
 <b><a href='/catalog/tyres/dunlop1.html'>Dunlop</a></b>,
 <b><a href='/catalog/tyres/goodyear1.html'>GoodYear</a></b>,
 <b><a href='/catalog/tyres/yokohama1.html'>Yokohama</a></b>,
 <b><a href='/catalog/disks/replica_fr1.html'>Replica</a></b>,
 <b><a href='/catalog/disks/skad1.html'>Скад</a></b>,
 <b><a href='/catalog/disks/oz_racing1.html'>OZ Racing</a></b>,
 <b><a href='/catalog/disks/cms1.html'>CMS</a></b> и многих других. 
<p>Вся наша <b>продукция высокого качества</b> и имеет <b>заводскую гарантию</b>.</p>
<p>У нас Вы сможете <b>купить летние шины</b>, <b>зимние шины</b>, <b>колесные диски</b>, а так же <b>аккумуляторы и <b>масло</b> для
 своего автомобиля за наличный расчёт с доставкой.</p>

</div>
<hr class='space' />
