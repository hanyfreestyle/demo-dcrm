<?php
if(!defined('WEB_ROOT')) {	exit;}

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

 
$row = $db->H_CheckTheGet("id","id","project_unit","2");
$id = $row['id'];
extract($row);
 

$PrrrrrId = $row['pro_id'] ;

Form_Open($ArrForm);
echo '<input type="hidden" value="'.$row['floor_id'].'"  name="flo_id"/>';
$ProjectName = GetNameFromID("project",$row['pro_id'],"name");
PrintFildInformation("col-md-4",$AdminLangFile['project_pro_name'],$ProjectName);
$FloorName = GetNameFromID("project_floor",$row['floor_id'],"name");
PrintFildInformation("col-md-4",$AdminLangFile['project_floor_name'],$FloorName);

$ProjectCode  = GetNameFromID("project",$row['pro_id'],"pro_code");
PrintFildInformation("col-md-4",$AdminLangFile['project_new_unit_code'],$ProjectCode.$row['p_code']);
echo '<div style="clear: both!important;"></div>';


$Lsit_SQL_Line = "SELECT * FROM project_price where pro_id = '$PrrrrrId' ";
$Arr = array("Label" => 'on' ,'SQL_Line_Send'=> $Lsit_SQL_Line );      
$Err[] = NF_PrintSelect_2018("Chosen",$ALang['pro_price_tabel_name'],"col-md-3","price_id","","req",$price_id,$Arr);	

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['project_unit_area_sq'],"u_area","1","0","req-num",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['pdf_g_area'],"g_area","1","0","req-num",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['project_new_unit_num'],"u_num","1","0","req-num",$MoreS);

echo '<input type="hidden" value="'.$row['pro_id'].'"  name="thispro_id"/>';


echo '<div style="clear: both!important;"></div>';


if($state == '2' or $state == '3'){
echo '<input type="hidden" value="'.$state.'"  name="state"/>';    
}else{
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['project_unit_state_t'],"state",$state);    
}

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['project_unit_notes'],"notes","0","0","option",$MoreS);
echo '<div style="clear: both!important;"></div>';


Form_Close_New("2","UnitList&Floor_Id=".$row['floor_id']);

if(isset($_POST['B1'])){
Vall($Err,"Edit_Unit",$db,"1",$USER_PERMATION_Edit);
}  


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();          
?>
 