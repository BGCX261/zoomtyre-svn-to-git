<h1>Импорт номенклатуры дисков</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'import-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' =>array('enctype'=>'multipart/form-data'),
)); ?>

	<?php if(!empty($results)):	?>
	<ul>
		<li>Всего позиций: <?php echo $results['old_producers']; ?></li>
		<li>Должно было быть добавленно новых: <?php echo $results['new_size'];?></li>
		<li>Обновленно позиций: <?php echo $results['old_size'];?></li>
		<li>
			Ошибок при добавлении: <b><?php echo $results['old_disks'] - $results['old_size'];?></b>
			<hr />
			<?php 
			if(count($results['errors']) > 0)
			foreach($results['errors'] as $key=>$error): ?>
				<big><?php echo $key; ?></big>
				<?php foreach($error as $field=>$list): ?>
					<?php echo implode(', ', $list); ?><br />
				<?php endforeach; ?>
			<?php endforeach; ?>
		</li>
	</ul>
	<?php endif; ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->fileField($model,'file'); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Загрузить файл'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->