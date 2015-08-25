<?php

class AdminModule extends CWebModule
{
	public function init()
	{

		if(!Yii::app()->user->checkAccess('accessAdmin')) {
			// запрет доступа в админку
			Yii::app()->user->setFlash('loginError','У Вас нет доступа к административной панели.');
			Yii::app()->user->loginRequired();
		}

		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			$controller->attachAssets();

			return true;
		}
		else
			return false;
	}
}
