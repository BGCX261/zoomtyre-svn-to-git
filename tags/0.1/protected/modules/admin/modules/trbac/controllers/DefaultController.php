<?php
/*
	$auth->createOperation('createPost','создание записи');
	$auth->createOperation('readPost','просмотр записи');
	$auth->createOperation('updatePost','редактирование записи');
	$auth->createOperation('deletePost','удаление записи');
		 
	$bizRule='return Yii::app()->user->id==$params["post"]->authID;';
	$task=$auth->createTask('updateOwnPost','редактирование своей записи',$bizRule);
	$task->addChild('updatePost');
		 
	$role=$auth->createRole('reader');
	$role->addChild('readPost');
		 
	$role=$auth->createRole('author');
	$role->addChild('reader');
	$role->addChild('createPost');
	$role->addChild('updateOwnPost');
		 
	$role=$auth->createRole('editor');
	$role->addChild('reader');
	$role->addChild('updatePost');
		 
	$role=$auth->createRole('admin');
	$role->addChild('editor');
	$role->addChild('author');
	$role->addChild('deletePost');
		 
	$auth->assign('reader','readerA');
	$auth->assign('author','authorB');
	$auth->assign('editor','editorC');
	$auth->assign('admin','adminD');
*/

class DefaultController extends AController
{
	private $_model;
	
	public function actionIndex()
	{
		$tree = $this->getTree();
		Yii::app()->clientScript->registerCssFile($this->assets.'/css/2-column-liquid-layout.css');
	
		$this->render('index', array('tree'=>$tree));
	}
	
	public function actionView(){
		$name = Yii::app()->getRequest()->getParam('name');
		$item = $this->getItem($name);
		$assigned = $this->getAssigned($name);
		
		if(Yii::app()->request->isAjaxRequest){
			$this->renderPartial('ajaxView', array(
				'item'=>$item,
				'assigned'=>$assigned,
			));
			Yii::app()->end();
		}
		
		$this->render('view',array(
				'item'=>$item,
				'assigned'=>$assigned,
		));
	}
	
	public function actionUpdate(){
		$item = $this->getItem();

		if(isset($_POST['AuthItem'])) {
			$item->attributes = $_POST['AuthItem'];
			if($item->save())
				$this->redirect(array('view','name'=>$item->name));
		}

		$this->render('update',array(
			'item'=>$item
		));
	}
	
	public function actionManage(){
		$item = $this->getItem();
		$assigned = $this->getAssigned($item->name);
		$model = new AuthAssignment;

		if(isset($_POST['delete_AuthAssignment'])){
			foreach($_POST['AuthAssignment'] as $delete) {
				if($delete['_delete']) {
					$model->deleteAll('userid=:userid', array(':userid'=>$delete['userid']));
				}
			}
			$this->redirect(array('view','name'=>$item->name));
		} elseif(isset($_POST['AuthAssignment'])){
			$model->attributes = $_POST['AuthAssignment'];
			$model->itemname = $item->name;
			
			if($model->save())
				$this->redirect(array('view','name'=>$item->name));
		}
		
		$this->render('manage', array(
			'model'=>$model,
			'item'=>$item,
			'assigned'=>$assigned,
		));
	}
	
	public function actionAutoCompleteLookup(){
       if(Yii::app()->request->isAjaxRequest && isset($_GET['q']))
       {
            /* q is the default GET variable name that is used by
            / the autocomplete widget to pass in user input
            */
          $name = $_GET['q']; 
                    // this was set with the "max" attribute of the CAutoComplete widget
          $limit = min($_GET['limit'], 50); 
          $criteria = new CDbCriteria;
          $criteria->condition = "username LIKE :sterm";
          $criteria->params = array(":sterm"=>"%$name%");
          $criteria->limit = $limit;
          $userArray = User::model()->findAll($criteria);
          $returnVal = '';
          foreach($userArray as $userAccount)
          {
             $returnVal .= $userAccount->getAttribute('username')."\n";
          }
          echo $returnVal;
       }
    }
	
	public function actionCreate(){
		$parent = $this->getItem();
		$item = new AuthItem;
		$item_child = new AuthItemChild;
		
		if(isset($_POST['AuthItem'])) {
			$item->attributes = $_POST['AuthItem'];
			$item_child->attributes = $_POST['AuthItemChild'];
			$item_child->child = $item->name;
			if($item->validate() && $item_child->validate()) {
				$item->save(false);
				$item_child->save(false);
				$this->redirect(array('view','name'=>$item->name));
			}
		}

		$this->render('create',array(
			'parent'=>$parent,
			'item'=>$item,
			'item_child'=>$item_child,
		));
		
	}
	
