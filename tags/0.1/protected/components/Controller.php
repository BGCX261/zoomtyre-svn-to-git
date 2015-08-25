<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $menu_element = '';
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	 * Форма авторизации
	 */
	public $loginForm = null;
	
	/**
	 * Фильтры
	 */
	public function filters(){
		
		return array(
			'loginWorkout',
			#'accessWorkout',
			'publishWidget',
			'menuWorkout',
			'shoppingCartWorkout',
			'selectionFormValidation',
		);
	}
	// Добавляю псевдоним для папки виджетов, которая находиться в папке с темой
	function filterPublishWidget($filterChain){
		Yii::setPathOfAlias('widgets' ,Yii::getPathOfAlias('webroot.themes.'.Yii::app()->theme->name.'.widgets'));
		$filterChain->run();
	}
	
	// Главное меню сайта
	function filterMenuWorkout($filterChain){
		$this->menu = array(
			array('label'=>'Каталог', 'url'=>array('catalog/index'), 'active'=>$this->id=='catalog', 'items'=>array(
				array('label'=>'Шины', 'url'=>array('catalog/tyres'), 'items'=>array(
					#array('label'=>'Летние', 'url'=>array('catalog/tyres', 'season'=>'summer')),
					#array('label'=>'Зимние', 'url'=>array('catalog/tyres', 'season'=>'winter'), 'items'=>array(
					#	array('label'=>'Шипованные', 'url'=>array('catalog/tyres', 'season'=>'winter', 'stud'=>'studded')),
					#	array('label'=>'Не шипованные', 'url'=>array('catalog/tyres', 'season'=>'winter', 'stud'=>'not_studded')),						
					#)),
				)),
				array('label'=>'Диски', 'url'=>array('catalog/disks'), 'items'=>array(
					#array('label'=>'Литые', 'url'=>array('catalog/disks', 'construct'=>'alloy')),
					#array('label'=>'Штампованные', 'url'=>array('catalog/disks', 'construct'=>'pressed')),
					#array('label'=>'Кованые', 'url'=>array('catalog/disks', 'construct'=>'forged')),
				)),
			)),
			array('label'=>'Подбор', 'url'=>array('selection/index'), 'active'=>$this->id=='selection', 'items'=>array(
				array('label'=>'Подбор шин', 'url'=>array('selection/tyres')),
				array('label'=>'Подбор дисков', 'url'=>array('selection/disks')),
				array('label'=>'Подбор по автомобилю', 'url'=>array('selection/by_car')),
			)),
			array('label'=>'Информация', 'url'=>array('info/index'), 'active'=>($this->id=='info'||$this->id=='news'||$this->id=='articles'||$this->id=='faq'||@$_GET['view']=='delivery'), 'items'=>array(
				array('label'=>'Новости', 'url'=>array('news/index'), 'active'=>$this->id=='news'),
				array('label'=>'Статьи', 'url'=>array('articles/index'), 'active'=>$this->id=='articles'),
				array('label'=>'FAQ', 'url'=>array('faq/index'), 'active'=>$this->id=='faq'),
				array('label'=>'Доставка', 'url'=>array('index/page', 'view'=>'delivery')),
			)),
			#array('label'=>'Менеджеры', 'url'=>array('managers/index')),
			array('label'=>'Корзина', 'url'=>array('basket/index')),
			array('label'=>'Контакты', 'url'=>array('index/page', 'view'=>'contacts')),
//			array('label'=>'Вход', 'url'=>array('index/login'), 'visible'=>Yii::app()->user->isGuest),
//			array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('index/logout'), 'visible'=>!Yii::app()->user->isGuest),
		);
		
		$filterChain->run();
	}

	// Авторизация пользователей
	function filterLoginWorkout($filterChain){
		$this->loginForm = new LoginForm();
		// collect user input data
		if(isset($_POST['LoginForm'])) {
			$this->loginForm->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($this->loginForm->validate()) {
				$this->loginForm->login();	
			} else {
				Yii::app()->user->setFlash('login',$this->loginForm);
				$this->redirect(Yii::app()->user->loginUrl);
			}
		}
		
		$filterChain->run();
	}
	
	// Проверка доступа, чтобы харч не лазил
	function filterAccessWorkout($filterChain){
		if(!Yii::app()->user->checkAccess('accessToSite') && $this->getRoute() != Yii::app()->user->loginUrl[0]) {
			// запрет доступа на сайт
			Yii::app()->user->setFlash('loginError','У Вас нет доступа.');
			Yii::app()->user->loginRequired();
		}

		$filterChain->run();
	}

	// корзинка
	function filterShoppingCartWorkout($filterChain){
		if(isset($_POST['ajax']) && strpos($_POST['ajax'], 'buy-form') === 0 ) {
			$model = new BasketForm;
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'basket' && $_POST['operation'] === 'clear') {
			Yii::app()->shoppingCart->clear();
		}
		
		if(isset($_POST['BasketForm'])) {
			$model = new BasketForm;
			$model->attributes = $_POST['BasketForm'];
			if($model->validate()) {
				list($class, $id) = preg_split('/_/', $model->id);
				$cart = Yii::app()->shoppingCart;
				$cart->put($class::model()->findByPk($id),$model->quantity);
			} else {
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
		}
		
		$filterChain->run();
	}
	
	function filterSelectionFormValidation($filterChain){
		
			$tyreSelectionForm = Yii::app()->request->getParam('TyreSelectionForm', array());
		$tyreSelection = new TyreSelectionForm();
		if(!empty($tyreSelectionForm)) {
			if(isset($_REQUEST['ajax']) && $_REQUEST['ajax']==='tyreSelectionForm') {
				echo CActiveForm::validate($tyreSelection);
				Yii::app()->end();
			}
		}

		$diskSelectionForm = Yii::app()->request->getParam('DiskSelectionForm', array());
		$diskSelection = new DiskSelectionForm();
		if(!empty($diskSelectionForm)) {
			if(isset($_REQUEST['ajax']) && $_REQUEST['ajax']==='diskSelectionForm') {
				echo CActiveForm::validate($diskSelection);
				Yii::app()->end();
			}
		}
		
		$byCarSelectionForm = Yii::app()->request->getParam('ByCarSelectionForm', array());
		$byCarSelection = new ByCarSelectionForm();
		if(!empty($byCarSelectionForm)) {
			if(isset($_REQUEST['ajax']) && $_REQUEST['ajax']==='ByCarSelectionForm') {
				echo CActiveForm::validate($byCarSelection);
				Yii::app()->end();
			}
		}
		
		$filterChain->run();
	}
	

	/**
	 * Функция добавление комментов 
	 */
	protected function addComment(&$model){

		if(isset($_POST['CommentForm'])){
			$commentForm = new CommentForm;
			$commentForm->attributes=$_POST['CommentForm'];
			
			if($commentForm->validate()) {
				Yii::app()->user->setState('CommentForm', null);

				$comment = new Comment;
				$comment->attributes = $_POST['CommentForm'];
				$comment->object_type = L::r_item('CommentType', get_class($model));
				$comment->object_id = $model->id;
				$comment->created = date('Y-m-d H:i:s');
				$comment->rating = 0;
				$comment->status = L::r_item('commentStatus', 'new');
				
				if($parent = Comment::model()->findbyPk((int)$commentForm->parent))
					$parent->append($comment);
				else
					$comment->saveNode();
				
				Yii::app()->user->setFlash('comment',array('text'=>'Спасибо за Ваш комментарий', 'class'=>'error'));
				$this->redirect(Yii::app()->request->requestUri.'#comment-'.$comment->id);
			} else
				Yii::app()->user->setState('CommentForm', $commentForm);

		} else
			Yii::app()->user->setState('CommentForm', null);
	}
	
	/**
	 * Изменения рейтинга
	 */
	protected function updateRating($model) {
		if(Yii::app()->request->isAjaxRequest) {
			$rating = Yii::app()->request->getParam('rating', 0);
			$profile = Profile::model()->findByPk(Yii::app()->user->name);
			if($rating==='inc')
				$rating = $profile->vote_weight;
			elseif($rating==='dec')
				$rating = -1*$profile->vote_weight;

			if($profile->vote_left>0) {
				echo $model->updateRating($rating);

				// Снижаю кол-во оставшихся голосов пользователя
				$profile->vote_left -= 1;
				$profile->save();
			} else {
				// должен возвращаться результат о том что голоса кончились
				echo $model->rating;
			}

			Yii::app()->end();
		}
	}
}