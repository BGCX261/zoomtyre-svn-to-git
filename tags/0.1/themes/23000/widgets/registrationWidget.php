<?
class registrationWidget extends CWidget {
	var $options = array();
	
    public function run() {
    	
    	$default = array(
    		'items' => array(
    		),
    	);
    	
    	$this->options = array_merge($default, $this->options);
    	
		$this->render(__CLASS__, array( 
				'options'=>$this->options
		));
	}
}
?>