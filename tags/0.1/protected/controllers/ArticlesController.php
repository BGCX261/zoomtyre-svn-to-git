<?php
class ArticlesController extends Controller {
	
	public function actionIndex(){
		$criteria = new CDbCriteria();

		$count = Article::model()->published()->count($criteria);
		$pages=new CPagination($count);

		// results per page
		$pages->pageSize=Yii::app()->params['articlesOnPage'];
		$pages->applyLimit($criteria);
		
		$models = Article::model()->published()->findAll($criteria);
		
		$this->render('index', array(
			'models' => $models,
			'pages' => $pages
		));
	}

	public function actionView($alias = null){
		$model = $this->loadModelByAlias($alias);
		
		$this->pageTitle = $model->title;

		Yii::app()->clientScript->registerMetaTag(str_replace("\n",'',strip_tags($model->preamble_marked)), 'description');

		$this->addComment($model);

		$this->menu_element = $model->title;
		
		$this->render('view', array(
			'model'=>$model,
		));
	}
	
	public function actionPrint($alias = null){
		$model = $this->loadModelByAlias($alias);
		
		$this->pageTitle = $model->title;
		Yii::app()->clientScript->registerMetaTag(str_replace("\n",'',strip_tags($model->preamble_marked)), 'description');

		#$this->addComment($model);
		
		$this->layout = 'print';
		$this->render('print', array(
			'model'=>$model,
		));
	}
	
	public function loadModelByAlias($alias){
		$model = Article::model()->find('alias=:alias', array(':alias'=>$alias));
		if($model===null)
			throw new CHttpException(404,'Запрашиваемая страница не существует.');
		return $model;
	}
}