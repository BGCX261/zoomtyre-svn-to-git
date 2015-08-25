<?php class TyresWidget extends CWidget {
	public $model;
	public $action = null;
	public $skin = 'tyres_simple';
	
	public function init(){
		$assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($assets.'/main.css');
		$cs->registerScriptFile($assets.'/main.js');
		
		if(empty($this->action))
			$this->action = CHtml::normalizeUrl(array('selection/index'));
	}
	
	public function run(){
		$this->render($this->skin, array(
			'tyreSelection'=>$this->model,
			'action'=>$this->action,
		));
	}
}
?>