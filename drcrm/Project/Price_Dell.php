<?php
if(!defined('WEB_ROOT')) {	exit;}
 
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id","project_price","2");
$id = $row['id'];
$ProUrlId = $row['pro_id'];
extract($row);

if($row['count'] == '0'){
    if(isset($_GET['Confirm'])){
        $db->H_DELETE_FromId("project_price",$id);
        Redirect_Page_2("index.php?view=Price_List&Project_Id=".$row['pro_id']);
    }else{
        New_Print_Alert("4",$AdminLangFile['project_flo_del_mas_conf']." ".$row['name']);
        PrintDeleteButConfirm("Price_List&Project_Id=".$ProUrlId,"Price_Dell&id=".$id);
    }
}else{
    New_Print_Alert("4",$AdminLangFile['pro_price_price_del_err']);
    PrintDeleteButConfirm("Price_List&Project_Id=".$ProUrlId,"");
}



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 