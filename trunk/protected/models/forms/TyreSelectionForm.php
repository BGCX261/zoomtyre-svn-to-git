<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class TyreSelectionForm extends CFormModel
{
	public $price_from; # Цена от
	public $price_until; # Цена до
	public $producers; # Производители
	public $width; # Ширина
	public $height; # Профиль
	public $diameter; # Диаметр шины
	public $season; # Сезонность
	public $currency; # Применяемость
	public $puncture; # Шипованность
	#public $construction_type;
	public $runflat; # Технология RunFlat

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('price_from, price_until', 'numerical', 'integerOnly'=>true),
			array('puncture, runflat', 'boolean'),
			array('producers, width, height, diameter, season, currency', 'safe'),
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
			'height' => 'Профиль',
			'diameter' => 'Диаметр шины',
			'season' => 'Сезонность',
			'currency' => 'Применяемость',
			'puncture' => 'Шипованность',
			'construction_type' => 'Конструкция',
			'runflat' => 'Технология RunFlat',
		);
	}
}
