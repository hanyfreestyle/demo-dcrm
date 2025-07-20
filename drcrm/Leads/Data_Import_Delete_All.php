<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

if($AdminConfig['leads_dell'] == '1'){
 
    if(isset($_GET['Confirm'])){
        $db->H_EmptyTabel("facebook_data");
        Redirect_Page_2("index.php?view=ListImportLeads");
    }else{
        $Mass = $ALang['leads_delete_all_data_mass'] ;
        $Already = $db->H_Total_Count("SELECT id FROM facebook_data ");
        ReportBlockPrint("col-md-3",$AdminLangFile['report_totalcount'],$Already,"fa-hdd-o","alert-inverse");
        echo '<div style="clear: both!important;"></div> ';  
   
        New_Print_Alert("4",$Mass);
        PrintDeleteButConfirm("ListImportLeads","DeleteAllData");

    }
}



###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page(); 
?>
 