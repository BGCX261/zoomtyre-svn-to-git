<?php

/**
 * This is the model class for table "itm_tyre".
 *
 * The followings are the available columns in table 'itm_tyre':
 * @property integer $id
 * @property string $producer_id
 * @property string $title
 * @property string $alias
 * @property string $photo
 * @property string $description
 * @property string $description_marked
 * @property integer $new
 * @property integer $sale
 * @property integer $season
 * @property integer $puncture
 * @property integer $currency
 * @property integer $construction_type
 * @property integer $runflat_type
 */
class Tyre extends CActiveRecord
{
	public 
	$images = array(
		'photo' => array(
			'field' => 'photo',
			'filename' => '%alias%',
			'alt' => 'Шина %title%',
			'title' => '%title%', 
			'addWatermark' => true,
			'bg' => '#FFFFFF',
			'file_type' => 'jpg',
			'sizes' => array(
				'small'=>array(120, 120),
				'big'=>array(400, 400),
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
	 * @return Tyre the static model class
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
		return 'itm_tyre';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producer_id, title, season, stud, currency, construction_type, runflat_type', 'required'),
			array('new, sale, currency, season, stud, construction_type, runflat_type', 'numerical', 'integerOnly'=>true),
			array('producer_id', 'length', 'max'=>10),
			array('title, photo', 'length', 'max'=>255),
			array('alias', 'length', 'max'=>45),
			array('description, description_marked', 'safe'),
			
			array('description, description_marked, new, sale, photo', 'default', 'value'=>null),
			array('new, sale', 'boolean'),
			array('alias', 'unique'),
			#array('logo', 'required'),
			array('photo', 'file', 'types'=>'jpg, gif, png, jpeg', 'maxSize' => 10490000, 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, producer_id, title, alias, photo, description, description_marked, new, sale, currency, season, stud, construction_type, runflat_type', 'safe', 'on'=>'search'),
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
			'producer' => array(self::BELONGS_TO, 'TyreProducers', 'producer_id'),
			'sizes' => array(self::HAS_MANY, 'TyreSizes', 'tyre_id', 'joinType'=>'inner join'),

			'comments'=>array(self::HAS_MANY, 
				'Comment', 
				'object_id', 
				'condition'=>'comments.status != '.L::r_item('commentStatus','blocked').' and comments.object_type='.L::r_item('CommentType',__CLASS__),
				'together'=>false,
				'order' => 'comments.root, comments.lft',
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'producer_id' => 'Производитель',
			'title' => 'Название',
			'alias' => 'Псевдоним',
			'photo' => 'Фото',
			'description' => 'Описание',
			'description_marked' => 'Описание',
			'new' => 'Новинка',
			'sale' => 'Распродажа',
			'currency' => 'Применяемость',
			'season' => 'Сезонность',
			'stud' => 'Шипы',
			'construction_type' => 'Конструкция',
			'runflat_type' => 'RunOnFlat',
			'sizes' => 'Типоразмеры',
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
		$criteria->compare('producer_id',$this->producer_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('description_marked',$this->description_marked,true);
		$criteria->compare('new',$this->new);
		$criteria->compare('sale',$this->sale);
		$criteria->compare('season',$this->season);
		$criteria->compare('stud',$this->stud);
		$criteria->compare('currency',$this->currency);
		$criteria->compare('construction_type',$this->construction_type);
		$criteria->compare('runflat_type',$this->runflat_type);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterDelete(){
		return parent::afterDelete();
	}
	
	public function beforeSave(){
		$this->alias = EString::strtolower($this->alias);

		if($this->description) {
			Yii::import('ext.markdown.*');
			$md = new EMarkdown;
			$this->description_marked = $md->transform($this->description);
		}
	
		return parent::beforeSave();
	}
}