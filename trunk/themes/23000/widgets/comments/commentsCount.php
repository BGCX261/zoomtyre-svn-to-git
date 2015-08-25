<?php class commentsCount extends CWidget {
	protected $assets;
	public $skin = 'count';

	public $options = array();
	public $model;
	public $name = 'comments_count';

	public function init(){
		
		$this->assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
		Yii::app()->getClientScript()
		->registerCoreScript('jquery')
		->registerCssFile($this->assets.'/count.css');

    	$default = array(
    		'url' => Yii::app()->request->requestUri,
    	);
    	
    	$this->options = array_merge($default, $this->options);
    	
	}

	public function run() {
		$this->render($this->skin);
	}
}
?>