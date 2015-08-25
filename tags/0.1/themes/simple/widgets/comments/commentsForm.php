<?
class commentsForm extends CWidget {
	protected $form = null;
	protected $assets;
	public $skin = 'form';

	var $options = array();
	var $model;
	

	public function init(){

		$this->assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
		Yii::app()->getClientScript()
		->registerCoreScript('jquery')
		->registerCssFile($this->assets.'/form.css');

		$default = array(
			'captchaAction' => 'captcha',
		);
    	
		$this->options = array_merge($default, $this->options);

    	$this->form = Yii::app()->user->getState('CommentForm');

		if(empty($this->form))
			$this->form = new CommentForm;
			
		if(!Yii::app()->user->isGuest && empty($this->form->author))
			$this->form->author = Yii::app()->user->name;

	}

	public function run() {
		$this->render($this->skin);
	}
}
?>