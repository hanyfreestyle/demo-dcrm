<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
if(!isset($_POST['B1'])){
UnsetAllSession("height_t,marktext,markcolor,file_width,file_height,file_size,m_pagename,m_des,m_meta");
UnsetAllSession("m_pagename_en,m_des_en,m_meta_en,c_width,c_height,c_color,resize_t,resize_p,c_do,color,width,height,width_t");
}


$row = $db->H_SelectOneRow("SELECT * FROM  config_cat where cat_id = '$ConfigTabel' ");
$row =  unserialize($row['des']);
extract($row);
 
 
$ArrForm = array('FormClassConfig'=> '1');
Form_Open($ArrForm);
$MoreS = array('TextLang' => 'text_en'); 
$Err = array();


#################################################################################################################################
###################################################   
#################################################################################################################################
New_Print_Alert("5",$AdminLangFile['mainconfig_general_settings_len']);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" ', 'Dir'=> "En"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['mainconfig_count_unit_per_page'],"perpage_unit","1","1","req",$MoreS);

$Arr = array("StartFrom" => '1',"Label" => 'on');  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['mainconfig_view_content_by'],"col-md-3","order_by_unit",$Order_ByList,"req",$order_by_unit,$Arr);
 
 
echo '<div style="clear: both!important;"></div>';
NF_PrintRadio_Active ("1_Line","col-md-4","Data Tabel","datatabel",$datatabel);


Form_Close("2");

if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$USER_PERMATION_Edit);
}
?>


</div></div>