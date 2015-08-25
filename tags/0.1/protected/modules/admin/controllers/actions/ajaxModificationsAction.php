<?
class ajaxModificationsAction extends CAction {
	var $import = null; 
	public function run(){
		Yii::import($this->import);
		$id = Yii::app()->request->getParam('id', 0);
		if($id <= 0)
			echo '{}';
		else {
			$data = CHtml::listData( Modification::model()->findAll(array('condition'=>'model_id='.$id, 'order'=>'title')), 'id', 'title' );
			$data[0]='';
			ksort($data);

			echo CJavaScript::jsonEncode($data);
		} 
	}
}
?>