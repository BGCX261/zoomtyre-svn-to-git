<?php class ECatalog extends CWidget {
	 
	var $assets;
	var $options;
	var $model;
	var $name;
	
	public function init(){
		$this->assets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('autocatalog.extensions.catalog.assets'), false, -1, true);
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		$cs->registerScriptFile($this->assets.'/catalog.js');
		
		$default = array(
			'urlCatalog'=>CHtml::normalizeUrl(array('default/ajaxCatalog')),
			'urlBrand'=>CHtml::normalizeUrl(array('default/ajaxBrand')),
			'urlModel'=>CHtml::normalizeUrl(array('default/ajaxModel')),
			'allowEmpty'=>false,
		);
		$this->options = array_merge($default, $this->options);
	}
	
	public function run(){
		
		Yii::import('autocatalog.models.*');
		
		$this->render('default', array(
			'id'=>$this->id,
			'model'=>$this->model,
			'name'=>$this->name,
			'options'=>$this->options,
		));
	}
}
?>