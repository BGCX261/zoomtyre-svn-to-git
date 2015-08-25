<?php
class BasketForm extends CFormModel
{
	public $id;
	public $quantity;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('id', 'required'),
			array('quantity', 'numerical', 'integerOnly'=>true, 'allowEmpty'=>true),
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
			'id'=>'Позиция',
			'quantity'=>'Количество',
		);
	}
}