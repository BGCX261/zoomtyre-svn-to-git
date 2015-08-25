<div id="<?php echo $this->id; ?>">
<?php if($cart->getCount() > 0): ?>
	<?php echo $cart->getCount(); ?> позиций - 
	<?php echo $cart->getItemsCount(); ?> штук -
	<?php echo $cart->getCost(); ?> рублей -
	<?php echo CHtml::link('очистить корзину', '#', array('id'=>$this->id.'_clearBasket')); ?>
	<?php echo CHtml::link('оформить заказ', array('basket/index')); ?>
<?php endif; ?>
</div>