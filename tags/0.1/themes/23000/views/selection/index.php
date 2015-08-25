<?php
$this->pageTitle=Yii::app()->name . ' - Продажа шин, дисков, автозапчастей';
$this->breadcrumbs=array(
	'Подбор',
);
?>

<div class='grid_4 alpha'>
	<h2 class="title1"><span><span>Подбор шин</span></span></h2>
	<?php $this->widget('widgets.selection.tyresWidget')?>
</div>

<div class='grid_4'>
	<h2 class="title3"><span><span>Полезная информация</span></span></h2>
</div>

<div class='grid_4 omega'>
	<h2 class="title2"><span><span>Подбор дисков</span></span></h2>
	<?php $this->widget('widgets.selection.disksWidget')?>
</div>