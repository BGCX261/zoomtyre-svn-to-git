<?php 
$this->menu=array(
	array('label'=>'Обзор элементов авторизации', 'url'=>array('index')),
	array('label'=>'Редактировать элемент авторизации', 'url'=>array('update', 'name'=>$item->name)),
	array('label'=>'Удалить элемент авторизации', 'url'=>array('delete', 'name'=>$item->name)),
	array('label'=>'Управление пользователями', 'url'=>array('manage', 'name'=>$item->name)),
);
?>

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