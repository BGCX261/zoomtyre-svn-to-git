<?php
class UsersController extends Controller
{
	/*
	 * Регистрация
	 */
	public function actionRegistration(){
		$model = new RegistrationForm();
		if(!empty($_POST['RegistrationForm'])) {
			$model->attributes = $_POST['RegistrationForm'];
			if($model->validate()) {

				if(User::model()->exists('email=:email and status!=:status', array(':email'=>$model->email, ':status'=>L::r_item('userStatus', 'not_active')))) {
					$model->addError('email', 'Пользователь с таким почтовым адресом уже зарегестрирован в нашей системе.');
				} else {
					// регистрация пошла, отпраляю почту и создаю пользователя со статусом "не активен"
					Yii::import('ext.yii-mail.*');
					$message = new YiiMailMessage;
					$message->view = 'email_confirmation';
					$message->setBody(array(
						'hash'=>sha1($model->email.Yii::app()->params['salt']),
						'email'=>$model->email,
						'date'=>date('YmdHis'),
					),'text/html');
					$message->subject = Yii::app()->name.' - Подтверждение почтового адреса/E-mail confirmation';
					$message->addTo($model->email);
					$message->from = Yii::app()->params['registrationEmail'];
					if(Yii::app()->mail->send($message)){
						if(!($user = User::model()->find('email=:email', array(':email'=>$model->email))))
							$user = new User;
						else {
							# надо удалить потеряного клиента
							Client::model()->deleteByPk($user->username);
						}
						$user->username = $model->username;
						$user->password = $model->password;
						$user->password_confirm = $model->password_confirm;
						$user->created = date('Y-m-d H:i:s');
						$user->email = $model->email;
						$user->city = $model->city;
						$user->name = $model->name;
						$user->status = L::r_item('userStatus', 'not_active');
						if($user->save()){
							if(!($client = Client::model()->find('username=:username', array(':username'=>$user->username))))
								$client = new Client;
							# Добавляю клиента
							$client->attributes = $model->attributes;
							$client->card = Client::model()->find(array('select'=>'max(card) as maxCardNumber'))->maxCardNumber+1;
							$client->save();

							Yii::app()->user->setFlash('registration', 'На указанный Вами e-mail было отправленно письмо с кодом подтверждения. Введите его.');
							$this->redirect(array('users/confirmation'));
						}
					} else {
						$model->addError('email', 'Мы не можем отправить почту на указаный Вами адрес.');
					}
				}
			}
		}
		
		$model->password = null;
		$model->password_confirm = null;
		
		$this->render('registration', array('registration_form'=>$model));
	}
	
	/*
	 * Подтверждение email при регистрации
	 */
	public function actionConfirmation(){
		$hash = trim(Yii::app()->request->getParam('hash', null));
		if(!empty($hash) && ($user = User::model()->find('sha(concat(email, "'.Yii::app()->params['salt'].'")) = :hash', array(':hash'=>$hash)))) {
			// Пользователь найден, регистрация окончена
			$user->password_confirm = $user->password;
			$user->status = L::r_item('userStatus', 'active');
			$user->activated = date('Y-m-d H:i:s');
			$user->save();
			if(empty($user->errors)) {
				// добавляю пользователя в RBAC
				$auth=Yii::app()->authManager;
				$auth->assign('user',$user->username);
				
				$loginForm=new LoginForm;
				$loginForm->username = $user->username;
				$loginForm->password = $user->password;
				$loginForm->login();
				$this->redirect(array('users/view', 'username'=>$user->username));
			}
		} elseif(!empty($hash)) {
			Yii::app()->user->setFlash('registration', 'Вы ввели неверный ключ. Попробуйте еще раз.');
		} else
			Yii::app()->user->setFlash('registration', 'На указанный Вами e-mail было отправленно письмо с кодом подтверждения. Введите его.');


		$this->render('confirmation', array(
			'hash' => $hash,
		));
	}
	
