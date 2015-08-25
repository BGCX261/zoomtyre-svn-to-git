<?
class statBehavior extends CActiveRecordBehavior {
	/**
	 * Обновление рейтинга
	 */
	public function updateRating($d = 0) {
		/*
		 * @string $d дельта на которую изменить рейтинг
		 */
		
		if($d === 0)
			return;

		if( Vote::allow($this->Owner->id, get_class($this->Owner))){
			$this->Owner->rating = $this->Owner->rating+$d;
			$this->Owner->save();
		}

		return $this->Owner->rating;
	}

	/**
	 * обновление кол-ва просмотров
	 */
	public function updateViews() {
		/*
		 * @string $field Имя виртуального поля в котром хранится файл
		 * @string $name Имя файла, который будет сохранен на диске
		 */
		if( View::allow($this->Owner->id, get_class($this->Owner))){
			$this->Owner->views += 1;
			$this->Owner->save();
		}

		return $this->Owner->rating;
	}
}
?>