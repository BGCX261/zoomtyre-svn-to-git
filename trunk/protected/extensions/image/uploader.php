<?php
class uploader extends CWidget {
	var $options = array();
	var $model;
	var $name;
	var $assets;
	

	public function init(){
		
			$default = array(
				// for default skin
				'skin'=>'default',
				'preview'=>null,
				'allowDelete'=>true,
				'deleteField'=>$this->name.'_delete',
				'fileField'=>$this->name.'_file',

				//for ajax
				/*
				'onStart'=>'',
				'onComplete'=>'',
				'onSuccess'=>'',
				'onError'=>'',
				'onDataError'=>'',
				*/
				'url'=>'',
				'secureuri'=>false,
				'loader'=>$this->id.'Loader',
				'field'=>$this->id,
				'result'=>$this->id.'Result',
				'button'=>$this->id.'ButtonUpload',
				'container'=>$this->id.'Container',
				// for ajax2
				'onBeforeSerialize'=>'', #function($form, options)
				'onBeforeSubmit'=>'', #function(arr, $form, options)
				'onSuccess'=>'', #function(data)
				'url'=>'',
				'data'=>null,
				'form'=>$this->id.'Form',
			);
	
			$this->options = array_merge($default, $this->options);
			$options = CJavaScript::encode($this->options);	
		
		switch ($this->options['skin']) {
			case 'ajax':
				$this->assets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.image.assets'), false, -1, true);
				$cs = Yii::app()->clientScript;
				$cs->registerCoreScript('jquery');
				$cs->registerScriptFile($this->assets.'/ajaxfileupload.js');
				$cs->registerScriptFile($this->assets.'/ajaxfunction.js');

				$cs->registerScript(__CLASS__.'#'.$this->id,"$.ajaxFunction($options);");
			break;
			case 'ajax2':
				$this->assets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('ext.image.assets'), false, -1, true);
				$cs = Yii::app()->clientScript;
				$cs->registerCoreScript('jquery');
				$cs->registerScriptFile($this->assets.'/jquery.form.js');

				// заплатка, не могу понять почему исчезает форма обрамляющая поле файла
				$cs->registerScript(__CLASS__.'#'.$this->id.'WrapInner',"$('#{$this->options['container']}').wrapInner('<form id=\'{$this->options['form']}\' enctype=\'multipart/form-data\' method=\'post\' action=\'{$this->options['url']}\'></form>');");
				
				$cs->registerScript(__CLASS__.'#'.$this->id,"$('#{$this->options['form']}').ajaxForm({
					url: '{$this->options['url']}',
					data: ".CJavaScript::encode($this->options['data']).",
					dataType: 'json',
					beforeSubmit: function(arr, form, options){
						$('#".$this->options['loader']."').show();
					},
					success: function(data){
						$('#".$this->options['loader']."').hide();
						$('#".$this->options['field']."').val('');
						if(typeof(data.error) != 'undefined'){
							alert(data.error);
						} else {
							".($this->options['onSuccess']?CJavaScript::encode($this->options['onSuccess']):'').";
						}
					},
					error:function(data){
						alert(data);
					}
				});");
			break;
		}

		return parent::init();
	}
	
	public function run(){
		$this->render($this->options['skin'], array( 
			'options'=>$this->options, 
			'model'=>$this->model, 
			'name'=>$this->name 
		));
	}
}
?>