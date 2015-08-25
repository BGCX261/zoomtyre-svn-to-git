<?php
$this->pageTitle=Yii::app()->name . ' - Профиль';
$this->breadcrumbs=array(
	'Профиль',
);
?>

<div class='controls'>
	<?php echo CHtml::link('Редактировать профиль', array('users/edit', 'username'=>$model->username));?> | 
	<?php echo CHtml::link('Заказы', array('users/orders', 'username'=>$model->username));?> 
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'email',
		array(
			'name'=>'status',
			'value'=>L::ruitem('UserStatus', $model->status),
		),
		'client.card',
		array(
			'name'=>'client.discount',
			'type'=>'raw',
			'value'=>$model->client?($model->client->discount?$model->client->discount:'0').'&#37;':null,
		),
		array(
			'name'=>'avatar',
			'type'=>'image',
			'value'=>$model->avatar?Image::getFile($model->avatar):null,
		),
		'name',
		'created',
		'activated',
		'birthday',
		array(
			'name'=>'gender',
			'value'=>isset($model->gender)?L::ruitem('gender', $model->gender):null,
		),
		'last_login',
		'client.phone',
		'client.city',
		'client.address',
	),
)); ?>
