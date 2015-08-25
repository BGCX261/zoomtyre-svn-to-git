<?php

/**
 * This is the model class for table "images".
 *
 * The followings are the available columns in table 'images':
 * @property string $filename
 * @property string $created
 * @property string $alt
 * @property string $title
 *
 * The followings are the available model relations:
 */
class Image extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return Image the static model class
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
		return 'tbl_images';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('filename, created', 'required'),
			array('filename, alt, title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('filename, created, alt, title', 'safe', 'on'=>'search'),
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
			'filename' => 'Файл',
			'created' => 'Дата создания',
			'alt' => 'Альтернативный текст',
			'title' => 'Название',
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

		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('alt',$this->alt,true);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public static function getFile($filename, $size = 'normal'){
		$img = Yii::getPathOfAlias('webroot').'/'.str_replace('::size::', $size, $filename);
		// уменьшаю кол-во запросов
		if(file_exists($img) && is_file($img) && getimagesize($img))
			return str_replace('::size::', $size, $filename);
		else
			return null;
		/*
		if(Image::model()->exists('filename=:filename', array(':filename'=>$filename))) {
			if(file_exists($img))
				# всё норм, возвращаю файл
				return str_replace('::size::', $size, $filename);
			else
				# файл есть в базе, но его нет в файловой системе
				return null;
		} else {
			if(file_exists($img) && is_file($img) && getimagesize($img))
				# файла нет в базе, но он есть в файловой системе
				return str_replace('::size::', $size, $filename);
			else
			# файла нет ни в базе ни в файловой системе, фигня какая то....
			return null;
		}
		*/
	}
	
	public static function addFile($cfile ,$filename, $folder, 
				$sizes = array('orig'), $alt = '', $title = '', $addWatermark = false, 
				$bg = '#000000', $format = 'jpg', $saveOld = false){
		/*
		 * @CUploadedFile $cfile загруженный файл
		 * @string $filename Имя конечного файла, без пути
		 * @string $folder путь 
		 * @array $sizes Массив типа ключ=>значение, где ключ - псевдоним размера и значение - массив размеров (ширина, высота)
		 * @string $alt Альтернативное название картинки
		 * @string $title Всплывающая подсказка над картинкой
		 */

		$filename_key = str_replace(array(Yii::getPathOfAlias('webroot'), DIRECTORY_SEPARATOR), array('','/'), $folder).'::size::/'.$filename;
		// Заполняю модель
		if(! ($image = Image::model()->findByPK($filename_key))) {
			$image = new Image;
			$image->filename = $filename_key;
			$image->created = date('Y-m-d H:i:s');
		}
	
		$image->alt = $alt;
		$image->title = $title;

		// Валидация
		if($image->validate()) {
			// Обрабатываю размеры
			foreach($sizes as $key=>$size){
				if(!is_array($size))
					$key = $size;

				// Удаляю старую картинку всех размеров
				$fullpath = $folder.$key.DIRECTORY_SEPARATOR.$filename;
				if(file_exists($fullpath))
					unlink($fullpath);
				
				$last_folder = str_replace(array('/','\/'), DIRECTORY_SEPARATOR, $folder.$key).DIRECTORY_SEPARATOR;

				// Если нет папки
				$size_folder = Yii::app()->file->set($last_folder);
				if(!$size_folder->exists)
					$size_folder->createDir();

				// Если нужны дополнительные размеры - создаю
				if(is_array($size)) {
					$pic = Yii::app()->image->load($cfile->tempName);
					$pic->thumb(isset($size[0])?$size[0]:0, isset($size[1])?$size[1]:0, true, $bg);
					if($addWatermark)
						$pic->watermark( Yii::getPathOfAlias('webroot').Yii::app()->params['watermark'], 5);

					$pic->save($fullpath);
				}else{
					$pic = Yii::app()->image->load($cfile->tempName);
					if($addWatermark)
						$pic->watermark( Yii::getPathOfAlias('webroot').Yii::app()->params['watermark'], 5);
					$pic->save($fullpath);
				}
			}

			// Сохраняю модель
			$image->save();

			return $image->filename;
		} else
			return null;
	}
	
	public static function deleteFile($filename, $sizes){
		/* Удаляет картинку во всех размерах и запись из базы
		 * @string $filename Имя файла вида /folder1/folder2/::size::/file.jpg
		 * @array $sizes Массив типа ключ=>значение, где ключ - псевдоним размера и значение - массив размеров (ширина, высота)
		 */
		// Удаляю запись из базы, если она есть
		
		$image = Image::model()->findByPk($filename);

		if($image) {
			$image->delete();
		}

		// Удаляю файлы
		foreach($sizes as $key=>$size){
			if(is_array($size))
				$size = $key;

			$fullpath = str_replace('::size::', $size, $filename);

			if($fullpath)
				$fullpath = Yii::getPathOfAlias('webroot').$fullpath; 

			if( file_exists( $fullpath ) && is_file($fullpath)) {
				unlink($fullpath);
			}
		}
	}
}