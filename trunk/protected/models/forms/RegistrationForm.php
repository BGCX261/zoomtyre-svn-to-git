<?php
class RegistrationForm extends CFormModel
{
	public $username;
	public $password;
	public $password_confirm;
	public $name;
	public $email;
	public $phone;
	public $city;
	public $address;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('username, password, password_confirm, email, name, phone, city, address', 'required'),
			array('username', 'unique', 'className'=>'User', 'attributeName'=>'username', 'criteria'=>array(
				'condition' => 'status != '.L::r_item('userStatus', 'not_active')
			)),
			array('password', 'compare', 'compareAttribute'=>'password_confirm'),
			array('email', 'email', /*'checkMX'=>true, 'checkPort'=>true*/),
			array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd'), 'captchaAction'=>Yii::app()->params['captchaAction']),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'Логин',
			'password'=>'Пароль',
			'password_confirm'=>'Подтверждение пароля',
			'name'=>'Имя',
			'phone'=>'Телефон',
			'city'=>'Город',
			'address'=>'Адрес доставки',
			'email'=>'E-mail',
			'comment'=>'Комментарий',
			'verifyCode'=>'Антиробот',
		);
	}
}
