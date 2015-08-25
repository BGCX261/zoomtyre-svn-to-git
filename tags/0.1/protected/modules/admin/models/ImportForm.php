<?php
class ImportForm extends CFormModel
{
	public $file;
	public $margin = 15;

	/**
	 * Declares the validation rules.
	 */
	public function rules() {
		return array(
			array('file', 'file', 'types'=>'xls', 'maxSize' => 10490000),
			array('margin', 'numerical'),
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
			'file'=>'Файл импорта',
			'margin'=>'Наценка, %',
		);
	}
}