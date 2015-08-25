var ru2en = {
  ru_str : "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя",
  en_str : [
    'A','B','V','G','D','E','YO','ZH','Z','I','J','K','L','M','N','O','P','R','S','T',
    'U','F','H','TS','CH','SH','SCH','','Y','','E','YU', 'YA',
    'a','b','v','g','d','e','yo','zh','z','i','j','k','l','m','n','o','p','r','s','t',
    'u','f','h','ts','ch','sh','sch','','y','','e','yu','ya'],
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