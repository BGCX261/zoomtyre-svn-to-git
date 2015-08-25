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
markdown_set_ru_simple = {
	nameSpace: 'markdown_wo_images default',
	onShiftEnter: {keepDefault:false, openWith:'\n\n'},
	markupSet: [
		{name:'Жирный', key:'B', openWith:'**', closeWith:'**'},
		{name:'Курсив', key:'I', openWith:'_', closeWith:'_'},
		{separator:'---------------' },
		{name:'Ненумерованный список', openWith:'- ' },
		{name:'Нумерованный список', openWith:function(markItUp) {
			return markItUp.line+'. ';
		}},
		{separator:'---------------' },
		{name:'Ссылка', key:'L', openWith:'[', closeWith:']([![Ссылка:!:http://]!] "[![Всплывающая подсказка]!]")', placeHolder:'Текст Вашей ссылки...' },
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