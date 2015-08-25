(function($){
	$.fn.extend({ 
		catalogSelect: function(options) {

			//Settings list and the default values
			var defaults = {
				urlCatalog: '/admin/catalog/default/ajaxCatalog',
				urlBrand: '/admin/catalog/default/ajaxBrand',
				urlModel: '/admin/catalog/default/ajaxModel',
				urlModification: '/admin/catalog/default/ajaxModification',

				brandSelect: $('#brand_id'),
				modelSelect: $('#model_id'),
				modificationSelect: $('#modification_id'),
				allowEmpty: false,
			};
			
			var options = $.extend(defaults, options);

    		return this.each(function() {
				var o = options;

				// Дополняю урлы
				if(o.model_id > 0){
					o.urlCatalog += '?'+o.model+'='+o.model_id;
					o.urlBrand += '?'+o.model+'='+o.model_id;
					o.urlModel += '?'+o.model+'='+o.model_id;
					o.urlModification += '?'+o.model+'='+o.model_id;
				}
				
				var obj = $(this);
				var form = obj.parents('form');

				// Сбор данных с первой внешней формы
				function getData(){
					return form.serialize()+'&brand_id='+o.brandSelect.val()+'&model_id='+o.modelSelect.val()+'&modification_id='+o.modificationSelect.val();
				}
				
				// Изменение слекта выбора брэнда, и отправка данных
				o.brandSelect.change(function(){
					if(o.select != 'brand')
					send(o.urlBrand, getData(), loadModels, function(){
						o.brandSelect.parent().find('img.loader').show();
						
						o.modelSelect.html('<option value="" selected></option>').val('');
						o.modificationSelect.html('<option value="" selected></option>').val('');
						
						o.modelSelect.parent().hide();
						o.modificationSelect.parent().hide();
					});
				});
				
				// Изменение слекта выбора модели, и отправка данных
				o.modelSelect.change(function(){
					if(o.select != 'model')
					send(o.urlModel, getData(), loadModifications,function(){
						o.modelSelect.parent().find('img.loader').show();
						
						o.modificationSelect.html('<option value="" selected></option>').val('');
						
						o.modificationSelect.parent().hide();
					});
				});
				
				/*
				o.modificationSelect.change(function(){
					send(o.urlModel, form.serialize(), loadModifications,function(){
						o.modificationSelect.parent().find('img.loader').show();
						//o.modificationSelect.parent().hide();
					});
				});
				*/
				
				// Первичная отправка данных
				send(o.urlCatalog, getData(), loadBrands, function(){
					o.brandSelect.parent().find('img.loader').show();
					
					o.brandSelect.html('<option value="" selected></option>').val('');
					o.modelSelect.html('<option value="" selected></option>').val('');
					o.modificationSelect.html('<option value="" selected></option>').val('');
				});
				
				/****************************/

				// Данные загружены
				function loadBrands(data){
					// Пустой результат
					if(data.data.length < 0) {
						o.brandSelect.parent().find('img.loader').hide();
						//alert('Пусто');
						//obj.find('.errorMessage').show();
						return;
					}
					
					if(o.allowEmpty){
						data.data.unshift({id:null,title:''});
						console.debug(data.data);
					}
					// переношу данные в селект
					set(data, o.brandSelect);
	    			o.brandSelect.parent().find('img.loader').hide();
	    			
	    			// Отправка запроса для следующего селекта
	    			if(o.select != data.type){
						send(o.urlBrand, getData(), loadModels, function(){
							//obj.find('.errorMessage').hide();
							o.brandSelect.parent().find('img.loader').show();
							o.modelSelect.parent().hide();
							o.modificationSelect.parent().hide();
						});
	    			}
	    		}
	    		
	    		function loadModels(data){
					if(data.data.length <= 0) {
						o.brandSelect.parent().find('img.loader').hide();
						//alert('Пусто');
						//obj.find('.errorMessage').show();
						return;
					}
	    			
					set(data, o.modelSelect);

	    			o.brandSelect.parent().find('img.loader').hide();

	    			if(o.select != data.type){
						send(o.urlModel, getData(), loadModifications,function(){
							//obj.find('.errorMessage').hide();
							o.modelSelect.parent().find('img.loader').show();
							o.modificationSelect.parent().hide();
						});
	    			}
	    		}
	    		
	    		function loadModifications(data){
					if(data.data.length < 0) {
		    			o.brandSelect.parent().find('img.loader').hide();
	    				o.modelSelect.parent().find('img.loader').hide();
						//alert('Пусто');
	    				//obj.find('.errorMessage').show();
						return;
					}
	    			
					set(data, o.modificationSelect);
	    			o.brandSelect.parent().find('img.loader').hide();
	    			o.modelSelect.parent().find('img.loader').hide();
	    			
	    			/*
					send(o.urlModel, getData(), loadModifications,function(){
						o.modificationSelect.parent().find('img.loader').show();
						//o.modificationSelect.parent().hide();
					});
					*/
	    		}
    		});
    		
    		function set(data, select){
    			select.parent().show();
    			select.html('');
    			$.each(data.data, function(i){
    				if(data.data[i].selected)
    					select.append("<option value=\'"+data.data[i].id+"\' selected>"+data.data[i].title+"</option>");
    				else
    					select.append("<option value=\'"+data.data[i].id+"\'>"+data.data[i].title+"</option>");
    			});
    		}
    		
    		function send(url, data, success, showLoader){
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: url,
					cache: false,
					success: success,
					data: data,
					beforeSend: showLoader,
				});
    		}
		}
	});
})(jQuery);