<?php
if(!defined('WEB_ROOT')) {	exit;}
ini_set('max_execution_time', 600);
ini_set('memory_limit','1024M');
 
 
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
LoadingDiv(); 


use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;
use Kunnu\Dropbox\Exceptions\DropboxClientException;	

 
$row = $db->H_CheckTheGet("id","id","x_back_up","2");
$id = $row['id'];


$OPenDive = '1';

if($row['state'] == '0' and DROPBOX_BACK_UP == '1' and $OPenDive == '1'){




     
$DB_FileName_Extension = $row['path'];

#################################################################################################################################
###################################################   DropBox  Config
#################################################################################################################################
//($clientId, $, $accessToken = null)
$DropBox_clientId = "tf0y4b33ubji5ws"; 
$DropBox_clientSecret = "ddilrarllj14pc6";
$DropBox_accessToken = "_xdL2CZdYIAAAAAAAAAE7S_gjg2CNwXx1Nshs0xLkxJYe4cA4BIDvFEfJYoPvhd-";
$Month = date("m",time()); $Year =  date("Y",time());
$DropBox_UploadFolder = "/DiarCrm/PhotoBackup/".$Year."-".$Month;

$app = new DropboxApp($DropBox_clientId , $DropBox_clientSecret ,$DropBox_accessToken );
$dropbox = new Dropbox($app);

$dropboxFile = new DropboxFile(BACK_PHOTO_FOLDER.$DB_FileName_Extension);
$file = $dropbox->simpleUpload($dropboxFile, $DropBox_UploadFolder."/".$DB_FileName_Extension, ['autorename' => true]);
 

$server_data  = array ('state'=> "1");
$add_server = $db->AutoExecute("x_back_up",$server_data,AUTO_UPDATE,"id = $id");

if($row['b_type']=='f_photo'){
 Redirect_Page_2('index.php?view=PhotoFullList');     
}elseif($row['b_type']=='m_photo'){
Redirect_Page_2('index.php?view=PhotoMonthlyList');    
}

 
   
}

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();   
 
?>
 