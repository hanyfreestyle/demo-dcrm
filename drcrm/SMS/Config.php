<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
if(!isset($_POST['B1'])){
UnsetAllSession("height_t,marktext,markcolor,file_width,file_height,file_size,m_pagename,m_des,m_meta");
UnsetAllSession("m_pagename_en,m_des_en,m_meta_en,c_width,c_height,c_color,resize_t,resize_p,c_do,color,width,height,width_t");
UnsetAllSession("username,password,sendername");
}

$row = $db->H_SelectOneRow("SELECT * FROM  config_cat where cat_id = '$ConfigTabel' ");
$row =  unserialize($row['des']);
extract($row);

$ArrForm = array('FormClassConfig'=> '1');
Form_Open($ArrForm);
$MoreS = array('TextLang' => 'text_en'); 
$Err = array();

New_Print_Alert("5",$AdminLangFile['mainconfig_general_settings_len']); 
$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" ', 'Dir'=> "En"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['mainconfig_count_unit_per_page'],"perpage_unit","1","1","req",$MoreS);


$Arr = array("StartFrom" => '1',"Label" => 'on' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['mainconfig_view_content_by'],"col-md-3","order_by_unit",$Order_ByList,"req",$order_by_unit,$Arr);

$Arr = array("StartFrom" => '1',"Label" => 'on' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['reportconfig_report_period'],"col-md-3","report_period",$ReportPeriodArr,"req",$report_period,$Arr);
 
echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required" ', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['sms_username'],"username","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required" ', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['sms_password'],"password","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required" ', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['sms_sendername'],"sendername","1","1","req",$MoreS);
  
echo '<div style="clear: both!important;"></div>';

$Arr = array("StartFrom" => '1',"Label" => 'on' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['sms_en_count'],"col-md-3","en_count",$SMS_Count_Arr,"req",$en_count,$Arr);
 
$Arr = array("StartFrom" => '1',"Label" => 'on' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['sms_ar_count'],"col-md-3","ar_count",$SMS_Count_Arr,"req",$ar_count,$Arr);
 

echo '<div style="clear: both!important;"></div>';
NF_PrintRadio_Active ("1_Line","col-md-4","Data Tabel","datatabel",$datatabel);

echo '<div style="clear: both!important;"></div>'.BR.BR;

NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_decrease_filter_size'],"filter_cont",$filter_cont);
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_campaigns'],"c_lead_cat",$c_lead_cat);
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_ticket_cust'],"c_ticket_cust",$c_ticket_cust);

New_Print_Alert("5",$AdminLangFile['lppage_google_h1']);
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_jop'],"c_jop",$c_jop);
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_kind'],"c_kind",$c_kind);

if(F_SOCIAL_ID){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_social'],"c_social",$c_social);
}
if(F_FULL_COUNTRY){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_live'],"c_live",$c_live);
}
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_nationality'],"nationality",$nationality);
if(F_FULL_COUNTRY){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_country_live'],"country_live",$country_live);
}
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['reportconfig_city'],"c_city",$c_city);




echo '<div style="clear: both!important;"></div>'.BR.BR;
Form_Close_New("2","List");


if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$USER_PERMATION_Edit);
}
?>


</div></div>