<div class="form">
<?php $form=$this->beginWidget('CActiveForm'); ?>
	<input type='text' title='Что искать?' class='watermark' />
	<button type="submit" class="search"><img alt="Искать" src="<?php echo $this->assets; ?>/button-search.png"></button>
<?php $this->endWidget(); ?>
</div><!-- form -->
