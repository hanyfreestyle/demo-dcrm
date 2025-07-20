<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$TabelNameIs = "customer_notes";
$row = $db->H_CheckTheGet("id","id",$TabelNameIs,"2");
$id = $row['id'];
$CustId = $row['cust_id'];


if(isset($_GET['Confirm'])){
    $db->H_DELETE_FromId($TabelNameIs,$id);
    Redirect_Page_2("index.php?view=Profile&id=".$CustId);
}else{
    PrintFildInformation("",$AdminLangFile['customer_notes'],$row['notes']);
    echo '<div style="clear: both!important;"></div>'.BR;
    New_Print_Alert("4",$AdminLangFile['customer_notes_dell_confim']);
    PrintDeleteButConfirm("Profile&id=".$CustId,"NotesDelete&id=".$id);
}





###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>
 