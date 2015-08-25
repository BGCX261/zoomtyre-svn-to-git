<?php
class imageUpload extends CWidget {
	public $assets = '';
	public $skin = 'default';
	
	public $model = null;
	public $field = '';
	public $allowDelete = true;
	public $defaultPreviewSize = 'normal';
	public $options = array();
	
	public function init(){
		$default = array();
		$this->options = array_merge($default, $this->options);
		
	}
	
	public function run(){
		$this->render($this->skin, array(
			'options' => $this->options,
		));
	}
} 