<?php
if(!defined('WEB_ROOT')) {	exit;}
 
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id","reservation","2");
$id = $row['id'];
extract($row);

 

if($row['type']== '2' and $row['state'] == '0' and  $AdminConfig['admin'] == '1'  ){


echo '<div class="alert alert-warning alert-dismissable Arr_Mass">';
echo $AdminLangFile['contract_cont_mass_conifrm'];
echo '</div>';


echo '<div style="clear: both!important;"></div>';
Form_Open($ArrForm);


$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("Date",$AdminLangFile['contract_dell_date'],"dell_date","1","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("Text",$AdminLangFile['contract_ref_num'],"dell_num","1","1","req",$MoreS);
 
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['contract_dell_notes'],"dell_notes","1","0","req",$MoreS);



Form_Close_New("1","Contract");
if(isset($_POST['B1'])){
if($ErrForm != '1'){    
Vall($Err,"Contract_Dell",$db,"1",$USER_PERMATION_Dell);
}  
}            
    
 
echo '<div style="clear: both!important;"></div>';

New_Print_Alert("1",$AdminLangFile['contract_mass_con_des']);  
PrintFildInformation("col-md-3",$AdminLangFile['contract_contract_date'],ConvertDateToCalender_2($row['new_date']));
PrintFildInformation("col-md-3",$AdminLangFile['contract_contract_num'],$row['ref_num_2']);
PrintFildInformation("col-md-6",$AdminLangFile['contract_contract_notes'],$row['notes_2']);
echo '<div style="height:100px;"></div>' ;


    



echo '<div style="clear: both!important;"></div>';
New_Print_Alert("5",$AdminLangFile['contract_mass_rev_unit_des']);

$ProjectName = GetNameFromID("project",$row['pro_id'],"name");
PrintFildInformation("col-md-3",$AdminLangFile['project_pro_name'],$ProjectName);

$FloorName = GetNameFromID("project_floor",$row['floor_id'],"name");
PrintFildInformation("col-md-3",$AdminLangFile['project_floor_name'],$FloorName);

$UnitCode = GetNameFromID("project_unit",$row['unit_id'],"p_code");
PrintFildInformation("col-md-3",$AdminLangFile['project_unit_code'],$UnitCode);

$UnitArea = GetNameFromID("project_unit",$row['unit_id'],"u_area");
PrintFildInformation("col-md-3",$AdminLangFile['project_unit_area_sq'],$UnitArea." M");


echo '<div style="clear: both!important;"></div>';

if($row['ref_num'] != ""){
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("5",$AdminLangFile['contract_mass_rev_des']);        
PrintFildInformation("col-md-3",$AdminLangFile['contract_rev_date'],ConvertDateToCalender_2($row['rev_date']));
PrintFildInformation("col-md-3",$AdminLangFile['contract_cont_date'],ConvertDateToCalender_2($row['cont_date']));
PrintFildInformation("col-md-3",$AdminLangFile['contract_ref_num'],$row['ref_num']);   
}


##################################################################################################################
##################################################################################################################
##################################################################################################################
/// بيانات العميل
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("5","بيانات العميل");

$cust_idD =  $row['cust_id'];
$row_cust = $db->H_SelectOneRow("SELECT * FROM customer where id = '$cust_idD'");
PrintFildInformation("col-md-4",$AdminLangFile['contract_cust_id'],$row_cust['name']);

if( $row['cust2_id'] != '0'){
$cust2_idD =  $row['cust2_id'];
$row_cust2 = $db->H_SelectOneRow("SELECT * FROM customer where id = '$cust2_idD'");
PrintFildInformation("col-md-4",$AdminLangFile['contract_cust_id']." 2",$row_cust2['name']);   
}


if( $row['cust3_id'] != '0'){
$cust3_idD =  $row['cust3_id'];
$row_cust3 = $db->H_SelectOneRow("SELECT * FROM customer where id = '$cust3_idD'");
PrintFildInformation("col-md-4",$AdminLangFile['contract_cust_id']." 3",$row_cust3['name']);   
}


echo '<div style="clear: both!important;"></div>';

PrintCustInfoCol($row_cust);

if( $row['cust2_id'] != '0'){
PrintCustInfoCol($row_cust2,"2");    
}   

if( $row['cust3_id'] != '0'){
PrintCustInfoCol($row_cust3,"3");    
}






echo '<div style="clear: both!important;"></div>';
$emp_id =  GetNameFromID_User("tbl_user",$row['emp_id'],"name") ;
PrintFildInformation("col-md-6",$AdminLangFile['contract_emp_id'],$emp_id);

PrintFildInformation("col-md-6",$AdminLangFile['contract_notes'],$row['notes']);
echo '<div style="clear: both!important;"></div>';

}



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 