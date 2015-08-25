<?php
$this->pageTitle=Yii::app()->name . ' - Каталог';
$this->breadcrumbs=array(
	'Каталог',
);
?>

<div class='grid_8 alpha'>
	<h2 class="title2"><span><span>Каталог товаров</span></span></h2>
	<div class='grid_4 alpha tcenter'>
		<a href='<?php echo CHtml::normalizeUrl(array('catalog/tyres'));?>'><img src="/themes/23000/images/tyre.jpg" alt="Каталог шин" title="Каталог шин"></a>
		<h3><?php echo CHtml::link('Шины', array('catalog/tyres'));?></h3>
	</div>
	<div class='grid_4 omega tcenter'>
		<a href='<?php echo CHtml::normalizeUrl(array('catalog/disks'));?>'><img src="/themes/23000/images/disk.jpg" alt="Каталог дисков" title="Каталог дисков"></a>
		<h3 class=''><?php echo CHtml::link('Диски', array('catalog/disks'));?></h3>
	</div>
</div>

<div class='services grid_4 omega'>
	<?php $this->renderPartial('//modules/info');?>
	
	<?php /* <h2 class="title3"><span><span>Подбор по авто</span></span></h2> */ ?>
</div>