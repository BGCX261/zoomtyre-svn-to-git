<?
class EMarkitUp extends CInputWidget
{
	var $assets = '';
	var $options = array();
	var $model;
	var $name;
	
	public function init()
	{
		$this->assets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.markitup.assets'), false, -1, true);
		
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		$cs->registerScriptFile($this->assets.'/jquery.markitup.pack.js');
		
        $default = array(
        	'skin'=>'default',
        	'set'=>'markdown',
        	'imageUpload'=>false,
        	'imageUploadUrl'=>CHtml::normalizeUrl(array('articles/uploadImage')),
        	'data'=>null,
        	'class'=>'',
        	'title'=>'',
        );

		$this->options = array_merge($default, $this->options);
		
		switch ($this->options['set']) {
			case 'html':
				$cs->registerScriptFile($this->assets.'/jquery.simplemodal-1.4.js');
				$cs->registerCssFile($this->assets.'/main.css');
				$cs->registerCssFile($this->assets.'/skins/simple/style.css');
		
				$cs->registerScriptFile($this->assets.'/sets/html/set.js');
				$cs->registerCssFile( $this->assets.'/sets/html/style.css');
				$cs->registerScript(__CLASS__.'#'.$this->id,"jQuery('#{$this->id}').markItUp(html_set);");
			break;
			default:
				if($this->options['imageUpload']){
					$cs->registerScriptFile($this->assets.'/jquery.simplemodal-1.4.js');
					$cs->registerCssFile($this->assets.'/main.css');
					$cs->registerCssFile($this->assets.'/skins/simple/style.css');
					
					$cs->registerScriptFile($this->assets.'/sets/markdown/set.ru.js', CClientScript::POS_BEGIN);
					$cs->registerCssFile($this->assets.'/sets/markdown/style.css');
					$cs->registerScript(__CLASS__.'#'.$this->id,"jQuery('#{$this->id}').markItUp(markdown_set_ru);");
					$cs->registerScript(__CLASS__.'#'.$this->id.'Finder', '$("#markItUp'.ucfirst($this->id).' .imageUpload").bind("click", function(){
						$("#'.$this->id.'ImageUpload").modal({
							minHeight:300,
							minWidth: 540
						});
						$("#'.$this->id.'ImageUpload .simplemodal-ok").bind("click", function(){
							var alt = $("#'.$this->id.'ImageUpload .alt").val();
							var title = $("#'.$this->id.'ImageUpload .title").val();
							var signature = $("#'.$this->id.'ImageUpload .signature").val();
							var file = $("#'.$this->id.'ImageUpload .file").val();
							
							$.markItUp({ openWith:"\n\n!["+(alt?alt:"Альтернативный текст")+"]("+(file?file:"Ссылка на файл")+" \""+(title?title:"Текст всплывающей подсказки")+"\" \""+(signature?signature:"Подпись под картинкой")+"\")\n\n", closeWith:"" } );
							
							$.modal.close();
						});
						$("#'.$this->id.'ImageUpload .simplemodal-cancel").bind("click", function(){
							$.modal.close();
						});
						
					})');
				} else {
					if($this->options['skin'] == 'simple') {
						$cs->registerCssFile($this->assets.'/skins/simple/style.css');
						$cs->registerScriptFile($this->assets.'/sets/markdown/set.ru.simple.js');
						$cs->registerCssFile( $this->assets.'/sets/markdown/style.simple.css');
						$cs->registerScript(__CLASS__.'#'.$this->id,"jQuery('#{$this->id}').markItUp(markdown_set_ru_simple);");
					} else {
						$cs->registerScriptFile($this->assets.'/jquery.simplemodal-1.4.js');
						$cs->registerCssFile($this->assets.'/main.css');
						$cs->registerCssFile($this->assets.'/skins/simple/style.css');
						
						$cs->registerScriptFile($this->assets.'/sets/markdown/set.ru.wo_images.js');
						$cs->registerCssFile( $this->assets.'/sets/markdown/style.wo_images.css');
						$cs->registerScript(__CLASS__.'#'.$this->id,"jQuery('#{$this->id}').markItUp(markdown_set_ru_wo_images);");
					}
				}
			break;
		}
	}

	public function run() {
		$this->render($this->options['skin'], array('id'=>$this->id, 'model'=>$this->model, 'name'=>$this->name, 'options'=>$this->options));		
	}
}
?>