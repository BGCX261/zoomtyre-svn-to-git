<?php

/**
 * This is the model class for table "tbl_faq".
 *
 * The followings are the available columns in table 'tbl_faq':
 * @property integer $id
 * @property integer $part
 * @property string $question
 * @property string $alias
 * @property string $answer
 * @property integer $rating
 */
class Faq extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Faq the static model class
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
		return 'tbl_faq';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('part, question, alias, answer, rating', 'required'),
			array('part, rating', 'numerical', 'integerOnly'=>true),
			array('alias', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, part, question, alias, answer, rating', 'safe', 'on'=>'search'),
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
			'part' => 'Part',
			'question' => 'Question',
			'alias' => 'Alias',
			'answer' => 'Answer',
			'rating' => 'Rating',
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
		$criteria->compare('part',$this->part);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('rating',$this->rating);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}