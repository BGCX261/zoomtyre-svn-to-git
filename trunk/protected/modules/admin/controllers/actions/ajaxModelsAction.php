<?php class ajaxModelsAction extends CAction {
	var $import = null; 
	public function run(){
		Yii::import($this->import);
		
		$id = Yii::app()->request->getParam('id', 0);
		if($id <= 0)
			echo '{}';
		else {
			$models = Car::model()->findAll(array('condition'=>'brand_id='.$id, 'order'=>'title'));
			$data = array('');

			foreach($models as $m)
				$data[$m->id] = $m->title.' '.EString::getYear($m->manufacture_start).(empty($m->manufacture_end)?'...':' - '.EString::getYear($m->manufacture_end));
				
			echo CJavaScript::jsonEncode($data);
		} 
	}
}
?>