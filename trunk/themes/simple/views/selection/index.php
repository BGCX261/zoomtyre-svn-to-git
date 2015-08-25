<div class='span-9'>
	<h2 class="title1"><span><span>Подбор шин</span></span></h2>
	<?php $this->widget('widgets.selection.tyresWidget', array( 'model'=>$tyreSelection, ))?>
</div>
<div class='span-9 last'>
	<h2 class="title2"><span><span>Подбор дисков</span></span></h2>
	<?php $this->widget('widgets.selection.disksWidget', array( 'model'=>$diskSelection, ))?>
</div>

<br class='clear'>