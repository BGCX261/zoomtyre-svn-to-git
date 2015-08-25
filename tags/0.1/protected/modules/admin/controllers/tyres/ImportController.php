<?php

class ImportController extends AController
{
	## Прайс с номенклатурой
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
				
				Yii::import('ext.markdown.*');
				Yii::import('ext.markdownify.*');
				Yii::import('webroot.helpers.*');
				
				#$tyresForm->file = CUploadedFile::getInstance($tyresForm, 'file');
				
/* Первая страница
 * 1. CAI
 * 2. Производитель
 * 3. Модель
 * 4. Сезон
 * 5. Применяемость
 * 6. Тип протектора
 * 7. Шипованность
 * 8. Ширина профиля(мм)
 * 9. Высота профиля (%)
 * 10. Диаметр (,R)
 * 11. Индекс скорости
 * 12. Индекс нагрузки
 * 13. Цена
 * 14. Фото, большое
 * 15. Фото, мелкое
*/
				
				$uploaded = Yii::app()->file->set('ImportForm[file]');
				Yii::app()->file->set(Yii::getPathOfAlias('webroot.files.'.$this->id.'.'.$this->action->id))->createDir();
				$newfile = $uploaded->copy(strtolower(Yii::getPathOfAlias('webroot.files.'.$this->id.'.'.$this->action->id)).'/'.$uploaded->basename);
			
				$newfile->filename = $newfile->filename.'.'.date('YmdHis'); 

