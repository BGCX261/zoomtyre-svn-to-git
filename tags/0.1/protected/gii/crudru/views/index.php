<?php
$class=get_class($model);
Yii::app()->clientScript->registerScript('gii.crud',"
$('#{$class}_controller').change(function(){
	$(this).data('changed',$(this).val()!='');
});
$('#{$class}_model').bind('keyup change', function(){
	var controller=$('#{$class}_controller');
	if(!controller.data('changed')) {
		var id=new String($(this).val().match(/\\w*$/));
		if(id.length>0)
			id=id.substring(0,1).toLowerCase()+id.substring(1);
		controller.val(id);
	}
});
");
?>
<h1>Crud Generator</h1>

<p>This generator generates a controller and views that implement CRUD operations for the specified data model.</p>

<?php $form=$this->beginWidget('CCodeForm', array('model'=>$model)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'model'); ?>
		<?php echo $form->textField($model,'model',array('size'=>65)); ?>
		<div class="tooltip">
			Model class is case-sensitive. It can be either a class name (e.g. <code>Post</code>)
		    or the path alias of the class file (e.g. <code>application.models.Post</code>).
		    Note that if the former, the class must be auto-loadable.
		</div>
		<?php echo $form->error($model,'model'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>65)); ?>
		<div class="tooltip">
			Имя обьекта на русском языке в единственном числе именительном падеже (Есть - Кто? Что?)
		</div>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'name_many_nominative'); ?>
		<?php echo $form->textField($model,'name_many_nominative',array('size'=>65)); ?>
		<div class="tooltip">
			Имя обьекта на русском языке во множественном числе именительном падеже, с заглавной буквы (Есть - Кто? Что?)
		</div>
		<?php echo $form->error($model,'name_many_nominative'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'name_one_accusative'); ?>
		<?php echo $form->textField($model,'name_one_accusative',array('size'=>65)); ?>
		<div class="tooltip">
			Имя обьекта на русском языке в единственном числе винительном падеже (Удалить, Добавить, Обновить - Кого? Что?)
		</div>
		<?php echo $form->error($model,'name_one_accusative'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_one_preposition'); ?>
		<?php echo $form->textField($model,'name_one_preposition',array('size'=>65)); ?>
		<div class="tooltip">
			Имя обьекта на русском языке в единственном числе предложном падеже (Подробнее о - О ком? О чём?)
		</div>
		<?php echo $form->error($model,'name_one_preposition'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_many_genitive'); ?>
		<?php echo $form->textField($model,'name_many_genitive',array('size'=>65)); ?>
		<div class="tooltip">
			Имя обьекта на русском языке во множественном числе родительном падеже (Обзор - Кого? Чего?)
		</div>
		<?php echo $form->error($model,'name_many_genitive'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'name_many_instrumentative'); ?>
		<?php echo $form->textField($model,'name_many_instrumentative',array('size'=>65)); ?>
		<div class="tooltip">
			Имя обьекта на русском языке во множественном числе творительном падеже (Управление - Кем? Чем?)
		</div>
		<?php echo $form->error($model,'name_many_instrumentative'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'controller'); ?>
		<?php echo $form->textField($model,'controller',array('size'=>65)); ?>
		<div class="tooltip">
			Controller ID is case-sensitive. CRUD controllers are often named after
			the model class name that they are dealing with. Below are some examples:
			<ul>
				<li><code>post</code> generates <code>PostController.php</code></li>
				<li><code>postTag</code> generates <code>PostTagController.php</code></li>
				<li><code>admin/user</code> generates <code>admin/UserController.php</code>.
					If the application has an <code>admin</code> module enabled,
					it will generate <code>UserController</code> (and other CRUD code)
					within the module instead.
				</li>
			</ul>
		</div>
		<?php echo $form->error($model,'controller'); ?>
	</div>

	<div class="row sticky">
		<?php echo $form->labelEx($model,'baseControllerClass'); ?>
		<?php echo $form->textField($model,'baseControllerClass',array('size'=>65)); ?>
		<div class="tooltip">
			This is the class that the new CRUD controller class will extend from.
			Please make sure the class exists and can be autoloaded.
		</div>
		<?php echo $form->error($model,'baseControllerClass'); ?>
	</div>

<?php $this->endWidget(); ?>
