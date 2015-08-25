<textarea id="<?php echo $id; ?>" name="<?php echo get_class($model).'['.$name.']'; ?>" class='<?php echo @$options['class']; ?>' title='<?php echo @$options['title']; ?>' ><?php echo !empty($options['text'])?$options['text']:$model->$name; ?></textarea>

<?php if($options['imageUpload']): ?>
<div id='<?php echo $this->id;?>ImageUpload' style='display:none;'>
	<h3 class=''>Картинка в текст</h3>
	<div class='row'>
		<label>Файл</label>
		<?php 
			/*
			$this->widget('ext.image.uploader', array(
				'model'=>$model,
				'name'=>$name,
				'options'=>array(
					'skin'=>'ajax',
					'url'=>$options['imageUploadUrl'],
					'onSuccess'=>'js:function(data, options){
						$("#'.$this->id.'ImageUpload .file").val(data);
						$("#'.$this->id.'ImageUpload .simplemodal-ok").removeAttr("disabled");
					}',
				),
			));
			*/
			$this->widget('ext.image.uploader', array(
				'model'=>$model,
				'name'=>$name,
				'options'=>array(
					'skin'=>'ajax2',
					'url'=>$options['imageUploadUrl'],
					'data'=>$options['data'],
					'onSuccess'=>'js:$("#'.$this->id.'ImageUpload .file").val(data);$("#'.$this->id.'ImageUpload .simplemodal-ok").removeAttr("disabled");',
				),
			));
		?>
		<input type='hidden' class='file'/>
	</div>
	<div class='row'>
		<label>Альтернативный текст</label>
		<?php echo CHtml::textField('alt', '', array('class'=>'alt', 'size'=>48)); ?>
	</div>
	<div class='row'>
		<label>Подсказка</label>
		<?php echo CHtml::textField('title', '', array('class'=>'title', 'size'=>48)); ?>
	</div>
	<div class='row'>
		<label>Подпись</label>
		<?php echo CHtml::textArea('signature', '', array('class'=>'signature', 'cols'=>37)); ?>
	</div>
	<div class='row buttons' align="right">
		<?php echo CHtml::button('Отмена', array('class'=>'simplemodal-cancel')); ?>
		<?php echo CHtml::button('Ок', array('class'=>'simplemodal-ok')); ?>
	</div>
</div>
<?php endif; ?>