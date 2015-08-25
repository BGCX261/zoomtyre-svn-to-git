$(function(){
	$('.selection-widget .producers .control').bind('click', cbToggle);

	$('.selection-widget .producers input[type=checkbox]').bind('change', function(){
		$('.selection-widget .producers .control').html('определённые');
	})
	
	function cbToggle(block){
		var block = $(this).parents('div.producers');
		if($(this).html() != 'все') {
			$(this).html('все');
			$(block).find('input[type=checkbox]').attr('checked', true);
		} else {
			$(this).html('определённые');
			$(block).find('input[type=checkbox]').removeAttr('checked')
		}
	}

})