<?php
if(!defined('WEB_ROOT')) {	exit;}
 

#################################################################################################################################
###################################################   TimeForToday
#################################################################################################################################
function TimeForToday(){
   $Today =  strtotime('today 00:00:00');
   return $Today;
}


#################################################################################################################################
###################################################   FULLDate
#################################################################################################################################
function  FULLDate($VaLL){
   if($VaLL != ""){
       $Stamp = strtotime($VaLL);  
       $Day =  intval(date("d",$Stamp)); 
       $Month =  intval(date("m",$Stamp)); 
       $Year =  intval(date("Y",$Stamp));
    }else{
       $Stamp = ""; 
       $Day =   "";
       $Month =  ""; 
       $Year =   "";  
    } 
   $FullDate = array("Stamp"=>$Stamp ,"Day"=> $Day ,"Month"=> $Month ,"Year"=> $Year ); 
   return $FullDate ;
}

function  FULLDate_2018($VaLL){
   if(isset($_POST[$VaLL]) and $_POST[$VaLL] != ""){
       $Stamp = strtotime($_POST[$VaLL]);  
       $Day =  intval(date("d",$Stamp)); 
       $Month =  intval(date("m",$Stamp)); 
       $Year =  intval(date("Y",$Stamp));
    }else{
       $Stamp = ""; 
       $Day =   "";
       $Month =  ""; 
       $Year =   "";  
    } 
   $FullDate = array("Stamp"=>$Stamp ,"Day"=> $Day ,"Month"=> $Month ,"Year"=> $Year ); 
   return $FullDate ;
}

#################################################################################################################################
###################################################   PrintFullTime
#################################################################################################################################
function PrintFullTime($Time){
   $FullTime =  date("Y-m-d",$Time).BR;
   $FullTime .=  date("h:i:s A",$Time); 
   return $FullTime ;
}

function PrintFollowTime($Time){
   $FullTime =  date("h:i A",$Time); 
   return $FullTime ;
}



#################################################################################################################################
###################################################   FULLDate_ForToday
#################################################################################################################################
function  FULLDate_ForToday(){
   $Stamp =  strtotime('today 00:00:00');
   $Day =  intval(date("d",$Stamp)); 
   $Month =  intval(date("m",$Stamp)); 
   $Year =  intval(date("Y",$Stamp));
  $FullDate = array("Stamp"=>$Stamp ,"Day"=> $Day ,"Month"=> $Month ,"Year"=> $Year ); 
  return $FullDate ;
}

#################################################################################################################################
###################################################    FULLDate_ForToday_PerAdmin
#################################################################################################################################
function  FULLDate_ForToday_PerAdmin($Stamp){
   $Day =  intval(date("d",$Stamp)); 
   $Month =  intval(date("m",$Stamp)); 
   $Year =  intval(date("Y",$Stamp));
  $FullDate = array("Stamp"=>$Stamp ,"Day"=> $Day ,"Month"=> $Month ,"Year"=> $Year ); 
  return $FullDate ;
}


#################################################################################################################################
###################################################   TimeForToday_frompost
#################################################################################################################################
function TimeForToday_frompost($Vall){
   if($Vall == ""){
   $Today =  strtotime('today 00:00:00');
   }else{
   $Today =  strtotime($Vall); 
   }
   return $Today; 
}

#################################################################################################################################
###################################################   ThisWeek
#################################################################################################################################
function ThisWeek(){
    $monday = strtotime("last saturday");
    $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
    $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
    $FullDate = array("start"=>$monday ,"end"=> $sunday  );
    return $FullDate ;
}

#################################################################################################################################
###################################################  ReportPeriod 
#################################################################################################################################
function ReportPeriod($Satet){
 if($Satet == '1'){
 $monday = strtotime("last saturday");
 $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
 $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
 $FullDate = array("start"=>$monday ,"end"=> $sunday  );    
 }elseif($Satet == '2'){
 $firstDayUTS = mktime (0, 0, 0, date("m"), 1, date("Y"));
 $lastDayUTS = mktime (0, 0, 0, date("m"), date('t'), date("Y"));   
 $FullDate = array("start"=>$firstDayUTS ,"end"=> $lastDayUTS  ); 
 }
 return $FullDate ;
}

