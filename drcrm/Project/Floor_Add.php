<?php
if(!defined('WEB_ROOT')) {	exit;}

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id","project","2");
$ProjectId = $row['id'];


$CountFloor = $db->H_Total_Count("SELECT * FROM project_floor WHERE pro_id = '$ProjectId'");

#################################################################################################################################
###################################################    
#################################################################################################################################
echo '<div class="alert alert-info alert-dismissable Arr_Mass">';
echo $AdminLangFile['project_floor_add_mass']." ".$row['name'].BR;
echo $AdminLangFile['project_floor_last_mass']." ".$CountFloor.BR;
if($CountFloor != '0'){
    $Name = $db->SelArr("SELECT * FROM project_floor where pro_id = '$ProjectId' ORDER BY f_code ");
    echo " ( " ;
    for($i = 0; $i < count($Name); $i++) {
        echo $Name[$i]['name'] ." " ;
        $f_unit_new  =  $Name[$i]['unit'] ;
    }
    echo " ) " ;
    $FilterIdFloor = GetInfoforFloor_New($ProjectId) ;
}else{
    $f_unit_new = "";
    $FilterIdFloor = "";
}
echo '</div>';



#################################################################################################################################
###################################################    
#################################################################################################################################  
Form_Open();
echo '<input type="hidden" name="pro_id" value="'.$ProjectId.'" />';

$Lsit_SQL_Line = "SELECT * FROM project_floor_name WHERE id != 0 $FilterIdFloor " ;
$Arr = array("Label" => 'on' ,'SQL_Line_Send'=> $Lsit_SQL_Line );    
$Err[] = NF_PrintSelect_2018("Chosen",$ALang['project_floor_name'],"col-md-4","name","","req",0,$Arr);	
 
$Arr = array("Label" => 'on',"ChangePrintVall"=> '0' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['project_floor_u_count'],"col-md-4","unit",$FloorCodeArr,"req",$f_unit_new,$Arr);

echo '<div style="clear: both!important;"></div>';

Form_Close_New("1","Floor_List&id=".$ProjectId);

#################################################################################################################################
###################################################
#################################################################################################################################
if(isset($_POST['B1'])){
    $ThisFloorCode = GetNameFromID("project_floor_name", $_POST['name'],"code");
    $already = $db->H_Total_Count("SELECT * FROM project_floor WHERE pro_id = '$ProjectId' and f_code = '$ThisFloorCode' ");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['project_floor_code_err']);
    }else{
        Vall($Err,"AddFloor",$db,"1",$USER_PERMATION_Add);
    }
}



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 