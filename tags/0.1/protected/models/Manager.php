<?php

/**
 * This is the model class for table "tbl_managers".
 *
 * The followings are the available columns in table 'tbl_managers':
 * @property string $username
 * @property integer $priority
 * @property string $phone
 * @property string $avatar
 * @property string $email
 * @property integer $online
 */
class Manager extends CActiveRecord
{
	
	protected 
	$images = array(
		'avatar' => array(
			'field' => 'avatar',
			'filename' => '%username%',
			'alt' => '%username%',
			'title' => '%username%', 
			'addWatermark' => false,
			'bg' => '#000',
			'file_type' => 'jpg',
			'sizes' => array(
				'normal'=>array(100, 100),
			),
		),
	);
	
	/**
	 * Returns a list of behaviors that this model should behave as.
	 * @return array of behavior configurations indexed by behavior names
	 */
	public function behaviors(){
		return array(
			'ImageManageBehavior' => array(
				'class' => 'ImageManageBehavior',
				'conf' => $this->images,
			),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Manager the static model class
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
		return 'tbl_managers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, phone, email', 'required'),
			array('priority, online', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>80),
			array('phone, email', 'length', 'max'=>45),
			array('avatar', 'length', 'max'=>255),
			array('username', 'exist', 'className'=>'User', 'attributeName'=>'username'),
			array('avatar', 'file', 'types'=>'jpg, gif, png, jpeg', 'maxSize' => 10490000, 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, priority, phone, avatar, email, online', 'safe', 'on'=>'search'),
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
			'priority' => 'Приоритет',
			'phone' => 'Телефон',
			'avatar' => 'Аватар',
			'email' => 'Почта',
			'online' => 'Online',
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
		$criteria->compare('priority',$this->priority);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('online',$this->online);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}