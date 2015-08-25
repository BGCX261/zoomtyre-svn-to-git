<?php
Yii::import('zii.widgets.CMenu');

class EMenu extends CMenu {
	
	public function init(){
		$assets = Yii::app()->assetManager->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets', false, -1, true);
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($assets.'/emenu.css');
		
		parent::init();
	}
	
	protected function renderMenu($items) {
		if(count($items)) {
			$default = array(
				'class' => 'emenu',
			);
			$this->htmlOptions = array_merge($default, $this->htmlOptions);

			echo CHtml::openTag('div',$this->htmlOptions)."\n";
			$this->renderMenuRecursive($items);
			echo CHtml::closeTag('div');
		}
	}
	
	protected function renderMenuRecursive($items) {
		echo CHtml::openTag('ul',array('class'=>'first_level'))."\n";
		$count=0;
		$n=count($items);
		foreach($items as $item){
			$options=isset($item['itemOptions']) ? $item['itemOptions'] : array();
			$class=array();
			if($item['active'] && $this->activeCssClass!='')
				$class[]=$this->activeCssClass;
			if($count===1 && $this->firstItemCssClass!='')
				$class[]=$this->firstItemCssClass;
			if($count===$n && $this->lastItemCssClass!='')
				$class[]=$this->lastItemCssClass;
			if($class!==array()) {
				if(empty($options['class']))
					$options['class']=implode(' ',$class);
				else
					$options['class'].=' '.implode(' ',$class);
			}
                        
			echo CHtml::openTag('li', $options);
			
			$menu=$this->renderMenuItem($item);
			
			if(isset($this->itemTemplate) || isset($item['template'])) {
				$template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
				echo strtr($template,array('{menu}'=>$menu));
			} else
				echo $menu;
				
			echo CHtml::closeTag('li')."\n";
		}
		echo CHtml::closeTag('ul');
		echo CHtml::tag('div', array('class'=>'clear'), '');
		
		$route=$this->getController()->getRoute();

		$this->getActiveItemPath($items, $route, $path);

		if(empty($path))
			return;

		echo CHtml::openTag('ul',array('class'=>'second_level'))."\n";
		$last_item = null;
		foreach($path as $item) {
			echo CHtml::openTag('li', $options);
			
			$menu=$this->renderMenuItem($item);
			
			if(isset($this->itemTemplate) || isset($item['template'])) {
				$template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
				echo strtr($template,array('{menu}'=>$menu));
			} else
				echo $menu;

			$last_item = $item;
			echo CHtml::closeTag('li')."\n";
		}
		echo CHtml::closeTag('ul');

		$c = count($path);
		$last_level = array();
		foreach($path as $i=>$item) {
			if(($i+1) == $c) {
				if(isset($item['items']))
					$last_level = $item['items'];
				else
					$last_level = $item['parent']['items'];
			}
		}

		if(empty($last_level)) {
			echo CHtml::tag('div', array('class'=>'clear'), '');
			return;
		}

		echo CHtml::openTag('ul',array('class'=>'third_level'))."\n";
		foreach($last_level as $i=>$item) {
			if($item['label'] != $last_item['label']) {
				echo CHtml::openTag('li', $options);
				$menu = $this->renderMenuItem($item);
				if(isset($this->itemTemplate) || isset($item['template'])) {
					$template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
					echo strtr($template,array('{menu}'=>$menu));
				} else
					echo $menu;
				echo CHtml::closeTag('li')."\n";
			}
		}
		echo CHtml::closeTag('ul');
		echo CHtml::tag('div', array('class'=>'clear'), '');
	}
	
	protected function getActiveItemPath($items, $route, &$path = array(), &$level = 0, &$parent = null){
		
		foreach($items as $i=>$item) {
			$item['parent'] = $parent;
			if($item['active']) {
				$c = count($path);
				$path[] = $item;
				#unset($path[$c]['items']);
			}

			if(isset($item['items'])) {
				$this->getActiveItemPath($item['items'], $route, $path, $level, $item);
			}
		}
	}
}