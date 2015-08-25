<div id='<?php echo $options['container']; ?>' class='ajaxUploader <?php echo @$options['class']; ?>'>
<?php
/* 
echo CHtml::beginForm($options['url'], 'post', array(
	'id'=>$options['form'],
	'enctype'=>'multipart/form-data',
));
*/
echo CHtml::fileField('file','', array('id'=>$options['field']));
echo CHtml::submitButton(isset($options['label'])?$options['label']:'Загрузить');
echo CHtml::image($this->assets.'/loader.gif', '', array( 'id'=>$options['loader'], 'style'=>'display: none;' ));
echo CHtml::openTag('span', array('id'=>$options['result'], 'style'=>'display:none')).CHtml::closeTag('span');
/* echo CHtml::endForm(); */
?>
</div>