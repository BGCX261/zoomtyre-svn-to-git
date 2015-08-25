<span class='shopping-cart' id='<?php echo $this->id; ?>'>
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'buy-form-'.$this->id,
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('style'=>'display:inline;')
)); ?>
	<?php echo $form->hiddenField($this->form, 'id', array('value'=>$this->model->getId())); ?>
	<?php echo $form->textField($this->form,'quantity',array('size'=>2, 'class'=>'input')); ?>
	<?php echo CHtml::ajaxSubmitButton('купить', '', array('success'=>'js:function(data){ if($("#'.$this->id.' .input").val() > 0) { $("#shoppingCart").html($(data).find("#shoppingCart").html()); sold("#'.$this->id.'"); }}')); ?>
	<?php echo $form->error($this->form,'quantity'); ?>
<?php $this->endWidget(); ?>
</span>