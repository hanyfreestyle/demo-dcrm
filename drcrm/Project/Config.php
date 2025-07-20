<?php
if(!defined('WEB_ROOT')) {	exit;}

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$row = $db->H_SelectOneRow("SELECT * FROM  config_cat where cat_id = '$ConfigTabel' ");
$row =  unserialize($row['des']);
extract($row);


$ArrForm = array('FormClassConfig'=> '1');
Form_Open($ArrForm);
 
 
$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" ', 'Dir'=> "En"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['mainconfig_count_unit_per_page'],"perpage_unit","1","1","req",$MoreS);


$Arr = array("StartFrom" => '1',"Label" => 'on');  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['mainconfig_view_content_by'],"col-md-3","order_by_unit",$Order_ByList,"req",$order_by_unit,$Arr);
 

NF_PrintRadio_Active ("2_Line","col-md-3","Data Tabel","datatabel",$datatabel);

NF_PrintRadio_Active ("2_Line","col-md-3","Print Button Name","but_name",$but_name);




Form_Close_New("2","List");

if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$USER_PERMATION_Edit);
}

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>