<?php
class cart extends CWidget {
	public $id = 'shoppingCart';
	public $skin = 'cart';
	
	public function init(){
		#$this->assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
		$cs = Yii::app()->getClientScript()
		->registerCoreScript('jquery');

		$cs->registerScript(__CLASS__.'#clearBasket', 'jQuery(".clearBasket").live("click", function(){
			$.ajax({
				"data":"ajax=basket&operation=clear",
				"type":"get",
				"success":function(data){ 
					$("#'.$this->id.'").html($(data).find("#'.$this->id.'").html());
					$("#basket").html($(data).find("#basket").html());
				}
			});
			
			return false;
		});');

	}
	
	public function run(){
		$cart = Yii::app()->shoppingCart;
		
		$this->render($this->skin, array('cart' => $cart));
	}
	
}