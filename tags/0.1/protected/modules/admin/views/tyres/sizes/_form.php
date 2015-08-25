<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tyre-sizes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные здёздочкой (<span class="required">*</span>) должны быть обязательно заполненны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php Yii::app()->clientScript->registerScriptFile( $this->assets.'/js/jquery.selectboxes.min.js' ); ?>
		<?php echo $form->labelEx($model,'tyre_id'); ?>
		<div class='input'>
			<div>Производитель<br />
			<?php 
			echo CHtml::dropDownList(null, $model->isNewRecord?null:$model->tyre->producer_id , CHtml::listData(TyreProducers::model()->findAll(), 'id', 'title'), 
					array(
						'id'=>'tyreProducersList',
						'ajax'=>array(
							'url'=>CHtml::normalizeUrl(array('tyres/sizes/ajaxTyres')),
							'dataType'=>'json',
							'data'=>'js:"producer_id="+$(this).val()',
							'success'=>'function(data){ jQuery(\'#'.get_class($model).'_tyre_id\').html("").addOption(data, false); }',
						),
			)); ?>
			</div>
			<div>Шина<br />
			<?php echo $form->dropDownList($model, 'tyre_id', $model->isNewRecord?array():CHtml::listData(Tyre::model()->findAll('producer_id='.$model->tyre->producer_id), 'id', 'title') ); ?>
			</div>
			<?php 
			if($model->isNewRecord)
 				Yii::app()->clientScript->registerScript(get_class($model).'#tyreProducersList', '$("#'.get_class($model).'_tyre_id").ajaxAddOption("'.CHtml::normalizeUrl(array('tyres/sizes/ajaxTyres')).'", {producer_id: $("#tyreProducersList").val()});');
			?>
		</div>
		<?php echo $form->error($model,'tyre_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>45,'maxlength'=>45)); ?>
		<p class='hint'>Уникальный идентификатор</p>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'diameter'); ?>
		<?php echo $form->textField($model,'diameter',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'diameter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'load_index'); ?>
		<?php echo $form->textField($model,'load_index',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'load_index'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'speed_rating'); ?>
		<?php echo $form->textField($model,'speed_rating',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'speed_rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rest'); ?>
		<?php echo $form->textField($model,'rest',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'rest'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->