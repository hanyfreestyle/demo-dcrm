<?php
if(!defined('WEB_ROOT')) {	exit;}
 
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$id =  $RowUsreInfo['user_id'];



if(isset($_POST['DletePhoto'])){
Image_Dell_User_But($id);
}    
    
    
    
$sql = "SELECT * FROM tbl_user where user_id = '$id' ";
$row = $db->H_SelectOneRow($sql);

Form_Open($ArrForm);
//hidden
echo '<input type="hidden" value="'.$row['user_id'].'" name="user_id" />';
echo '<input type="hidden" value="'.$row['photo'].'" name="old_photo" />'; 
 

PrintFildInformation("col-md-3",$AdminLangFile['users_user_name'],$row['user_name']);

PrintFildInformation("col-md-3",$AdminLangFile['users_name'],$row['name']);

/*
PrintFildInformation("col-md-3","Authentication Code",$row['google_code']);
PrintFildInformation("col-md-3","Telegram Code",$row['telegram_code']); 
 */
 
echo '<div style="clear: both!important;"></div>';
 

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="email"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['users_email'],"email","1","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-minlength="11"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['users_mobile'],"mobile","1","0","req",$MoreS);

echo '<div style="clear: both!important;"></div>'.BR;


if(USER_PROFILE_UPDATE_IMG == '1'){
$Arr= array("Col"=> "col-md-6" ,"name"=> "photo" ,'required' => '',"photo"=> $row['photo'] ,"path"=> F_PATH_V ,"Dell_But"=>'1',"StopView"=>'1') ;
New_PrintFilePhoto("Edit",$Arr);
}



Form_Close("2");


if(isset($_POST['B1'])){
Vall($Err,"EditUserProfile",$db,"1","1");
} 

    
          

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

	
?>