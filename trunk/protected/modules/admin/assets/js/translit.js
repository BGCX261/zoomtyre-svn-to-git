var ru2en = {
  ru_str : "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя",
  en_str : [
	'a','b','v','g','d','e','e','g','z','i','y','k','l','m','n','o','p','r','s','t',
	'u','f','kh','c','ch','sh','sh','','y','','e','yu', 'ya',
	'a','b','v','g','d','e','e','g','z','i','y','k','l','m','n','o','p','r','s','t',
	'u','f','kh','c','ch','sh','sh','','y','','e','yu', 'ya'],
  translit : function(org_str) {
    var tmp_str = "";
    for(var i = 0, l = org_str.length; i < l; i++) {
      var s = org_str.charAt(i), n = this.ru_str.indexOf(s);
      if(n >= 0) { tmp_str += this.en_str[n]; }
      else { tmp_str += s; }
    }
    return tmp_str;
  }
}