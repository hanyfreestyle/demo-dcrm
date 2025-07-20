<?php
 require_once '../include/inc_reqfile.php';
 require_once '_index_config.php';
 require_once 'Process.php';
 
$Cat_Id =  $_GET['Cat_Id'];

$Lsit_SQL_Line ="select * from project_floor  where pro_id = '$Cat_Id' ";
$Arr = array("Label" => 'on' ,'SQL_Line_Send'=> $Lsit_SQL_Line );      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['project_floor_name'],"col-md-3","floor_id","","optin",0,$Arr);	



?>