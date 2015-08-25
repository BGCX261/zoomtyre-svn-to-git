<?php
class AccessFilter extends CFilter {
	public $object;
	
	protected function preFilter($filterChain){
		if(!Yii::app()->user->checkAccess($this->object)) {
			throw new CHttpException(403,'Ошибка запроса. У Вас нет доступа к выполнению этой операции.');
			return false;
		}

		return true;
	}
	
	protected function postFilter($filterChain){
		
	}
}