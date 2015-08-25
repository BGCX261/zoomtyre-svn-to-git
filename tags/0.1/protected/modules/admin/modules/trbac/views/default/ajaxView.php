<b><?php echo CHtml::encode($item->getAttributeLabel('name')); ?>:</b>
<?php echo CHtml::link(CHtml::encode($item->name), array('view', 'name'=>$item->name)); ?>
<br />

<b><?php echo CHtml::encode($item->getAttributeLabel('type')); ?>:</b>
<?php echo L::item('AuthItemType', $item->type); ?>
<br />

<?php if(!empty($item->description)): ?>
<b><?php echo CHtml::encode($item->getAttributeLabel('description')); ?>:</b>
<?php echo CHtml::encode($item->description); ?>
<br />
<?php endif; ?>

<?php if(!empty($item->bizrule)): ?>
<b><?php echo CHtml::encode($item->getAttributeLabel('bizrule')); ?>:</b>
<?php echo CHtml::encode($item->bizrule); ?>
<br />
<?php endif; ?>

<?php echo CHtml::link('Добавить потомка', array('create', 'name'=>$item->name)); ?> <?php echo CHtml::link('Редактировать', array('update', 'name'=>$item->name)); ?> <?php echo CHtml::link('Удалить', array('delete', 'name'=>$item->name), array('onclick' => 'return confirm("Вы уверены что хотите удалить этот раздел со всеми подразделами?");')); ?>
<br />
<?php if(!empty($item->data) && $item->data != 'N;'): ?>
<b><?php echo CHtml::encode($item->getAttributeLabel('data')); ?>:</b>
<?php echo CHtml::encode($item->data); ?>
<br />
<?php endif; ?>

<?php if(!empty($assigned)): ?>
	<br />
	<b>Пользователи:</b>
	<?php foreach($assigned as $i=>$user):?>
		<?php echo CHtml::link($user->userid, array('/admin/users/view', 'id'=>$user->userid)).($i+1 < count($assigned)?',':''); ?>
	<?php endforeach; ?>
<?php endif; ?>
<br />
<?php echo CHtml::link('Управление пользователями', array('manage', 'name'=>$item->name)); ?>