#################################################################################################################################
###################################################   ConvertDateToYears
#################################################################################################################################
function ConvertDateToYears() {
   if($_POST['date'] == "") {
     $date['date'] = time();
     $date['month'] = date("m",$date['date']);
     $date['year'] = date("Y",$date['date']);
   } else {
     $date_Send = Clean_Mypost($_POST['date']);
     $date['date'] = strtotime($date_Send);
     $date['month'] = date("m",$date['date']);
     $date['year'] = date("Y",$date['date']);
   }
   return $date;
}
#################################################################################################################################
###################################################   ConvertDateToYears_2
#################################################################################################################################
function ConvertDateToYears_2($SendDate) {
    $date['date'] = strtotime($SendDate);
    $date['month'] = date("m",$date['date']);
    $date['year'] = date("Y",$date['date']);
    return $date;
}
#################################################################################################################################
###################################################   ConvertDateToCalender
#################################################################################################################################
function ConvertDateToCalender($date) {
    if($date == "") {
        $date = time();
    }
    $date2['month'] = date("m",$date);
    $date2['year'] = date("Y",$date);
    $date2['day'] = date("d",$date);
    $all = $date2['year']."-".$date2['month']."-".$date2['day'];
    return $all;
}
#################################################################################################################################
###################################################   ConvertDateToCalender_2
#################################################################################################################################
function ConvertDateToCalender_2($date) {
    if($date == "") {
        $date = time();
    }
    $date2['month'] = date("m",$date);
    $date2['year'] = date("Y",$date);
    $date2['day'] = date("d",$date);
    $all = $date2['year']."-".$date2['month']."-".$date2['day'];
    return $all;
}
#################################################################################################################################
###################################################   
#################################################################################################################################
function ConvertDateToCalender_3($date) {
    if($date == "") {
        $date = time();
    }
    $date2['month'] = date("m",$date);
    $date2['year'] = date("Y",$date);
    $date2['day'] = date("d",$date);
    $all = $date2['month']."/".$date2['day']."/".$date2['year'];
    return $all;
}
#################################################################################################################################
###################################################   ConvertDateToCalender_4
#################################################################################################################################
function ConvertDateToCalender_4($date) {
    if($date == "") {
        $date = time();
    }
    $date2['month'] = date("m",$date);
    $date2['year'] = date("Y",$date);
    $date2['day'] = date("d",$date);
    $all = date("m / Y",$date);
    return $all;
}


#################################################################################################################################
###################################################   ConvertDateToCalender_chart
#################################################################################################################################
function ConvertDateToCalender_chart($date) {
    if($date == "") {
     $date = time();
    }
    $date2['month'] = date("m",$date);
    $date2['year'] = date("Y",$date);
    $date2['day'] = date("d",$date);
    $all = $date2['month']."-".$date2['day'];
    return $all;
}
#################################################################################################################################
###################################################    
#################################################################################################################################
function ConvertToArDate($Date,$Format = 'hj: d F Y') {
   $geoDatex = explode('-',$Date);
   $date = ArabicTools::arabicDate($Format,strtotime($geoDatex[2].'-'.$geoDatex[1].'-'.$geoDatex[0]));
   return $date;
}
function ConvertToStamp($Date) {
   $geoDatex = explode('-',$Date);
   $date = strtotime($geoDatex[2].'-'.$geoDatex[1].'-'.$geoDatex[0]);
   return $date;
}
function getTime($timestamp) {
   $date = date("D M Y j G:i:s",$timestamp);
   echo $date;
}

