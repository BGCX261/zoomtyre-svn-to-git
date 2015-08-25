<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля отмеченные здёздочкой (<span class="required">*</span>) должны быть обязательно заполненны.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'alias'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', L::items('partnerType')); ?>
		<p class='hint'>Предоставляемые услуги.</p>
		<?php echo $form->error($model,'type'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'name'=>get_class($model).'[username]',
			'value'=>$model->username,
			'url'=>CHtml::normalizeUrl(array('users/list')), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>200,
			'htmlOptions'=>array('size'=>45, 'maxlength'=>64),
			'mustMatch'=>true,
			'autoFill'=>true,
			'multiple'=>false,
		));
		?>
		<p class='hint'>Логин пользователя, который является главным контактным лицом и администратором партнёрки.</p>
		<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php
		$this->widget('ext.markitup.EMarkitUp', array(
			'model'=>$model,
			'name'=>'description',
		));
		?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'map'); ?>
		<?php
		$this->widget('ext.yandex.EYandexMaps', array(
			'model'=>$model,
			'x_field'=>'map_x',
			'y_field'=>'map_y',
			'key'=>Yii::app()->params['yandex_maps_api_key'],
			'options'=>array(
				'width'=>'600px',
			),
		));
		?>
		<?php echo $form->error($model,'map_x'); ?>
		<?php echo $form->error($model,'map_y'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->