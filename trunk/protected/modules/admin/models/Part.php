<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property string $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $title
 * @property string $alias
 * @property string $url
 * @property integer $main
 * @property string $template
 * @property string $page_title
 * @property string $page_description
 * @property string $page_keywords
 */
class Part extends CActiveRecord
{
	private static $_roots = array();
	var $childs = array();
	/**
	 * Returns the static model of the specified AR class.
	 * @return Part the static model class
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
		return 'tbl_parts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, alias', 'required'),
			#array('alias', 'unique', 'criteria'=>)
			array('main', 'numerical', 'integerOnly'=>true),
			array('lft, rgt', 'length', 'max'=>10),
			array('root', 'length', 'max'=>45),
			array('title, alias, url, template', 'length', 'max'=>255),
			array('page_title, page_description, page_keywords', 'safe'),
			array('main', 'default', 'value'=>0),
			array('visible', 'default', 'value'=>1),
			array('path, htmlOptions, url, url_part, template, page_title, page_description, page_keywords', 'default', 'value'=>null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, alias, url, url_part, main, template, page_title, page_description, page_keywords', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * 
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
	 * по алиасу возвращает иерархически сформированное дерево
	 * @param string $alias псевдоним корневого элемента
	 */
	public function tree($alias) {
		$criteria = new CDbCriteria();
		$criteria->condition = 'alias=:alias';
		$criteria->params = array(':alias'=>$alias);
		
		$root = $this->roots()->find($criteria);
		if(empty($root))
			return array();

		$branch = $root->descendants(null, true)->findAll();
		$branch = $this->hierarchical($branch);

		return $branch;
	}
	
	/*
	 * Возвращает идентификатор дерева по псевдониму
	 */
	static public function treeId($alias = null){
		if(!isset(self::$_roots[$alias])) {
			$root = self::model()->roots()->find('alias=:alias', array(':alias'=>$alias));
			self::$_roots[$alias] = $root->root;
		}
		return isset(self::$_roots[$alias]) ? self::$_roots[$alias] : false;
	}
	
	/*
	 * Возврщает куст с корнем имеющим alias
	 */
	public function bush($root_alias = 'admin'){
		$root = self::model()->roots()->find('alias=:alias', array(':alias'=>$root_alias));
		
		$criteria = $this->getDbCriteria();
		$db = $this->getDbConnection();
		$alias=$db->quoteColumnName($this->getTableAlias());
		
		$criteria->mergeWith(array(
			'condition'=>$alias.'.'.$db->quoteColumnName($this->rootAttribute).'='.$root->{$this->rootAttribute},
			'order'=>$alias.'.'.$db->quoteColumnName($this->leftAttribute),
		));
		
		return $this;
	}
	
	/*
	 * 
	 */
	public function canBeMain(){
		$criteria = $this->getDbCriteria();
		$db = $this->getDbConnection();
		$alias=$db->quoteColumnName($this->getTableAlias());
		
		$criteria->mergeWith(array(
			'condition'=>$alias.'.main = true',
		));
		
		return $this;
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
			'root' => 'Дерево',
			'lft' => 'Левый ключ',
			'rgt' => 'Правый ключ',
			'level' => 'Уровень',
			'title' => 'Имя',
			'alias' => 'Метка',
			'url' => 'Ссылка',
			'url_part' => 'Ссылка',
			'main' => 'Основной раздел',
			'template' => 'Шаблон ссылки',
			'htmlOptions' => 'HTML опции',
			'visible' => 'Видимость',
			'path' => 'Путь в кустах',
			'page_title' => 'СЕО title страницы',
			'page_description' => 'СЕО description страницы',
			'page_keywords' => 'СЕО keywords страницы',
		
			'parent' => 'Родитель',
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
		$criteria->compare('root',$this->root,true);
		$criteria->compare('lft',$this->lft,true);
		$criteria->compare('rgt',$this->rgt,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('main',$this->main);
		$criteria->compare('template',$this->template,true);
		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('page_description',$this->page_description,true);
		$criteria->compare('page_keywords',$this->page_keywords,true);
		
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Возвращает список корней 
	 * @return CActiveDataProvider провайдер данных, который может вернуть список корней с наложенными на него базовыми фильтрами.
	 */
	
	public function searchRoots(){
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('root',$this->root,true);
		$criteria->compare('lft',$this->lft,true);
		$criteria->compare('rgt',$this->rgt,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('url_part',$this->url_part,true);
		$criteria->compare('main',$this->main);
		$criteria->compare('template',$this->template,true);
		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('page_description',$this->page_description,true);
		$criteria->compare('page_keywords',$this->page_keywords,true);
		
		
		$criteria->mergeWith($this->roots()->getDbCriteria()->toArray());

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Возвращает список корней 
	 * @return CActiveDataProvider провайдер данных, который может вернуть список корней с наложенными на него базовыми фильтрами.
	 */
	
	public function searchList($id = null){
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('url_part',$this->url_part,true);
		$criteria->compare('main',$this->main);
		$criteria->compare('template',$this->template,true);
		$criteria->compare('page_title',$this->page_title,true);
		$criteria->compare('page_description',$this->page_description,true);
		$criteria->compare('page_keywords',$this->page_keywords,true);
		
		$criteria->addCondition('root='.$id);
				
		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'sort' => array(
				'defaultOrder' => 'lft',
			),
			'pagination' => array(
				'pageSize' => 50,
			),
		));
	}
	
	public function afterSave(){
		// parent for path and full url
		if($this->isRoot()){
			# path
			$path = $this->title;
			# full url
			$url = $this->url_part?('/'.$this->url_part):$this->url_part;
		} else {
			$parents = $this->ancestors()->findAll();
			// path
			$tmp = CHtml::listData($parents, 'id', 'title');
			$tmp[] = $this->title;
			$path = implode(' &rarr; ', $tmp);
			// full url
			if(!empty($this->url_part)) {
				$tmp = CHtml::listData($parents, 'id', 'url_part');
				$tmp[] = $this->url_part;
				$tmp = EArray::trimEmpty($tmp);
				$url = '/'.implode('/', $tmp);
			} else
				$url = null;
		}
			
		$this->updateByPk($this->id, array('path'=>$path, 'url'=>$url));

		return parent::afterSave();
	}
	
	/*
	 * 
	 */
	static public function replaceArrows($value){
		return str_replace('&rarr;', '→', $value);
	}
}