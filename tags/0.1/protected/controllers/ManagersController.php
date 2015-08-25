<?php
class ManagersController extends Controller
{

	public function actionIndex(){
		$this->render('index');
	}
	
	/*
	 * Просмотр профиля
	 */
	public function actionView($username = null){
		if($model = Manager::model()->find('username=:username', array(':username'=>$username)) ) {
			$this->render('view', array(
				'model'=>$model,
			));
		} else
			throw new CHttpException(400,'Такой страницы нет');
	}
}