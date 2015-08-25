<?php

class Modification extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'cat_modifications':
	 * @var integer $id
	 * @var integer $model_id
	 * @var string $title
	 * @var string $alias
	 * @var integer $archive
	 * @var string $manufacture_start
	 * @var string $manufacture_end
	 * @var string $description
	 * @var string $description_marked
	 */

	var $modelTitle;
	var $brandId;
	
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
		return 'cat_modifications';
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
			array('model_id, title, alias, manufacture_start', 'required'),
			array('model_id, archive, comments_count', 'numerical', 'integerOnly'=>true),
			array('title, alias', 'length', 'max'=>255),
			array('manufacture_end, description, description_safe', 'safe'),
			array('manufacture_end', 'default', 'setOnEmpty'=>'null'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, model_id, title, alias, archive, manufacture_start, manufacture_end, description', 'safe', 'on'=>'search'),
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
			'model'=>array(self::BELONGS_TO, 'Car', 'model_id'),
			'characteristic'=>array(self::HAS_ONE, 'Characteristic', 'modification_id'),
		
			'comments'=>array(self::HAS_MANY, 'Comment', 'object_id', 'condition'=>'comments.type='.L::r_item('CommentType',__CLASS__)),
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
			'model_id' => 'Модель',
			'title' => 'Название',
			'archive' => 'Архив',
			'alias' => 'Псевдоним',
			'manufacture_start' => 'Начало производства',
			'manufacture_end' => 'Окончание производства',
			'description' => 'Описание',
			'description_marked' => 'Описание',
			'comments_count' => 'Количество комментариев',

			'brandId' => 'Марка',
			'modelTitle' => 'Модель',
		
			'comments' => 'Комментарии',
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

		if(Yii::app()->request->isAjaxRequest) {
			if($modification = Yii::app()->request->getParam('Modification', false)){
				$a = CHtml::listData( Car::model()->findAll('brand_id=:brand_id', array(':brand_id'=>$modification['brandId'])), 'id', 'id');
				if(count($a)>0)
					$criteria->compare('model_id', $a);
				elseif($modification['model_id']>0)
					$criteria->compare('model_id', 0);
				else
					$criteria->compare('model_id', array());
				$this->brandId = $modification['brandId'];
				
				$a = CHtml::listData( Car::model()->findAll('title like :title', array(':title'=>'%'.$modification['modelTitle'].'%')), 'id', 'id');
				if(count($a)>0)
					$criteria->compare('model_id', $a);
				elseif($modification['modelTitle'])
					$criteria->compare('model_id', 0);
				else
					$criteria->compare('model_id', array());
				$criteria->compare('model_id', $a);
				$this->modelTitle = $modification['modelTitle'];
			}
		}

		$criteria->compare('title',$this->title,true);

		$criteria->compare('alias',$this->alias,true);

		$criteria->compare('archive',$this->archive);
		
		$criteria->compare('manufacture_start',$this->manufacture_start,true);

		$criteria->compare('manufacture_end',$this->manufacture_end,true);

		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider('Modification', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['linesPerPage'],
			),
		));
	}

	public function afterDelete(){
		# Проверка и очистка связей
		$characteristics = Characteristic::model()->findAll('Characteristic=:Characteristic', array(':Characteristic'=>$this->id));
		if(count($characteristics)>0)
			foreach($characteristics as $characteristic)
				$characteristic->delete();

		Comment::model()->deleteAll('object_id=:object_id and type='.L::ritem('CommentType',__CLASS__),array(':object_id'=>$this->id));

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