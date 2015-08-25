<?php

class DefaultController extends AController
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionAjaxCatalog(){
	    $type = 'brand';
	    $id = $this->getModel($model, $type);
		$data = Brand::model()->findAll(array('order'=>'title'));

		$tmp = array();
		foreach($data as $e){
			$c = count($tmp);
			$tmp[$c] = array('id'=>$e->id, 'title'=>$e->title);
			if($e->id == $id)
				$tmp[$c]['selected'] = true;
		}
		
		echo $data = CJavaScript::jsonEncode(array('type'=>$type, 'data'=>$tmp));
	
		Yii::app()->end();
	}
	
	public function actionAjaxBrand(){
		$type = 'model';
		$id = $this->getModel($model, $type);
		$data = Car::model()->findAll('brand_id=:brand_id', array(':brand_id'=>(int) $_POST['brand_id']));
		
		$tmp = array();
		foreach($data as $e){
			$c = count($tmp);
			$tmp[$c] = array('id'=>$e->id, 'title'=>$e->title.' '.date('Y', strtotime($e->manufacture_start)).($e->manufacture_end?'-'.date('Y', strtotime($e->manufacture_end)):'...'));
			if($e->id == $id)
				$tmp[$c]['selected'] = true;
		}
		
		echo $data = CJavaScript::jsonEncode(array('type'=>$type, 'data'=>$tmp));

		Yii::app()->end();
	}
	
	public function actionAjaxModel(){
		$type = 'modification';
		$id = $this->getModel($model, $type);
		$data = Modification::model()->findAll('model_id=:model_id', array(':model_id'=>(int) $_POST['model_id']));
		
		$tmp = array();
		foreach($data as $e){
			$c = count($tmp);
			$tmp[$c] = array('id'=>$e->id, 'title'=>$e->title.' '.date('Y', strtotime($e->manufacture_start)).($e->manufacture_end?'-'.date('Y', strtotime($e->manufacture_end)):'...'));
			if($e->id == $id)
				$tmp[$c]['selected'] = true;
		}
		
		echo $data = CJavaScript::jsonEncode(array('type'=>$type, 'data'=>$tmp));

		Yii::app()->end();
	}
	
	private function getModel(&$model, $type){
		$r = Yii::app()->request;
		$brand = $r->getQuery('Brand');
		$model = $r->getQuery('Car');
		$modification = $r->getQuery('Modification');
		
		if($brand && $brand > 0) {
			$model = Brand::model()->findbyPk($brand);
			switch($type){
				case 'brand':
					return $model->id;
				break;
			}
		}

		if($model && $model > 0) {
			$model = Car::model()->findbyPk($model);
			switch($type){
				case 'brand':
					return $model->brand_id;
				break;
				case 'model':
					return $model->id;
				break;
			}
		}
			
		if($modification && $modification > 0) {
			$model = Modification::model()->findbyPk($modification);
			switch($type){
				case 'brand':
					return $model->model->brand_id;
				break;
				case 'model':
					return $model->model_id;
				break;
				case 'modification':
					return $model->id;
				break;
			}
		}
		
		return null;
	}
	
	/*****************************************/
	
	
	public function actionAjaxCat(){
		if (!Yii::app()->request->isAjaxRequest) {
			$this->redirect('index');
		}
		
        if(isset($_GET['root']) && $_GET['root'] == 'source')
        	echo $this->getBrands();
		elseif(isset($_GET['root']))
			echo $this->getChilds($_GET['root']);
	}
	
	private function getBrands(){
        $data = Brand::model()->with('models')->findAll();

        $tmp = array();
        foreach($data as $model){
			$c = count($tmp);
			$tmp[$c] = $this->makeText($model);
			if(count($model->models) > 0)
				$tmp[$c]['hasChildren'] = true;
		}
		
		return CJavaScript::jsonEncode(array(array(
				'text'=>'Автокаталог',
				'expanded'=>true,
				'classes'=>'root',
				'children'=>$tmp,
			)));
	}
	
	private function getChilds($node){
		list($id, $type) = preg_split('/:/', $node, 2);

		switch($type){
		case 'brand':
			$brand = Brand::model()->findByPK($id);
			$tmp = array();
			if(count($brand->models) > 0) {
				foreach($brand->models as $model){
					$c = count($tmp);
					$tmp[$c] = $this->makeText($model);
					if(count($model->modifications)>0)
						$tmp[$c]['hasChildren'] = true;
				}
			}
			
			return CJavaScript::jsonEncode($tmp);
		break;
		case 'car':
			$car = Car::model()->findByPK($id);
			$tmp = array();
			foreach($car->modifications as $model){
				$c = count($tmp);
				$tmp[$c] = $this->makeText($model);
			}
			
			return CJavaScript::jsonEncode($tmp);
		break;
		default:
			
			return CJavaScript::jsonEncode(array());
		break;
		}
	}
	
	private function makeText($model){
		return array(
			'text' => '<a href="#" class="href-like-text catalog-selector '.strtolower(get_class($model)).'" rel="'.$model->id.':'.strtolower(get_class($model)).'">'.$model->title.'</a>',
			'id' => $model->id.':'.strtolower(get_class($model)),
		);
	}
	

	public function actionImport(){
		$this->render('import');
		
		#$this->getCatalog();
		#$this->getOldCatalog();
		#$this->cleanTemp();
		$this->parseTempTechsTable();

	}
	
	protected function parseTempTechsTable(){
		$criteria = new CDbCriteria;
		$criteria->limit = 1000;
		$criteria->offset = 7000;
		#$criteria->condition = 'id=429';
		#$criteria->order = 'id desc';
		$models = Tmp::model()->findAll($criteria);

		foreach($models as $k=>$model){
			preg_match_all('|<TR BGCOLOR=#ECECEC><TD><P class=table1>(.*)</TD>(?:.*)<TD Bgcolor=#F5F5F5><P class=table>(.*)</TD>|isU', $model->techs_table, $out, PREG_PATTERN_ORDER);
			$tmp = array();
			foreach($out[2] as $i=>$val)
				if(!isset($tmp[$out[1][$i]]))
					$tmp[$out[1][$i]] = trim(strip_tags($out[2][$i], '<br>'));
				else
					$tmp['_'.$out[1][$i]] = trim(strip_tags($out[2][$i], '<br>'));
					
				#d($tmp, true);
				
				$char = new Characteristic; 
				$models[$k]->mod = $tmp['Модель'];
				/********/
				@list($models[$k]->modificationManufactureStart, $models[$k]->modificationManufactureEnd) = explode('-',$tmp['Год выпуска']);
				$models[$k]->modificationManufactureStart = intval($models[$k]->modificationManufactureStart)?intval($models[$k]->modificationManufactureStart):null;
				$models[$k]->modificationManufactureEnd = intval($models[$k]->modificationManufactureEnd)?intval($models[$k]->modificationManufactureEnd):null;
				/********/
				$char->body = L::ritem('bodyType', trim($tmp['Кузов']));
				if(($tmp['Кузов'] == 'Купе-кабриолет' || $tmp['Кузов'] == 'Купе-Родстер' || $tmp['Кузов']=='Купе-Кабриолет') && !L::ritem('bodyType', trim($tmp['Кузов'])))
					$char->body = 20;
				if(($tmp['Кузов'] == 'Хэтчбэк' || $tmp['Кузов'] == 'Хэчтбек' || $tmp['Кузов'] == 'Седан<BR>Хэтчбек') && !L::ritem('bodyType', trim($tmp['Кузов'])))
					$char->body = 3;
				if(($tmp['Кузов'] == 'Landaulet') && !L::ritem('bodyType', trim($tmp['Кузов'])))
					$char->body = 21;
				if(($tmp['Кузов'] == 'Компактвен') && !L::ritem('bodyType', trim($tmp['Кузов'])))
					$char->body = 12;
				if(($tmp['Кузов'] == 'Джип') && !L::ritem('bodyType', trim($tmp['Кузов'])))
					$char->body = 6;
				@list($char->doors, $char->seats) = explode('/', $tmp['Количество дверей/мест']);
				@$char->weight = intval($tmp['Снаряженная масса, кг'])?intval($tmp['Снаряженная масса, кг']):null;
				@$char->weight_loaded = intval($tmp['Полная масса, кг'])?intval($tmp['Полная масса, кг']):null;
				@$char->trunk_capacity = $tmp['Объем багажника min/max, л'];
				@$char->length = intval($tmp['Длина'])?intval($tmp['Длина']):null;
				@$char->width = intval($tmp['Ширина'])?intval($tmp['Ширина']):null;
				@$char->height = intval($tmp['Высота'])?intval($tmp['Высота']):null;
				@$char->wheelbase = intval($tmp['Колесная база'])?intval($tmp['Колесная база']):null;
				#$char-> ??? = $tmp['Колея передняя/задняя'];
				$char->clearance = @$tmp['Дорожный просвет'];
				$char->turn_radius = @intval(str_replace(',','.',$tmp['Минимальный радиус поворота, м']));
				$char->displacement = @$tmp['Расположение'];
				
				if(isset($tmp['Число и расположение цилиндров']) && strstr($tmp['Число и расположение цилиндров'], 'V') )
					$char->engine_type = 'V-образный, '.mb_strtolower($tmp['Тип'], 'UTF-8');
				elseif(isset($tmp['Число и расположение цилиндров']) && strstr($tmp['Число и расположение цилиндров'], 'оппозитно') )
					$char->engine_type = 'Оппозитный, '.mb_strtolower($tmp['Тип'], 'UTF-8');
				elseif(isset($tmp['Число и расположение цилиндров']) && strstr($tmp['Число и расположение цилиндров'], 'в ряд') )
					$char->engine_type = 'Рядный, '.mb_strtolower($tmp['Тип'], 'UTF-8');
				
				$char->cylinders = intval(preg_replace('|[^0-9]|i','',$tmp['Число и расположение цилиндров']));
				$char->volume = $tmp['Рабочий объем, куб.см'];
				$char->valves = intval($tmp['Число клапанов'])?intval($tmp['Число клапанов']):null;
				
				if(isset($tmp['Мощность, л.с./ об/мин']) && strstr($tmp['Мощность, л.с./ об/мин'], '/') ){
					$t = explode('/', $tmp['Мощность, л.с./ об/мин']);
					$char->max_power = round(str_replace(',','.',$t[0]));
					$char->max_power_rpm = $t[1];
				}
				
				if(isset($tmp['Максимальный крутящий момент, Нхм / об/мин']) && strstr($tmp['Максимальный крутящий момент, Нхм / об/мин'], '/') ){
					$t = explode('/', $tmp['Максимальный крутящий момент, Нхм / об/мин']);
					$char->max_torque = $t[0];
					$char->max_torque_rpm = $t[1];
				}
				
				if(isset($tmp['_Тип']) && ($t = preg_split('/(\(|<br>)/iU', $tmp['_Тип'])) ) {
					if(count($t)>0)
						foreach($t as $t0){
							if(empty($t0))
								continue;
								
							$t0 = trim(preg_replace('|[\(\)]|is','',$t0));
							if(strstr($t0, 'Механи')) {
								$char->transmission_mt = $t0;
								$char->gears_mt = intval(preg_replace('|[^\d]|is','',$t0));
							} else {
								$char->transmission_at = $t0;
								$char->gears_at = intval(preg_replace('|[^\d]|is','',$t0));
							}
						}
				}
				
				if(isset($tmp['Максимальная скорость, км/ч']) && $t = preg_split('/(\(|<br>|\/)/iU', $tmp['Максимальная скорость, км/ч']) ) {
					$t = CArray::trimEmpty($t);
					if(isset($t[0])) {
						$t[0] = trim(preg_replace('|[\(\)]|is','',$t[0]));
						$char->top_speed_mt = intval($t[0])?intval($t[0]):null;
					}
					if(isset($t[1])) {
						$t[1] = trim(preg_replace('|[\(\)]|is','',$t[1]));
						$char->top_speed_at = intval($t[1])?intval($t[1]):null;
					}elseif(isset($char->transmission_at))
						$char->top_speed_at = $char->top_speed_mt;
				}
				
				if(isset($tmp['Время разгона с места до 100 км/ч, с']) && $t = preg_split('/(\(|<br>|\/)/iU', $tmp['Время разгона с места до 100 км/ч, с']) ) {
					$t = CArray::trimEmpty($t);
					if(isset($t[0])) {
						$t[0] = trim(preg_replace('|[\(\)]|is','',$t[0]));
						$char->acceleration_mt = ((float)$t[0])?(float)$t[0]:null;
					}
					if(isset($t[1])) {
						$t[1] = trim(preg_replace('|[\(\)]|is','',$t[1]));
						$char->acceleration_at = ((float)$t[1])?(float)$t[1]:null;
					}elseif(isset($char->transmission_at))
						$char->acceleration_at = $char->acceleration_mt;
				}
				
				if(isset($tmp['Городской цикл']) && $t = preg_split('/(\(|<br>|\/)/iU', $tmp['Городской цикл']) ) {
					$t = CArray::trimEmpty($t);
					if(isset($t[0])) {
						$t[0] = trim(preg_replace('|[\(\)]|is','',$t[0]));
						$t[0] = str_replace(',','.',$t[0]);
						$char->fuel_consumption_urban_mt = ((float)$t[0]>0)?(float)$t[0]:null;
					}
					if(isset($t[1])) {
						$t[1] = trim(preg_replace('|[\(\)]|is','',$t[1]));
						$t[1] = str_replace(',','.',$t[1]);
						$char->fuel_consumption_urban_at = ((float)$t[1]>0)?(float)$t[1]:null;
					}elseif(isset($char->transmission_at))
						$char->fuel_consumption_urban_at = $char->fuel_consumption_urban_mt;
				}
				
				if(isset($tmp['Загородный цикл']) && $t = preg_split('/(\(|<br>|\/)/iU', $tmp['Загородный цикл']) ) {
					$t = CArray::trimEmpty($t);
					if(isset($t[0])) {
						$t[0] = trim(preg_replace('|[\(\)]|is','',$t[0]));
						$t[0] = str_replace(',','.',$t[0]);
						$char->fuel_consumption_country_mt = ((float)$t[0]>0)?(float)$t[0]:null;
					}
					if(isset($t[1])) {
						$t[1] = trim(preg_replace('|[\(\)]|is','',$t[1]));
						$t[1] = str_replace(',','.',$t[1]);
						$char->fuel_consumption_country_at = ((float)$t[1]>0)?(float)$t[1]:null;
					}elseif(isset($char->transmission_at))
						$char->fuel_consumption_country_at = $char->fuel_consumption_country_mt;
				}
				
				if(isset($tmp['Смешанный цикл']) && $t = preg_split('/(\(|<br>|\/)/iU', $tmp['Смешанный цикл']) ) {
					$t = CArray::trimEmpty($t);
					if(isset($t[0])) {
						$t[0] = trim(preg_replace('|[\(\)]|is','',$t[0]));
						$t[0] = str_replace(',','.',$t[0]);
						$char->fuel_consumption_combined_mt = ((float)$t[0]>0)?(float)$t[0]:null;
					}
					if(isset($t[1])) {
						$t[1] = trim(preg_replace('|[\(\)]|is','',$t[1]));
						$t[1] = str_replace(',','.',$t[1]);
						$char->fuel_consumption_combined_at = ((float)$t[1]>0)?(float)$t[1]:null;
					}elseif(isset($char->transmission_at))
						$char->fuel_consumption_combined_at = $char->fuel_consumption_combined_mt;
				}
				
				if( isset($tmp['Размер шин']) && $t = preg_split('/(<br>)/iU', $tmp['Размер шин']) ) {
					$t = CArray::trimEmpty($t);
					if(isset($t[0])) {
						$t[0] = trim(str_ireplace(array("\n", '(', ')', 'Спереди', 'Сзади'),'',$t[0]));
						$char->tyres_front = $t[0]?$t[0]:null;
					}
					if(isset($t[1])) {
						$t[1] = trim(str_ireplace(array("\n", '(', ')', 'Спереди', 'Сзади'),'',$t[1]));
						$char->tyres_rear = $t[1]?$t[1]:null;
					}else
						$char->tyres_rear = $char->tyres_front;
				}
				
				if( isset($tmp['Размер дисков']) &&  $t = preg_split('/(<br>)/iU', $tmp['Размер дисков']) ) {
					$t = CArray::trimEmpty($t);
					if(isset($t[0])) {
						$t[0] = trim(str_ireplace(array("\n", '(', ')', 'Спереди', 'Сзади'),'',$t[0]));
						$char->disks_front = $t[0]?$t[0]:null;
					}
					if(isset($t[1])) {
						$t[1] = trim(str_ireplace(array("\n", '(', ')', 'Спереди', 'Сзади'),'',$t[1]));
						$char->disks_rear = $t[1]?$t[1]:null;
					}else
						$char->disks_rear = $char->disks_front;
				}
				
				@$char->drive = $tmp['Привод'];
				@$char->suspension_front = $tmp['Передних колес'];
				@$char->suspension_rear = $tmp['Задних колес'];
				@$char->brakes_front = $tmp['Передние'];
				@$char->brakes_rear = $tmp['Задние'];
				@$char->fuel_type = $tmp['Топливо'];
				@$char->fuel_capacity = intval($tmp['Емкость топливного бака, л'])?intval($tmp['Емкость топливного бака, л']):null;
				
				$models[$k]->char = $char;
				$this->saveChar($models[$k]);
		}
	}
	
	protected function saveChar($model){
		if(!$brand = Brand::model()->find('alias=:alias', array(':alias'=>$model->brand_alias)))
			$brand = new Brand;

		$brand->title = $model->brand;
		$brand->alias = $model->brand_alias;
		$brand->save();
		if(!empty($brand->errors)) {
			d('brand '.$brand->title);
			d($brand->errors);
		}
		
		if(!$car = Car::model()->find('alias=:alias', array(':alias'=>$model->model_alias)))
			$car = new Car;

		$car->brand_id = $brand->id;
		$car->title = $model->model;
		$car->alias = $model->model_alias;
		$car->manufacture_start = $model->modificationManufactureStart.'0101';
		$car->manufacture_end = $model->modificationManufactureEnd?$model->modificationManufactureEnd.'0101':null;
		$car->save();
		if(!empty($car->errors)) {
			d('model '.$car->title);
			d($car->errors);
		}
		
		if(!$mod = Modification::model()->find('alias=:alias', array(':alias'=>$model->mod_alias)))
			$mod = new Modification;

		$mod->model_id = $car->id;
		$mod->title = $model->mod;
		$mod->alias = $model->mod_alias;
		$mod->manufacture_start = $model->modificationManufactureStart.'0101';
		$mod->manufacture_end = $model->modificationManufactureEnd?$model->modificationManufactureEnd.'0101':null;
		$mod->save();
		if(!empty($mod->errors)) {
			d('mod '.$mod->title);
			d($mod->errors);
		}
		
		if(!$char = Characteristic::model()->find('modification_id=:mod_id', array(':mod_id'=>$mod->id)))
			$char = new Characteristic;
			
		$char->attributes = $model->char->attributes;
		$char->modification_id = $mod->id;
		$char->save();
		if(!empty($char->errors)) {
			d('char '.$mod->title);
			d($char->errors);
			d($model->url);
		}
	}
	
	protected function cleanTemp(){
		/* Чистка таблицы с временным каталогом */
		$models = Tmp::model()->findAll();
		foreach($models as $model){
			
			$model->model = trim(strip_tags($model->model));
			
			if($model->mod === 'Технические характеристики')
				$model->mod = $model->model;
			
			echo $model->save()?")":"!";
			
		}
	}
	

	protected function getOldCatalog(){
		/* Украсть католог с http://www.carexpert.ru/
		/* С концептами, но без ранее выпускавшихся моделей */
		$brands = Brand::model()->findAll();
		foreach($brands as $brand){
			
			$brand_title = $brand->title;
			$brand_alias = $brand->alias;
			
			
			$ch = curl_init();
			
			// set URL and other appropriate options
			curl_setopt($ch, CURLOPT_URL, 'http://www.carexpert.ru/'.$brand->alias.'.htm');
			#d('http://www.carexpert.ru/'.$brand->alias.'.htm');
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			
			// grab URL and pass it to the browser
			$html = curl_exec($ch);
			// close cURL resource, and free up system resources
			curl_close($ch);

			$html = iconv('windows-1251', 'UTF-8', $html);
			
			#<A HREF=/models/vaz04.htm title="ВАЗ 2104 (1984-1992)">ВАЗ 2104:</A>
			
			preg_match_all('|(/models/(.*)\.htm) title="(.*)">(?:.*)</a|Ui', $html, $out);
			
			$tmp = array();
			foreach($out[3] as $k=>$t)
				$tmp[$t] = $k;

			$tmp2 = array();
			foreach($tmp as $k=>$t) {
				$tmp2[1][] = $out[1][$t];
				$tmp2[2][] = $out[2][$t];
				list($tmp2[3][], $tmp2[4][]) = explode('(', $out[3][$t]);
			}
			$out = $tmp2;
			if(empty($out))
				continue;
			
    		foreach($out[1] as $i=>$m){
				
				$model_title = $out[3][$i];
				$model_alias = $out[2][$i];
				$model_manufacture = trim(str_replace(')','',$out[4][$i]));
				

				$ch = curl_init();
			
				// set URL and other appropriate options
				curl_setopt($ch, CURLOPT_URL, 'http://www.carexpert.ru'.$m);
				#d('http://www.carexpert.ru'.$m);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

				// grab URL and pass it to the browser
				$html = curl_exec($ch);
				// close cURL resource, and free up system resources
				curl_close($ch);
				
				$html = iconv('windows-1251', 'UTF-8', $html);
				preg_match_all('|(/models/tech/(.*)\.htm)(:?[^"]*)>(.*)</a|Ui', $html, $out1, PREG_PATTERN_ORDER);
				
				#d($brand_title.' '.$brand_alias);
				#d($model_title.' '.$model_alias);
				
				foreach($out1[1] as $i1=>$t){
					
					$mod_title = $out1[4][$i1];
					$mod_alias = $out1[2][$i1];
					

					$ch = curl_init();
				
					// set URL and other appropriate options
					curl_setopt($ch, CURLOPT_URL, 'http://www.carexpert.ru'.$t);
					d('http://www.carexpert.ru'.$t);

					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	
					// grab URL and pass it to the browser
					$html = curl_exec($ch);
					
					// close cURL resource, and free up system resources
					curl_close($ch);
					
					$html = iconv('windows-1251', 'UTF-8', $html);

					preg_match_all("|Общие данные(.*)</table>|siU", $html, $out3, PREG_PATTERN_ORDER);
					
					$tmp = new Tmp;

					$tmp->brand = trim($brand_title);
					$tmp->brand_alias = trim($brand_alias);
					$tmp->model = trim($model_title);
					$tmp->model_alias = trim($model_alias);
					$tmp->mod = trim($mod_title);
					$tmp->mod_alias = trim($mod_alias);
					$tmp->date = trim($model_manufacture);
					$tmp->techs_table = '<table><tr><td>'.$out3[0][0];
					$tmp->url = 'http://www.carexpert.ru'.$t;
					
					if(!Tmp::model()->exists('url=:url', array(':url'=>$tmp->url)))
						$tmp->save();
				} 
    		}
		}
	}
	
	protected function getCatalog(){
		/* Украсть католог с http://www.carexpert.ru/
		/* С концептами, но без ранее выпускавшихся моделей */
		$brands = Brand::model()->findAll();
		foreach($brands as $brand){
			
			$brand_title = $brand->title;
			$brand_alias = $brand->alias;
			
			
			$ch = curl_init();
			
			// set URL and other appropriate options
			curl_setopt($ch, CURLOPT_URL, 'http://www.carexpert.ru/'.$brand->alias.'.htm');
			#d('http://www.carexpert.ru/'.$brand->alias.'.htm');
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			
			// grab URL and pass it to the browser
			$html = curl_exec($ch);
			// close cURL resource, and free up system resources
			curl_close($ch);

			$html = iconv('windows-1251', 'UTF-8', $html);
			
			preg_match_all('|(/models/(.*)\.htm)(:?[^"]*)>(.*)</a|Ui', $html, $out, PREG_PATTERN_ORDER);
    
    		foreach($out[1] as $i=>$m){
				
				$model_title = $out[4][$i];
				$model_alias = $out[2][$i];
				

				$ch = curl_init();
			
				// set URL and other appropriate options
				curl_setopt($ch, CURLOPT_URL, 'http://www.carexpert.ru'.$m);
				#d('http://www.carexpert.ru'.$m);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

				// grab URL and pass it to the browser
				$html = curl_exec($ch);
				// close cURL resource, and free up system resources
				curl_close($ch);
				
				$html = iconv('windows-1251', 'UTF-8', $html);
				preg_match_all('|(/models/tech/(.*)\.htm)(:?[^"]*)>(.*)</a|Ui', $html, $out1, PREG_PATTERN_ORDER);
				
				#d($brand_title.' '.$brand_alias);
				#d($model_title.' '.$model_alias);
				
				#d($out1, true);

				foreach($out1[1] as $i1=>$t){
					
					$mod_title = $out1[4][$i1];
					$mod_alias = $out1[2][$i1];
					

					$ch = curl_init();
				
					// set URL and other appropriate options
					curl_setopt($ch, CURLOPT_URL, 'http://www.carexpert.ru'.$t);
					d('http://www.carexpert.ru'.$t);

					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	
					// grab URL and pass it to the browser
					$html = curl_exec($ch);
					
					// close cURL resource, and free up system resources
					curl_close($ch);
					
					$html = iconv('windows-1251', 'UTF-8', $html);

					preg_match_all("|Общие данные(.*)</table>|siU", $html, $out3, PREG_PATTERN_ORDER);
					
					$tmp = new Tmp;

					$tmp->brand = trim($brand_title);
					$tmp->brand_alias = trim($brand_alias);
					$tmp->model = trim($model_title);
					$tmp->model_alias = trim($model_alias);
					$tmp->mod = trim($mod_title);
					$tmp->mod_alias = trim($mod_alias);
					$tmp->techs_table = '<table><tr><td>'.$out3[0][0];
					$tmp->url = 'http://www.carexpert.ru'.$t;
					
					if(!Tmp::model()->exists('url=:url', array(':url'=>$tmp->url)))
						$tmp->save();
					
					$tmp->save();
				} 
    		}
		}
	}
	
}