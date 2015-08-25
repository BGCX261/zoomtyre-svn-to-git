<?php

class ImportController extends AController
{
	public function actionNomenclature()
	{
		ini_set('memory_limit', '650M');
		set_time_limit(0);
		
		$tyresForm=new ImportForm;
		$result = array();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ImportForm']))
		{
			
			$tyresForm->attributes=$_POST['ImportForm'];

			if($tyresForm->validate()) {
				# Вот тут начинается импорт

				$uploaded = Yii::app()->file->set('ImportForm[file]');
				Yii::app()->file->set(Yii::getPathOfAlias('webroot.files.'.$this->id.'.'.$this->action->id))->createDir();
				$newfile = $uploaded->copy(strtolower(Yii::getPathOfAlias('webroot.files.'.$this->id.'.'.$this->action->id)).'/'.$uploaded->basename);

				$newfile->filename = $newfile->filename.'.'.date('YmdHis'); 

				Yii::import('ext.phpexcelreader.EPhpExcelReader');
				$data=new EPhpExcelReader($newfile->realpath, false);
				$sheet = 1;
				$rowcount = $data->rowcount($sheet);
				
				#$colcount = $data->colcount();
				#$rowcount = 10;
				$r = 2;
				while($r <= $rowcount) {

					$cai = $data->val($r, 1);
					if(empty($cai)) {
						$r++;
						continue;
					}
					
					
					$producer_alias = EString::strtolower(EString::sanitize( $data->val($r, 2)));
					if( ! $producer = DiskProducers::model()->find('alias=:alias', array(':alias'=>$producer_alias)) ) {
						$producer = new DiskProducers();
						@$result['new_producers']+=1;
					} else
						@$result['old_producers']+=1;

					$producer->title = $data->val($r, 2);
					$producer->alias = $producer_alias;
					if(! $producer->save()) {
						$result['errors']['producer:'.$data->val($r, 1)] = $producer->errors;
					}

					$disk_alias = EString::strtolower(EString::sanitize( $data->val($r, 3) ));
					if( ! $disk = Disk::model()->find('alias=:alias', array(':alias'=>$disk_alias)) ) {
						$disk = new Disk();
						@$result['new_disks']+=1;
					} else
						@$result['old_disks']+=1;

					$disk->producer_id = $producer->id;
					$disk->title = $data->val($r, 3);
					$disk->alias = $disk_alias;
					$disk->color = 1;
					$disk->construction_type = L::r_item('diskConstructionType', 'alloy');

					if($data->val($r,5))
						$disk->construction_type = L::r_item('diskConstructionType', 'forged');
					/*
					if($data->val($r, 4) && $data->val($r,5))
						$disk->construction_type = L::r_item('diskConstructionType', 'scratched');
					if(!($data->val($r, 4)) && !($data->val($r,5)) ))
						$disk->construction_type = L::r_item('diskConstructionType', 'stamped');
					*/
						
					// загрузка картинок...
					$alias = EString::sanitize($producer_alias.'_'.$disk_alias);
					$path0 = Yii::getPathOfAlias( 'webroot.files.'.EString::strtolower('Disk').'.'.'photo' ).DIRECTORY_SEPARATOR;
					$f = false;
					
					$tmp_image = str_replace('.jpg','.png',$data->val($r, 12));
					
					if(!empty($tmp_image) && empty($disk->photo)) {
					#d($tmp_image);
					#d($tyre->photo);
						foreach(Disk::model()->images['photo']['sizes'] as $key=>$size){
							$pic = null;
							// папка в которой будет хранится картинка
							$path = $path0.$key.DIRECTORY_SEPARATOR;
							// создаю папку если ее не было
							EFile::set($path)->createDir();
						
							$pic = @file_get_contents('http://www.4tochki.ru'.$tmp_image);
							$info = pathinfo($tmp_image); #$row['pic_file'] - 117*(65-88) (лента слева)
		
							if(empty($pic)) {
								continue;
							}
		
							$fullpath = $path.$alias.'.jpg';
							file_put_contents($fullpath ,$pic);
							
							$pic = Yii::app()->image->load($fullpath);
							$pic->thumb(isset($size[0])?$size[0]:0, isset($size[1])?$size[1]:0, true, '#FFFFFF');
							if($key=='big')
								$pic->watermark( Yii::getPathOfAlias('webroot').Yii::app()->params['watermark'], 5);
								

							$pic->save($fullpath);
							$f = true;
						}
		
						if($f) {
							if(!( $image = Image::model()->find('filename=:alias', array(':alias'=>'/files/disk/photo/::size::/'.$alias.'.jpg'))))
								$image = new Image();
			
							$image->created = date('Y-m-d H:i:s', strtotime($row['add_date']));
							$image->filename = '/files/disk/photo/::size::/'.$alias.'.jpg';
							$image->title = $producer->title.' '.$disk->title;
							$image->alt = $producer->title.' '.$disk->title;
							$image->save();
							
							$disk->photo = '/files/disk/photo/::size::/'.$alias.'.jpg';
						} else
							$disk->photo = null;
					}

					if(! $disk->save()){
						$result['errors']['disk:'.$data->val($r, 1)] = $disk->errors;
					}

					if( ! $size = DiskSizes::model()->find('code=:code', array(':code'=>$cai)) ) {
						$size = new DiskSizes();
						$size->alias = uniqid();
						$size->save(false);
						@$result['new_size']+=1;
					} else
						@$result['old_size']+=1;
						
					$size->disk_id = $disk->id;
					$size->code = $cai;
					
					
				/*
				 * 1. cae	
				 * 2. producer.name
				 * 3. model.name
				 * 4. lit
				 * 5. kov
				 * 6. sh
				 * 7. d	
				 * 8. pcd
				 * 9. pcd2
				 * 10.vil
				 * 11.dia
				 */
					
					$width_fl_point=(preg_replace("/,/",".",$data->val($r, 6)));
					$width_c=floatval(preg_replace("/^[^0-9\.]/","",$width_fl_point));
					$size->width = $width_c;
					
					$size->diameter = $data->val($r, 7);
					
					$ET_fl_point=(preg_replace("/,/",".",$data->val($r, 10)));
					$ET_c=floatval(preg_replace("/^[^0-9\.\-]/","",$ET_fl_point));
					$size->ET = floatval($ET_c);

					list($size->PCD_screws, $PCD_diameter_fl_point) = preg_split('/[^\d,\.]+/i', $data->val($r, 8));

					$PCD_diameter_fl_point=(preg_replace("/,/",".",$PCD_diameter_fl_point));
					$PCD_diameter_c=floatval(preg_replace("/^[^0-9\.]/","",$PCD_diameter_fl_point));
					$size->PCD_diameter = $PCD_diameter_c;
					
					$DIA_fl_point=(preg_replace("/,/",".",$data->val($r, 11)));
					$DIA_c=floatval(preg_replace("/^[^0-9\.]/","",$DIA_fl_point));
					$size->DIA = $DIA_c;
					
					$size->price = 0;
					$size->rest = 0;
					
					$size->alias = $size->id.'-'.$size->width.'-'.$size->diameter.'-'.$size->PCD_screws.'-'.$size->PCD_diameter.'-ET'.$size->ET.'-'.$size->DIA;
					if(! $size->save()) {
						$size->delete();
						$result['errors']['size:'.$data->val($r, 1)] = $size->errors;
					}
					$r++;
				}
				
				#$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('nomenclature',array(
			'model'=>$tyresForm,
			'results'=>$result,
		));
	}
	
