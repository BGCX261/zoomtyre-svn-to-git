<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class DiskSelectionForm extends CFormModel
{
	public $price_from; # Цена от
	public $price_until; # Цена до
	public $producers; # Производители
	public $width; # Ширина
	public $diameter; # Диаметер
	public $ET; # Вылет
	public $ET_d; # Дельта вылета 3 +/- 
	public $PCD; 

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('price_from, price_until', 'numerical', 'integerOnly'=>true),
			array('producers, width, diameter, ET, ET_d, PCD', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'price_from' => 'Цена от',
			'price_until' => 'Цена до',
			'producers' => 'Производители',
			'width' => 'Ширина',
			'diameter' => 'Диаметер диска',
			'ET' => 'Вылет',
			'ET_d' => '+/- 3',
			'PCD' => 'Крепеж',
		);
	}
}
