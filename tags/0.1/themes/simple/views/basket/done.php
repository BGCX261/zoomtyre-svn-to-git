Ваш заказ успешно принят!

<?php 
if(!empty($order) && empty($order->client)){
	$registration_form->attributes = $order->attributes;
	$this->renderPartial('_registration', array('order'=>$order, 'registration_form'=>$registration_form));
}
?>