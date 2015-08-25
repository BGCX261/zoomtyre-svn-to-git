<?
class UserRBACBehavior extends CActiveRecordBehavior {
	public function afterDelete($event) {
		$owner=$this->getOwner();
		$auth=Yii::app()->authManager;
		AuthAssignment::model()->deleteAll('userid=:userid', array(':userid'=>$owner->getPrimaryKey()));
	}
}
?>