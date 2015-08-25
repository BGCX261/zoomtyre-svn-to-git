<div id='<?php echo $this->id; ?>Container' class='ajaxUploader <?php echo @$options['class']; ?>'>
	<form name="form" action="" method="POST" enctype="multipart/form-data">
		<input id="<?php echo $this->id; ?>" type="file" name="file">
		<button id="<?php echo $this->id; ?>ButtonUpload"><?php echo isset($options['label'])?$options['label']:'Загрузить'; ?></button>
		<img id="<?php echo $this->id; ?>Loader" src='<?php echo $this->assets; ?>/loader.gif' style='display:none;' />
		<span id="<?php echo $this->id; ?>Result" style='display:none;'></span>
		<?php if(!empty($options['preid'])): ?>
		<input type='hidden' name='preid' value='<?php echo $options['preid']; ?>' />
		<?php endif; ?>
	</form>
</div>