$(function(){
	$('.selection-widget .producers .control').bind('click', cbToggle);

	$('.selection-widget .producers input[type=checkbox]').bind('change', function(){
		$('.selection-widget .producers .control').html('все');
	})
	
	function cbToggle(block){
		var block = $(this).parents('div.producers');
		if($(this).html() != 'выбрать') {
			$(this).html('выбрать');
			$(block).find('input[type=checkbox]').attr('checked', true);
		} else {
			$(this).html('все');
			$(block).find('input[type=checkbox]').removeAttr('checked')
		}
	}

})