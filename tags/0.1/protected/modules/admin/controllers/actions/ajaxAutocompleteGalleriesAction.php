<?
class ajaxAutocompleteGalleriesAction extends CAction {
	public function run(){
		if(Yii::app()->request->isAjaxRequest && isset($_GET['q'])){
			$title = Yii::app()->request->getParam('q', '');
			$limit = Yii::app()->request->getParam('limit', 50);
			$limit = min($limit, 50);
			$criteria = new CDbCriteria;
			$criteria->condition = "title LIKE :sterm";
			$criteria->params = array(":sterm"=>"%$title%");
			$criteria->limit = $limit;
			$array = Gallery::model()->findAll($criteria);

			$result = '';
			foreach($array as $val)
				$result .= $val->getAttribute('title').'|'.$val->getAttribute('id')."\n";

			echo $result;
		}
	}
}
?>