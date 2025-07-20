<?php
require_once '../include/inc_reqfile.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['SendSmS'])){
   $ThIsIsTest = '0'; 
//print_r3($_POST);    
    
$url = "http://smssmartegypt.com/sms/api/?";
$username = $_POST['username'];
$password = $_POST['password'];
$sendername = $_POST['sendername'];
$Des = $_POST['des'];



 
 
$CustList = $db->SelArr($_POST['sql_line']);
$ToTal_Send = '0' ;
$SendMobile = "";
for($i = 0; $i < count($CustList); $i++) {

if($CustList[$i]['mobile_2']){
  $Mobile = $CustList[$i]['mobile'].",".$CustList[$i]['mobile_2'];
  $SendMobile = $SendMobile.",".$Mobile ;
  $ToTal_Send = $ToTal_Send + 2 ; 
}else{
 $Mobile = $CustList[$i]['mobile'];
 $SendMobile = $SendMobile.",".$Mobile ;
 $ToTal_Send = $ToTal_Send + 1 ;    
}
}
 
$SendMobile = MoveFirstWord($SendMobile);
$body = 'username='.$username.'&password='.$password.'&sendername='.$sendername.'&mobiles='.$SendMobile.'&message='.$Des;
//$result = get_data($url, $body);

if($ThIsIsTest == '1'){
 echo $body.BR;   
}else{
$result = get_data($url, $body);    
}

  

 
    $server_data  = array ('id'=> NULL ,
    'date_add'=> TimeForToday() ,
    'date_time'=> time() ,
    'type'=>  $_POST['type'] ,
    'name'=> $_POST['name'] ,
    'des'=> $_POST['des'] ,
    'count'=> $_POST['count'] ,
    'total'=> $ToTal_Send ,
    );
    
    
   if($ThIsIsTest == '1'){
     print_r3($server_data);   
    }else{
      $add_server = $db->AutoExecute("sms_report",$server_data,AUTO_INSERT);
      Redirect_Page_2("index.php?view=Report");    
    }


}



function get_data($url, $body){
    //$userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
    $ch      = curl_init();
    $timeout = 7;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    //curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}


   	
?>