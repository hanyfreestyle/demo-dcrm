<?php
if(!defined('WEB_ROOT')) {	exit;}
 
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$DellConfimUrl = $view ;
$TabelName = "project_area";
$Related_TabelName = "project";
$CountFilde =  'area_id';
$Redirect_Page = "AreaList";


$row = $db->H_CheckTheGet("id","id",$TabelName,"2");
$id = $row['id'];

if($row['count'] >=  '1'){
    New_Print_Alert("4",$AdminLangFile['mainform_err_dell_mass']." ".$row[$NamePrint]);
    PrintDeleteButConfirm($Redirect_Page,"");
}else{

    $already = $db->H_Total_Count("SELECT id FROM $Related_TabelName WHERE $CountFilde = '$id'");
    if($already > 0) {
        UpdateFildeForDell($TabelName,"count",$already,$id) ;
        New_Print_Alert("4",$AdminLangFile['mainform_err_dell_mass']." ".$row[$NamePrint]);
        PrintDeleteButConfirm($Redirect_Page,"");
    }else{

        if(isset($_GET['Confirm'])){
            $db->H_DELETE_FromId($TabelName,$id);
            Redirect_Page_2("index.php?view=".$Redirect_Page);
        }else{
            New_Print_Alert("4",$AdminLangFile['mainform_confirm_dell_mass']." ".$row[$NamePrint]);
            PrintDeleteButConfirm($Redirect_Page,$DellConfimUrl."&id=".$id);
        }
    }

}

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page(); 

?>
 