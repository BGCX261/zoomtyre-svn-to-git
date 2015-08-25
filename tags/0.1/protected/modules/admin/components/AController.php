<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AController extends CController
{
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	
	public $assets;
	
	public function attachAssets(){
		$path = Yii::getPathOfAlias('admin.assets');
		$this->assets = Yii::app()->assetManager->publish($path, false, -1, true);
		
		Yii::app()->clientScript->registerCoreScript('jquery')
		->registerScriptFile($this->assets.'/js/jquery.colourific.js', CClientScript::POS_HEAD)
		->registerScriptFile($this->assets.'/js/jquery.selectboxes.min.js')
		->registerScriptFile($this->assets.'/js/translit.js')
		->registerCssFile($this->assets.'/css/main.css')
		->registerCssFile($this->assets.'/css/ui.theme.smoothness/jquery-ui-1.7.3.css');
	}
}