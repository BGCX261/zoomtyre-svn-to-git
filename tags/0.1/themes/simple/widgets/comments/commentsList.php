<?
class commentsList extends CWidget {
	protected $assets;
	public $skin = 'list';

	public $options = array();
	public $model;
	public $name = 'comments';

	public function init(){

		$this->assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
		Yii::app()->getClientScript()
		->registerCoreScript('jquery')
		->registerCssFile($this->assets.'/list.css');

    	$default = array(
    		
    	);
    	
    	$this->options = array_merge($default, $this->options);
    	
	}

	public function run() {
		$this->render($this->skin);
	}
}
?>