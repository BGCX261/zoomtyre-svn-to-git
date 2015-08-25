<?
/**
 * Поведение для згрузки картинок
 * Использование
 * 	
 * public function behaviors(){
 * 		return array(
 * 			'ImageUploadBehavior2' => array(
 * 				'class' => 'ImageUploadBehavior2',
 * 				'conf' => array(
 * 					'logo' => array(
 *	 					'field' => 'logo',
 *						'saveOld' => false,
 *						'filename' => '%alias%_%uniqid%',
 *						'alt' => 'Производитель шин %title%',
 *						'title' => '%title%',
 *						'addWatermark' => false,
 *						'bg' => '#FFFFFF',
 *						'file_type' => 'jpg',
 *						'sizes' => array(
 *							'small'=>array(21,21),
 *							'normal'=>array(150,100),
 *							'big'=>array(250,187),
 *						),
 *					),
 *				),
 * 			),
 * 		);
 * 	}
 * 
 * @author Артем
 *
 */
class ImageManageBehavior extends CActiveRecordBehavior {
	public $conf = null;
	private 
	$default = array(
			'saveOld' => false,
			'filename' => '%alias%',
			'alt' => '%title%',
			'title' => '%title%',
			'removeWildCards' => true, 
			'addWatermark' => false,
			'bg' => '#FFFFFF',
			'file_type' => 'jpg',
			'sizes' => array(
				'orig',
			),
	);
	
	public function beforeValidate($event){
		$owner=$this->getOwner();
		
		foreach($this->conf as $img) {
			# файл есть в $_FILES
			if($file = CUploadedFile::getInstance($owner, $img['field'])) {
				$owner->{$img['field']} = $file;
				// удалить предыдущий файл
				if(!$owner->isNewRecord) {
					$model = $owner->findByPk($owner->getPrimaryKey());
					$this->deleteImage($model->{$img['field']}, $img['sizes']);
				}
			}

			# в массиве $_POST в поле с файлом метка об удалении 
			if($owner->{$img['field']} === 'delete') {
				$owner->{$img['field']} = null;
				// Удаляю старые файл
				if(!$owner->isNewRecord) {
					$model = $owner->findByPk($owner->getPrimaryKey());
					$this->deleteImage($model->{$img['field']}, $img['sizes']);
					
					$owner->updateByPk($owner->getPrimaryKey(), array( $img['field']=>null ));
				}
			}
			
			# если всё остаёться по прежнему
			if($owner->{$img['field']} === '' && empty($file)) {
				unset($owner->{$img['field']});
			}
		}
	}
	
	public function afterDelete($event) {
		$owner=$this->getOwner();
		
		foreach($this->conf as $img) {
			$this->deleteImage($owner->{$img['field']}, $img['sizes']);
		}
	}
	
	public function afterSave($event) {
		$owner=$this->getOwner();
		
		foreach($this->conf as $img) {
			# загружаю файл если он был отправлен
			if($owner->{$img['field']} instanceof CUploadedFile) {
				# значения по умолчанию
				$img = array_merge($this->default, $img);

				$filename = $this->wildCards($img['filename'], $owner, $img['removeWildCards']);
				$alt = $this->wildCards($img['alt'], $owner, $img['removeWildCards']);
				$title = $this->wildCards($img['title'], $owner, $img['removeWildCards']);
				
				$file = $this->uploadImage($img['field'], $filename, $img['sizes'], $alt, $title, $img['addWatermark'], $img['bg'], $img['file_type']);
				
				$owner->updateByPk($owner->getPrimaryKey(), array( $img['field']=>$file ));
			}
		}
	}
	
	/**
	 * Подстановка wildcards значениями атрибутов модели
	 */
	private function wildCards($str = '', $model, $remove = true){
		if(preg_match_all('/%(\w[\w0-9]*)%/is', $str, $res) > 0) {
			foreach($res[1] as $card) {
				if(isset($model->attributes[$card]))
					$str = str_replace('%'.$card.'%', $model->attributes[$card], $str);
				elseif($card == 'uniqid') # замена карда на uniqid
					$str = str_replace('%'.$card.'%', uniqid(), $str);
				elseif($remove) # удалить карды, если им нет подстановки
					$str = str_replace('%'.$card.'%', '', $str);
			}
		}
		
		if(empty($str))
			return $model->getPrimaryKey();
			#return uniqid();

		return $str;
	}
	
	/**
	 * Удаление картинки
	 */
	protected function deleteImage($file, $sizes) {
		Image::deleteFile($file, $sizes);
	}
	
	/**
	 * Загрузка картинки
	 */
	protected function uploadImage($field, $name, $sizes, $alt='', $title='', $addWatermark = false, $bg = '#FFFFFF', $file_type = 'jpg', $saveOld = false) {
		/*
		 * @string $field Имя виртуального поля в котром хранится файл
		 * @string $name Имя файла, который будет сохранен на диске
		 */
		$owner = $owner=$this->getOwner();

		if($owner->{$field} instanceof CUploadedFile) {
			$filename = EString::strtolower(EFile::sanitize($name).'.'.$file_type);
			$path = Yii::getPathOfAlias( 
						'webroot.files.'.EString::strtolower(get_class($owner)).'.'.$field 
					).DIRECTORY_SEPARATOR;
		
			return $owner->{$field} = Image::addFile( $owner->{$field}, $filename, $path, $sizes, $alt, $title, $addWatermark, $bg, $file_type, $saveOld);
		}
	}
}
?>