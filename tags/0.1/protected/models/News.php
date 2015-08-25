<?php

/**
 * This is the model class for table "tbl_articles".
 *
 * The followings are the available columns in table 'tbl_articles':
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $photo
 * @property string $author
 * @property string $publicated
 * @property string $preamble
 * @property string $preamble_marked
 * @property string $text
 * @property string $text_marked
 * @property string $source
 * @property string $source_link
 * @property integer $status
 */
class News extends CActiveRecord
{
	
	protected 
	$images = array(
		'photo' => array(
			'field' => 'photo',
			'filename' => '%alias%',
			'alt' => '%title%',
			'title' => '%title%', 
			'addWatermark' => false,
			'bg' => '#FFFFFF',
			'file_type' => 'jpg',
			'sizes' => array(
				'small'=>array(120, 80),
				'normal'=>array(280, 187),
				'main'=>array(340, 227),
				'big'=>array(500, 333),
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
	
	public function scopes(){
		$table = $this->getTableAlias();
		return array(
			'published' => array(
				'condition' => $table.'.status = '.L::r_ruitem('publicationStatus', 'published').' and '.$table.'.publicated < now()',
				'order' => $table.'.publicated desc',
			),
		);
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Articles the static model class
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
		return 'tbl_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, alias, author, publicated, text, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('title, alias, photo, source, source_link', 'length', 'max'=>255),
			array('author', 'length', 'max'=>45),
			array('preamble, preamble_marked, text_marked', 'safe'),
			array('alias, preid', 'unique'),
			array('alias', 'match', 'pattern'=>'/[a-z0-9-_]+/i'),
			array('preamble, source, source_link', 'default', 'value'=>null),
			
			
			array('photo', 'file', 'types'=>'jpg, gif, png, jpeg', 'maxSize' => 10490000, 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, preid, title, alias, photo, author, publicated, preamble, preamble_marked, text, text_marked, source, source_link, status', 'safe', 'on'=>'search'),
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
			'title' => 'Название',
			'alias' => 'Псевдоним',
			'url' => 'Ссылка',
			'photo' => 'Фото',
			'author' => 'Автор',
			'publicated' => 'Дата публикации',
			'preamble' => 'Преамбула',
			'preamble_marked' => 'Преамбула',
			'text' => 'Текст',
			'text_marked' => 'Текст',
			'source' => 'Источник',
			'source_link' => 'Ссылка на источник',
			'status' => 'Статус',
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
		$criteria->compare('preid',$this->preid,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('publicated',$this->publicated,true);
		$criteria->compare('preamble',$this->preamble,true);
		$criteria->compare('preamble_marked',$this->preamble_marked,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('text_marked',$this->text_marked,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('source_link',$this->source_link,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'sort' => array(
				'defaultOrder'=>array(
					'publicated'=>'desc',
				),
			),
		));
	}
	
	public function beforeSave(){

		Yii::import('ext.markdown.*');
		$md = new EMarkdown;
		$this->text_marked = $md->transform($this->text);
		if(!empty($this->preamble))
			$this->preamble_marked = $md->transform($this->preamble);
			
		$this->url = Yii::app()->createUrl('articles/view', array('alias'=>$this->alias));
			
		return parent::beforeSave();
	}
}