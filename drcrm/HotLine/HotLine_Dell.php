<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

if($AdminConfig['leads_dell'] == '1'){
    $row = $db->H_CheckTheGet("id","id","c_leads","2");
    $id = $row['id'];
    if(isset($_GET['Confirm'])){
        $db->H_DELETE_FromId("c_leads",$id) ;
        Redirect_Page_2("index.php?view=List");
    }else{
        New_Print_Alert("4",$AdminLangFile['mainform_confirm_dell_mass']." ".$row['name']);
        PrintDeleteButConfirm("List","Dell&id=".$id);
    }
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
