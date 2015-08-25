<?php class rating extends CWidget {
	var $options = array();
	var $model;
	var $url = '';

	public function init(){

		$default = array(
			'model'=>$this->model,
			'skin'=>'simple',
			'class'=>'rating',
		);

		$this->options = array_merge($default, $this->options);

		return parent::init();
	}
	
	public function run(){

		$this->render($this->options['skin'], array( 'options'=>$this->options, 'url'=>$this->url ));
	}
}
?>