	public function actionIndex(){
		
		ini_set('memory_limit', '650M');
		set_time_limit(0);
		
		$form=new ImportForm;
		$result = array();
		
			if(isset($_POST['ImportForm']))
		{
			
			$form->attributes=$_POST['ImportForm'];

			if($form->validate()) {
				# Вот тут начинается импорт
				
/* Первая страница
 * 1. CAI
 * 2. J
 * 3. R
 * 4. /
 * 5. X
 * 6. ET
 * 7. Ø
 * 8. Модель
 * 9. Производитель
 * 10.Кол-во (ОПТ)
 * 11.Цена (ОПТ)
 * 12.Кол-во (ИМ)
 * 13.Цена (ИМ)
*/
				$sheet = 1;				
				

				$uploaded = Yii::app()->file->set('ImportForm[file]');
				Yii::app()->file->set(Yii::getPathOfAlias('webroot.files.'.$this->id.'.'.$this->action->id))->createDir();
				$newfile = $uploaded->copy(strtolower(Yii::getPathOfAlias('webroot.files.'.$this->id.'.'.$this->action->id)).'/'.$uploaded->basename);

				$newfile->filename = $newfile->filename.'.'.date('YmdHis'); 

				Yii::import('ext.phpexcelreader.EPhpExcelReader');
				$data=new EPhpExcelReader($newfile->realpath, false);

				$rowcount = $data->rowcount($sheet);
				$result['rowcount'] = $rowcount;
				$result['count'] = 0;
				#$colcount = $data->colcount();
				#$rowcount = 5;
				$r = 2;
				while($r <= $rowcount) {
					
					$cai = $data->val($r, 1, $sheet);

					if($size = DiskSizes::model()->find('code=:code', array(':code'=>$cai)) ) {
						$size->price = $data->val($r, 13, $sheet);
						if(!empty($form->margin))
							$size->price += $size->price * ($form->margin/100);
							
						$rest10 = $data->val($r, 10, $sheet);
						$rest12 = $data->val($r, 12, $sheet);
						if( is_int($rest12) && is_int($rest10)) {
							if($rest12 > $rest10)
								$size->rest = $rest12;
							else
								$size->rest = $rest10;
						} elseif(!is_int($rest12) && is_int($rest10))
							$size->rest = 10;
						elseif(is_int($rest12) && !is_int($rest10))
							$size->rest = 20;
						else
							$size->rest = 20;

						if(! $size->save()) {
							$result['errors']['size:'.$data->val($r, 1, $sheet)] = $size->errors;
						}
						$result['count']++;
					} else 
						echo '<p>'.$cai.' '.$data->val($r, 9, $sheet).' '.$data->val($r, 8, $sheet).' not found</p>';

					$r++;
				}
				
				#$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('index',array(
			'model'=>$form,
			'results'=>$result,
		));
	}
}