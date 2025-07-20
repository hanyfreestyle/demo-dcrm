<?php
 

$row = $db->H_CheckTheGet("id","id","x_back_up","2");

if($row['b_type']=="sql"){
$file = BACKUP_FOLDER_DIR.$row['path'];    
}elseif($row['b_type']=="f_photo"){
$file = BACK_PHOTO_FOLDER.$row['path'];       
}elseif($row['b_type']=="m_photo"){
$file = BACK_PHOTO_FOLDER.$row['path'];       
}

$fileNAme = GetNameWithNoExt_2($row['path']);
$Exten =  GetExOfFile($row['path']);
$Name = $fileNAme.'.'.$Exten['Exten'];
Download_File($file,$Name);

?>