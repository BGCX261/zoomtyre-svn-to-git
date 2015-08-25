<?php
class menu2 extends CWidget {
	public $assets = '';
	public $skin = 'default';
	public $active = null;
	/**
	 * @var array list of menu items. Each menu item is specified as an array of name-value pairs.
	 * Possible option names include the following:
	 * <ul>
	 * <li>title: string, required, specifies the menu item label. When {@link encodeLabel} is true, the label
	 * will be HTML-encoded.</li>
	 * <li>url: string or array, optional, specifies the URL of the menu item. It is passed to {@link CHtml::normalizeUrl}
	 * to generate a valid URL. If this is not set, the menu item will be rendered as a span text.</li>
	 * <li>visible: boolean, optional, whether this menu item is visible. Defaults to true.
	 * This can be used to control the visibility of menu items based on user permissions.</li>
	 * <li>childs: array, optional, specifies the sub-menu items. Its format is the same as the parent items.</li>
	 * <li>htmlOptions: array, optional, additional HTML attributes to be rendered for the link or span tag of the menu item.</li>
	 * </ul>
	 */
	public $items=array();

	/**
	 * @var string the template used to render an individual menu item. In this template,
	 * the token "{menu}" will be replaced with the corresponding menu link or text.
	 * If this property is not set, each menu will be rendered without any decoration.
	 * This property will be overridden by the 'template' option set in individual menu items via {@items}.
	 * @since 1.1.1
	 */
	#public $itemTemplate;

	/**
	 * @var boolean whether the labels for menu items should be HTML-encoded. Defaults to true.
	 */
	#public $encodeLabel=true;

	/**
	 * @var string the CSS class to be appended to the active menu item. Defaults to 'active'.
	 * If empty, the CSS class of menu items will not be changed.
	 */
	public $activeCssClass='active';

	/**
	 * @var array HTML attributes for the menu's root container tag
	 */
	#public $htmlOptions=array();

	/**
	 * @var string the HTML element name that will be used to wrap the label of all menu links.
	 * For example, if this property is set as 'span', a menu item may be rendered as
	 * &lt;li&gt;&lt;a href="url"&gt;&lt;span&gt;label&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
	 * This is useful when implementing menu items using the sliding window technique.
	 * Defaults to null, meaning no wrapper tag will be generated.
	 * @since 1.1.4
	 */
	#public $linkLabelWrapper;

	public function init(){
		$this->assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
		$cs = Yii::app()->getClientScript();
		
		if(empty($this->active))
			$this->active = Yii::app()->request->requestUri;
		
	}
	
	public function run() {
		
		$top = array();
		$middle = array();
		$bottom = array();

		$this->items = $this->normalize($this->items);

		$path = $this->getPath($this->items);

		if(!empty($path))
			if(count($path) < 1)
				$top = $this->items[0]['childs'];
			elseif(isset($path[0]['childs']))
				$top = $path[0]['childs'];

		$c = count($path);
		$node = array_pop($path);
		$path[] = $node;

		if(!empty($node['childs'])) {
			$bottom = $node['childs'];
		} elseif(isset($path[$c-2]) && !empty($path[$c-2]['childs']) && $path[$c-2]['id'] != $path[0]['id']) {
			$bottom = $path[$c-2]['childs'];
			foreach($bottom as $k=>$item)
				if($item['id'] == $node['id'])
					unset($bottom[$k]);
		}
			
		$middle = array_slice($path, 1);
		
		$this->render($this->skin,array(
			'top'=>$top,
			'middle'=>$middle,
			'bottom'=>$bottom
		));
	}
	
	/**
	 * Нормализует элементы
	 * @param array $items
	 */
	
	protected function normalize($items){
		// перегоняю в массив
		$items = $this->convertToArray($items);
		// делаю активные
		$this->setActive($items);
		#d($items);

		return $items;
	}
	
	/**
	 * Получает путь от корня до выбранного элемента
	 * @param array $items
	 * @param array $result
	 */
	private function getPath($items, &$result = array()){
		foreach($items as $k=>$item) {
			if(isset($item['active']) && $item['active']) {
				#d($item['title']);
				$result[] = $item;
				#unset($result[count($result)-1]['childs']);
			}
			if(!empty($item['childs']))
				$this->getPath($item['childs'], $result);
		}
		return $result;
	}
	
	/**
	 * Ставить метку активности цепочке выбраного элемента
	 */
	private function setActive(&$items){
		$f = false;
		foreach($items as $k=>$item) {
			if(!empty($item['childs']))
				$f = $items[$k]['active'] = $this->setActive($items[$k]['childs']);

			// определение активного узла, это пиздец
			if($f) return $f;
			if($f = $this->isActive( $item['url'], $this->active) ) {
				return $items[$k]['active'] = $f;
			}
		}
	}
	
	/**
	 * Определяет активность узла
	 */
	private function isActive($url = '', $route = ''){
		// определение активного узла, это пиздец
		$flag_strlen = 0;
		$f = false;

		// Отрезаю лишние слеши
		$url = trim($url,'/');
		$route=trim($route,'/');

		// цикл который находит максимально длинную строку
		$i = 0;
		do {
			$pos=strrpos($route, '/');

			if(strcmp($url,$route) != 0) {
				$route = substr($route, 0, $pos);
			} elseif($flag_strlen < strlen($route)) {
				$f = true;
				$flag_strlen = strlen($route);
				$pos = false;
			}

			#echo $route.' '.$url;
			$i++;
			#echo '<br />';
		// максимальная глубина 20
		} while($pos && $i < 20);
		
		return $f;
	}
	/*
	 * Преобразует массив обектов в массив
	 */
	private function convertToArray($items) {
		$result = array();
		foreach($items as $item) {
			$c = count($result);
			$result[$c] = array(
				'id'=>$item->id,
				'title'=>$item->title, 
				'url'=>$item->url, 
				'visible'=>$item->visible,
				'htmlOptions'=>$item->htmlOptions,
				'active'=>false,
			);
			
			if(empty($item->url) && count($item->childs) > 0) {
				/*
				# Перенос ссылки первого потомка
				$tmp = &$item->childs;
				reset($tmp);
				$result[$c]['url'] = $item->childs[key($tmp)]->url;
				*/
				$result[$c]['url'] = Yii::app()->createUrl('admin/stub', array('item'=>$item->alias));
			}
			
			if(!empty($item->childs))
				$result[$c]['childs'] = $this->convertToArray($item->childs);
		}
		
		return $result;
	}
	
}
?>