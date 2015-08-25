<?php
class CatalogController extends Controller {
	public function actionIndex(){
		$this->render('index');
	}
	
	/**
	 * 
	 * Каталог дисков - список производителей с фильтрами по сезонности и шипованности
	 * @param string $season сезонность
	 */
	public function actionDisks($construct = null, $aliasProducer = null, $aliasModel = null, $aliasSize = null){

		// Если выбрана размер
		if(!empty($aliasSize)) {
			$this->showDisksBySize($aliasSize, $construct);
			Yii::app()->end();
		}
		
		// Если выбрана модель
		if(!empty($aliasModel)) {
			$this->showDisksByModel($aliasModel, $construct);
			Yii::app()->end();
		}
		
		// Если выбран производитель
		if(!empty($aliasProducer)) {
			$this->showDisksByProducer($aliasProducer, $construct);
			Yii::app()->end();
		}
		
		$criteria = new CDbCriteria;
		// Сезонность
		if($construct && L::r_item('diskConstructionType', $construct))
			$criteria->addCondition('disks.construction_type = '.L::r_item('diskConstructionType', $construct));

		$criteria->addCondition('sizes.rest <> "0"');

		$criteria->with = array('disks.sizes');

		$dataProvider=new CActiveDataProvider('DiskProducers', array(
			'pagination' => false,
			'criteria' => $criteria,
		));
		
		$this->render('disks/producers', array('dataProvider'=>$dataProvider, 'construct'=>$construct));
	}
	
	private function showDisksByProducer($alias, $construct = null) {
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'producer.alias = :alias';
		$criteria->params = array(':alias'=>$alias);

		if($construct && L::r_item('diskConstructionType', $construct))
			$criteria->addCondition('t.construction_type = '.L::r_item('diskConstructionType', $construct));

		$criteria->addCondition('sizes.rest <> "0"');
		$criteria->with = array('producer'=>array('together'=>true), 'sizes'=>array('together'=>true));
		$criteria->group = 't.id';
		
		#Yii::app()->end();
		$dataProvider=new CActiveDataProvider('Disk', array(
			'criteria' => $criteria,
		));
		
		#
		$this->render('disks/models', array(
			'dataProvider'=>$dataProvider,
			'construct' => $construct,
		));
	}
	
	private function showDisksByModel($alias, $construct = null) {
		$criteria = new CDbCriteria;
		$criteria->condition = 'disk.alias = :alias';
		$criteria->params = array(':alias'=>$alias);
		
		if(!($model = Disk::model()->find('alias = :alias', array(':alias'=>$alias))))
			throw new CHttpException(400,'Такой страницы нет');
		
		// Сезонность
		if($construct && L::r_item('diskConstructionType', $construct))
			$criteria->addCondition('disk.diskConstructionType = '.L::r_item('diskConstructionType', $construct));
			
		$criteria->addCondition('t.rest <> "0"');
			
		$criteria->with = array('disk');
		
		$dataProvider=new CActiveDataProvider('DiskSizes', array(
			'criteria' => $criteria,
		));
		
		$this->addComment($model);
		
		$this->render('disks/sizes', array(
			'dataProvider'=>$dataProvider,
			'construct' => $construct,
			'model' => $model,
		));
	}
	
