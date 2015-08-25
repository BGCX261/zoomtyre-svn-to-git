<?php

/**
 * This is the model class for table "tbl_orders".
 *
 * The followings are the available columns in table 'tbl_orders':
 * @property string $id
 * @property string $created
 * @property integer $status
 * @property string $order
 * @property string $manager
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $comment
 */
class Order extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Orders the static model class
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
		return 'tbl_orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client', 'exist', 'className'=>'User', 'attributeName'=>'username', 'allowEmpty'=>true),
			array('created, status, order', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('manager, phone', 'length', 'max'=>45),
			array('name, email', 'length', 'max'=>80),
			array('comment, address, city, data', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, phone, email, city, address', 'required', 'on'=>'guest_order'),
			array('id, created, status, order, manager, name, email, phone, comment, address, city', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'created' => 'Поступил',
			'status' => 'Статус',
			'order' => 'Заказ',
			'manager' => 'Менеджер',
			'client' => 'Авторизованный клиент',
			'name' => 'Клиент',
			'email' => 'email',
			'phone' => 'Телефон',
			'city' => 'Город',
			'address' => 'Адрес доставки',
			'comment' => 'Комментарий',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('order',$this->order,true);
		$criteria->compare('manager',$this->manager,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'sort' => array(
				'defaultOrder'=>array(
					'created'=>'desc',
				),
			),
		));
	}
}