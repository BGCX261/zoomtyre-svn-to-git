<?php
class SearchWidget extends CWidget {
	public $skin = 'form';
	protected $model = null;
	public $assets;

	public function run(){
		$this->assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
	
		#$this->model = $this->owner->searchForm;
		
		$this->render($this->skin, array( 'model'=>$this->model ));
		
	}
}