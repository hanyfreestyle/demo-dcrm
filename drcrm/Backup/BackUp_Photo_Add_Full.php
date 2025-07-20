<?php
if(!defined('WEB_ROOT')) {	exit;}
ini_set('max_execution_time', 600);
ini_set('memory_limit','1024M');

 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



  



$THESQL = "SELECT * FROM x_back_up where b_type = 'f_photo' ";
$already = $db->H_Total_Count($THESQL);

if($already < MAX_FULL_BACK ){
 
  LoadingDiv();  


$DB_ZipTypeIs = MySQLBackup_ZipTypeIs("zip"); /// 'sql', 'zip', 'gz', 'gzip'
$DB_NameIs = "FullBackup_";
$DB_FileName = $DB_NameIs.date('Y-m-d_H-i-s');
$DB_FileName_Extension = $DB_FileName.$DB_ZipTypeIs['Extension'];

HZip::zipDir(FULL_SOURS_PHOTO_DIR, BACK_PHOTO_FOLDER.$DB_FileName_Extension);



$server_data  = array ('id'=> NULL ,
    'date_add'=> TimeForToday() ,
    'name'=> $DB_FileName ,
    'path'=> $DB_FileName_Extension ,
    'type'=> "1" ,
    'state'=> "0" , 
    'b_type'=> "f_photo" , 
);


$add_server = $db->AutoExecute("x_back_up",$server_data,AUTO_INSERT);

Redirect_Page_2('index.php?view=PhotoFullList');


}else{
Redirect_Page_2('index.php?view=PhotoFullList');    
}    

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();

?>
 