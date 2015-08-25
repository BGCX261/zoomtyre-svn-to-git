/**
 * Ответ на комментарий
 */

(function($){
	$.fn.comments = function(options) {
		var defaults = {};
		var options = $.extend(defaults, options);
	 
		return this.each(function() {
			var t = $(this);

			t.find('a.ans').live('click', function(e){
				t.find('.comments-form .parent').val($(this).attr('rel'));
				//$.markItUp({target: t.find("textarea.text"), openWith: " @"+ $(this).attr('author') +" "});
				
				var li = $(this).parents('li')
				li.append(t.find('.comments-form').css('margin-left', li.css('margin-left')));
				t.find('.noans').show();
				
				//e.preventDefault();
			});
			
			t.find('.noans').bind('click', function(e){
				t.find('ul').after(t.find('.comments-form'));
				t.find('.noans').hide();
				t.find('.comments-form .parent').val('');
				e.preventDefault();
			});
		});

	};
})(jQuery);