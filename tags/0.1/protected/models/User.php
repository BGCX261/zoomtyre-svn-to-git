<?php

/**
 * This is the model class for table "tbl_users".
 *
 * The followings are the available columns in table 'tbl_users':
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $avatar
 * @property integer $status
 * @property string $created
 * @property string $activated
 * @property string $name
 * @property string $birthday
 * @property integer $gender
 * @property string $country
 * @property string $city
 * @property string $last_login
 */
class User extends CActiveRecord
{
	public $password_confirm;
	
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
			'UserRBACBehavior',
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'tbl_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, status, email, username, password, password_confirm', 'required'),
			array('username, email', 'unique'),
			array('password', 'compare', 'compareAttribute'=>'password_confirm'),
			array('email', 'email'),
			array('status, gender', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>80),
			array('avatar', 'length', 'max'=>255),
			array('name, country, city', 'length', 'max'=>45),
			array('activated, birthday, last_login', 'safe'),
			array('avatar, activated, name, birthday, gender, country, city, last_login', 'default', 'value'=>null),
			array('created', 'default', 'value'=>date('Y-m-d H:i:s')),
			
			array('avatar', 'file', 'types'=>'jpg, gif, png, jpeg', 'maxSize' => 10490000, 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('username, password, email, avatar, status, created, activated, name, birthday, gender, country, city, last_login', 'safe', 'on'=>'search'),
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
			'client' => array(self::HAS_ONE, 'Client', 'username'),
			'orders' => array(self::HAS_MANY, 'Order', 'client'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'Имя пользователя',
			'password' => 'Пароль',
			'password_confirm' => 'Подтверждение пароля',
			'email' => 'E-mail',
			'avatar' => 'Аватар',
			'status' => 'Статус',
			'created' => 'Дата регистрации',
			'activated' => 'Дата активации',
			'name' => 'Имя',
			'birthday' => 'День рождения',
			'gender' => 'Пол',
			'country' => 'Страна',
			'city' => 'Город',
			'last_login' => 'Последний вход',
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
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('activated',$this->activated,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('last_login',$this->last_login,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function updateLastLogin(){
		$this->updateByPk($this->getPrimaryKey(), array('last_login'=>date('Y-m-d H:i:s')));
	}
}