<?php
if(!defined('WEB_ROOT')) {	exit;}
ini_set('max_execution_time', 600);
ini_set('memory_limit','1024M');
 
 

#LoadingDiv();  
 
$Satet_Upload = "0";

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;
use Kunnu\Dropbox\Exceptions\DropboxClientException;

#################################################################################################################################
###################################################    DB  Config
#################################################################################################################################
$DB_ZipTypeIs = MySQLBackup_ZipTypeIs("zip"); /// 'sql', 'zip', 'gz', 'gzip'
$DB_NameIs = "DiarCrm_";
$DB_FileName = $DB_NameIs.date('Y-m-d_H-i-s');
$DB_FileName_Extension = $DB_FileName.$DB_ZipTypeIs['Extension'];

 

$DropBox_clientId = "hzpvst0jcryrg5a"; 
$DropBox_clientSecret = "tkqzsa3ucl6fcu4";
$DropBox_accessToken = "hK84wDvSuLAAAAAAAAAACIHnzso8Vppca3Igdc1tgZU2EZoA4kPLtKrVcz5HqmKy";
$Month = date("m",time()); $Year =  date("Y",time());
$DropBox_UploadFolder = "/DiarCrm/sql/".$Year."-".$Month;



#################################################################################################################################
###################################################    Creat BackUp
#################################################################################################################################
	$connection = [
		'host'=> $pfw_host,
		'database'=> $pfw_db,
		'user'=> $pfw_user ,
		'password'=> $pfw_pw,
	];
	#$tables = ['*'];
	#$tables = ['tbl_user'];
    $show = ['TABLES', 'DATA'];
	$backup = new BackupMySQL($connection, $tables, $show);
	$backup->setFolder(BACKUP_FOLDER_DIR);
	$backup->setName($DB_FileName);
    #$backup->setTables(array("*", "sales_ticket", "sales_ticket_des" ));
    #$backup->setTables(array("z_sales_ticket_2018","z_sales_ticket_des_2018"));
    $backup->setTables(array("*", "z_sales_ticket_2018", "z_sales_ticket_2019","z_sales_ticket_2020","z_sales_ticket_2021","z_sales_ticket_2022","z_sales_ticket_des_2018","z_sales_ticket_des_2019","z_sales_ticket_des_2020","z_sales_ticket_des_2021","z_sales_ticket_des_2022" ));
	$backup->run();
    $backup->zip($DB_ZipTypeIs['ZipType']);
        

if(DROPBOX_BACK_UP == '1'){
$app = new DropboxApp($DropBox_clientId , $DropBox_clientSecret ,$DropBox_accessToken );
$dropbox = new Dropbox($app);
}

if(DROPBOX_BACK_UP == '1'){
$dropboxFile = new DropboxFile(BACKUP_FOLDER_DIR.$DB_FileName_Extension);
$file = $dropbox->simpleUpload($dropboxFile, $DropBox_UploadFolder."/".$DB_FileName_Extension, ['autorename' => true]);
$Satet_Upload = "1";
}


$server_data  = array ('id'=> NULL ,
    'date_add'=> TimeForToday() ,
    'name'=> $DB_FileName ,
    'path'=> $DB_FileName_Extension ,
    'type'=> "1" ,
    'state'=> $Satet_Upload ,  
    'b_type'=> "sql" ,
);


$db->AutoExecute("x_back_up",$server_data,AUTO_INSERT);

Redirect_Page_2('index.php?view=List');

 
?>
 