	private function showDisksBySize($id, $construct = null) {
		$criteria = new CDbCriteria;
		$criteria->condition = 't.id = :id';
		$criteria->params = array(':id'=>$id);
		
		$model = DiskSizes::model()->find($criteria);
		$this->addComment($model->disk);
		#throw new CHttpException(400,'Такой страницы нет');
		
		$this->render('disks/size', array(
			'model'=>$model,
			'construct' => $construct,
		));
	}
	
	
	/**
	 * 
	 * Каталог шин - список производителей с фильтрами по сезонности и шипованности
	 * @param string $season сезонность
	 * @param string $stud ошипованность
	 */
	public function actionTyres($season = null, $stud = null, $aliasProducer = null, $aliasModel = null, $aliasSize = null){

		// Если выбрана размер
		if(!empty($aliasSize)) {
			$this->showTyresBySize($aliasSize, $season, $stud);
			Yii::app()->end();
		}
		
		// Если выбрана модель
		if(!empty($aliasModel)) {
			$this->showTyresByModel($aliasModel, $season, $stud);
			Yii::app()->end();
		}
		
		// Если выбран производитель
		if(!empty($aliasProducer)) {
			$this->showTyresByProducer($aliasProducer, $season, $stud);
			Yii::app()->end();
		}
		
		$criteria = new CDbCriteria;
		// Сезонность
		if($season && L::r_item('tyreSeason', $season))
			$criteria->addCondition('tyres.season = '.L::r_item('tyreSeason', $season));

		// Шипованность			
		if($stud == 'studded')
			$criteria->addCondition('tyres.stud = 1');
		if($stud == 'not_studded')
			$criteria->addCondition('tyres.stud = 0');
			
		$criteria->addCondition('sizes.rest <> "0"');
			
		$criteria->with = array('tyres.sizes');
		$criteria->order = 't.title';
		
		$dataProvider=new CActiveDataProvider('TyreProducers', array(
			'pagination' => false,
			'criteria' => $criteria,
		));
		
		$this->render('tyres/producers', array('dataProvider'=>$dataProvider, 'season'=>$season, 'stud'=>$stud));
	}
	
	private function showTyresByProducer($alias, $season = null, $stud = null) {
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'producer.alias = :alias';
		$criteria->params = array(':alias'=>$alias);
		// Сезонность
		if($season && L::r_item('tyreSeason', $season))
			$criteria->addCondition('t.season = '.L::r_item('tyreSeason', $season));

		// Шипованность			
		if($stud == 'studded')
			$criteria->addCondition('t.stud = 1');
		if($stud == 'not_studded')
			$criteria->addCondition('t.stud = 0');
			
		$criteria->addCondition('sizes.rest <> "0"');
		$criteria->with = array('producer'=>array('together'=>true), 'sizes'=>array('together'=>true));
		$criteria->group = 't.id';
		#Yii::app()->end();
		$dataProvider=new CActiveDataProvider('Tyre', array(
			'criteria' => $criteria,
		));

		$this->render('tyres/models', array(
			'dataProvider'=>$dataProvider,
			'season' => $season,
			'stud' => $stud,
		));
	}
	
	private function showTyresByModel($alias, $season = null, $stud = null) {
		$criteria = new CDbCriteria;
		$criteria->condition = 'tyre.alias = :alias';
		$criteria->params = array(':alias'=>$alias);
		
		if(!($model = Tyre::model()->find('alias = :alias', array(':alias'=>$alias))))
			throw new CHttpException(400,'Такой страницы нет');
		
		// Сезонность
		if($season && L::r_item('tyreSeason', $season))
			$criteria->addCondition('tyre.season = '.L::r_item('tyreSeason', $season));

		// Шипованность			
		if($stud == 'studded')
			$criteria->addCondition('tyre.stud = 1');
		if($stud == 'not_studded')
			$criteria->addCondition('tyre.stud = 0');
			
		$criteria->addCondition('t.rest <> "0"');
			
		$criteria->with = array('tyre');
		
		$dataProvider=new CActiveDataProvider('TyreSizes', array(
			'criteria' => $criteria,
		));
		
		$this->addComment($model);
		
		$this->render('tyres/sizes', array(
			'dataProvider'=>$dataProvider,
			'season' => $season,
			'stud' => $stud,
			'model' => $model,
		));
	}
	
	private function showTyresBySize($id, $season = null, $stud = null) {
		$criteria = new CDbCriteria;
		$criteria->condition = 't.id = :id';
		$criteria->params = array(':id'=>$id);
		
		$model = TyreSizes::model()->find($criteria);
		$this->addComment($model->tyre);
		#throw new CHttpException(400,'Такой страницы нет');
		
		$this->render('tyres/size', array(
			'model'=>$model,
			'season' => $season,
			'stud' => $stud,
		));
	}
}