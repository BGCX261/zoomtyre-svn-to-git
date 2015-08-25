<?php

class EString
{
	// второй параметр в винительном падеже - кого? что?
	static protected $months = array(
		array('Январь', 'январе'), array('Февраль', 'феврале'), array('Март', 'марте'), array('Апрель', 'апреле'),
		array('Май', 'мае'), array('Июнь', 'июне'), array('Июль', 'июле'), array('Август', 'августе'),
		array('Сентябрь', 'сентябре'), array('Октябрь', 'октябре'), array('Ноябрь', 'ноябре'), array('Декабрь', 'декабре') 
	);
	
	static protected $days_of_week = array(
		array('Понедельник', 'понедельник'), array('Вторник', 'вторник'), array('Среда', 'среду'), array('Четверг', 'четверг'),
		array('Пятница', 'пятницу'), array('Суббота', 'субботу'), array('Воскресенье', 'воскресенье') 
	);
	
	static public function getYear($date){
		return date('Y', strtotime($date));
	}
	
	static public function getBackTime($date){
		$date = strtotime($date);
		$back_time = '';
		
		$times = array(
			'y'=>array(60*60*24*365,'год назад', 'года назад', 'лет назад'),
			'm'=>array(60*60*24*30,'месяц назад', 'месяца назад', 'месяцев назад'),
			'w'=>array(60*60*24*7,'неделю назад', 'недели назад', 'недель назад'),
			'd'=>array(60*60*24,'вчера', 'дня назад', 'дней назад'),
			'h'=>array(60*60,'час назад', 'часа назад', 'часов назад'),
			'i'=>array(60,'минуту назад', 'минуты назад', 'минут назад'),
			's'=>array(1,'секунду назад', 'секунды назад', 'секунд назад'),
		);
		
		foreach($times as $k=>$q){
			if(($t=(($date - time())*(-1) / $q[0])) >= 1 ){
				$t = ceil($t)-1;
				if($t == 0) {
					$back_time = 'вот сейчас';
					break;
				} elseif($t < 2) {
					$back_time = $q[1];
					break;
				} elseif($t <5) {
					$back_time = $t.' '.$q[2];
					break;
				} else {
					$back_time = $t.' '.$q[3];
					break;
				}
			}
		}

		switch($k){
			case 'y':
				$back_time .= ', в '.date('Y',$date).'-ом, в '.self::$months[(date('n', $date)-1)][1].', '.date('j', $date).'-го в '.date('H:i', $date);
			break;
			case 'm':
				$back_time .= ', в '.self::$months[(date('n', $date)-1)][1].', '.date('j', $date).'-го в '.date('H:i', $date);
			break;
			case 'w':
				if( ($t = (date('N', $date)-1)) == 1)
					$back_time .= ', '.date('j', $date).'-го во ';
				else
					$back_time .= ', '.date('j', $date).'-го в ';
				$back_time .= self::$days_of_week[$t][1].', в '.date('H:i', $date);
					
			break;
			case 'd':
				$back_time .= ', в '.date('H:i', $date);
			break;
			case 'h':
			break;
			case 'i':
			break;
			case 's':
			break;
		}
		
		return $back_time;
	}
	
	public static function sanitize($string, $suffix = null){
		$string = EString::rus2translit($string);
		
		$string = preg_replace(array('/\s+/is', '/[^\w\d\.\-]/is', ), array('_',''), $string);
		$string = preg_replace(array('/_{2,}/is'), array('_'), $string);
		$string = trim($string, '_');
		
		if(!empty($suffix))
			$string = $string.$suffix;
		
		return $string;
	}
	
	public static function rus2translit($string) {  
	     $converter = array(  
	         'а' => 'a',   'б' => 'b',   'в' => 'v',  
	         'г' => 'g',   'д' => 'd',   'е' => 'e',  
	         'ё' => 'e',   'ж' => 'zh',  'з' => 'z',  
	         'и' => 'i',   'й' => 'y',   'к' => 'k',  
	         'л' => 'l',   'м' => 'm',   'н' => 'n',  
	         'о' => 'o',   'п' => 'p',   'р' => 'r',  
	         'с' => 's',   'т' => 't',   'у' => 'u',  
	         'ф' => 'f',   'х' => 'h',   'ц' => 'c',  
	         'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  
	         'ь' => "'",  'ы' => 'y',   'ъ' => "'",  
	         'э' => 'e',   'ю' => 'yu',  'я' => 'ya',  
	   
	        'А' => 'A',   'Б' => 'B',   'В' => 'V',  
	         'Г' => 'G',   'Д' => 'D',   'Е' => 'E',  
	         'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',  
	         'И' => 'I',   'Й' => 'Y',   'К' => 'K',  
	         'Л' => 'L',   'М' => 'M',   'Н' => 'N',  
	         'О' => 'O',   'П' => 'P',   'Р' => 'R',  
	         'С' => 'S',   'Т' => 'T',   'У' => 'U',  
	         'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',  
	         'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',  
	         'Ь' => "'",  'Ы' => 'Y',   'Ъ' => "'",  
	         'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',  
	     );  
	     return strtr($string, $converter);  
	} 
	
