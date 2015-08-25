<?php
class CommentForm extends CFormModel
{
	public $parent;
	public $author;
	public $text;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('author, text', 'required'),
			array('parent', 'numerical', 'integerOnly'=>true),
			array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd'), 'captchaAction'=>'index/captcha'),
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
			'author'=>'Имя',
			'text'=>'Текст',
			'verifyCode'=>'Антиробот',
		);
	}
}