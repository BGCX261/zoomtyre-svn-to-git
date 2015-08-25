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

	var $logo_file;
	var $logo_delete;
	var $logo_sizes = array(
		'small'=>array(42,42),
		'normal'=>array(120,120),
		'big'=>array(200,200),
	);
	
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
		$tmp = array(
			array('title, alias, logo', 'required'),
			array('alias', 'unique'),
			array('archive, comments_count', 'numerical', 'integerOnly'=>true),
			array('title, alias', 'length', 'max'=>255),
			array('logo', 'length', 'max'=>255),
			array('country', 'length', 'max'=>10),
			array('description, description_marked', 'safe'),
			
			array('logo_file', 'file', 'types'=>'jpg, gif, png, jpeg', 'maxSize' => 10490000, 'allowEmpty'=>true),
			array('logo_delete', 'boolean'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, alias, archive, country', 'safe', 'on'=>'search'),
		);
		
		if(empty($this->logo))
			$tmp[] = array('logo_file', 'required');
		
		return $tmp;
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
			'logo_delete' => 'Удалить логотип',
			'logo_file' => 'Загрузить логотип',
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
		
		$this->deleteImage('logo_delete', $this->logo_sizes);
				
		return parent::afterDelete();
	}
	
	public function beforeSave(){
		if($this->description) {
			Yii::import('ext.markdown.*');
			$md = new EMarkdown;
			$this->description_marked = $md->transform($this->description);
		}
		
		$this->uploadImage('logo_file', $this->alias, $this->logo_sizes, $this->title, 'Логотип '.$this->title);
		
		return parent::beforeSave();
	}
	
	
	/**
	 * Удаление картинки
	 */
	public function deleteImage($field, $sizes) {
		/*
		 * @string $field Имя виртуального поля в котром хранится файл
		 * @string $name Имя файла, который будет сохранен на диске
		 */
		if($this->{$field}) {
			$orig_field = str_replace('_delete','',$field);
			Image::deleteFile($this->{$orig_field}, $sizes);
			$this->{$orig_field} = null;
		}
	}

	/**
	 * Загрузка картинки
	 */
	public function uploadImage($field, $name, $sizes, $alt='', $title='') {
		/*
		 * @string $field Имя виртуального поля в котром хранится файл
		 * @string $name Имя файла, который будет сохранен на диске
		 */
		if($image = CUploadedFile::getInstance($this, $field)) {
			$orig_field = str_replace('_file','',$field);
			$filename = EString::strtolower(EFile::sanitize($name).'.'.$image->extensionName);
			$path = Yii::getPathOfAlias( 'webroot.files.'.EString::strtolower(__CLASS__).'.'.$orig_field ).DIRECTORY_SEPARATOR;
			
			Image::deleteFile($this->{$orig_field}, $sizes);
			$this->{$orig_field} = Image::addFile( $image, $filename, $path, $sizes, $alt, $title, false, '#FFFFFF');
		}
	}
	
}