<?php
class PasswordRecoveryForm extends CFormModel
{
	public $username;
	public $email;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('username', 'exist', 'className'=>'User', 'attributeName'=>'username'),
			array('email', 'exist', 'className'=>'User', 'attributeName'=>'email'),
			array('email', 'email'),
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
			'email'=>'E-mail',
			'verifyCode'=>'Антиробот',
		);
	}
}
