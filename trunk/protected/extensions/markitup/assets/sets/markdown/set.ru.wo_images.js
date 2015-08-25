// -------------------------------------------------------------------
// markItUp!
// -------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// -------------------------------------------------------------------
// MarkDown tags example
// http://en.wikipedia.org/wiki/Markdown
// http://daringfireball.net/projects/markdown/
// -------------------------------------------------------------------
// Feel free to add more tags
// -------------------------------------------------------------------
markdown_set_ru_wo_images = {
	nameSpace: 'markdown_wo_images default',
	onShiftEnter: {keepDefault:false, openWith:'\n\n'},
	markupSet: [
		{name:'Заголовок первого уровня', key:'1', placeHolder:'Ваш заголовок...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '=') } },
		{name:'Заголовок второго уровня', key:'2', placeHolder:'Ваш заголовок...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '-') } },
		{name:'Заголовок 3', key:'3', openWith:'### ', placeHolder:'Ваш заголовок...' },
		{name:'Заголовок 4', key:'4', openWith:'#### ', placeHolder:'Ваш заголовок...' },
		{name:'Заголовок 5', key:'5', openWith:'##### ', placeHolder:'Ваш заголовок...' },
		{name:'Заголовок 6', key:'6', openWith:'###### ', placeHolder:'Ваш заголовок...' },
		{separator:'---------------' },		
		{name:'Жирный', key:'B', openWith:'**', closeWith:'**'},
		{name:'Курсив', key:'I', openWith:'_', closeWith:'_'},
		{separator:'---------------' },
		{name:'Ненумерованный список', openWith:'- ' },
		{name:'Нумерованный список', openWith:function(markItUp) {
			return markItUp.line+'. ';
		}},
		{separator:'---------------' },
		{name:'Картинку по ссылке', replaceWith:'![[![Альтернативный текст]!]]([![Url:!:http://]!] "[![Тайтл]!]")'},
		{name:'Ссылка', key:'L', openWith:'[', closeWith:']([![Url:!:http://]!] "[![Тайтл]!]")', placeHolder:'Текст Вашей ссылки...' },
		{separator:'---------------'},
		{name:'Цитата', openWith:'> '},
		/*{separator:'---------------'},
		{name:'Preview', call:'preview', className:"preview"}*/
	]
}

// mIu nameSpace to avoid conflict.
miu = {
	markdownTitle: function(markItUp, char) {
		heading = '';
		n = $.trim(markItUp.selection||markItUp.placeHolder).length;
		for(i = 0; i < n; i++) {
			heading += char;
		}
		return '\n'+heading;
	}
}