				Yii::import('ext.phpexcelreader.EPhpExcelReader');
				$data=new EPhpExcelReader($newfile->realpath, false);
				$rowcount = $data->rowcount();
				#$colcount = $data->colcount();
				#$rowcount = 3;
				$r = 2;
				while($r <= $rowcount) {
					
					$producer_alias = EString::strtolower(EString::sanitize( $data->val($r, 2) ));

					if( ! $producer = TyreProducers::model()->find('alias=:alias', array(':alias'=>$producer_alias)) ) {
						$producer = new TyreProducers();
						@$result['new_producers']+=1;
					} else
						@$result['old_producers']+=1;

					$producer->title = $data->val($r, 2);
					$producer->alias = $producer_alias;
					if(! $producer->save()) {
						$result['errors']['producer:'.$data->val($r, 1)] = $producer->errors;
					}

					$tyre_alias = EString::strtolower(EString::sanitize( $data->val($r, 3) ));
					if( ! $tyre = Tyre::model()->find('alias=:alias', array(':alias'=>$tyre_alias)) ) {
						$tyre = new Tyre();
						@$result['new_tyres']+=1;
					} else
						@$result['old_tyres']+=1;
						
					$tyre->producer_id = $producer->id;
					$tyre->title = $data->val($r, 3);
					$tyre->alias = $tyre_alias;
					$tyre->new = true;
					$tyre->currency = L::r_item('tyreCurrency', $data->val($r, 5))?L::r_item('tyreCurrency', $data->val($r, 5)):0;
					if($data->val($r,4) == 'зимние')
						$tyre->season = L::r_item('tyreSeason', 'winter');
					if($data->val($r,4) == 'летние')
						$tyre->season = L::r_item('tyreSeason', 'summer');
					if($data->val($r,4) == 'всесезонные')
						$tyre->season = L::r_item('tyreSeason', 'yearround');

					$tyre->stud = $data->val($r, 7)?1:0;
					$tyre->construction_type = 1;
					$tyre->runflat_type = 0;
					

					// загрузка картинок...
					$alias = EString::sanitize($producer_alias.'_'.$tyre_alias);
					$path0 = Yii::getPathOfAlias( 'webroot.files.'.EString::strtolower('Tyre').'.'.'photo' ).DIRECTORY_SEPARATOR;
					$f = false;
					
					$tmp_image = str_replace('.jpg','.png',$data->val($r, 14));
					
					if(!empty($tmp_image) && empty($tyre->photo)) {
					#d($tmp_image);
					#d($tyre->photo);
						foreach(Tyre::model()->images['photo']['sizes'] as $key=>$size){
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
							if(!( $image = Image::model()->find('filename=:alias', array(':alias'=>'/files/tyre/photo/::size::/'.$alias.'.jpg'))))
								$image = new Image();
			
							$image->created = date('Y-m-d H:i:s', strtotime($row['add_date']));
							$image->filename = '/files/tyre/photo/::size::/'.$alias.'.jpg';
							$image->title = $producer->title.' '.$tyre->title;
							$image->alt = $producer->title.' '.$tyre->title;
							$image->save();
							
							$tyre->photo = '/files/tyre/photo/::size::/'.$alias.'.jpg';
						} else
							$tyre->photo = null;
					}

					
					if(! $tyre->save()){
						$result['errors']['tyre:'.$data->val($r, 1)] = $tyre->errors;
					}

					$cai = $data->val($r, 1);
					if( ! $size = TyreSizes::model()->find('code=:code', array(':code'=>$cai)) ) {
						$size = new TyreSizes();
						$size->alias = uniqid();
						$size->save(false);
						@$result['new_size']+=1;
					} else
						@$result['old_size']+=1;

					$size->tyre_id = $tyre->id;
					$size->code = $cai;
					$size->width = $data->val($r, 8);
					$size->height = $data->val($r, 9);
					$size->diameter = $data->val($r, 10);

					$size->speed_rating = preg_replace('/[0-9]/isU', '', $data->val($r, 11));
					$size->load_index = preg_replace('/[a-z]/isU', '', $data->val($r, 12));

					$size->price = 0;
					$size->rest = 0;
					
					#d($size->attributes);
					
					$size->alias = $size->id.'-'.$size->width.'-'.$size->height.'-'.$size->diameter.'-'.$size->speed_rating.$size->load_index;
					
					# Сохраняю...
					if(! $size->save()) {
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
	
	## По мотивам прайса из shop4shop
	public function actionIndex()
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
				
/* вторая страница
 * 1. CAI
 * 2. Профиль(мм)
 * 3. Высота (%)
 * 4. Диаметр (,R)
 * 5. Индекс
 * 6. Модель
 * 7. Производитель
 * 8. Сезон
 * 9. Кол-во (ОПТ)
 * 10. Цена (ОПТ)
 * 11. Кол-во (ИМ)
 * 12. Цена (ИМ) 
*/
				
				

				$uploaded = Yii::app()->file->set('ImportForm[file]');
				Yii::app()->file->set(Yii::getPathOfAlias('webroot.files.'.$this->id.'.'.$this->action->id))->createDir();
				$newfile = $uploaded->copy(strtolower(Yii::getPathOfAlias('webroot.files.'.$this->id.'.'.$this->action->id)).'/'.$uploaded->basename);

				$newfile->filename = $newfile->filename.'.'.date('YmdHis'); 

				Yii::import('ext.phpexcelreader.EPhpExcelReader');
				$data=new EPhpExcelReader($newfile->realpath, false);
				$sheet = 0;
				$rowcount = $data->rowcount($sheet);
				$result['rowcount'] = $rowcount;
				$result['count'] = 0;
				#$colcount = $data->colcount();
				#$rowcount = 5;
				$r = 2;
				while($r <= $rowcount) {
					
					$cai = $data->val($r, 1, $sheet);

					if($size = TyreSizes::model()->find('code=:code', array(':code'=>$cai)) ) {
						
						$size->price = $data->val($r, 12, $sheet);
						if(!empty($tyresForm->margin))
							$size->price += $size->price * ($tyresForm->margin/100);
							
						$rest11 = $data->val($r, 11, $sheet);
						$rest9 = $data->val($r, 9, $sheet);
						if( is_int($rest11) && is_int($rest9)) {
							if($rest11 > $rest9)
								$size->rest = $rest11;
							else
								$size->rest = $rest9;
						} elseif(!is_int($rest11) && is_int($rest9))
							$size->rest = 10;
						elseif(is_int($rest11) && !is_int($rest9))
							$size->rest = 20;
						else
							$size->rest = 20;

						if(! $size->save()) {
							$result['errors']['size:'.$data->val($r, 1, $sheet)] = $size->errors;
						}
						$result['count']++;
					} else
						echo '<p>'.$cai.' '.$data->val($r, 7, $sheet).' '.$data->val($r, 6, $sheet).' not found</p>';

					$r++;
				}
				
				#$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('index',array(
			'model'=>$tyresForm,
			'results'=>$result,
		));
	}
}