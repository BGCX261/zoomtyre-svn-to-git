<?php

class SelectionController extends Controller
{
	public function actionIndex()
	{
		
		$tyreSelectionForm = Yii::app()->request->getParam('TyreSelectionForm', array());
		$tyreSelection = new TyreSelectionForm();
		if(!empty($tyreSelectionForm)) {
			if(isset($_REQUEST['ajax']) && $_REQUEST['ajax']==='tyreSelectionForm') {
				echo CActiveForm::validate($tyreSelection);
				Yii::app()->end();
			}
			$tyreSelection->attributes = $tyreSelectionForm;

			if($tyreSelection->validate()) {
				$this->redirect(array_merge(array('selection/tyres'), $tyreSelectionForm)); // переход в результат подбора шин
			}
		}

		$diskSelectionForm = Yii::app()->request->getParam('DiskSelectionForm', array());
		$diskSelection = new DiskSelectionForm();
		if(!empty($diskSelectionForm)) {
			if(isset($_REQUEST['ajax']) && $_REQUEST['ajax']==='diskSelectionForm') {
				echo CActiveForm::validate($diskSelection);
				Yii::app()->end();
			}
			
			$diskSelection->attributes = $diskSelectionForm;
			if($diskSelection->validate()) {
				$this->redirect(array_merge(array('selection/disks'), $diskSelectionForm)); // переход в результат подбора шин
			}
		}
		
		$byCarSelectionForm = Yii::app()->request->getParam('ByCarSelectionForm', array());
		$byCarSelection = new ByCarSelectionForm();
		if(!empty($byCarSelectionForm)) {
			if(isset($_REQUEST['ajax']) && $_REQUEST['ajax']==='ByCarSelectionForm') {
				echo CActiveForm::validate($byCarSelection);
				Yii::app()->end();
			}
			
			$byCarSelection->attributes = $byCarSelectionForm;
			if($byCarSelection->validate()) {
				$this->redirect(array_merge(array('selection/by_car'), $byCarSelectionForm));// переход в результат подбора по автомобилю
			}
		}
		
		$this->render('index', array(
			'tyreSelection' => $tyreSelection,
			'diskSelection' => $diskSelection,
			'byCarSelection' => $byCarSelection,
		));
	}
	
	public function actionTyres()
	{
		$sizes = array();
		$form = $_GET;
		$selection = new TyreSelectionForm();
		$pages = null;
		if(!empty($form)) {
			$selection->attributes = $form;

			if($selection->validate()) {
				$criteria= new CDbCriteria;
				$criteria->with = array('tyre');
				
				if(!empty($selection->producers)) {
					
					$crit0 = new CDbCriteria;
					$crit0->with = array('producer');
					$crit0->compare('producer.alias', $selection->producers);
					// Собираю шины производителей подходящих под условия фильтра
					$tyres = CHtml::listData( Tyre::model()->findAll($crit0), 'id', 'id');
					$criteria->compare('tyre_id', $tyres);
				}

				#$criteria->compare('code',$this->code,true);
				$criteria->compare('width',$selection->width,true);
				$criteria->compare('height',$selection->height,true);
				$criteria->compare('diameter',$selection->diameter,true);
				$criteria->compare('tyre.season',$selection->season);
				$criteria->compare('tyre.stud',$selection->puncture);

				$criteria->compare('price', '>='.$selection->price_from, false);
				$criteria->compare('price', '<='.$selection->price_until, false);
				$criteria->compare('price', '<>0');
				
				$criteria->mergeWith( TyreSizes::model()->inSight()->getDbCriteria() );
				
				$data = new CActiveDataProvider( 'TyreSizes', array(
					'criteria' => $criteria,
					'pagination'=>array(
						'pageSize'=>Yii::app()->params['selection.resultsPerPage'],
					)
				));
			}
		}
		
		$this->render('tyres', array(
			'selection' => $selection,
			'data' => $data,
		));
	}
	
	public function actionDisks()
	{
		$sizes = array();
		$form = $_GET;
		$selection = new DiskSelectionForm();
		$pages = null;
		if(!empty($form)) {
			$selection->attributes = $form;

			if($selection->validate()) {
				
				#d($tyreSelection->attributes);
				
				$criteria= new CDbCriteria;
				
				if(!empty($selection->producers)) {
					
					$crit0 = new CDbCriteria;
					$crit0->with = array('producer');
					$crit0->compare('producer.alias', $selection->producers);
					// Собираю шины производителей подходящих под условия фильтра
					$disks = CHtml::listData( Disk::model()->findAll($crit0), 'id', 'id');
					$criteria->compare('disk_id', $disks);
				}

				#$criteria->compare('code',$this->code,true);
				$criteria->compare('width',$selection->width);
				$criteria->compare('diameter',$selection->diameter);
				$criteria->compare('ET',$selection->ET,true);
				
				$pcd_screws = $pcd_diameter = null;
				if($selection->PCD)
					list($pcd_screws, $pcd_diameter) = preg_split('/x/i', $selection->PCD);
				$criteria->compare('PCD_screws',$pcd_screws);
				$criteria->compare('PCD_diameter',$pcd_diameter, true);

				$criteria->compare('price', '>='.$selection->price_from, false);
				$criteria->compare('price', '<='.$selection->price_until, false);
				$criteria->compare('price', '<>0');
				
				$criteria->mergeWith( DiskSizes::model()->inSight()->getDbCriteria() );
				
				$data = new CActiveDataProvider( 'DiskSizes', array(
					'criteria' => $criteria,
					'pagination'=>array(
						'pageSize'=>Yii::app()->params['selection.resultsPerPage'],
					)
				));
			}
		}
		
		
		$this->render('disks', array(
			'selection' => $selection,
			'data' => $data,
		));
	}
}