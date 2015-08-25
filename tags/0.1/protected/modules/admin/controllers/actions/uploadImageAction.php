<?
class uploadImageAction extends CAction {
	var $path;
	var $sizes = array(
		'normal'=>array(500),
	);
	var $field = 'file';
	var $folder = 'webroot.files.article';
	var $watermark = false;
	
	public function run(){
		if($image = CUploadedFile::getInstanceByName($this->field)) {
			// Валидация по форме
			$v = new ImageForm();
			$v->image = true;
			$v->image_file = $image;
			if($v->validate()){
				$preid = Yii::app()->request->getPost('preid', date('Ymd'));
				$tmp = pathinfo($image->name);
				$filename = EString::strtolower(EFile::sanitize($tmp['filename']).'_'.uniqid().'.'.$tmp['extension']);
				$path = Yii::getPathOfAlias( $this->folder.'.'.$this->field ).DIRECTORY_SEPARATOR.$preid.DIRECTORY_SEPARATOR;
				$result = Image::addFile( $image, $filename, $path, $this->sizes, $preid, null, $this->watermark?Yii::app()->params['watermark']:false);
				echo '"'.Image::getFile($result, 'normal').'"';
			} else {
				echo '{"error":"Файл не проходит валидацию, выберите другой."}';
			}
		} else {
			echo '{"error":"Ошибка загрузки файла."}';
		}
	}
}
?>