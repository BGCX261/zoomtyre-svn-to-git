<?php

class CharacteristicsController extends AController
{
	var $defaultAction = 'admin';
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Characteristic;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Characteristic']))
		{
			$model->attributes=$_POST['Characteristic'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Characteristic']))
		{
			$model->attributes=$_POST['Characteristic'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Characteristic('search');
		if(isset($_GET['Characteristic']))
			$model->attributes=$_GET['Characteristic'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/*
	 * 
	 */
	public function actionComplete(){
		if(Yii::app()->request->isAjaxRequest && isset($_GET['q'])){
			$val = $_GET['q'];
			$col = mysql_escape_string($_GET['col']);

			$limit = min($_GET['limit'], 50);
			$criteria = new CDbCriteria;
			$criteria->condition = $col.' LIKE :sterm';
			$criteria->params = array(":sterm"=>"%$val%");
			$criteria->limit = $limit;
			$array = Characteristic::model()->findAll($criteria);
			$res = '';
			foreach($array as $value)
				$res .= $value->getAttribute($col)."\n";
			echo $res;
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Characteristic::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='characteristic-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
