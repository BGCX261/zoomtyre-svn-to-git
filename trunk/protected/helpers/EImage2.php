<?php
/**
 * Хреновый враппер на ImageMagick
 * @author Артем
 *
 */
class EImage2 extends CApplicationComponent {
	private $image; # обьект Imagick
	
	/**
	 * 
	 * Загрузка файла
	 * @param string $filepath Путь к файлу
	 * @return object $this При ошибке ЛОЖЬ
	 */
	public function load($filepath){
		$this->image = new Imagick;
		$this->image->readImage(($filepath));
		if(!$this->image)
			throw new CException(Yii::t('EImage','Image cant be loaded.'));

		return $this;
	}
	
	/**
	 * 
	 * Сохранение файла
	 * @param string $type Разрешение сохраняемого файла, если null, то файл будет сохранён в исходном формате 
	 * @param string $dir Директория где будет сохранён файл
	 * @param string $overwrite Перезаписать существующий файл
	 * @return boolean Ложь в случае ошибки сохранения 
	 */
	public function save($filename = null){
		if($filename) {
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$this->image->setFormat($ext);
		}
		$this->image->setImageFileName($filename);
		return $this->image->writeImage();
	}
	
	/**
	 * 
	 * Установить формат картинки
	 * @param string $format
	 */
	public function setFormat($format) {
		$this->image->setFormat($format);
		return $this;
	}
	
	/**
	 * 
	 * Получить формат картинки
	 */
	public function getFormat(){
		return $this->image->getFormat();
	}
	
	/**
	 * 
	 * Размеры картинки
	 */
	public function getGeometry(){
		return $this->image->getImageGeometry();
	}
	
	/**
	 * Имя файла
	 */
	public function getImageFilename(){
		return $this->image->getImageFilename();
	}
	
	/*
	 * Переразмеривает картинку
	 */
	public function thumb($x, $y, $bestfit = false, $bg = 'transparent'){
		/**
		 * 1. если x или y равен нулю и bestfit = false
		 * bestfit становиться равным true
		 * 
		 * 2. если x или y равен нулю и bestfit = true
		 * картинка принимает размеры пропорциональные большей стороне
		 * 
		 * 3. если x и y не равны нулю и bestfit = false
		 * то картинка принемает размеры x и y
		 * 
		 * 4. если x и y не равны нулю и bestfit = true
		 * картинка принимает минимальные пропорциональные размеры и накладываеться
		 * на другую картинку цветом $bg и размером x,y
		 * 
		 */
	
		if($x <= 0 || $y <= 0) {
			$newdim = $this->calculateDim($x, $y);
			$x = $newdim[0];
			$y = $newdim[1];
			$this->image->thumbnailImage($newdim[0], $newdim[1]);
		}elseif(!$bestfit) {
			$this->image->thumbnailImage($x, $y);
		}else{
			$newdim = $this->calculateDim($x, $y, 'min');
			$this->image->thumbnailImage($newdim[0], $newdim[1]);
			
			$canvas = new Imagick();
			$canvas->newImage($x, $y, new ImagickPixel($bg));
			$canvas->compositeImage($this->image, Imagick::COMPOSITE_OVER, ($x-$newdim[0])/2, ($y-$newdim[1])/2);
			$this->image = $canvas;
		}
		
		$this->image->setImagePage($x, $y, 0, 0);
		
		return $this;
	}
	
	/**
	 * Накладываем на картинку ватермарку
	 */
	public function watermark($wm, $padding = 0) {

		$watermark = new Imagick($wm);

		# Если марка больше картинки, то марка не клеиться
		$image_width = $this->geometry['width'];
		$image_height = $this->geometry['height'];
		
		$watermark_width = $watermark->getImageWidth();
		$watermark_height = $watermark->getImageHeight();
		
		# возвращаю исходную картинку
		if ($image_width < $watermark_width + $padding || $image_height < $watermark_height + $padding)
			return $this;


		# Подсчёт позиций
		$positions = array();
		$positions[] = array(0 + $padding, 0 + $padding);
		$positions[] = array($image_width - $watermark_width - $padding, 0 + $padding);
		$positions[] = array($image_width - $watermark_width - $padding, $image_height - $watermark_height - $padding);
		$positions[] = array(0 + $padding, $image_height - $watermark_height - $padding);

		$min = null;
		$min_colors = 0;

		# Подсчет цветов в каждой позиции, поиск минимального
		foreach($positions as $position) {
			$region = $this->image->getImageRegion(
				$watermark_width,
				$watermark_height,
				$position[0],
				$position[1]
			);

			$colors = $region->getImageColors();

			if ($min === null || $colors <= $min_colors) {
				$min = $position;
				$min_colors = $colors;
			}
		}

		
		// Draw the watermark
		if($this->image->compositeImage( $watermark, Imagick::COMPOSITE_OVER, $min[0], $min[1]))
			return $this;
		else
			return false;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $x_rounding
	 * @param unknown_type $y_rounding
	 * @param unknown_type $stroke_width
	 * @param unknown_type $displace
	 * @param unknown_type $size_correction
	 */
	public function roundCorners($x_rounding, $y_rounding, $stroke_width = 10, $displace = 5, $size_correction = -6 ){
		$this->image->roundCorners($x_rounding, $y_rounding, $stroke_width, $displace, $size_correction);
		return $this;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function getImageBlob(){
		return $this->image->getImageBlob();
	}
	
	public function init() {
		parent::init();
	}
	
	/**
	 * Подсчет размеров картинки, в пропорции по большей стороне
	 * @param unknown_type $nx
	 * @param unknown_type $ny
	 */
	private function calculateDim($nx,$ny, $border = 'max') {
		$x = $this->geometry['width'];
		$y = $this->geometry['height'];

		# пропорции
		if($x>0) $rx=$nx/$x;
		if($y>0) $ry=$ny/$y;
        
		# использую , пропорцию по большей стороне
		if($border == 'max')
			if($rx<$ry){
				$ox = $x*$ny/$y;
				$oy = $ny;
			}else{
				$ox = $nx;
				$oy = $y*$nx/$x;
			}
		else
			if($rx>$ry){
				$ox = $x*$ny/$y;
				$oy = $ny;
			}else{
				$ox = $nx;
				$oy = $y*$nx/$x;
			}

		# новые размеры
		return array(intval($ox),intval($oy));
	}
}
?>