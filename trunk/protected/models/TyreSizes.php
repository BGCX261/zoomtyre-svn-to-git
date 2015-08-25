<?php

/**
 * This is the model class for table "itm_tyre_sizes".
 *
 * The followings are the available columns in table 'itm_tyre_sizes':
 * @property integer $id
 * @property string $tyre_id
 * @property string $code
 * @property string $alias
 * @property string $width
 * @property string $height
 * @property string $diameter
 * @property string $load_index
 * @property string $speed_rating
 * @property string $price
 * @property string $rest
 */
class TyreSizes extends CActiveRecord implements IECartPosition
{
	var $producer; # заглушка для поиска в шаблоне admin
	var $size; #заглушка для собранного размера
	
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
		return 'Шина '.$this->size.' '.$this->tyre->producer->title.' '.$this->tyre->title;
	}
	
	function getUrl(){
		$params = array(
			'catalog/tyres', 
			'aliasProducer'=>$this->tyre->producer->alias, 
			'aliasModel'=>$this->tyre->alias, 
			'aliasSize'=>$this->alias
		);

		return Yii::app()->createUrl($params[0], array_slice($params, 1));
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return TyreSizes the static model class
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
				'order'=>$alias.'.rest',
			),
		);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'itm_tyre_sizes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tyre_id, code, alias, width, height, diameter, price, rest', 'required'),
			array('tyre_id, width, height, diameter, load_index, price', 'length', 'max'=>10),
			array('code', 'length', 'max'=>45),
			array('alias', 'length', 'max'=>80),
			array('speed_rating, rest', 'length', 'max'=>3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tyre_id, code, alias, width, height, diameter, load_index, speed_rating, price, rest', 'safe', 'on'=>'search'),
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
			'tyre' => array(self::BELONGS_TO, 'Tyre', 'tyre_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tyre_id' => 'Шина',
			'code' => 'Артикул',
			'width' => 'Ширина',
			'height' => 'Высота',
			'diameter' => 'Диаметр',
			'load_index' => 'Индекс нагрузки',
			'speed_rating' => 'Индекс скорости',
			'price' => 'Цена',
			'rest' => 'Остаток',
			'tyre' => 'Шина',
			'producer' => 'Производитель',
			'tyre_size' => 'Типоразмер',
			'size' => 'Типоразмер',
			'order' => 'Заказать',
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
			if($model = Yii::app()->request->getParam('TyreSizes', false)){
				// Обработка условий фильтра выбора производителя 
				$this->producer = $model['producer'];
				// Собираю шины производителей подходящих под условия фильтра
				$tyres = CHtml::listData( Tyre::model()->findAll('producer_id=:producer_id', array(':producer_id'=>$model['producer'])), 'id', 'id');
				// Подкидываю к фильтру новое условие
				$criteria->compare('tyre_id', $tyres);
			}
		}

		$criteria->compare('id',$this->id);
		$criteria->compare('tyre_id',$this->tyre_id,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('width',$this->width,true);
		$criteria->compare('height',$this->height,true);
		$criteria->compare('diameter',$this->diameter,true);
		$criteria->compare('load_index',$this->load_index,true);
		$criteria->compare('speed_rating',$this->speed_rating,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('rest',$this->rest,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterFind(){
		
		$this->size = $this->width.'/'.$this->height.' R'.$this->diameter.' '.$this->load_index.$this->speed_rating;
		
		return parent::afterFind();
	}

}