<?php

/**
 * This is the model class for table "itm_disk".
 *
 * The followings are the available columns in table 'itm_disk':
 * @property integer $id
 * @property string $producer_id
 * @property string $title
 * @property string $alias
 * @property string $photo
 * @property string $description
 * @property string $description_marked
 * @property integer $new
 * @property integer $sale
 * @property integer $construction_type
 * @property integer $color
 * @property integer $model_id
 * @property string $comments_count
 * @property integer $rating
 */
class Disk extends CActiveRecord
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
	 * @return Disk the static model class
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
		return 'itm_disk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('producer_id, title, construction_type, color', 'required'),
			array('new, sale, construction_type, color, model_id, rating', 'numerical', 'integerOnly'=>true),
			array('producer_id, comments_count', 'length', 'max'=>10),
			array('title, photo', 'length', 'max'=>255),
			array('alias', 'length', 'max'=>45),
			array('description, description_marked', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, producer_id, title, alias, photo, description, description_marked, new, sale, construction_type, color, model_id, comments_count, rating', 'safe', 'on'=>'search'),
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
			'producer' => array(self::BELONGS_TO, 'DiskProducers', 'producer_id'),
			'sizes' => array(self::HAS_MANY, 'DiskSizes', 'disk_id', 'joinType'=>'inner join'),
			'model' => array(self::BELONGS_TO, 'Car', 'model_id'),

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
			'construction_type' => 'Тип',
			'color' => 'Цвет',
			'model_id' => 'Реплика',
			'comments_count' => 'Comments Count',
			'rating' => 'Rating',

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
		$criteria->compare('construction_type',$this->construction_type);
		$criteria->compare('color',$this->color);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('comments_count',$this->comments_count,true);
		$criteria->compare('rating',$this->rating);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}