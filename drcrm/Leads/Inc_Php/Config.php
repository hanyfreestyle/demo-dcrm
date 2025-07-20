<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_SelectOneRow("SELECT * FROM config_cat where cat_id = '$ConfigTabel' ");
$des = $row['des'];
$row =  unserialize($des);
extract($row);

 
Form_Open();
 
 
New_Print_Alert("5",$AdminLangFile['mainform_config_h1']); 
$Err = MainConfigSection("leads","0") ;
 

$Arr = array("StartFrom" => '1',"Label" => 'on');
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['lppage_data_type'],"col-md-3","data_type",$ExportDataTypeArr,"req",$data_type,$Arr);

NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['mainform_ajex_delete'],"ajex_delete",$row['ajex_delete']);
      
      
      
      
      
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("5","اعدادات  اسنيراد البيانات"); 
$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" ', 'Dir'=> "En"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['mainconfig_count_unit_per_page'],"perpage_facebook","1","1","req",$MoreS); 

echo '<div style="clear: both!important;"></div>';
 
New_Print_Alert("5",$AdminLangFile['leads_import_c_h1']); 

$ReqLine = 'required data-parsley-type="alphanum" data-parsley-maxlength="1" ';
$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => $ReqLine, 'Dir'=> "En_Lang"  ,'OnLine'=> '0');

$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['leads_import_name'],"import_name","1","0","op",$MoreS);
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['leads_import_email'],"import_email","1","0","op",$MoreS); 
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['leads_import_mobile'],"import_mobile","1","0","op",$MoreS); 
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['leads_import_mobile_2'],"import_mobile_2","1","0","op",$MoreS); 
 
 
if(LEADS_IMPORT_JOP == '1'){
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['leads_import_jop'],"import_jop","1","0","op",$MoreS);     
} 

if(LEADS_IMPORT_AREA == '1'){
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['leads_import_area'],"import_area","1","0","op",$MoreS);     
} 

if(LEADS_IMPORT_EDU == '1'){
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['leads_import_edu'],"import_edu","1","0","op",$MoreS);     
} 

 
Form_Close("2");

if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$USER_PERMATION_Edit);
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