	static public function wildCards($str = '', $model, $remove = false){

		if(preg_match_all('/%(\w[\w0-9]*)%/is', $str, $res) > 0) {
			foreach($res[1] as $card) {
				if(isset($model->attributes[$card]))
					$str = str_replace('%'.$card.'%', $model->attributes[$card], $str);
				elseif($remove) # удалить карды, если им нет подстановки
					$str = str_replace('%'.$card.'%', '', $str);
			}
		}

		return $str;
	}
	
	static public function truncateByWords($phrase, $max_words = 5){
	   $phrase_array = explode(' ',$phrase);
	   if(count($phrase_array) > $max_words && $max_words > 0)
	      $phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
	   return $phrase;
	}
	
	public function truncate($text, $length, $suffix = '&hellip;', $isHTML = true){
		$i = 0;
		$simpleTags=array('br'=>true,'hr'=>true,'input'=>true,'image'=>true,'link'=>true,'meta'=>true);
		$tags = array();
		if($isHTML){
			preg_match_all('/<[^>]+>([^<]*)/', $text, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
			foreach($m as $o){
				if($o[0][1] - $i >= $length)
					break;
				$t = self::substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
				// test if the tag is unpaired, then we mustn't save them
				if(isset($t[0]) && $t[0] != '/' && (!isset($simpleTags[$t])))
					$tags[] = $t;
				elseif(end($tags) == self::substr($t, 1))
					array_pop($tags);
				$i += $o[1][1] - $o[0][1];
			}
		}
		
		// output without closing tags
		$output = self::substr($text, 0, $length = min(self::strlen($text),  $length + $i));
		// closing tags
		$output2 = (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '');
		
		// Find last space or HTML tag (solving problem with last space in HTML tag eg. <span class="new">)
		$pos = (int)end(end(preg_split('/<.*>| /', $output, -1, PREG_SPLIT_OFFSET_CAPTURE)));
		// Append closing tags to output
		$output.=$output2;

		// Get everything until last space
		$one = self::substr($output, 0, $pos);
		// Get the rest
		$two = self::substr($output, $pos, (self::strlen($output) - $pos));
		// Extract all tags from the last bit
		preg_match_all('/<(.*?)>/s', $two, $tags);
		// Add suffix if needed
		if (self::strlen($text) > $length) { $one .= $suffix; }
		// Re-attach tags
		$output = $one . implode($tags[0]);
		
		return $output;
	}
    
    static function strlen($str){
    	if(function_exists('mb_strlen'))
    		return mb_strlen($str, 'UTF-8');

    	return strlen($str);
    }
    
    static function substr($str, $start, $length = null){
    	if(function_exists('mb_substr'))
    		return mb_substr($str, $start, $length, 'UTF-8');

    	return substr($str, $start, $length);
    }
    
    static function strpos($haystack , $needle, $offset = null){
    	if(function_exists('mb_strrpos'))
    		return mb_strpos($haystack , $needle, $offset, 'UTF-8');

    	return strpos($haystack , $needle, $offset);
    }
    
    static function strrpos($haystack , $needle, $offset = null){
    	if(function_exists('mb_strrpos'))
    		return mb_strrpos($haystack , $needle, $offset, 'UTF-8');

    	return strrpos($haystack , $needle, $offset);
    }
    
    static function strtolower($str){
    	if(function_exists('mb_strtolower'))
    		return mb_strtolower($str, 'UTF-8');

    	return strtolower($str);
    }
    
    static function ucfirst($string){
    	if(function_exists('mb_ucfirst'))
    		return mb_ucfirst($string, 'UTF-8');

    	return ucfirst($string);
    }
    
}