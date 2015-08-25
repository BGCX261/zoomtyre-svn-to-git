<?php

/**
 * This is the model class for table "tbl_clients".
 *
 * The followings are the available columns in table 'tbl_clients':
 * @property string $username
 * @property string $card
 * @property double $discount
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $city
 * @property string $street
 */
class Client extends CActiveRecord
{
	public $maxCardNumber = 0;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Client the static model class
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
		return 'tbl_clients';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, name, phone, email, city, address, card', 'required'),
			array('discount', 'numerical'),
			array('username, name', 'length', 'max'=>80),
			array('address', 'length', 'max'=>255),
			array('card', 'length', 'max'=>10),
			array('card', 'unique'),
			array('phone, email, city', 'length', 'max'=>45),
			array('username', 'exist', 'className'=>'User', 'attributeName'=>'username'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, card, discount, name, phone, email, city, address', 'safe', 'on'=>'search'),
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
			'username' => 'Пользователь',
			'card' => 'Номер карты',
			'discount' => 'Скидка',
			'name' => 'Имя',
			'phone' => 'Телефон',
			'email' => 'Email',
			'city' => 'Город',
			'address' => 'Адрес',
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

		$criteria->compare('username',$this->username,true);
		$criteria->compare('card',$this->card,true);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}