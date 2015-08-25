<?php

/**
 * This is the model class for table "itm_disk_prices".
 *
 * The followings are the available columns in table 'itm_disk_prices':
 * @property string $id
 * @property string $disk_size_id
 * @property string $partner_id
 * @property string $price
 * @property integer $max_discount
 */
class DiskPrices extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DiskPrices the static model class
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
		return 'itm_disk_prices';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price', 'required'),
			array('max_discount', 'numerical', 'integerOnly'=>true),
			array('price', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, disk_size_id, partner_id, price, max_discount', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'disk_size_id' => 'Disk Size',
			'partner_id' => 'Partner',
			'price' => 'Price',
			'max_discount' => 'Max Discount',
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
		$criteria->compare('disk_size_id',$this->disk_size_id,true);
		$criteria->compare('partner_id',$this->partner_id,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('max_discount',$this->max_discount);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}