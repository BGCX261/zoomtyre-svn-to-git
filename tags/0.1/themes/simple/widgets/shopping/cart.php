<?php
class cart extends CWidget {
	public $id = 'shoppingCart';
	public $skin = 'cart';
	
	public function init(){
		#$this->assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
		$cs = Yii::app()->getClientScript()
		->registerCoreScript('jquery');
		
		$cs->registerScript(__CLASS__.'#'.$this->id.'_clearBasket', 'jQuery("#'.$this->id.'_clearBasket").live("click", function(){
			$.ajax({
				"data":"ajax=basket&operation=clear",
				"type":"post",
				"success":function(data){ $("#'.$this->id.'").html($(data).find("#'.$this->id.'").html()); }
			});
		});');

	}
	
	public function run(){
		$cart = Yii::app()->shoppingCart;
		
		$this->render($this->skin, array('cart' => $cart));
	}
	
}