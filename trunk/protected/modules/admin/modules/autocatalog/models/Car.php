<?php

class Car extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'cat_models':
	 * @var integer $id
	 * @var integer $brand_id
	 * @var integer $archive
	 * @var string $title
	 * @var string $alias
	 * @var integer $concept
	 * @var string $description
	 * @var string $description_marked
	 * @var string $manufacture_start
	 * @var string $manufacture_end
	 * @var integer $comments_count
	 */
	public $RU_NAME = 'Модель';
	
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
		return 'cat_models';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('alias', 'unique'),
			array('brand_id, title, alias, manufacture_start', 'required'),
			array('concept', 'boolean'),
			array('brand_id, archive, comments_count', 'numerical', 'integerOnly'=>true),
			array('title, alias', 'length', 'max'=>255),
			array('description, description_marked, manufacture_end', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, brand_id, archive, title, alias, description, manufacture_start, manufacture_end', 'safe', 'on'=>'search'),
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
			'brand'=>array(self::BELONGS_TO, 'Brand', 'brand_id'),
			'modifications'=>array(self::HAS_MANY, 'Modification', 'model_id'),
		);
	}
	
	public function scopes(){
		return array(
			'active' => array(
				'condition' => 'models.archive is null or models.archive != '.L::ritem('ArchiveStatus', 'Архив'),
				'order' => 'models.title asc',
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
			'brand_id' => 'Бренд',
			'archive' => 'Архив',
			'title' => 'Название',
			'alias' => 'Псевдоним',
			'concept' => 'Концепт',
			'description' => 'Описание',
			'description_marked' => 'Описание',
			'manufacture_start' => 'Начало производства',
			'manufacture_end' => 'Окончание производства',
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

		$criteria->compare('brand_id',$this->brand_id);

		$criteria->compare('archive',$this->archive);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('alias',$this->alias,true);
		
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider('Car', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['linesPerPage'],
			),
		));
	}
	
	public function afterDelete(){
		# Проверка и очистка связей
		$modifications = Modification::model()->findAll('model_id=:model_id', array(':model_id'=>$this->id));
		if(count($modifications)>0)
			foreach($modifications as $modification)
				$modification->delete();
		
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