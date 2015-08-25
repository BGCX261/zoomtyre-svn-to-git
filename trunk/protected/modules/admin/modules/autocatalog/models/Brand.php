<?php

class Brand extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'cat_brands':
	 * @var integer $id
	 * @var string $title
	 * @var string $alias
	 * @var string $logo
	 * @var integer $archive
	 * @var string $country
	 * @var string $description
	 * @var string $description_marked
	 */
	public
	$images = array(
		'logo' => array(
			'field' => 'logo',
			'filename' => '%alias%',
			'alt' => '%title%',
			'title' => '%title%', 
			'addWatermark' => false,
			'bg' => '#FFFFFF',
			'file_type' => 'jpg',
			'sizes' => array(
				'small'=>array(42,42),
				'normal'=>array(120,120),
				'big'=>array(200,200),
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
		return 'cat_brands';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, alias, logo', 'required'),
			array('alias', 'unique'),
			array('archive, comments_count', 'numerical', 'integerOnly'=>true),
			array('title, alias', 'length', 'max'=>255),
			array('logo', 'length', 'max'=>255),
			array('country', 'length', 'max'=>10),
			array('description, description_marked', 'safe'),
			
			array('logo', 'file', 'types'=>'jpg, gif, png, jpeg', 'maxSize' => 10490000, 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, alias, archive, country', 'safe', 'on'=>'search'),
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
			'models'=>array(self::HAS_MANY, 'Car', 'brand_id'),
		);
	}
	
	public function scopes(){
		return array(
			'active' => array(
				'condition' => 't.archive is null or t.archive != '.L::ritem('ArchiveStatus', 'Архив'),
				'order' => 't.title asc',
			)
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
			'alias' => 'Псевдомин',
			'logo' => 'Логотип',
			'archive' => 'Архив',
			'country' => 'Страна',
			'description' => 'Описание',
			'description_marked' => 'Описание',
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

		$criteria->compare('id',$this->id);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('alias',$this->alias,true);

		$criteria->compare('archive',$this->archive);

		$criteria->compare('country',$this->country,true);

		return new CActiveDataProvider('Brand', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['linesPerPage'],
			),
		));
	}
	
	public function afterDelete(){
		# Проверка и очистка связей
				
		$models = Car::model()->findAll('brand_id=:brand_id', array(':brand_id'=>$this->id));
		if(count($models)>0)
			foreach($models as $model)
				$model->delete();
		
		return parent::afterDelete();
	}
	
	public function beforeSave(){
		if($this->description) {
			Yii::import('ext.markdown.*');
			$md = new EMarkdown;
			$this->description_marked = $md->transform($this->description);
		}
		
		return parent::beforeSave();
	}
}