	/*
	 * восстановление пароля
	 */
	public function actionPassword_Recovery($hash = null){
		if(empty($hash)) {
			$model = new PasswordRecoveryForm;
			
			if(!empty($_POST['PasswordRecoveryForm'])) {
				$model->attributes = $_POST['PasswordRecoveryForm'];
				if(empty($model->username) && empty($model->email)) {
					$model->addError('username', 'Необходимо заполнить хотя бы одно из полей!');
					$model->addError('email', 'Необходимо заполнить хотя бы одно из полей!');
				} elseif($model->validate()) {
					if(!empty($model->username))
						$user = User::model()->findByPk($model->username);
					else
						$user = User::model()->find('email=:email', array(':email'=>$model->email));
						
					$hash = sha1($user->email.Yii::app()->params['salt']);
					$user->save();
					
					Yii::import('ext.yii-mail.*');
					$message = new YiiMailMessage;
					$message->view = 'password_recovery';
					$message->setBody(array(
						'hash'=>$hash,
						'mail'=>$user->email,
						'date'=>date('YmdHis'),
					),'text/html');
					$message->subject = Yii::app()->name.' - Восстановление пароля/E-mail confirmation';
					$message->addTo($user->email);
					$message->from = Yii::app()->params['registrationEmail'];
					Yii::app()->mail->send($message);
					
					echo 'к вам на почту должно было отправиться письмо с активацией аккаунта';
				}
				
				
			}
			
			$this->render('send_recovery_mail', array( 'model'=>$model));
		} else {
			$user = User::model()->find('sha(concat(email, "'.Yii::app()->params['salt'].'")) = :hash', array(':hash'=>$hash));
			if(!empty($_POST['User'])) {
				$user->password = $_POST['User']['password'];
				$user->password_confirm = $_POST['User']['password_confirm'];
				if($user->save()) {
					Yii::app()->user->setFlash('user','пароль успешно сброшен!');
					$loginForm=new LoginForm;
					$loginForm->username = $user->username;
					$loginForm->password = $user->password;
					$loginForm->login();
					$this->redirect(array('users/view', 'username'=>$user->username));
				}
			}

			if(!empty($user)) {
				$user->password = null;
				$user->password_confirm = null;
				$this->render('recovery', array( 'model'=>$user ));
			}
				
		}
	}
	
	/*
	 * Просмотр профиля
	 */
	public function actionView($username = null){
		$params = array('username'=>$username);
		if(Yii::app()->user->checkAccess('viewOwnProfile', $params)) {
			if($model = User::model()->find('username=:username', array(':username'=>$username)) ) {
				$this->render('view', array(
					'model'=>$model,
				));
			} else
				throw new CHttpException(400,'Такой страницы нет');
		} else
			throw new CHttpException(403,'У Вас нет доступа к просмотру этой страницы.');
	}
	
	/**
	 * Просмотр собственных заказов
	 */
	public function actionOrders($username = null){
		$params = array('username'=>$username);
		if(Yii::app()->user->checkAccess('viewOwnOrders', $params)) {
			if($user = User::model()->findByPk($username) ) {
				
				$this->render('orders', array('model'=>$user));
				
			} else
				throw new CHttpException(400,'Такой страницы нет');
		} else
			throw new CHttpException(403,'У Вас нет доступа к просмотру этой страницы.');
	}

	/*
	 * Редактирование профиля пользователя
	 */
	public function actionEdit($username = null){
		$params = array('username'=>$username);
		if(Yii::app()->user->checkAccess('editOwnProfile', $params)) {
			$model = User::model()->findByPk(Yii::app()->user->name);
			$model->scenario = 'byUserEdit';

			if(isset($_POST['User'])) {
				$model->attributes=$_POST['User'];
				if(empty($model->client)) {
					$model->client = new Client;
					$model->client->card = Client::model()->find(array('select'=>'max(card) as maxCardNumber'))->maxCardNumber+1;
				}

				$model->client->attributes = $model->attributes;
				$model->client->attributes = $_POST['Client'];
	
				if($model->validate() && $model->client->validate()) {
					$model->save(false);
					$model->client->save(false);
					$this->redirect(array('users/view','username'=>$model->username));
				}
			}
			
			if(empty($model->client))
				$model->client = new Client;

			$model->password = null;
			$model->password_confirm = null;
			$this->render('edit', array('model'=>$model));
		} else
			throw new CHttpException(403,'У Вас нет доступа к редактированию этой страницы.');
	}
}