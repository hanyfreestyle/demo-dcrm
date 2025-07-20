<?php
 require_once '../include/inc_reqfile.php';
 require_once '_index_config.php';
 $AdminConfig = checkUser();
 $GroupPermation = $AdminConfig[USERPERMATION_EDIT];

$NewVall = $_GET['newvall'];
$Fild = $_GET['fild'];

$sql = "SELECT * FROM  config_cat  where cat_id = '$ConfigTabel' ";
$row = $db->H_SelectOneRow($sql);
$des =  unserialize($row['des']);
$des = replace_key($Fild,$NewVall, $des);
$Data = serialize($des);
$server_data = array ('des'=> $Data , );
$add_server = $db->AutoExecute("config_cat",$server_data,AUTO_UPDATE,"cat_id = '$ConfigTabel'");

?>