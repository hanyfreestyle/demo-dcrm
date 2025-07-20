<?php
if(!defined('WEB_ROOT')) {	exit;}
 

############################################################################################################################################################
############################################ UpdateArNum
############################################################################################################################################################
function UpdateArNum($string) {
    return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
}

function faTOen($string) {
    $string = str_replace("+","00",$string);
    return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
}

function NumberClean($value){
$bad_symbols = array(",", ".");
$value = str_replace($bad_symbols, "", $value);
return $value ;
}

############################################################################################################################################################
############################################ Removehtml_2
############################################################################################################################################################
  function Removehtml_2($value){
    $value = Removword_L($value);
    $value = Remove_HTML($value);
    return $value ;
 }

############################################################################################################################################################
############################################ MaketheModeLink
############################################################################################################################################################
 function MaketheModeLink($value) {
   $value = trim($value);
   $rep1 = array(' ');
   $rep2 = array('-');
   $value = str_replace($rep1,$rep2,$value);
   return $value;
 }

############################################################################################################################################################
############################################ MaketheModeLink
############################################################################################################################################################
  function RemoveModeLink($value) {
   $value = trim($value);
   $rep1 = array('-');
   $rep2 = array(' ');
   $value = str_replace($rep1,$rep2,$value);
   return $value;
 }

############################################################################################################################################################
############################################ MaketheModeLink_Lang
############################################################################################################################################################
 function MaketheModeLink_Lang($value) {
   $value = trim($value);
   $rep1 = array(' ');
   $rep2 = array('_');
   $value = str_replace($rep1,$rep2,$value);
   return $value;
} 
 
 
############################################################################################################################################################
############################################ Removedash
############################################################################################################################################################
 function Removedash($value) {
   $value = nl2br($value);
   $rep1 = array("-");
   $rep2 = array(",");
   $value = str_replace($rep1,$rep2,$value);
   return $value;
 }

############################################################################################################################################################
############################################ MaketheModeLink
############################################################################################################################################################
function keephtml($string) {
   $res = str_replace('\r\n',"<br>",$string);
   return $res;
}
 
############################################################################################################################################################
############################################ NiceTrim
############################################################################################################################################################
function NiceTrim($TEXT,$MAX_LENGTH) {
   $str_to_count = html_entity_decode($TEXT);
   if(strlen($str_to_count) <= $MAX_LENGTH) {
     return $TEXT;
   }
   $s2 = substr($str_to_count,0,$MAX_LENGTH - 3);
   $s2 .= "...";
   return $s2;
}

############################################################################################################################################################
############################################ NiceTrim2011
############################################################################################################################################################
function NiceTrim2011($TEXT,$MAX_LENGTH) {
   $str_to_count = html_entity_decode($TEXT);
   if(strlen($str_to_count) <= $MAX_LENGTH) {
     return $TEXT;
   }
   $s2 = substr($str_to_count,0,$MAX_LENGTH - 3);
   $s2 .= "..";
   return $s2;
}
 
############################################################################################################################################################
############################################ NiceTrim2013
############################################################################################################################################################ 
function NiceTrim2013($TEXT,$MAX_LENGTH) {
  $str_to_count = $TEXT;
   $str_to_count = html_entity_decode($TEXT);
   if(strlen($str_to_count) <= $MAX_LENGTH) {
     return $TEXT;
   }
   $s2 = substr($str_to_count,0,$MAX_LENGTH );
  $xx = explode(" ",$s2);
  for ($i = 0; $i < count($xx)-1; $i++) {
  $s2z .= $xx[$i]." " ;  
  }
  $s2z .=  " ..."; 
   return $s2z;
} 

#################################################################################################################################
###################################################   NiceTrim2013_Meta
#################################################################################################################################
function NiceTrim2013_Meta($TEXT,$MAX_LENGTH) {
  $str_to_count = html_entity_decode($TEXT);
  if(mb_strlen($str_to_count,"utf-8") <= $MAX_LENGTH) {
     return $TEXT;
  }
  $s2 = mb_substr($str_to_count,0,$MAX_LENGTH,"utf-8");
  $xx = explode(" ",$s2);
  for ($i = 0; $i < count($xx)-1; $i++) {
  $s2z .= $xx[$i]." " ;  
  }
  return $s2z;
} 

