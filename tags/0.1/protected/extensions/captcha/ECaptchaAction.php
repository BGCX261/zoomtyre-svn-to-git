<?
class ECaptchaAction extends CCaptchaAction {
	public function renderImage($code){
		parent::renderImage($this->showCode($code));
	}
    
	protected function showCode($code) {
		$rand = mt_rand(1, (int)$code-1);
		return (mt_rand(0, 1)) ? ((int)$code-$rand."+".(int)$rand.'=') : ((int)$code+$rand."-".(int)$rand.'=');
	}
    
	protected function generateVerifyCode(){
		return mt_rand((int)$this->minLength, (int)$this->maxLength);
	}
	
	public function run() {
		if(isset($_GET[self::REFRESH_GET_VAR])) { // AJAX request for regenerating code
			$this->getVerifyCode(true);
			// we add a random 'v' parameter so that FireFox can refresh the image
			// when src attribute of image tag is changed
			echo $this->getController()->createUrl($this->getId(),array('v' => uniqid()));
		} else {
			$this->renderImage($this->getVerifyCode(true));
			Yii::app()->end();
		}
	}
}
?>