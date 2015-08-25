<?php

/**
 * This is the model class for table "itm_disk_sizes".
 *
 * The followings are the available columns in table 'itm_disk_sizes':
 * @property integer $id
 * @property string $disk_id
 * @property string $code
 * @property double $width
 * @property string $diameter
 * @property double $ET
 * @property string $PCD_screws
 * @property double $PCD_diameter
 * @property double $DIA
 * @property string $price
 * @property string $rest
 */
class DiskSizes extends CActiveRecord implements IECartPosition
{
	var $producer; # заглушка для поиска в шаблоне admin
	var $size; #заглушка для собранного размера
	var $PCD; # заглушка для PCD
	var $PCD0; # заглушка для PCD для подбора

	/*
	 * Методы интерфейса IECartPosition
	 */
	function getId(){
		return __CLASS__.'_'.$this->getPrimaryKey();
	}
	
	/*
	 * Методы интерфейса IECartPosition
	 */
	function getPrice(){
		return $this->price;
	}
	
	/*
	 * Методы интерфейса IECartPosition
	 */
	function getTitle(){
		return 'Диск '.$this->size.' '.$this->disk->producer->title.' '.$this->disk->title;
	}
	
	function getUrl(){
		$params = array(
			'catalog/disks', 
			'aliasProducer'=>$this->disk->producer->alias, 
			'aliasModel'=>$this->disk->alias, 
			'aliasSize'=>$this->alias
		);

		return Yii::app()->createUrl($params[0], array_slice($params, 1));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return DiskSizes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function scopes(){
		$db = $this->getDbConnection();
		$alias = $db->quoteColumnName($this->getTableAlias());
		return array(
			'inSight' => array(
				'condition' => $alias.'.rest > 0 and '.$alias.'.price > 0',
			),
			'orderByPrice'=>array(
				'order'=>$alias.'.price',
			),
			'orderByRest'=>array(
				'order'=>$alias.'.rest desc',
			),
		);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'itm_disk_sizes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('disk_id, alias, code, width, diameter, ET, PCD_screws, price, rest', 'required'),
			array('width, ET, PCD_diameter, DIA', 'numerical'),
			array('disk_id, diameter, PCD_screws, price', 'length', 'max'=>10),
			array('code', 'length', 'max'=>45),
			array('alias', 'length', 'max'=>80),
			array('rest', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, disk_id, code, width, diameter, ET, PCD_screws, PCD_diameter, DIA, price, rest', 'safe', 'on'=>'search'),
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
			'disk' => array(self::BELONGS_TO, 'Disk', 'disk_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'disk_id' => 'Диск',
			'code' => 'Артикул',
			'width' => 'Ширина',
			'diameter' => 'Диаметр',
			'ET' => 'Вылет',
			'PCD_screws' => 'PCD болтов',
			'PCD_diameter' => 'PCD диаметр',
			'DIA' => 'DIA',
			'price' => 'Цена',
			'rest' => 'Остаток',
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
		
		if(Yii::app()->request->isAjaxRequest) {
			if($model = Yii::app()->request->getParam('DiskSizes', false)){
				// Обработка условий фильтра выбора производителя 
				$this->producer = $model['producer'];
				// Собираю шины производителей подходящих под условия фильтра
				$disks = CHtml::listData( Disk::model()->findAll('producer_id=:producer_id', array(':producer_id'=>$model['producer'])), 'id', 'id');
				// Подкидываю к фильтру новое условие
				$criteria->compare('disk_id', $disks);
			}
		}

		$criteria->compare('id',$this->id);
		$criteria->compare('disk_id',$this->disk_id,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('width',$this->width);
		$criteria->compare('diameter',$this->diameter,true);
		$criteria->compare('ET',$this->ET);
		$criteria->compare('PCD_screws',$this->PCD_screws,true);
		$criteria->compare('PCD_diameter',$this->PCD_diameter);
		$criteria->compare('DIA',$this->DIA);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('rest',$this->rest,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterFind(){
		
		$this->size = $this->width.'x'.$this->diameter.'/'.$this->PCD_screws.'x'.$this->PCD_diameter.' ET'.$this->ET.($this->DIA?' - '.$this->DIA:'');
		
		return parent::afterFind();
	}
}