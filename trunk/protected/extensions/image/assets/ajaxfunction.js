$.extend({
	ajaxFunction: function(options) {

		//Settings list and the default values
		var defaults = {
			onStart: function(){},
			onEnd: function(){},
			onSuccess: function(){},
			onError: function(){},
			onDataError: function(){},
			
			url: '',
			secureuri: false,
			
			loader: 'Loader',
			field: '',
			result: 'Result',
			button: 'ButtonUpload',
			container: 'Container'
		};
		
		var options = $.extend(defaults, options);
		
		$('#'+options.button).bind('click', function(){

			$('#'+options.loader).ajaxStart(function(){
				$(this).show();
				$('#'+options.field).attr('disabled', '');
				$('#'+options.button).attr('disabled', '');
				
				if(typeof(options.onStart) != 'undefined')
					options.onStart();
			}).ajaxComplete(function(){
				$('#'+options.field).val('');
				$(this).hide();
				$('#'+options.field).removeAttr('disabled');
				$('#'+options.button).removeAttr('disabled');
				if(typeof(options.onEnd) != 'undefined')
					options.onEnd();
			});
			
			$.ajaxFileUpload({
				url:options.url,
				secureuri:options.secureuri,
				fileElementId:options.field,
				dataType: 'json',
				data: 'preid=100',
				success: function(data, status){
					if(typeof(data.error) != 'undefined'){
						$('#'+options.result).html(data.error).fadeIn();
						setInterval(function(){
							$('#'+options.result).fadeOut();
						}, 5000);
						
						if(typeof(options.onDataError) != 'undefined')
							options.onDataError(data, options);
					} else {
						$('#'+options.result).html('Ok').fadeIn();
						setInterval(function(){
							$('#'+options.result).fadeOut();
						}, 5000);
						
						if(typeof(options.onSuccess) != 'undefined')
							options.onSuccess(data, options);
					}
				},
				error: function(data, status, e){
					$('#'+options.result).html(e);
					//alert(e);
				}
			})
			
			return false;
			
		})
	}
})