#################################################################################################################################
###################################################   GetARDate
#################################################################################################################################
function GetARDate($SetLabel = "",$timestamp = null) {
   $nameday = date("l",$timestamp);
   $day = date("d",$timestamp);
   $namemonth = date("m",$timestamp);
   $year = date("Y",$timestamp);
   switch($nameday) {
     case "Saturday":
       $nameday = "السبت";
       break;
     case "Sunday":
       $nameday = "الأحد";
       break;
     case "Monday":
       $nameday = "الاثنين";
       break;
     case "Tuesday":
       $nameday = "الثلاثاء";
       break;
     case "Wednesday":
       $nameday = "الأربعاء";
       break;
     case "Thursday":
       $nameday = "الخميس";
       break;
     case "Friday":
       $nameday = "الجمعة";
       break;
   }
   switch($namemonth) {
     case 1:
       $namemonth = "يناير";
       break;
     case 2:
       $namemonth = "فبراير";
       break;
     case 3:
       $namemonth = "مارس";
       break;
     case 4:
       $namemonth = "إبريل";
       break;
     case 5:
       $namemonth = "مايو";
       break;
     case 6:
       $namemonth = "يونيو";
       break;
     case 7:
       $namemonth = "يوليو";
       break;
     case 8:
       $namemonth = "اغسطس";
       break;
     case 9:
       $namemonth = "سبتمبر";
       break;
     case 10:
       $namemonth = "اكتوبر";
       break;
     case 11:
       $namemonth = "نوفمبر";
       break;
     case 12:
       $namemonth = "ديسمبر";
       break;
   }
   echo $SetLabel."$nameday $day $namemonth $year";
}
#################################################################################################################################
###################################################   GetARDate2
#################################################################################################################################
function GetARDate2($SetLabel = "",$timestamp = null) {
   $nameday = date("l",$timestamp);
   $day = date("d",$timestamp);
   $namemonth = date("m",$timestamp);
   $year = date("Y",$timestamp);
   switch($nameday) {
     case "Saturday":
       $nameday = "السبت";
       break;
     case "Sunday":
       $nameday = "الأحد";
       break;
     case "Monday":
       $nameday = "الاثنين";
       break;
     case "Tuesday":
       $nameday = "الثلاثاء";
       break;
     case "Wednesday":
       $nameday = "الأربعاء";
       break;
     case "Thursday":
       $nameday = "الخميس";
       break;
     case "Friday":
       $nameday = "الجمعة";
       break;
   }
   switch($namemonth) {
     case 1:
       $namemonth = "يناير";
       break;
     case 2:
       $namemonth = "فبراير";
       break;
     case 3:
       $namemonth = "مارس";
       break;
     case 4:
       $namemonth = "إبريل";
       break;
     case 5:
       $namemonth = "مايو";
       break;
     case 6:
       $namemonth = "يونيو";
       break;
     case 7:
       $namemonth = "يوليو";
       break;
     case 8:
       $namemonth = "اغسطس";
       break;
     case 9:
       $namemonth = "سبتمبر";
       break;
     case 10:
       $namemonth = "اكتوبر";
       break;
     case 11:
       $namemonth = "نوفمبر";
       break;
     case 12:
       $namemonth = "ديسمبر";
       break;
   }
   return $SetLabel."$day $namemonth $year";
}

#################################################################################################################################
###################################################   GetARDate3
#################################################################################################################################
function GetARDate3($timestamp) {
    $SetLabel= "";
   $nameday = date("l",$timestamp);
    
   $day = date("d",$timestamp);
   $namemonth = date("m",$timestamp);
   $year = date("Y",$timestamp);
   switch($nameday) {
     case "Saturday":
       $nameday = "السبت";
       break;
     case "Sunday":
       $nameday = "الأحد";
       break;
     case "Monday":
       $nameday = "الاثنين";
       break;
     case "Tuesday":
       $nameday = "الثلاثاء";
       break;
     case "Wednesday":
       $nameday = "الأربعاء";
       break;
     case "Thursday":
       $nameday = "الخميس";
       break;
     case "Friday":
       $nameday = "الجمعة";
       break;
   }
   switch($namemonth) {
     case 1:
       $namemonth = "يناير";
       break;
     case 2:
       $namemonth = "فبراير";
       break;
     case 3:
       $namemonth = "مارس";
       break;
     case 4:
       $namemonth = "إبريل";
       break;
     case 5:
       $namemonth = "مايو";
       break;
     case 6:
       $namemonth = "يونيو";
       break;
     case 7:
       $namemonth = "يوليو";
       break;
     case 8:
       $namemonth = "اغسطس";
       break;
     case 9:
       $namemonth = "سبتمبر";
       break;
     case 10:
       $namemonth = "اكتوبر";
       break;
     case 11:
       $namemonth = "نوفمبر";
       break;
     case 12:
       $namemonth = "ديسمبر";
       break;
   }
   return $SetLabel."$nameday $day $namemonth $year";
 }
