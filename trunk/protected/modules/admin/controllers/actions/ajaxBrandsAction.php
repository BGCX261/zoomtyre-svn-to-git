<?php class ajaxBrandsAction extends CAction {
	var $import = null; 
	public function run(){
		Yii::import($this->import);
		$data = CHtml::listData( Brand::model()->findAll(array('order'=>'title')), 'id', 'title' );
		$data[0]='';
		ksort($data);

		echo CJavaScript::jsonEncode($data); 
	}
}
?>