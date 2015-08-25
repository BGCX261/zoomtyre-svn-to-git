<?php class disksWidget extends CWidget {
	public $model;
	public $action = null;
	public $skin = 'disks_simple';
	
	public function init(){
		$assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($assets.'/main.css');
		$cs->registerScriptFile($assets.'/main.js');
		
		if(empty($this->model))
			$this->model = new DiskSelectionForm;
		
		if(empty($this->action))
			$this->action = CHtml::normalizeUrl(array('selection/index'));
	}
	
	public function run(){
		$this->render($this->skin, array(
			'diskSelection'=>$this->model,
			'action'=>$this->action,
		));
	}
}
?>