#################################################################################################################################
###################################################   Time_Ago 
#################################################################################################################################
function Time_Ago($date,$timetype) {
   if(empty($date)) {
     return "No date provided";
   }
   $periods = array("ثانية","دقيقة","ساعات","يوم","اسبوع","شهر","year","decade");
   $lengths = array("60","60","24","7","4.35","12","10");
   $now = time();
   if($timetype = "1") {
     $unix_date = $date;
   } else {
     $unix_date = strtotime($date);
   }
   // check validity of date
   if(empty($unix_date)) {
     return "Bad date";
   }
   // is it future date or past date
   if($now > $unix_date) {
     $difference = $now - $unix_date;
     $tense = "منذ";
   } else {
     $difference = $unix_date - $now;
     $tense = "from now";
   }
   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
     $difference /= $lengths[$j];
   }
   $difference = round($difference);
   if($difference != 1) {
     $periods[$j] .= "";
   }
   return "{$tense} $difference  $periods[$j] ";
}
#################################################################################################################################
###################################################   Time_Ago_2
#################################################################################################################################
function Time_Ago_2($date,$Todate) {
    global $AdminLangFile ;
   if(empty($date)) {
     return "No date provided";
   }
   $periods = array("ثانية","دقيقة","ساعات",$AdminLangFile['report_day'],$AdminLangFile['report_week'],$AdminLangFile['report_month'],"year","decade");
   $lengths = array("60","60","24","7","4.35","12","10");
   $now = $Todate ;
   if($timetype = "1") {
     $unix_date = $date;
   } else {
     $unix_date = strtotime($date);
   }
   // check validity of date
   if(empty($unix_date)) {
     return "Bad date";
   }
   // is it future date or past date
   if($now > $unix_date) {
     $difference = $now - $unix_date;
    // $tense = "منذ";
   } else {
     $difference = $unix_date - $now;
    // $tense = "from now";
   }
   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
     $difference /= $lengths[$j];
   }
   $difference = round($difference);
   if($difference != 1) {
     $periods[$j] .= "";
   }
   
   if($difference == '0'){
     return $difference = $AdminLangFile['report_same_day'] ;
   }else{
    //return "{$tense} $difference  $periods[$j] ";
       return "$difference  $periods[$j] ";
   }
}


#################################################################################################################################
###################################################   
#################################################################################################################################
 class ArabicTools {
   function _ardInt($float) {
     return ($float < -0.0000001)?ceil($float - 0.0000001):floor($float + 0.0000001);
   }
   function arabicDate($format,$timestamp) {
     $format = trim($format);
     if(substr($format,0,1) == '*') {
       $use_span = true;
       $format = substr($format,1);
     } else
       $use_span = false;
     $type = substr($format,0,3);
     $arDay = array("Sat" => "السبت","Sun" => "الأحد","Mon" => "الإثنين","Tue" => "الثلاثاء","Wed" => "الأربعاء","Thu" => "الخميس","Fri" => "الجمعة");
     $ampm = array('am' => 'صباحا','pm' => 'مساء');
     list($d,$m,$y,$dayname,$monthname,$am) = explode(' ',date('d m Y D M a',$timestamp));
     if($type == 'hj:') {
       if(($y > 1582) || (($y == 1582) && ($m > 10)) || (($y == 1582) && ($m == 10) && ($d > 14))) {
         $jd = ArabicTools::_ardInt((1461 * ($y + 4800 + ArabicTools::_ardInt(($m - 14) / 12))) / 4);
         $jd += ArabicTools::_ardInt((367 * ($m - 2 - 12 * (ArabicTools::_ardInt(($m - 14) / 12)))) / 12);
         $jd -= ArabicTools::_ardInt((3 * (ArabicTools::_ardInt(($y + 4900 + ArabicTools::_ardInt(($m - 14) / 12)) / 100))) / 4);
         $jd += $d - 32075;
       } else {
         $jd = 367 * $y - ArabicTools::_ardInt((7 * ($y + 5001 + ArabicTools::_ardInt(($m - 9) / 7))) / 4) + ArabicTools::_ardInt((275 * $m) / 9) + $d + 1729777;
       }
       $l = $jd - 1948440 + 10632;
       $n = ArabicTools::_ardInt(($l - 1) / 10631);
       $l = $l - 10631 * $n + 355; // Correction: 355 instead of 354
       $j = (ArabicTools::_ardInt((10985 - $l) / 5316)) * (ArabicTools::_ardInt((50 * $l) / 17719)) + (ArabicTools::_ardInt($l / 5670)) * (ArabicTools::_ardInt((43 * $l) / 15238));
       $l = $l - (ArabicTools::_ardInt((30 - $j) / 15)) * (ArabicTools::_ardInt((17719 * $j) / 50)) - (ArabicTools::_ardInt($j / 16)) * (ArabicTools::_ardInt((15238 * $j) / 43)) + 29;
       $m = ArabicTools::_ardInt((24 * $l) / 709);
       $d = $l - ArabicTools::_ardInt((709 * $m) / 24);
       $y = 30 * $n + $j - 30;
       $format = substr($format,3);
       $hjMonth = array("محرم","صفر","ربيع أول","ربيع ثاني","جماد أول","جماد ثاني","رجب","شعبان","رمضان","شوال","ذو القعدة","ذو الحجة");
       $format = str_replace('j',$d,$format);
       $format = str_replace('d',str_pad($d,2,0,STR_PAD_LEFT),$format);
       $format = str_replace('l',$arDay[$dayname],$format);
       $format = str_replace('F',$hjMonth[$m - 1],$format);
       $format = str_replace('m',str_pad($m,2,0,STR_PAD_LEFT),$format);
       $format = str_replace('n',$m,$format);
       $format = str_replace('Y',$y,$format);
       $format = str_replace('y',substr($y,2),$format);
       $format = str_replace('a',substr($ampm[$am],0,1),$format);
       $format = str_replace('A',$ampm[$am],$format);
     } elseif($type == 'ar:') {
       $format = substr($format,3);
       $arMonth = array("Jan" => "يناير","Feb" => "فبراير","Mar" => "مارس","Apr" => "ابريل","May" => "مايو","Jun" => "يونيو","Jul" => "يوليو","Aug" => "اغسطس","Sep" => "سبتمبر","Oct" => "اكتوبر","Nov" => "نوفمبر","Dec" => "ديسمبر");
       $format = str_replace('l',$arDay[$dayname],$format);
       $format = str_replace('F',$arMonth[$monthname],$format);
       $format = str_replace('a',substr($ampm[$am],0,1),$format);
       $format = str_replace('A',$ampm[$am],$format);
     }
     $date = date($format,$timestamp);
     if($use_span)
       return '<span dir="rtl" lang="ar-sa">'.$date.'</span>';
     else
       return $date;
   }
   function dateHejri2Geo($hijriDate) {
     // hijriDate must be dd/mm/yyyy
     list($d,$m,$y) = explode('/',$hijriDate);
     $jd = ArabicTools::_ardInt((11 * $y + 3) / 30) + 354 * $y + 30 * $m - ArabicTools::_ardInt(($m - 1) / 2) + $d + 1948440 - 386;
     if($jd > 2299160) {
       $l = $jd + 68569;
       $n = ArabicTools::_ardInt((4 * $l) / 146097);
       $l = $l - ArabicTools::_ardInt((146097 * $n + 3) / 4);
       $i = ArabicTools::_ardInt((4000 * ($l + 1)) / 1461001);
       $l = $l - ArabicTools::_ardInt((1461 * $i) / 4) + 31;
       $j = ArabicTools::_ardInt((80 * $l) / 2447);
       $d = $l - ArabicTools::_ardInt((2447 * $j) / 80);
       $l = ArabicTools::_ardInt($j / 11);
       $m = $j + 2 - 12 * $l;
       $y = 100 * ($n - 49) + $i + $l;
     } else {
       $j = $jd + 1402;
       $k = ArabicTools::_ardInt(($j - 1) / 1461);
       $l = $j - 1461 * $k;
       $n = ArabicTools::_ardInt(($l - 1) / 365) - ArabicTools::_ardInt($l / 1461);
       $i = $l - 365 * $n + 30;
       $j = ArabicTools::_ardInt((80 * $i) / 2447);
       $d = $i - ArabicTools::_ardInt((2447 * $j) / 80);
       $i = ArabicTools::_ardInt($j / 11);
       $m = $j + 2 - 12 * $i;
       $y = 4 * $k + $n + $i - 4716;
     }
     return "$d-$m-$y";
   }
}

