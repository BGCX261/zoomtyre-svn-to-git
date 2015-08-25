<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'characteristic-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array( 'enctype'=>'multipart/form-data' ),
)); ?>

	<p class="hint">Поля с <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<!-- Выбор модификации -->
	<?php $this->widget('autocatalog.extensions.catalog.ECatalog', array(
		'model'=>$model,
		'name'=>'modification_id',
		'options'=>array(
			'select'=>'Modification',
		)
	));?>
	<!-- /Выбор модификации -->

	<?php /*
	<div class='row'>
		<?php echo $form->labelEx($model,'csvFile'); ?>
		<?php echo $form->fileField($model,'csvFile'); ?>
		<p class='hint'>Или набивайте в ручную. Первая колонка название параметра, вторая значение. Образец <a href='/files/charcteristics.example.csv'>тут</a>.</p>
		<?php echo $form->error($model,'csvFile'); ?>
	</div>
	*/ ?>

	<h3 class='header3'>Общие данные</h3>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->dropDownList($model,'body',L::items('bodyType')); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'doors'); ?>
		<?php echo $form->textField($model,'doors'); ?>
		<?php echo $form->error($model,'doors'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seats'); ?>
		<?php echo $form->textField($model,'seats'); ?>
		<?php echo $form->error($model,'seats'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'weight_loaded'); ?>
		<?php echo $form->textField($model,'weight_loaded'); ?>
		<?php echo $form->error($model,'weight_loaded'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'top_speed_at'); ?>
		<?php echo $form->textField($model,'top_speed_at'); ?>
		<?php echo $form->error($model,'top_speed_at'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'acceleration_at'); ?>
		<?php echo $form->textField($model,'acceleration_at'); ?>
		<?php echo $form->error($model,'acceleration_at'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'top_speed_mt'); ?>
		<?php echo $form->textField($model,'top_speed_mt'); ?>
		<?php echo $form->error($model,'top_speed_mt'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'acceleration_mt'); ?>
		<?php echo $form->textField($model,'acceleration_mt'); ?>
		<?php echo $form->error($model,'acceleration_mt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'turn_radius'); ?>
		<?php echo $form->textField($model,'turn_radius'); ?>
		<?php echo $form->error($model,'turn_radius'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'trunk_capacity'); ?>
		<?php echo $form->textField($model,'trunk_capacity'); ?>
		<?php echo $form->error($model,'trunk_capacity'); ?>
	</div>
	
	<h3 class='header3'>Размеры</h3>

	<div class="row">
		<?php echo $form->labelEx($model,'length'); ?>
		<?php echo $form->textField($model,'length'); ?>
		<?php echo $form->error($model,'length'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width'); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height'); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'wheelbase'); ?>
		<?php echo $form->textField($model,'wheelbase'); ?>
		<?php echo $form->error($model,'wheelbase'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'clearance'); ?>
		<?php echo $form->textField($model,'clearance'); ?>
		<?php echo $form->error($model,'clearance'); ?>
	</div>

	<h3 class='header3'>Двигатель</h3>

	<div class="row">
		<?php echo $form->labelEx($model,'engine_type'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'engine_type',
			'name'=>get_class($model).'[engine_type]',
			'value'=>$model->engine_type,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'engine_type'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'engine_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'volume'); ?>
		<?php echo $form->textField($model,'volume'); ?>
		<?php echo $form->error($model,'volume'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'displacement'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'displacement',
			'name'=>get_class($model).'[displacement]',
			'value'=>$model->displacement,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'displacement'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'displacement'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cylinders'); ?>
		<?php echo $form->textField($model,'cylinders'); ?>
		<?php echo $form->error($model,'cylinders'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'valves'); ?>
		<?php echo $form->textField($model,'valves'); ?>
		<?php echo $form->error($model,'valves'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_power'); ?>
		<?php echo $form->textField($model,'max_power'); ?>
		<?php echo $form->error($model,'max_power'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_power_rpm'); ?>
		<?php echo $form->textField($model,'max_power_rpm',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'max_power_rpm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_torque'); ?>
		<?php echo $form->textField($model,'max_torque'); ?>
		<?php echo $form->error($model,'max_torque'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'max_torque_rpm'); ?>
		<?php echo $form->textField($model,'max_torque_rpm',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'max_torque_rpm'); ?>
	</div>

	<h3 class='header3'>Трансмиссия</h3>

	<div class="row">
		<?php echo $form->labelEx($model,'transmission_at'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'transmission_at',
			'name'=>get_class($model).'[transmission_at]',
			'value'=>$model->transmission_at,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'transmission_at'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'transmission_at'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'gears_at'); ?>
		<?php echo $form->textField($model,'gears_at'); ?>
		<?php echo $form->error($model,'gears_at'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'transmission_mt'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'transmission_mt',
			'name'=>get_class($model).'[transmission_mt]',
			'value'=>$model->transmission_mt,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'transmission_mt'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'transmission_mt'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'gears_mt'); ?>
		<?php echo $form->textField($model,'gears_mt'); ?>
		<?php echo $form->error($model,'gears_mt'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'drive'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'drive',
			'name'=>get_class($model).'[drive]',
			'value'=>$model->drive,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'drive'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'drive'); ?>
	</div>
	
	<h3 class='header3'>Подвеска</h3>

	<div class="row">
		<?php echo $form->labelEx($model,'suspension_front'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'suspension_front',
			'name'=>get_class($model).'[suspension_front]',
			'value'=>$model->suspension_front,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'suspension_front'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'suspension_front'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'suspension_rear'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'suspension_rear',
			'name'=>get_class($model).'[suspension_rear]',
			'value'=>$model->suspension_rear,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'suspension_rear'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'suspension_rear'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tyres_front'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'tyres_front',
			'name'=>get_class($model).'[tyres_front]',
			'value'=>$model->tyres_front,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'tyres_front'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'tyres_front'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tyres_rear'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'tyres_rear',
			'name'=>get_class($model).'[tyres_rear]',
			'value'=>$model->tyres_rear,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'tyres_rear'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'tyres_rear'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'disks_front'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'disks_front',
			'name'=>get_class($model).'[disks_front]',
			'value'=>$model->disks_front,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'disks_front'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'disks_front'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'disks_rear'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'disks_rear',
			'name'=>get_class($model).'[disks_rear]',
			'value'=>$model->disks_rear,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'disks_rear'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'disks_rear'); ?>
	</div>
	
	<h3 class='header3'>Тормоза</h3>

	<div class="row">
		<?php echo $form->labelEx($model,'brakes_front'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'brakes_front',
			'name'=>get_class($model).'[brakes_front]',
			'value'=>$model->brakes_front,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'brakes_front'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'brakes_front'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'brakes_rear'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'brakes_rear',
			'name'=>get_class($model).'[brakes_rear]',
			'value'=>$model->brakes_rear,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'brakes_rear'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'brakes_rear'); ?>
	</div>

	<h3 class='header3'>Топливо</h3>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fuel_consumption_urban_at'); ?>
		<?php echo $form->textField($model,'fuel_consumption_urban_at'); ?>
		<?php echo $form->error($model,'fuel_consumption_urban_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fuel_consumption_country_at'); ?>
		<?php echo $form->textField($model,'fuel_consumption_country_at'); ?>
		<?php echo $form->error($model,'fuel_consumption_country_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fuel_consumption_combined_at'); ?>
		<?php echo $form->textField($model,'fuel_consumption_combined_at'); ?>
		<?php echo $form->error($model,'fuel_consumption_combined_at'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fuel_consumption_urban_mt'); ?>
		<?php echo $form->textField($model,'fuel_consumption_urban_mt'); ?>
		<?php echo $form->error($model,'fuel_consumption_urban_mt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fuel_consumption_country_mt'); ?>
		<?php echo $form->textField($model,'fuel_consumption_country_mt'); ?>
		<?php echo $form->error($model,'fuel_consumption_country_mt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fuel_consumption_combined_mt'); ?>
		<?php echo $form->textField($model,'fuel_consumption_combined_mt'); ?>
		<?php echo $form->error($model,'fuel_consumption_combined_mt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fuel_type'); ?>
		<?php
			$this->widget('CAutoComplete', array(
			'id'=>'fuel_type',
			'name'=>get_class($model).'[fuel_type]',
			'value'=>$model->fuel_type,
			'url'=>array('/admin/catalog/characteristics/complete'),
			'extraParams'=>array(
				'col'=>'fuel_type'
			), 
			'max'=>10,
			'minChars'=>1, 
			'delay'=>100,
			'matchCase'=>true,
			'htmlOptions'=>array('size'=>60),
			'multiple'=>false,
		));
		?>
		<?php echo $form->error($model,'fuel_type'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fuel_capacity'); ?>
		<?php echo $form->textField($model,'fuel_capacity'); ?>
		<?php echo $form->error($model,'fuel_capacity'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->