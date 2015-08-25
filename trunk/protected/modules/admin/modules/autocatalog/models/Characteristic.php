<?php

class Characteristic extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'cat_characteristics':
	 * @var integer $id
	 * @var integer $modification_id
	 * @var integer $fuel_capacity
	 * @var string $body
	 * @var integer $doors
	 * @var string $seats
	 * @var integer $weight
	 * @var integer $weight_loaded
	 * @var integer $top_speed_at
	 * @var double $acceleration_at
	 * @var integer $top_speed_mt
	 * @var double $acceleration_mt
	 * @var double $turn_radius
	 * @var string $trunk_capacity
	 * @var integer $length
	 * @var integer $width
	 * @var integer $height
	 * @var integer $clearance
	 * @var integer $track_front
	 * @var integer $track_rear
	 * @var integer $wheelbase
	 * @var string $engine_type
	 * @var integer $volume
	 * @var string $displacement
	 * @var double $compression_ratio
	 * @var string $cylinders
	 * @var integer $valves
	 * @var integer $max_power
	 * @var integer $max_power_rpm
	 * @var integer $max_torque
	 * @var integer $max_torque_rpm
	 * @var string $transmission_at
	 * @var integer $gears_at
	 * @var string $transmission_mt
	 * @var integer $gears_mt
	 * @var string $drive
	 * @var string $suspension_front
	 * @var string $suspension_rear
	 * @var string $tyres_front
	 * @var string $tyres_rear
	 * @var string $disks_front
	 * @var string $disks_rear
	 * @var string $brakes_front
	 * @var string $brakes_rear
	 * @var double $fuel_consumption_urban_at
	 * @var double $fuel_consumption_country_at
	 * @var double $fuel_consumption_combined_at
	 * @var double $fuel_consumption_urban_mt
	 * @var double $fuel_consumption_country_mt
	 * @var double $fuel_consumption_combined_mt
	 * @var string $fuel_type
	 */
	var $modificationTitle;
	var $modelTitle;
	var $brandTitle;
	var $manufactureStart;
	var $manufactureEnd;

	var $csvFile;
	
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
		return 'cat_characteristics';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modification_id', 'required'),
			array('modification_id, body, fuel_capacity, weight, weight_loaded, top_speed_at, top_speed_mt, length, width, height, wheelbase, volume, valves, max_power, gears_at, gears_mt', 'numerical', 'integerOnly'=>true),
			array('acceleration_at, acceleration_mt, turn_radius, fuel_consumption_urban_at, fuel_consumption_country_at, fuel_consumption_combined_at, fuel_consumption_urban_mt, fuel_consumption_country_mt, fuel_consumption_combined_mt', 'numerical'),
			array('engine_type, displacement, seats, trunk_capacity, cylinders, transmission_at, transmission_mt, drive, tyres_front, tyres_rear, disks_front, disks_rear, fuel_type, max_power_rpm, max_torque_rpm, brakes_front, brakes_rear', 'length', 'max'=>255),
			array('max_torque, clearance, doors', 'length', 'max'=>80),
			array('suspension_front, suspension_rear', 'length', 'max'=>500),
			
			array('csvFile', 'file', 'types'=>'csv', 'maxSize' => 10490000, 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, modification_id, fuel_capacity, body, doors, seats, weight, weight_loaded, top_speed, acceleration, turn_radius, trunk_capacity, length, width, height, track_front, track_rear, wheelbase, engine_type, volume, displacement, compression_ratio, cylinders, valves, max_power, max_power_rpm, max_torque, max_torque_rpm, transmission, drive, suspension_front, suspension_rear, tyres_front, tyres_rear, brakes_front, brakes_rear, fuel_consumption_urban, fuel_consumption_country, fuel_consumption_combined, fuel_type', 'safe', 'on'=>'search'),
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
			'modification'=>array(self::BELONGS_TO, 'Modification', 'modification_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'modification_id' => 'Модификация',
			'fuel_capacity' => 'Ёмкость топливного бака',
			'body' => 'Кузов',
			'doors' => 'Количество дверей',
			'seats' => 'Количество мест',
			'weight' => 'Снаряженная масса автомобиля',
			'weight_loaded' => ' Допустимая полная масса',
			'top_speed_at' => 'Максимальная скорость (AT)',
			'acceleration_at' => 'Разгон с 0 до 100 км/ч (AT)',
			'top_speed_mt' => 'Максимальная скорость (MT)',
			'acceleration_mt' => 'Разгон с 0 до 100 км/ч (MT)',
			'turn_radius' => 'Радиус разворота',
			'trunk_capacity' => 'Объём багажника',
			'length' => 'Длина',
			'width' => 'Ширина',
			'height' => 'Высота',
			'wheelbase' => 'Колесная база',
			'clearance' => 'Дорожный просвет',
			'engine_type' => 'Тип двигателя',
			'volume' => 'Объем двигателя',
			'displacement' => 'Расположение двигателя',
			'cylinders' => 'Количество цилиндров',
			'valves' => 'Количество клапанов',
			'max_power' => 'Максимальная мощность',
			'max_power_rpm' => 'при оборотах',
			'max_torque' => 'Максимальный крутящий момент',
			'max_torque_rpm' => 'при оборотах',
			'transmission_at' => 'Трансмиссия (AT)',
			'gears_at' => 'Количество передач (AT)',
			'transmission_mt' => 'Трансмиссия (MT)',
			'gears_mt' => 'Количество передач (MT)',
			'drive' => 'Привод',
			'suspension_front' => 'Передня подвеска',
			'suspension_rear' => 'Задняя подвеска',
			'tyres_front' => 'Передние колеса',
			'tyres_rear' => 'Задние колеса',
			'disks_front' => 'Передние диски',
			'disks_rear' => 'Задние диски',
			'brakes_front' => 'Передние тормоза',
			'brakes_rear' => 'Задние тормоза',
			'fuel_consumption_urban_at' => 'Расход топлива - городской (AT)',
			'fuel_consumption_country_at' => 'Расход топлива - загородный (AT)',
			'fuel_consumption_combined_at' => 'Расход топлива - смешаный (AT)',
			'fuel_consumption_urban_mt' => 'Расход топлива - городской (MT)',
			'fuel_consumption_country_mt' => 'Расход топлива - загородный (MT)',
			'fuel_consumption_combined_mt' => 'Расход топлива - смешаный (MT)',
			'fuel_type' => 'Тип топлива',
		
			'csvFile' => 'Файл с характеристиками',
			'brandTitle' => 'Бренд',
			'modelTitle' => 'Модель',
			'modificationTitle' => 'Модификация',
			'manufactureStart' => 'Начало производства',
			'manufactureEnd' => 'Окончание производства',
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
			if($model = Yii::app()->request->getParam('Characteristic', false)){
				
				$a = CHtml::listData( Modification::model()->findAll('title like :title', array(':title'=>'%'.$model['modificationTitle'].'%')), 'id', 'id');
				if(count($a)>0)
					$criteria->compare('modification_id', $a);
				elseif($modification['modificationTitle'])
					$criteria->compare('modification_id', 0);
				else
					$criteria->compare('modification_id', array());
				$criteria->compare('modification_id', $a);
				$this->modificationTitle = $model['modificationTitle'];

				$a = Car::model()->findAll('title like :title', array(':title'=>'%'.$model['modelTitle'].'%'));
				$tmp = array();
				foreach($a as $m)
					if(count($m->modifications) > 0)
						foreach($m->modifications as $t)
							$tmp[$t->id] = $t->id;
				$a = $tmp;
				if(count($a)>0)
					$criteria->compare('modification_id', $a);
				elseif($modification['modelTitle'])
					$criteria->compare('modification_id', 0);
				else
					$criteria->compare('modification_id', array());
				$criteria->compare('modification_id', $a);
				$this->modelTitle = $model['modelTitle'];
				
				
				$a = Brand::model()->findAll('title like :title', array(':title'=>'%'.$model['brandTitle'].'%'));
				$tmp = array();
				foreach($a as $b)
					if(count($b->models) > 0)
						foreach($b->models as $m)
							if(count($m->modifications) > 0)
								foreach($m->modifications as $t)
									$tmp[$t->id] = $t->id;
				$a = $tmp;
				if(count($a)>0)
					$criteria->compare('modification_id', $a);
				elseif($modification['brandTitle'])
					$criteria->compare('modification_id', 0);
				else
					$criteria->compare('modification_id', array());
				$criteria->compare('modification_id', $a);
				$this->brandTitle = $model['brandTitle'];
			}
		}
		
		$criteria->compare('fuel_capacity',$this->fuel_capacity);

		$criteria->compare('body',$this->body,true);

		$criteria->compare('doors',$this->doors);

		$criteria->compare('seats',$this->seats,true);

		$criteria->compare('weight',$this->weight);

		$criteria->compare('weight_loaded',$this->weight_loaded);

		$criteria->compare('top_speed_at',$this->top_speed_at);

		$criteria->compare('acceleration_at',$this->acceleration_at);

		$criteria->compare('top_speed_mt',$this->top_speed_mt);

		$criteria->compare('acceleration_mt',$this->acceleration_mt);
		
		$criteria->compare('turn_radius',$this->turn_radius);

		$criteria->compare('trunk_capacity',$this->trunk_capacity,true);

		$criteria->compare('length',$this->length);

		$criteria->compare('width',$this->width);

		$criteria->compare('height',$this->height);

		$criteria->compare('track_front',$this->tyres_front);

		$criteria->compare('track_rear',$this->tyres_front);
		
		$criteria->compare('track_front',$this->disks_front);

		$criteria->compare('track_rear',$this->disks_front);

		$criteria->compare('wheelbase',$this->wheelbase);

		$criteria->compare('engine_type',$this->engine_type,true);

		$criteria->compare('volume',$this->volume);

		$criteria->compare('displacement',$this->displacement,true);

		$criteria->compare('cylinders',$this->cylinders,true);

		$criteria->compare('valves',$this->valves);

		$criteria->compare('max_power',$this->max_power);

		$criteria->compare('max_power_rpm',$this->max_power_rpm,true);

		$criteria->compare('max_torque',$this->max_torque);

		$criteria->compare('max_torque_rpm',$this->max_torque_rpm,true);

		$criteria->compare('transmission_at',$this->transmission_at,true);

		$criteria->compare('gears_at',$this->gears_at,true);
		
		$criteria->compare('transmission_mt',$this->transmission_mt,true);

		$criteria->compare('gears_mt',$this->gears_mt,true);
		
		$criteria->compare('drive',$this->drive,true);
		
		$criteria->compare('suspension_front',$this->suspension_front,true);

		$criteria->compare('suspension_rear',$this->suspension_rear,true);

		$criteria->compare('tyres_front',$this->tyres_front,true);

		$criteria->compare('tyres_rear',$this->tyres_rear,true);

		$criteria->compare('brakes_front',$this->brakes_front,true);

		$criteria->compare('brakes_rear',$this->brakes_rear,true);

		$criteria->compare('fuel_consumption_urban_at',$this->fuel_consumption_urban_at);

		$criteria->compare('fuel_consumption_country_at',$this->fuel_consumption_country_at);

		$criteria->compare('fuel_consumption_combined_at',$this->fuel_consumption_combined_at);

		$criteria->compare('fuel_consumption_urban_mt',$this->fuel_consumption_urban_mt);

		$criteria->compare('fuel_consumption_country_mt',$this->fuel_consumption_country_mt);

		$criteria->compare('fuel_consumption_combined_mt',$this->fuel_consumption_combined_mt);
		
		$criteria->compare('fuel_type',$this->fuel_type,true);

		return new CActiveDataProvider('Characteristic', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->params['linesPerPage'],
			),
		));
	}

	public function beforeSave(){
		#$this->fromFile();
		return parent::beforeSave();
	}
}