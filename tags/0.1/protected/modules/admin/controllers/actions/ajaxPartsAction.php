<?
class ajaxPartsAction extends CAction {

	public function run(){
		$tree = $this->getTree();
		# заплатка 
		$tree = $tree[0]['children'];

		echo CJavaScript::jsonEncode($tree);
	}
	
	private function getTree(){
		if($root = Part::model()->find('alias="carclub"')) {
			$tree = $this->convertMenuTree($root->getNestedTree());
		}

		return $tree;
	}
	
	private function convertMenuTree($tree, $tmp = array()){

		foreach($tree as $node){
			$c = count($tmp);
			if(isset($node['node'])) {
				$tmp[$c]['text'] = $this->getText($node['node']);
				#$tmp[$c]['id'] = $node['node']->id;
			}

			if(isset($node['children']))
				$tmp[$c]['children'] = $this->convertMenuTree($node['children']);
		}
		
		return $tmp;
	}
	
	private function getText($node){
		if($node->alias == 'carclub')
			return $node->title;

		$text = CHtml::link(
				$node->title, 
				'#', 
				array('rel'=>$node->id, 'class'=>'href-like-text'.($node->can_be_main?' can-be-main':''), 'title'=>'Выбрать раздел '.$node->title)
			);
		return $text;
	}
}
?>