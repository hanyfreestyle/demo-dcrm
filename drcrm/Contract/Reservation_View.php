<?php
if(!defined('WEB_ROOT')) {	exit;}


######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

 
$row = $db->H_CheckTheGet("id","id","reservation","2");
$id = $row['id'];
extract($row);

##################################################################################################################
##################################################################################################################
##################################################################################################################
////  تغير حالة الحجز
if($row['type']== '1' and $row['state'] == '0'){ 
Form_Open($ArrForm);

$Rev_Arr = array('1'=> $AdminLangFile['contract_rev_update_1'] ,'2'=> $AdminLangFile['contract_rev_update_2']);
$Arr = array("StartFrom" => '1',"Label" => 'on');  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['contract_rev_update_h'],"col-md-4","update_id",$Rev_Arr,"req","",$Arr);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("Date",$AdminLangFile['contract_rev_date'],"new_date","0","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("Text",$AdminLangFile['contract_ref_num'],"ref_num_2","0","1","req",$MoreS);


echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['contract_notes'],"notes_2","0","0","option",$MoreS);
     
Form_Close("1");
echo BR.BR ;    
    
if(isset($_POST['B1'])){
    
 if($_POST['update_id'] == '1'){
    if(trim(Clean_Mypost($_POST['notes_2'])) == ""){
        SendJavaErrMass($AdminLangFile['contract_canel_err_mass']);
       $ErrForm = '1'; 
    }
 }   
    
 if($ErrForm != '1'){    
    Vall($Err,"Reservation_Update",$db,"1",$USER_PERMATION_Edit);
 }  
} 

##################################################################################################################
##################################################################################################################
##################################################################################################################


//// استمارة حجز ملغاه   
}elseif($row['type']== '1' and $row['state'] == '1'){
New_Print_Alert("3",$AdminLangFile['contract_canceled_view_mass']);    
PrintFildInformation("col-md-3",$AdminLangFile['contract_canceled_date'],ConvertDateToCalender_2($row['new_date']));
PrintFildInformation("col-md-3",$AdminLangFile['contract_canceled_num'],$row['ref_num_2']);
PrintFildInformation("col-md-6",$AdminLangFile['contract_canceled_notes'],$row['notes_2']);
echo '<div style="height:100px;"></div>' ;

##################################################################################################################
##################################################################################################################
##################################################################################################################

/////// عرض استمارة التعاقد
}elseif($row['type']== '2' and $row['state'] == '0'){
New_Print_Alert("1",$AdminLangFile['contract_mass_con_des']);     
PrintFildInformation("col-md-3",$AdminLangFile['contract_contract_date'],ConvertDateToCalender_2($row['new_date']));
PrintFildInformation("col-md-3",$AdminLangFile['contract_contract_num'],$row['ref_num_2']);
PrintFildInformation("col-md-6",$AdminLangFile['contract_contract_notes'],$row['notes_2']);
echo '<div style="height:100px;"></div>' ;


##################################################################################################################
##################################################################################################################
##################################################################################################################
 /////// الغاء التعاقد
}elseif($row['type']== '2' and $row['state'] == '1'){
New_Print_Alert("4",$AdminLangFile['contract_mass_cancel_des']);   

PrintFildInformation("col-md-3",$AdminLangFile['contract_dell_date'],ConvertDateToCalender_2($row['dell_date']));
PrintFildInformation("col-md-3",$AdminLangFile['contract_ref_num'],$row['ref_num_2']);
PrintFildInformation("col-md-6",$AdminLangFile['contract_dell_notes'],$row['dell_notes']);
echo '<div style="height:100px;"></div>' ;
 
New_Print_Alert("1",$AdminLangFile['contract_mass_con_des']);    
PrintFildInformation("col-md-3",$AdminLangFile['contract_contract_date'],ConvertDateToCalender_2($row['new_date']));
PrintFildInformation("col-md-3",$AdminLangFile['contract_contract_num'],$row['ref_num_2']);
PrintFildInformation("col-md-6",$AdminLangFile['contract_contract_notes'],$row['notes_2']);
echo '<div style="height:100px;"></div>' ;

  
}


 

##################################################################################################################
##################################################################################################################
##################################################################################################################
///// بيانات الوحدة
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


##################################################################################################################
##################################################################################################################
##################################################################################################################



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
echo '<div style="clear: both!important;"></div>';

$cust_idD =  $row['cust_id'];
$row_cust = $db->H_SelectOneRow( "SELECT * FROM customer where id = '$cust_idD'");




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
?>

<?php
echo '<a  class="ArButForm_Dell mb-sm btn btn-warning" href="index.php?view=List">'.$AdminLangFile['mainform_canceled_but'].'</a>';





######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>  

 