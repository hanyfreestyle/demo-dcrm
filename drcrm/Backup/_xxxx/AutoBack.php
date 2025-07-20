<?php
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;
use Kunnu\Dropbox\Exceptions\DropboxClientException;


require_once '../include/inc_reqfile.php';
require "ThirdParty/vendor/autoload.php";
define('BACKUP_FOLDER_DIR',__DIR__."/File/");
 
 
 
 /*
define('BACKUP_DIR','/home2/rockegblue/public_html/bluecrm/');
require BACKUP_DIR."Backup/ThirdParty/vendor/autoload.php";
define('BACKUP_FOLDER_DIR',__DIR__."/File/");


/*
#################################################################################################################################
###################################################    DB  Config
#################################################################################################################################
@$pfw_host = 'localhost';
@$pfw_user = 'rockegbl_usr2018';
@$pfw_pw = 'Pass@Y@@1587Iadmin';
@$pfw_db = 'rockegbl_crm2018';


#################################################################################################################################
###################################################    DB  Config
#################################################################################################################################
$DB_ZipTypeIs = MySQLBackup_ZipTypeIs("zip"); /// 'sql', 'zip', 'gz', 'gzip'
$DB_NameIs = "AutoBlueCrm_";
$DB_FileName = $DB_NameIs.date('Y-m-d_H-i-s');
$DB_FileName_Extension = $DB_FileName.$DB_ZipTypeIs['Extension'];

#################################################################################################################################
###################################################   DropBox  Config
#################################################################################################################################
//($clientId, $, $accessToken = null)
$DropBox_clientId = "tf0y4b33ubji5ws"; 
$DropBox_clientSecret = "ddilrarllj14pc6";
$DropBox_accessToken = "_xdL2CZdYIAAAAAAAAAE7S_gjg2CNwXx1Nshs0xLkxJYe4cA4BIDvFEfJYoPvhd-";
$Month = date("m",time()); $Year =  date("Y",time());
$DropBox_UploadFolder = "/bluerock/sqlbackup/".$Year."-".$Month;


#################################################################################################################################
###################################################    Creat BackUp
#################################################################################################################################
	$connection = [
		'host'=> $pfw_host,
		'database'=> $pfw_db,
		'user'=> $pfw_user ,
		'password'=> $pfw_pw,
	];
	$tables = ['*'];
//	$tables = ['tbl_user'];
    $show = ['TABLES', 'DATA'];
	$backup = new BackupMySQL($connection, $tables, $show);
	$backup->setFolder(BACKUP_FOLDER_DIR);
	$backup->setName($DB_FileName);
	$backup->run();
    $backup->zip($DB_ZipTypeIs['ZipType']);



#################################################################################################################################
###################################################    Move To DropBox
#################################################################################################################################

$app = new DropboxApp($DropBox_clientId , $DropBox_clientSecret ,$DropBox_accessToken );
$dropbox = new Dropbox($app);
$dropboxFile = new DropboxFile(BACKUP_FOLDER_DIR.$DB_FileName_Extension);
$file = $dropbox->simpleUpload($dropboxFile, $DropBox_UploadFolder."/".$DB_FileName_Extension, ['autorename' => true]);
$Satet_Upload = "1";


#################################################################################################################################
###################################################    Add To Tabel
#################################################################################################################################
$db = new DB($pfw_host,$pfw_user,$pfw_pw,$pfw_db);

$server_data  = array ('id'=> NULL ,
    'date_add'=> strtotime('today 00:00:00') ,
    'name'=> $DB_FileName ,
    'path'=> $DB_FileName_Extension ,
    'type'=> "2" ,
    'state'=> $Satet_Upload ,  
    'b_type'=> "sql" ,
);


$add_server = $db->AutoExecute("x_back_up",$server_data,AUTO_INSERT);
*/
?>