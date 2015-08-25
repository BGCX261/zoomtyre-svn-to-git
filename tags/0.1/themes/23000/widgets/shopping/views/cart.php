<span id="<?php echo $this->id; ?>">Корзина
<?php if($cart->getCount() > 0): ?>
 &mdash; <?php echo $cart->getCost(); ?> <i class='rub'>Р</i>
<?php endif; ?>
</span>