<?
class TyresListAction extends CAction {
	public function run() {
		if(Yii::app()->request->isAjaxRequest && isset($_GET['producer_id'])) {
			$producer_id = Yii::app()->request->getParam('producer_id'); 
			// this was set with the "max" attribute of the CAutoComplete widget
			$limit = Yii::app()->request->getParam('limit', 50);
			$limit = min($limit, 50);

			$criteria = new CDbCriteria;
			$criteria->condition = "producer_id = :sterm";
			$criteria->params = array(":sterm"=>$producer_id);
			$criteria->limit = $limit;
			$criteria->order = 'title';
			echo CJavaScript::jsonEncode(CHtml::listData(Tyre::model()->findAll($criteria), 'id', 'title'));
		}
	}
}
?>