#################################################################################################################################
###################################################  PrayerZoneTime  
#################################################################################################################################
function PrayerZoneTime($id) {
   $sql = "SELECT * FROM x_city_zone where city_id = '$id'";
   $result = mysql_query($sql);
   $row = mysql_fetch_array($result);
   $cityname = GetNameFromFiled("x_city","id",$id,"name");
   $countryname = GetNameFromFiled("x_country","id",$row['cn_id'],"name");
   $var = 'http://www.islamicfinder.org/prayer_service.php?';
   $var .= '&latitude='.$row['c_lat'];
   $var .= '&longitude='.$row['c_long'];
   ;
   $var .= '&timezone='.$row['zone'];
   $var .= '&pmethod='.$row['method'];
   $var .= '&simpleFormat=xml';
   $pray = simplexml_load_file($var);
   echo '<div class="C_NameZ">'.$countryname.'  | '.$cityname.' </div>';
   echo '<div class="t_zone">الفجر : <span>'.$pray->fajr.'</span></div>';
   echo '<div class="t_zone">الشروق : <span>'.$pray->sunrise.'</span></div>';
   echo '<div class="t_zone">ظهر : <span>'.$pray->dhuhr.'</span></div>';
   echo '<div class="t_zone">العصر : <span>'.$pray->asr.'</span></div>';
   echo '<div class="t_zone">مغرب : <span>'.$pray->maghrib.'</span></div>';
   echo '<div class="t_zone">العشاء : <span>'.$pray->isha.'</span></div>';
 }
 
 
 
 

 
?>