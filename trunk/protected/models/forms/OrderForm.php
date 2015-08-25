<?php
class OrderForm extends CFormModel {
	public $client;
	public $name;
	public $phone;
	public $email;
	public $city;
	public $address;
	public $comment;
	public $verifyCode;
	
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('client', 'exist', 'className'=>'User', 'attributeName'=>'username', 'allowEmpty'=>true),
			array('name, phone, email, city, address', 'required', 'on'=>'guest_order'),
			array('phone', 'match', 'pattern'=>'/^\+?[0-9]+[0-9\-\ ]*$/is', 'message'=>Yii::t('validation','Прекратите баловаться! Введите свой номер телефона!')),
			array('email', 'email'),
			array('name, comment, address, city', 'safe'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd') && !Yii::app()->user->isGuest, 'captchaAction'=>Yii::app()->params['captchaAction']),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>'Имя',
			'phone'=>'Телефон',
			'email'=>'E-mail',
			'comment'=>'Комментарий',
			'city'=>'Город',
			'address'=>'Адрес доставки',
			'verifyCode'=>'Антиробот',
		);
	}

}