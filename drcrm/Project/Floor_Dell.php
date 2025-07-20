<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id","project_floor","2");
$id = $row['id'];

if($row['state'] == '0'){
    if(isset($_GET['Confirm'])){
        $db->H_DELETE_FromId("project_floor",$id);
        CountProjectInfo();
        Redirect_Page_2("index.php?view=Floor_List&id=".$row['pro_id']);
    }else{
        $Mass = $AdminLangFile['project_flo_del_mas_conf']." ".$row['name'].BR;
        $Mass .= $AdminLangFile['project_pro_name']." ".GetNameFromID("project",$row['pro_id'],$NamePrint);
        New_Print_Alert("4",$Mass);
        PrintDeleteButConfirm("Floor_List&id=".$row['pro_id'],"FloorDell&id=".$id);
    }
}else{
    New_Print_Alert("4",$AdminLangFile['project_flo_del_mas_err']);
}

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
