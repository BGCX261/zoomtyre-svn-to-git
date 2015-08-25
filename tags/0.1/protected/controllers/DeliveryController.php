<?php
class DeliveryController extends Controller {
	public function actionIndex(){
		$this->render('index');
	}
	public function actionRegions(){
		$this->render('regions');
	}
}