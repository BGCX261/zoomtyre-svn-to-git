<?php class TyreProducersListAction extends CAction {
	public function run() {
		if(Yii::app()->request->isAjaxRequest) {
			// this was set with the "max" attribute of the CAutoComplete widget
			$limit = Yii::app()->request->getParam('limit', 50);
			$limit = min($limit, 50);

			$criteria = new CDbCriteria;
			$criteria->limit = $limit;
			$criteria->order = 'title';
			echo CJavaScript::jsonEncode(CHtml::listData(TyreProducers::model()->findAll($criteria), 'id', 'title'));
       }
	}
}
?>