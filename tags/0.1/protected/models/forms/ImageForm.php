<?php
class ImageForm extends CFormModel
{
	// для галлереек
	var $image_file;
	var $image_delete;
	var $image;
	var $title;
	var $alt;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		$tmp = array(
			array('image, alt, title', 'length', 'max'=>255),
			array('image', 'required'),
			
			array('image_file', 'file', 'types'=>'jpg, gif, png, jpeg', 'maxSize' => 10490000, 'allowEmpty'=>true),
			array('image_delete', 'boolean'),
		);
		
		if(empty($this->image))
			$tmp[] = array('image_file', 'required');
		
		return $tmp;
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
		);
	}
}