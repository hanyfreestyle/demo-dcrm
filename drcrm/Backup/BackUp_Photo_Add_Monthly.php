<?php
if(!defined('WEB_ROOT')) {	exit;}
ini_set('max_execution_time', 600);
ini_set('memory_limit','1024M');

 
 ######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);





$Month = date("m",time());
$Year =  date("Y",time());
$ThisDate = $Year."-".$Month ;
$THESQL = "SELECT * FROM x_back_up where b_type = 'm_photo' and date_month = '$ThisDate' ";
$already = $db->H_Total_Count($THESQL);

if($already < MAX_MONTHLY_BACK ){
 
  LoadingDiv();  
  
  
$DB_ZipTypeIs = MySQLBackup_ZipTypeIs("zip"); /// 'sql', 'zip', 'gz', 'gzip'
$DB_NameIs = "Monthly_";
$DB_FileName = $DB_NameIs.date('Y-m-d_H-i-s');
$DB_FileName_Extension = $DB_FileName.$DB_ZipTypeIs['Extension'];

HZip::zipDir(MONTH_SOURS_PHOTO_DIR, BACK_PHOTO_FOLDER.$DB_FileName_Extension);



$server_data  = array ('id'=> NULL ,
    'date_add'=> TimeForToday() ,
    'name'=> $DB_FileName ,
    'path'=> $DB_FileName_Extension ,
    'type'=> "1" ,
    'state'=> "0" , 
    'b_type'=> "m_photo" , 
    'date_month'=> $ThisDate ,
);


$add_server = $db->AutoExecute("x_back_up",$server_data,AUTO_INSERT);

Redirect_Page_2('index.php?view=PhotoMonthlyList');


}else{
Redirect_Page_2('index.php?view=PhotoMonthlyList');    
}    

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();

?>
 