	public function actionDelete(){
		$item = $this->getItem();
		$childs = $this->getChildsFlat($item->name);
		$childs[] = $item->name;
		foreach($childs as $child) {
			AuthItemChild::model()->deleteAll('parent=:parent or child=:child', array(':parent'=>$child, ':child'=>$child));
			AuthItem::model()->deleteAll('name=:name', array(':name'=>$child));
			AuthAssignment::model()->deleteAll('itemname=:itemname', array(':itemname'=>$child));
		}
		
		$this->redirect(array('index'));
	}
	
	/**********************************************************************/
	
	protected function getTree(){
		$roots = $this->getRoots();

		if(count($roots) > 0) {
			foreach($roots as $i=>$root) {
				$roots[$i]['children'] = $this->getChilds($root['name']);
			}
		} else {
			$this->initRoot();
			$roots = $this->getRoots();
		}

		return $roots;
	}
	
	protected function initRoot(){
		$auth = Yii::app()->AuthManager;
		$auth->createRole('admin');
	}
	
	protected function getRoots(){
		$roots = new CDbCriteria();
		$roots->condition = 'type=2 and c.child is null';
		$roots->join = 'left join '.Yii::app()->authManager->itemChildTable.' as c on name = c.child';
    	$roots->order = 'name ASC';
	    $roots = AuthItem::model()->findAll($roots);
	    if(count($roots) > 0) {
	    	$tmp = array();
	    	foreach($roots as $i=>$root) {
	    		$tmp[$i]['name'] = $root->name;
	    		$tmp[$i]['type'] = $root->type;
	    		$this->setText($tmp[$i]);
	    	}
	    	$roots = $tmp;
	    }
	    return $roots;
	}
	
	protected function getChilds($name){
		$childs = new CDbCriteria();
		$childs->condition = 'parent=:parent';
		$childs->params=array(':parent'=>$name);
    	$childs->order = 'child ASC';
	    $childs = AuthItemChild::model()->findAll($childs);
	    #print_r($childs);
	    if(count($childs) > 0) {
	    	$tmp = array();
	    	foreach($childs as $i=>$child) {
	    		$tmp[$i]['name'] = $child->child;
				$tmp[$i]['type'] = $this->getItem($child->child)->type;
				$this->setText($tmp[$i]);
	    	}
	    	$childs = $tmp;
	    	
			foreach($childs as $i=>$child)
				$childs[$i]['children'] = $this->getChilds($tmp[$i]['name']);

		} else 
	    	return array();
	    	
		return $childs;
	}
	
	protected function getChildsFlat($name,&$result = array()){
		$childs = new CDbCriteria();
		$childs->condition = 'parent=:parent';
		$childs->params=array(':parent'=>$name);
    	$childs->order = 'child ASC';
	    $childs = AuthItemChild::model()->findAll($childs);

	    if(count($childs) > 0) {
	    	foreach($childs as $i=>$child) {
				$result[count($result)] = $child->child;
				$this->getChildsFlat($child->child, $result);
	    	}

		} else 
	    	return array();
		$result = array_unique($result);
	    return $result;
	}
	
	protected function getItem($name = null){
		if(isset($name))
			$this->_model=AuthItem::model()->find('name=:name', array(':name'=>$name));
		elseif($name = Yii::app()->getRequest()->getParam('name'))
			$this->_model=AuthItem::model()->find('name=:name', array(':name'=>$name));

		if($this->_model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		return $this->_model;
	}
	
	protected function getAssigned($name){
		return AuthAssignment::model()->findAll('itemname=:name', array(':name'=>$name), array('order'=>'userid'));
	}
	
	protected function setText(&$item){
		switch($item['type']){
			case '0':
				$type = 'Операция';
			break;
			case '1':
				$type = 'Задача';
			break;
			case '2':
				$type = 'Роль';
			break;
		}
		$item['text'] = CHtml::ajaxLink(CHtml::encode($type.' '.$item['name']), array('view', 'name'=>$item['name']), array('type'=>'POST', 'update'=>'#ajaxView', 'beforeSend'=>'makeActive(this)'));
	}
}