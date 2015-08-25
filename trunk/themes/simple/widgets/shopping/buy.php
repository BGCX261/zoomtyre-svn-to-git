<?php class buy extends CWidget {
	protected $form = null;
	protected $assets;
	public $skin = 'buy';

	public $options = array();
	public $model;

	public function init(){
		
		$this->assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
		$cs = Yii::app()->getClientScript()
		->registerCoreScript('jquery');
    	
		$default = array(
		);

    	$this->options = array_merge($default, $this->options);

    	$this->form = Yii::app()->user->getState('BasketForm');

		if(empty($this->form))
			$this->form = new BasketForm;
    	
	}

	public function run() {
		$this->render($this->skin);
	}
}
?>