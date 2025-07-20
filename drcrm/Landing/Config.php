<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);  


$row = $db->H_SelectOneRow("SELECT * FROM  config_cat where cat_id = '$ConfigTabel' ");
$row =  unserialize($row['des']);
extract($row);
 
 

$ArrForm = array('FormClassConfig'=> '1');
Form_Open($ArrForm);
$MoreS = array('TextLang' => 'text_en'); 
$Err = array();


 
$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" ', 'Dir'=> "En"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['mainconfig_count_unit_per_page'],"perpage_unit","1","1","req",$MoreS);

$Arr = array("StartFrom" => '1',"Label" => 'on' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['mainconfig_view_content_by'],"col-md-3","order_by_unit",$Order_ByList,"req",$order_by_unit,$Arr);

NF_PrintRadio_Active ("2_Line","col-md-4","Data Tabel","datatabel",$datatabel);

echo '<div style="clear: both!important;"></div>'.BR;




#################################################################################################################################
###################################################   صور القسم
#################################################################################################################################
New_Print_Alert("5",$AdminLangFile['lppage_photo_section_settings']); 

$Val= array('0'=>$AdminLangFile['mainform_unit_add_photo_option'],'1'=> $AdminLangFile['mainform_unit_add_photo_require']);
NF_PrintRadio("2_Line","col-md-3",$AdminLangFile['mainconfig_unit_add_photo_req_sate'],"group_photo",$Val,$group_photo); 

$Arr = array("Label" => 'on',"Active" => '1' );      
$Err[] = NF_PrintSelect_2018("Chosen",$ALang['webconfig_upload_photo_type'],"col-md-3","photo_section","config_photo","req",$photo_section,$Arr);


$Arr = array("Label" => 'on',"Active" => '1' );      
$Err[] = NF_PrintSelect_2018("Chosen",$ALang['webconfig_upload_photo_type'],"col-md-3","block_photo","config_photo","req",$block_photo,$Arr);

 

echo '<div style="clear: both!important;"></div>';



#################################################################################################################################
###################################################   صور القسم
#################################################################################################################################
New_Print_Alert("5",$AdminLangFile['lppage_photo_album_settings']); 

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" ', 'Dir'=> "En"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['mainconfig_count_unit_per_page'],"perpage_photo","1","1","req",$MoreS);

$Arr = array("StartFrom" => '1',"Label" => 'on' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['mainconfig_view_content_by'],"col-md-3","order_by_photo",$Order_ByList,"req",$order_by_photo,$Arr);


$Arr = array("Label" => 'on',"Active" => '1' );      
$Err[] = NF_PrintSelect_2018("Chosen",$ALang['webconfig_upload_photo_type'],"col-md-3","photo_album","config_photo","req",$photo_album,$Arr);


Form_Close("2");

if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$USER_PERMATION_Edit);
}



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 