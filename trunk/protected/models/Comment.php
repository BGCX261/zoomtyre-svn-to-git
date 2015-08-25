<?php

/**
 * This is the model class for table "tbl_comments".
 *
 * The followings are the available columns in table 'comments':
 * @property string $id
 * @property string $object_id
 * @property string $object_type
 * @property string $author
 * @property string $text
 * @property string $text_marked
 * @property string $created
 * @property integer $rating
 * @property integer $status
 *
 * The followings are the available model relations:
 */
class Comment extends CActiveRecord
{
	public $object;
	
	/**
	 * Поведения модели
	 */
	public function behaviors(){
		return array(
			'tree' => array(
				'class' => 'ENestedSetBehavior2',
				// хранить ли множество деревьев в одной таблице
				'hasManyRoots' => true,
				// поле для хранения идентификатора дерева при $hasManyRoots=false; не используется
				'rootAttribute' => 'root',
				// обязательные поля для NS
				'leftAttribute' => 'lft',
				'rightAttribute' => 'rgt',
				'levelAttribute' => 'level',
				'aliasAttribute' => 'alias',
			),
		);
	}
	/**
	 * Returns the static model of the specified AR class.
	 * @return Comment the static model class
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
		return 'tbl_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('object_id, object_type, text, created, status', 'required'),
			array('rating, status, lft, rgt, level', 'numerical', 'integerOnly'=>true),
			array('object_id, object_type', 'length', 'max'=>10),
			array('author', 'length', 'max'=>45),
			array('status', 'default', 'value'=>L::r_item('commentStatus', 'blocked')),
			array('text','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, lft, rgt, level, object_id, object_type, author, text, text_marked, created, rating, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		$items = L::items('CommentType');
		$a = array();
		foreach($items as $k=>$label){
			$a[$label] = array(self::BELONGS_TO, $label, 'object_id', /*'condition'=>'Comment.type='.L::ritem('CommentType', $label)*/);
		}
		
		return array_merge($a,array(
			'user_author' => array(self::BELONGS_TO, 'User', 'author'),
		));
	}

	/**
	 * @return array of scopes
	 */
    public function scopes(){
		$db = $this->getDbConnection();
		$alias = $db->quoteColumnName($this->getTableAlias());
    	
        return array(
            'approved'=>array(
				'condition'=>$alias.'.status='.L::r_item('CommentStatus', 'approved'),
            ),
            'notblocked'=>array(
				'condition'=>$alias.'.status!='.L::r_item('CommentStatus', 'blocked'),
            ),
            'recently'=>array(
                'order'=>$alias.'.created DESC',
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
			'lft' => 'Левый ключ',
			'rgt' => 'Правый ключ',
			'level' => 'Уровень',
			'object_id' => 'Объект',
			'object_type' => 'Тип',
			'author' => 'Автор',
			'text' => 'Текст',
			'text_marked' => 'Текст',
			'created' => 'Дата создания',
			'rating' => 'Рейтинг',
			'status' => 'Статус',
		
			'parentTitle'=>'Название материала',
			'url'=>'Ссылка',
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
		$criteria->compare('object_id',$this->object_id,true);
		$criteria->compare('object_type',$this->object_type,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('text_marked',$this->text_marked,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('status',$this->status);
		$criteria->addCondition('id<>1');

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'sort' => array(
				'defaultOrder'=>array(
					'created'=>'desc',
				),
			),
		));
	}
	
	public function setObject(){
		if($this->object_type > 0)
			$this->object = $this->{L::item('CommentType', $this->object_type)};
	}
	
	public function updateParentComments(){
		
		#throw new CException(Yii::t('Comment','Сделай подсчет комментов у обьекта через поведение!')); 
		$class = L::item('CommentType', $this->object_type);
		$class = new $class;
		$model = $class->with('comments:notblocked')->findByPK($this->object_id);

		$criteria = new CDbCriteria;
		$criteria->condition = 'object_type = :type and object_id = :id';
		$criteria->params = array(':type'=>$this->object_type, 'id'=>$this->object_id);
		$count = $this->notblocked()->count($criteria);

		$class->updateByPk($this->object_id, array('comments_count'=>$count));
	}
	
	public function updateRating($d = 0){
		if($d === 0)
			return;

		if( Vote::allow($this->id, get_class($this))){
			$this->rating = $this->rating+$d;
			$this->save();
		}

		// ОБновление рейтинга и кол-ва комментов пользователя
		if($this->user_author) {
			$this->user_author->updateCommentsCount();
		}

		return $this->rating;
	}
	
	public function afterFind(){
		$this->setObject();
		
		if(empty($this->text_marked)) {
			Yii::import('ext.markdown.*');
			$md = new EMarkdown;
			$md->purifyOutput = true;
			$this->text_marked = trim($md->transform( CHtml::encode($this->text)));
			$this->updateByPk($this->getPrimaryKey(), array('text_marked'=>$this->text_marked));
		}
			

		return parent::afterFind();
	}
	
	public function beforeSave(){
		if($this->isNewRecord)
			$this->created = date('Y-m-d H:i:s');
		
		Yii::import('ext.markdown.*');
		$md = new EMarkdown;
		$md->purifyOutput = true;
		$this->text_marked = trim($md->transform( CHtml::encode($this->text)));
		
		return parent::beforeSave();
	}
	
	public function afterDelete(){
		$this->updateParentComments();

		return parent::afterDelete();
	}
	
	public function afterSave(){
		$this->updateParentComments();

		return parent::afterSave();
	}
}