<?php
if(!defined('WEB_ROOT')) {	exit;}
Module_InCFile();
 
echo '<div class="row ShortMenu"><div class="col-md-12">';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Add").'"  href="index.php?view=Add">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['customer_add'].'</a>';

if(F_CUSTOMER_CONTRACT){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("AddContract").'"  href="index.php?view=AddContract">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['customer_add_contract'].'</a>';
}

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("FilterCust").'"  href="index.php?view=FilterCust">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['customer_filter'].'</a>';


if($AdminConfig['admin'] == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ExportCust").'"  href="index.php?view=ExportCust">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['customer_exportcust'].'</a>';
}


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Search").'"  href="index.php?view=Search">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['customer_customer_search'].'</a>';



if($USER_PERMATION_Edit == '1'){

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("UpDate").'"  href="index.php?view=UpDate">
<i class="fa fa-refresh"></i>'.$AdminLangFile['managedate_update'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$AdminLangFile['mainform_tap_section_settings'].'</a>';
}
 
 
 
echo '<div style="clear: both!important;"></div>';

$CustMenu = $db->SelArr("SELECT * FROM f_cust_type where state = '1' ORDER BY id");
for($i = 0; $i < count($CustMenu); $i++) {
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut($CustMenu[$i]['url']).'"  href="index.php?view='.$CustMenu[$i]['url'].'">
<i class="fa">('.$CustMenu[$i]['count'].')</i>'.$CustMenu[$i][$NamePrint].'</a>';
} 


////////////////////////////////////Load
$T_ARRAY_CUST_TYPE = $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
$T_ARRAY_CUST_TYPESUB = $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");
$T_ARRAY_USERS_NAME = $db->SelArr("SELECT user_id,name FROM tbl_user");
$T_ARRAY_CONFIG_DATA  =  LoadTabelData_To_Arr("1" ,"config_data");
$T_ARRAY_LEAD_TYPE  =  LoadTabelData_To_Arr(F_LEAD_TYPE ,"fs_lead_type");
$T_ARRAY_LEAD_SOURS  =  LoadTabelData_To_Arr(F_LEAD_SOURS ,"fs_lead_sours");

echo '</div></div>';
echo '<div style="clear: both!important;"></div>';

?>
