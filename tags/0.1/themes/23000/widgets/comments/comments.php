<?
class comments extends CWidget {
	protected $assets;
	public $skin = 'comments';

	public $options = array();
	public $model;
	public $name = 'comments';

	public function init(){
		
		$this->assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
		$cs = Yii::app()->getClientScript()
		->registerCoreScript('jquery')
		->registerScriptFile($this->assets.'/jquery.comments.js')
		->registerCssFile($this->assets.'/comments.css');
		
    	$default = array(
    		'captchaAction' => 'index/captcha',
    	);
    	
    	$this->options = array_merge($default, $this->options);
    	
    	$cs->registerScript(__CLASS__.'#'.$this->id, 'jQuery("#'.$this->id.'").comments();');
    	
	}

	public function run() {
		$this->render($this->skin);
	}
}
?>