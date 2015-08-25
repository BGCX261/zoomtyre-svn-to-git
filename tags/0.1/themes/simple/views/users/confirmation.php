<h1>Подтверждение регистрации</h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>

<div class="flash">
	<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>

<?php endif; ?>

<form method='post'>
	<input type='text' name='hash' />
	<input type='submit' value='send' />
</form>
