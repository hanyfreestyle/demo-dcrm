<?php
if(!defined('WEB_ROOT')) {	exit;}
 


######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
$ThISTabelName = "project";
 
$row = $db->H_CheckTheGet("id","id",$ThISTabelName,"2");
$id = $row['id'];
extract($row);


#################################################################################################################################
###################################################    
#################################################################################################################################
if(isset($_GET['Confirm'])){

    $sql = "DELETE FROM project_floor WHERE pro_id ='$id'" ;
    $db->H_DELETE($sql);

    $sql = "DELETE FROM project_unit WHERE pro_id ='$id'" ;
    $db->H_DELETE($sql);

    $sql = "DELETE FROM project_price WHERE pro_id ='$id'" ;
    $db->H_DELETE($sql);

    $sql = "DELETE FROM reservation WHERE pro_id ='$id'" ;
    $db->H_DELETE($sql);

    $sql =  "DELETE FROM project WHERE id ='$id'" ;
    $db->H_DELETE($sql);

    CountProjectArea();
    Redirect_Page_2("index.php?view=List");

}else{

    $Floor_Count = $db->H_Total_Count("SELECT * FROM project_floor WHERE pro_id = '$id'");
    $Unit_Count = $db->H_Total_Count("SELECT * FROM project_unit  WHERE pro_id = '$id'");
    $Price_Count = $db->H_Total_Count("SELECT * FROM project_price  WHERE pro_id = '$id'");
    $Reservation_Count = $db->H_Total_Count("SELECT * FROM reservation  WHERE pro_id = '$id'");

    echo '<div class="alert alert-warning alert-dismissable Arr_Mass">';
    echo $AdminLangFile['project_pro_dell_w_1'].BR;
    echo $AdminLangFile['project_pro_dell_w_count']." ".$Floor_Count." ".$AdminLangFile['project_pro_dell_w_floor'].BR;
    echo $AdminLangFile['project_pro_dell_w_count']." ".$Unit_Count." ".$AdminLangFile['project_pro_dell_w_unit'].BR;
    echo $AdminLangFile['project_pro_dell_w_count']." ".$Price_Count." ".$AdminLangFile['project_pro_dell_w_price'].BR;
    echo $AdminLangFile['project_pro_dell_w_count']." ".$Reservation_Count." ".$AdminLangFile['project_pro_dell_w_rev'].BR;
    echo '</div>';

    New_Print_Alert("4",$AdminLangFile['project_pro_dell_mas_confirm']." ".$row[$NamePrint]);
    PrintDeleteButConfirm("List","ProjectDell&id=".$id);

}



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 