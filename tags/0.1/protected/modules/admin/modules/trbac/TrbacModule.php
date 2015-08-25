<?php

class TrbacModule extends CWebModule
{
	public function init()
	{
		if(!Yii::app()->user->checkAccess('accessTRBAC')) {
			throw new CHttpException(403,'Ошибка запроса. У Вас нет доступа к выполнению этой операции.');
			return false;
		}
		
		// import the module-level models and components
		$this->setImport(array(
			'trbac.models.*',
			'trbac.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
