<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id","user_group","2");
$id = $row['id'];
 
if($AdminConfig['admin'] == '1' and $id != '1') {
    if($row['count'] == '0'){
        if(isset($_GET['Confirm'])){
            $db->H_DELETE_FromId("user_group",$id);
            $db->H_DELETE("DELETE FROM user_permission WHERE group_id ='$id'")  ;
            Redirect_Page_2("index.php?view=Cat_List");
        }else{
            New_Print_Alert("4",$AdminLangFile['users_dell_cat_confirm']." ".$row['name']);
            PrintDeleteButConfirm("Cat_List","Cat_Dell&id=".$id); 
        }
    }else{
        New_Print_Alert("4",$AdminLangFile['users_dell_cat_err']); 
        PrintDeleteButConfirm("Cat_List","");
    }
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
 