<?php
if(!defined('WEB_ROOT')) {	exit;}
 

$SMS_Count_Arr = array(
'1'=> $AdminLangFile['sms_arr_mass_1'],
'2'=> $AdminLangFile['sms_arr_mass_2'],
'3'=> $AdminLangFile['sms_arr_mass_3'],
);


function Rterun_SMS_Type($state) {
    global $AdminLangFile ;
   switch($state) {
     case "1":
       $order = $AdminLangFile['sms_sms_type_1'];
       break;
     case "2":
       $order = $AdminLangFile['sms_sms_type_2'];
       break;
     default:
       $order = '';
   }
   return $order;
}

function Rterun_SMS_Ar_Letter($state) {
    global $AdminLangFile ;
   switch($state) {
     case "1":
       $order = "70";
       break;
     case "2":
       $order = "134";
       break;
     case "3":
       $order = "201";
       break;
     default:
       $order = '';
   }
   return $order;
}


function Rterun_SMS_En_Letter($state) {
    global $AdminLangFile ;
   switch($state) {
     case "1":
       $order = "160";
       break;
     case "2":
       $order = "306";
       break;
     case "3":
       $order = "459";
       break;
     default:
       $order = '';
   }
   return $order;
}

 
?>