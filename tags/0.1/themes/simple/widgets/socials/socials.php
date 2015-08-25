<?
class socials extends CWidget {
	var $options = array();
	var $model;

	public function init(){
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile(Yii::app()->params['addthisAPI'], CClientScript::POS_END);

		$default = array(
			'skin'=>'simple',
			'title' => '',
			'url' => '',
			'description' => '',
			'print' => true,
			'printUrl' => false,
			'rating' => false,
			'ratingClass' => '',
			'ratingUrl' => '',
		);

		$this->options = array_merge($default, $this->options);

		return parent::init();
	}
	
	public function run(){
		$this->render($this->options['skin'], array( 'model'=>$this->model, 'options'=>$this->options ));
	}
}
?>