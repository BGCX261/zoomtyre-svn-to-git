<?php

/**
 * This is the model class for table "itm_disk_producers".
 *
 * The followings are the available columns in table 'itm_disk_producers':
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $logo
 * @property string $description
 * @property string $description_marked
 */
class DiskProducers extends CActiveRecord
{
	
	protected 
	$images = array(
		'logo' => array(
			'field' => 'logo',
			'filename' => '%alias%',
			'alt' => 'Производитель шин %title%',
			'title' => '%title%', 
			'addWatermark' => false,
			'bg' => '#FFFFFF',
			'file_type' => 'jpg',
			'sizes' => array(
				'small'=>array(21,21),
				'normal'=>array(150,100),
				'big'=>array(250,187),
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
	 * @return DiskProducers the static model class
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
		return 'itm_disk_producers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, alias', 'required'),
			array('title, logo', 'length', 'max'=>255),
			array('alias', 'length', 'max'=>45),
			array('description, description_marked', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, alias, logo, description, description_marked', 'safe', 'on'=>'search'),
		);
	}
	
	public function scopes(){
		$db = $this->getDbConnection();
		$alias = $db->quoteColumnName($this->getTableAlias());
		return array(
			'alphabetically' => array( 'order' => $alias.'.title', ),
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
			'disks' => array(self::HAS_MANY, 'Disk', 'producer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название',
			'alias' => 'Псевдоним',
			'logo' => 'Логотип',
			'description' => 'Описание',
			'description_marked' => 'Описание',
			'disks' => 'Диски',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('description_marked',$this->description_marked,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave(){
		$this->alias = EString::strtolower($this->alias);
		
		if($this->description) {
			Yii::import('ext.mardown.*');
			$md = new EMarkdown;
			$this->description_marked = $md->transform($this->description);
		}
		
		#$this->uploadImage('logo_file', $this->alias, $this->logo_sizes, $this->title, 'Логотип: '.$this->title);

		return parent::beforeSave();
	}
}