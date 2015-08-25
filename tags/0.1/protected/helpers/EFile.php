<?php
class EFile extends CFile {
/**
* Returns a filename based on the $name paramater that has been
* striped of special characters, it's spaces changed to underscores,
* and shortened to 50 characters... but keeping it's extension
* PD: Updated to keep extensions, based on code by timdw at
* <a href="http://forums.codecharge.com/posts.php?post_id=75694
" title="http://forums.codecharge.com/posts.php?post_id=75694
" rel="nofollow">http://forums.codecharge.com/posts.php?post_id=75694
</a> */

//public static function sanitize($name, $dir = false) {
//  $name = EString::rus2translit($name);
//	
//  $special_chars = array (":", "#","$","%","^","&","*","!","~","‘","\"","’","'","=","?","/","[","]","(",")","|","<",">",";","\\",",",".");
//  $name = preg_replace("/^[.]*/","",$name); // remove leading dots
//  $name = preg_replace("/[.]*$/","",$name); // remove trailing dots
//  
//  if(!$dir)
//  	$lastdotpos=strrpos($name, "."); // save last dot position
//  else
//  	$lastdotpos = false;
//  
//  $name = str_replace($special_chars, "", $name);  // remove special characters
//  
//  $name = preg_replace('|\s+|','_',$name); // replace spaces with _
//  
//  $afterdot = "";
//  if ($lastdotpos !== false) { // Split into name and extension, if any.
//    if ($lastdotpos < (strlen($name) - 1))
//        $afterdot = substr($name, $lastdotpos);
//    
//    $extensionlen = strlen($afterdot);
//    
//    if ($lastdotpos < (50 - $extensionlen) )
//        $beforedot = substr($name, 0, $lastdotpos);
//    else
//        $beforedot = substr($name, 0, (50 - $extensionlen));
//  }
//  else   // no extension
//   $beforedot = substr($name,0,50);
//
//  
//  if ($afterdot)
//    $name = $beforedot . "." . $afterdot;
//  else
//    $name = $beforedot;
//  
//  $name = trim($name,' _-');
//    
//  return $name;
//
//}

 

}