############################################################################################################################################################
############################################ NiceTrimNew
############################################################################################################################################################
function NiceTrimNew($String,$text_length) {
   if(strlen($String) > $text_length) {
     $String = substr($String,0,$text_length);
     $String .= "...";
   }
   return $String;
}
############################################################################################################################################################
############################################ MoveLastWord
############################################################################################################################################################
function MoveLastWord($TextNeed) {
  $TextNeedLans = strlen(trim($TextNeed));
  $TextNeed = substr($TextNeed,0,$TextNeedLans - 1);
   return $TextNeed;
}
function MoveFirstWord($TextNeed) {
   $TextNeedLans = strlen(trim($TextNeed));
   $TextNeed = substr($TextNeed,1);
   return $TextNeed;
}
############################################################################################################################################################
############################################ rand_string
############################################################################################################################################################
function rand_string($num_chars) {
   $chars = array("1","2","3","4","5","6","7","8","9","0","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
   $string = array_rand($chars,$num_chars);
   foreach($string as $s) {
     $ret .= $chars[$s];
   }
   return $ret;
}
############################################################################################################################################################
############################################ LatterCase
############################################################################################################################################################
function LatterCase($text,$state="0"){
    $text_type = preg_match("/\p{Arabic}/u", $text);
    if($text_type == '1'){
    $state = '0';    
    }
       switch ($state){ 
    	case "0":
        $text = $text; 
    	break;
    
    	case "1":
        $text = strtoupper($text);
    	break;
    
    	case "2":
        $text =  strtolower($text);
    	break;
    	
        case "3":
        $text = ucwords(strtolower($text));
    	break;        
     	
         default :
        $text = $text; 
     } 
 return $text;
} 
############################################################################################################################################################
############################################ Remove_HTML
############################################################################################################################################################
function Remove_HTML($s,$keep = '',$expand = 'script|style|noframes|select|option') {
   /**/ //prep the string
   $s = ' '.$s;
   /**/ //initialize keep tag logic
   if(strlen($keep) > 0) {
     $k = explode('|',$keep);
     for($i = 0; $i < count($k); $i++) {
       $s = str_replace('<'.$k[$i],'[{('.$k[$i],$s);
       $s = str_replace('</'.$k[$i],'[{(/'.$k[$i],$s);
     }
   }else{
       $k =array();
   }
   //begin removal
   /**/ //remove comment blocks
   while(stripos($s,'<!--') > 0) {
     $pos[1] = stripos($s,'<!--');
     $pos[2] = stripos($s,'-->',$pos[1]);
     $len[1] = $pos[2] - $pos[1] + 3;
     $x = substr($s,$pos[1],$len[1]);
     $s = str_replace($x,'',$s);
   }
   /**/ //remove tags with content between them
   if(strlen($expand) > 0) {
     $e = explode('|',$expand);
     for($i = 0; $i < count($e); $i++) {
       while(stripos($s,'<'.$e[$i]) > 0) {
         $len[1] = strlen('<'.$e[$i]);
         $pos[1] = stripos($s,'<'.$e[$i]);
         $pos[2] = stripos($s,$e[$i].'>',$pos[1] + $len[1]);
         $len[2] = $pos[2] - $pos[1] + $len[1];
         $x = substr($s,$pos[1],$len[2]);
         $s = str_replace($x,'',$s);
       }
     }
   }
   /**/ //remove remaining tags
   while(stripos($s,'<') > 0) {
     $pos[1] = stripos($s,'<');
     $pos[2] = stripos($s,'>',$pos[1]);
     $len[1] = $pos[2] - $pos[1] + 1;
     $x = substr($s,$pos[1],$len[1]);
     $s = str_replace($x,'',$s);
   }
   /**/ //finalize keep tag
   for($i = 0; $i < count($k); $i++) {
     $s = str_replace('[{('.$k[$i],'<'.$k[$i],$s);
     $s = str_replace('[{(/'.$k[$i],'</'.$k[$i],$s);
   }
   return trim($s);
   //echo $SS ;
   //  echo remove_HTML($SS);
}
############################################################################################################################################################
############################################ Letter_Encrypt
############################################################################################################################################################
function Letter_Encrypt($sData, $sKey='mysecretkey'){
    $sResult = '';
    $sKey = md5($sKey);
    for($i=0;$i<strlen($sData);$i++){
        $sChar    = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar    = chr(ord($sChar) + ord($sKeyChar));
        $sResult .= $sChar;
    }
    return encode_base64($sResult);
}
function Letter_Decrypt($sData, $sKey='mysecretkey'){
    $sResult = '';
    $sKey = md5($sKey);
    $sData   = decode_base64($sData);
    for($i=0;$i<strlen($sData);$i++){
        $sChar    = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar    = chr(ord($sChar) - ord($sKeyChar));
        $sResult .= $sChar;
    }
    return $sResult;
}
function encode_base64($sData){
    $sBase64 = base64_encode($sData);
    return strtr($sBase64, '+/', '-_');
}
function decode_base64($sData){
    $sBase64 = strtr($sData, '-_', '+/');
    return base64_decode($sBase64);
}



#################################################################################################################################
###################################################  CreateKeyword 
#################################################################################################################################
function CreateKeyword($dataR){
$data =<<<EOF
$dataR
EOF;
$params['content'] = $data; //page content

//set the length of keywords you like
$params['min_word_length'] = 5;  //minimum length of single words
$params['min_word_occur'] = 2;  //minimum occur of single words

$params['min_2words_length'] = 4;  //minimum length of words for 2 word phrases
$params['min_2words_phrase_length'] = 10; //minimum length of 2 word phrases
$params['min_2words_phrase_occur'] = 2; //minimum occur of 2 words phrase

$params['min_3words_length'] = 3;  //minimum length of words for 3 word phrases
$params['min_3words_phrase_length'] = 10; //minimum length of 3 word phrases
$params['min_3words_phrase_occur'] = 2; //minimum occur of 3 words phrase

$keyword = new autokeyword($params, "utf-8");

$keywords_01 =  $keyword->parse_words();
$keywords_02 =  $keyword->parse_2words();
$keywords_03 =  $keyword->parse_3words();

$keywords = $keywords_03 . $keywords_02. $keywords_01 ;
//$keywords = $keywords_02  ;
//echo strlen($keywords);

//$keywords = $keywords_01 ."<br/><br/><br/>". $keywords_02."<br/><br/><br/>". $keywords_03 ;

return $keywords ; 
}




?>