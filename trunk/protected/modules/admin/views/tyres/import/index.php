<h1>Импорт остатков шин</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'import-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' =>array('enctype'=>'multipart/form-data'),
)); ?>

	<?php if(!empty($results)):	?>
	<ul>
		<li>Всего позиций: <?php echo $results['rowcount']; ?></li>
		<li>Обновленно позиций: <?php echo $results['count'];?></li>
	</ul>
	<?php endif; ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->fileField($model,'file'); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'margin'); ?>
		<?php echo $form->textField($model,'margin'); ?>
		<?php echo $form->error($model,'margin'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Загрузить файл'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->