<?php

class AuthAssignment extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'AuthAssignment':
	 */
	
	public $_delete;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'auth_assignment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('itemname, userid', 'required'),
			array('itemname, userid', 'uniqueKey'),
			array('itemname, userid', 'length', 'max'=>64),
			array('bizrule, data', 'safe'),
			array('data', 'default', 'setOnEmpty'=>'N;'),
			array('_delete', 'boolean', 'trueValue'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'itemname' => 'Элемент авторизации',
			'userid' => 'Логин',
			'bizrule' => 'Бизнес логика',
			'data' => 'Данные',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		return new CActiveDataProvider('AuthAssignment', array(
			'criteria'=>$criteria,
		));
	}
	
	public function uniqueKey($attribute, $params) {
		if($this->exists('itemname=:itemname and userid=:userid', array(':itemname'=>$this->itemname, ':userid'=>$this->userid))) {
			if(!isset($this->errors['userid']))
				$this->addError('userid', 'Этот пользователь уже есть.');
		}
		
		if(!User::model()->findByPK($this->userid)) {
			if(!isset($this->errors['userid']))
				$this->addError('userid', 'Такого пользователя не существует.');
		}
	}
}