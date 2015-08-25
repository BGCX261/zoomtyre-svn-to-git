<?php
class PartsController extends AController {
	var $defaultAction = 'admin';
	
	/*
	 * Метод-заглушка 
	 * (обязательно правило в config->urlManager->rules: '<module:(admin)>/<action:(stub)>'=>'<module>/parts/<action>')
	 * для фиктивных разделов у которых нет обработчиков.
	 */
	public function actionStub($item = null){
		if(!empty($item) && $this->getViewFile($this->action->id.'/'.$item))
			$this->render($this->action->id.'/'.$item);
		else
			$this->render('stub');
	}
	
	
	// вывод куста списком CGridView
	public function actionList($id = null) {
		$root = Part::model()->roots()->findByPk($id);
		#if(empty($root))
			#$this->redirect('admin');
			#$this->forward('admin');
		
		$model=new Part('searchList');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Part']))
			$model->attributes=$_GET['Part'];
			
			
		// сортировка узлов
		if(Yii::app()->request->isPostRequest) {
			$node = Yii::app()->request->getParam('node', null);
			$operation = Yii::app()->request->getParam('operation', null);
			
			$node = $this->loadNode($node);
			if($operation == 'moveDown') {
				if($target = $node->getNextSibling())
					$node->moveAfter($target);
			} elseif($operation == 'moveUp') {
				if($target = $node->getPrevSibling())
					$node->moveBefore($target);
			}
		}

		$this->render('list',array(
			'model'=>$model,
			'root'=>$root,
		));
	}
	
	// Иерархический вывод
	public function actionTree($id = null){
		$root = Part::model()->roots()->findByPk($id);
		$branch = $root->descendants(null, true)->findAll();
		
		$tree = Part::model()->tree->hierarchical($branch);
		
		$this->render('tree', array(
			'model' => $root,
			'tree' => $tree,
		));
		
	}
	
	public function actionViewNode($id = null){
		$model=$this->loadNode($id);
		
		$root = $model->ancestors()->roots()->find();
	
		$this->render('node/view',array(
			'model'=>$model,
			'root' => $root,
			
		));
	}
	
	public function actionCreateNode($id = null){
		$parent=$this->loadNode($id);
		
		if($parent->lft <= 1)
			$root = $parent;
		else
			$root = $parent->ancestors()->roots()->find();

		$model=new Part;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Part'])) {
			$model->attributes=$_POST['Part'];
			if($parent->append($model))
				$this->redirect(array('viewNode','id'=>$model->id));
		}

		$this->render('node/create',array(
			'model'=>$model,
			'root'=>$root,
		));
	}
	
	public function actionUpdateNode($id = null){
		$model=$this->loadNode($id);
		$root = $model->ancestors()->roots()->find();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Part'])) {
			$model->attributes=$_POST['Part'];
			if($model->saveNode())
				$this->redirect(array('viewNode','id'=>$model->id));
		}

		$this->render('node/update',array(
			'model'=>$model,
			'root'=>$root,
		));
	}
	
	public function actionDeleteNode($id) {
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$model = $this->loadNode($id);
			$root = $model->roots()->find();
			$model->deleteNode();
		
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('tree', 'id'=>$root->id));

		}
		else
			throw new CHttpException(400,'Ошибка запроса. Пожалуйста, не повторяйте этот запрос.');
    }
	
	public function actionAdmin(){
		$model=new Part('searchRoots');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Part']))
			$model->attributes=$_GET['Part'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionCreate(){
		$model=new Part;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Part']))
		{
			$model->attributes=$_POST['Part'];

			if($model->saveNode()) {
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionUpdate($id) {
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Part'])) {
			$model->attributes=$_POST['Part'];
			if($model->saveNode())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	public function actionView($id) {
		$model = $this->loadModel($id);
		
		$this->render('view',array(
			'model'=>$model,
		));
	}
	
	public function actionDelete($id) {
		if(Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadNode($id)->deleteNode();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Ошибка запроса. Пожалуйста, не повторяйте этот запрос.');
    }
	
	public function loadNode($id) {
		$model=Part::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'Запрашиваемая страница не существует.');
		return $model;
    }
	
	public function loadModel($id) {
		$model=Part::model()->roots()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'Запрашиваемая страница не существует.');
		return $model;
    }
}