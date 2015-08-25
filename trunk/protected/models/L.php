<?php

/**
 * This is the model class for table "tbl_lookups".
 *
 * The followings are the available columns in table 'tbl_lookups':
 * @property string $id
 * @property string $name
 * @property string $ru
 * @property string $code
 * @property string $type
 * @property integer $ord
 */
class L extends CActiveRecord
{
	private static $_items = array();
	private static $_ruitems = array();
	private static $_types = array();
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return L the static model class
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
		return 'tbl_lookups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, code, type, ord', 'required'),
			array('ord', 'numerical', 'integerOnly'=>true),
			array('name, ru', 'length', 'max'=>60),
			array('code, type', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, ru, code, type, ord', 'safe', 'on'=>'search'),
		);
	}
	
	public function defaultScope() {
		return array(
			'order'=>'type',
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
			'name' => 'Name',
			'ru' => 'Ru',
			'code' => 'Code',
			'type' => 'Type',
			'ord' => 'Ord',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ru',$this->ru,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('ord',$this->ord);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'sort' => array(
				'defaultOrder'=>array(
					'type'=>true,
					'ord'=>false,
				),
			),
		));
	}
	
	
	/**
	 * 
	 * Возвращает массив с всеми типами
	 */
	public static function types(){
		if(empty(self::$_types))
			self::loadTypes();
		return self::$_types;
	}
	
	/**
	 * 
	 * Возвращает массив со всеми значениями псевдонимов ($name) по типу ($type)
	 * @param string $type
	 */
	public static function items($type){
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return self::$_items[$type];
	}
	
	/**
	 * 
	 * Возвращает массив со всеми значениями псевдонимов ($ru) по типу ($type)
	 * @param string $type
	 */
	public static function ruitems($type){
		if(!isset(self::$_ruitems[$type]))
			self::loadRuItems($type);
		return self::$_ruitems[$type];
	}
	
	
	/**
	 * 
	 * Возвразщает псевдоним ($name) с ключем ($code) по типу ($type)
	 * @param string $type
	 * @param int $code
	 */
	public static function item($type, $code){
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
	}
	
	/**
	 * 
	 * Возвразщает псевдоним ($ru) с ключем ($code) по типу ($type)
	 * @param string $type
	 * @param int $code
	 */
	public static function ruitem($type, $code){
		if(!isset(self::$_ruitems[$type]))
			self::loadRuItems($type);
		return isset(self::$_ruitems[$type][$code]) ? self::$_ruitems[$type][$code] : false;
	}
	
	/**
	 * 
	 * Возвразщает код ($code) по вседониму ($name) по типу ($type)
	 * @param string $type
	 * @param string $item
	 */
	public static function r_item($type, $item){
		if(!isset(self::$_items[$type]))
			self::loadItems($type);
		return array_search($item, self::$_items[$type]);
	}
	
	/**
	 * 
	 * Возвразщает код ($code) по вседониму ($ru) по типу ($type)
	 * @param string $type
	 * @param string $item
	 */
	public static function r_ruitem($type, $item){
		if(!isset(self::$_ruitems[$type]))
			self::loadRuItems($type);
		return array_search($item, self::$_ruitems[$type]);
	}

	/**
	 * 
	 * Загружаю в статичный массив значения ($name) по типу ($type)
	 * @param string $type
	 */
	public static function loadItems($type){
		self::$_items[$type]=array();
		$models=self::model()->findAll(array(
			'condition'=>'type=:type',
			'params'=>array(':type'=>$type),
			'order'=>'ord',
		));
		foreach($models as $model)
			self::$_items[$type][$model->code]=$model->name;
	}
	

	/**
	 * 
	 * Загружаю в статичный массив значения ($ru) по типу ($type)
	 * @param string $type
	 */
	public static function loadRuItems($type){
		self::$_ruitems[$type]=array();
		$models=self::model()->findAll(array(
			'condition'=>'type=:type',
			'params'=>array(':type'=>$type),
			'order'=>'ord',
		));
		foreach($models as $model)
			self::$_ruitems[$type][$model->code]=$model->ru;
	}
	
	/**
	 * 
	 * Загружаю в статичный массив все типы ($type)
	 */
	public static function loadTypes(){
		self::$_types=array();
		$models=self::model()->findAll(array(
			'order'=>'type',
			'group'=>'type',
		));
		
		foreach($models as $model)
			self::$_types[$model->type]=$model->type;
	}
	
}