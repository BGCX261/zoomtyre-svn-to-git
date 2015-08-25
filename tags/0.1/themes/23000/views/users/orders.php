<?php
$this->pageTitle=Yii::app()->name . ' - История заказов';
$this->breadcrumbs=array(
	'История заказов',
);
?>

<?php foreach($model->orders as $o): ?>
<div>
<?php 
$order = CJSON::decode($o->order);
if(count($order)>0): 
?>
<?php echo $o->created; ?> | <?php echo L::ruitem('orderStatus',$o->status); ?> | <?php echo CHtml::link($o->manager, array('managers/view', 'username'=>$o->manager)); ?> 

<table width="100%">
<tr>
	<th>Товар</th>
	<th>За штуку</th>
	<th>Кол-во</th>
	<th>Цена</th>
</tr>
<?php 
$total = 0;
foreach($order as $position): ?>
	<tr><?php 
	$class = $position['item'][0];
	$item = $class::model()->findByPk($position['item'][1]);
	?>
		<td><?php echo CHtml::link($item->getTitle(), $item->getUrl()); ?></td>
		<td><?php echo $position['price'].' р.'; ?></td>
		<td><?php echo $position['quantity'].' шт.'; ?></td>
		<td><?php echo $position['quantity']*$position['price'].' р.'; ?></td>
	</tr>
<?php 
$total += $position['quantity']*$position['price'];
endforeach; ?>
	<tr>
		<th>Итого</th>
		<th><?php 
		$nf = new CNumberFormatter(Yii::app()->language);
		echo $nf->formatCurrency($total, 'RUB'); ?></th>
	</tr>
</table>
<?php endif; ?>

</div>
<?php endforeach; ?> 