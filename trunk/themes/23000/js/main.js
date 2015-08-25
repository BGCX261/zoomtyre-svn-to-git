/**
 * 
 */

function breadcumbsWidth(){
	var w = 460;
	var id = '#breadcrumbs';
	if( $(id).width() > w ) {
		var html = $(id).html().replace(/<\/span> (<a[^>]+?)>([^(\.{3})]*?)<\/a>/i, "</span> $1 title='$2'>...</a> ");
		$(id).html(html);
		breadcumbsWidth();
	}
}

function sold(id) {
	$(id).append('<span class="sold" style="display:none;">Добавлено в <a href="/basket/index.html">корзину</a>!</span>');
	$(id).find('.sold').fadeIn(function(){
		setTimeout(function(){
			$(id).find('.sold').fadeOut(function(){$(this).remove();});
		}, 3000)
	});
}