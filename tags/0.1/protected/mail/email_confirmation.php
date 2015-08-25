<h1>Добро пожаловать на <?php echo Yii::app()->name; ?></h1>
<p>Это письмо подтверждающее Вашу регистрацию на сайте <?php echo CHtml::link(Yii::app()->name, Yii::app()->request->hostInfo);?></p>
<p>Для окончания регистрации Вам необходимо пройти 
по <?php echo CHtml::link('ссылке', Yii::app()->request->hostInfo.CHtml::normalizeUrl(array('users/confirmation', 'hash'=>$hash, 'date'=>$date))); ?>.</p>
<p>Или по адресу <?php echo CHtml::link(
	Yii::app()->request->hostInfo.CHtml::normalizeUrl(array('users/confirmation')), 
	Yii::app()->request->hostInfo.CHtml::normalizeUrl(array('users/confirmation'))
	); ?> ввести свой код активации: <br /><?php echo $hash; ?></p>


<p>Если Вы не регистрировались на сайте <?php echo Yii::app()->name; ?> и это письмо ошибка, 
то просто Вы всё равно можете зайти на наш сайт и найти много интересного для себя =)</p>

<div>e-mail: <?php echo $email;?>, <?php echo date('Y-m-d, H:i:s', strtotime($date)); ?></div>

<p>С Уважением, Веб-сервер и администрация ресурса <?php echo Yii::app()->name; ?>!</p>