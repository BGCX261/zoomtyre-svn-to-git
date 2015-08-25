<?php
class ajaxAutocompleteBlogsAction extends CAction {
	public function run(){
		if(Yii::app()->request->isAjaxRequest && isset($_GET['q'])){
			$tag = Yii::app()->request->getParam('q', '');
			$limit = Yii::app()->request->getParam('limit', 50);
			$limit = min($limit, 50);
			$criteria = new CDbCriteria;
			$criteria->condition = "title LIKE :sterm";
			$criteria->params = array(":sterm"=>"%$tag%");
			$criteria->limit = $limit;
			$tagArray = Blog::model()->findAll($criteria);

			$returnVal = '';
			foreach($tagArray as $tagValue)
				$returnVal .= $tagValue->getAttribute('title').'|'.$tagValue->getAttribute('id')."\n";
			echo $returnVal;
		}
	}
}
?>