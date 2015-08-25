<?php
class AuthWidget extends CWidget {
	public $skin = 'form';
	protected $model = null;

	public function run(){
		$this->model = $this->owner->loginForm;
		
		if(!Yii::app()->user->isGuest)
			$this->skin = 'info';
			
		$this->render($this->skin, array( 'model'=>$this->model ));
		
	}
}