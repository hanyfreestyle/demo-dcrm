<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
 
 
Form_Open($ArrForm);


$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_page_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_page_name'].ENLANG,"name_en","1","1","req",$MoreS);

echo '<div style="clear: both!important;"></div>';

if( F_LEAD_TYPE == 1){
$Arr = array("Label" => 'on',"Active" => '1');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_lead_type'],"col-md-3","lead_type","fs_lead_type","req","0",$Arr);
$RowCount = RowCountForLight_New($RowCount,"4");  
}

if( F_LEAD_SOURS == 1){
$Arr = array("Label" => 'on',"Active" => '1');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_lead_sours'],"col-md-3","lead_sours","fs_lead_sours","req","0",$Arr); 
$RowCount = RowCountForLight_New($RowCount,"4"); 
}
 
if(F_LEAD_CAT == 1){
$Arr = array("Label" => 'on',"Active" => '1','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_LEAD_CAT);      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['hotline_ad_campaign'],"col-md-3","lead_cat","config_data","req","0",$Arr); 
$RowCount = RowCountForLight_New($RowCount,"4");    
}

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['lppage_details'],"des","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['lppage_details'].ENLANG,"des_en","0","0","option",$MoreS);
 
echo '<div style="clear: both!important;"></div>';

#################################################################################################################################
###################################################   Google
#################################################################################################################################
echo '<div style="clear: both!important;"></div>'.BR;
New_Print_Alert("5",$AdminLangFile['lppage_google_h1']); 

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_url'],"name_m","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_url'].ENLANG,"name_m_en","1","1","req",$MoreS);
echo '<div style="clear: both!important;"></div> ';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-maxlength="70"' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_page_title'],"g_name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-maxlength="70"'  ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_page_title'].ENLANG,"g_name_en","1","1","req",$MoreS);

echo '<div style="clear: both!important;"></div> ';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-maxlength="160"' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['lppage_description'],"g_des","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-maxlength="160"'  ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['lppage_description'],"g_des_en","0","0","option",$MoreS);
 
echo '<div style="clear: both!important;"></div>';



#################################################################################################################################
###################################################   Thanks
#################################################################################################################################
echo '<div style="clear: both!important;"></div>';

New_Print_Alert("5",$AdminLangFile['lppage_h1_thanks']);  
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['lppage_content_title'],"thanks_title","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['lppage_content_title'].ENLANG,"thanks_title_en","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['lppage_content'],"thanks_des","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['lppage_content'].ENLANG,"thanks_des_en","0","0","option",$MoreS);

echo '<div style="clear: both!important;"></div>';
$MoreS = array('Col' => "col-md-9",'Placeholder'=> "",'required' => 'data-parsley-type="url"' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['lppage_site_url'],"website_url","0","1","",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'data-parsley-type="digits" data-parsley-minlength="11"' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['lppage_mob_num'],"thanks_mob","0","1","",$MoreS);


echo '<div style="clear: both!important;"></div>';
New_Print_Alert("5","Photo"); 
$Arr= array("Col"=> "col-md-6" ,"name"=> "photo" ,'required' => '','upload_type'=>$ConfigP['photo_section']) ;
New_PrintFilePhoto("Add",$Arr);
 
 
Form_Close_New("1","ListPage");

echo '<div style="clear: both!important;"></div> ';

 
if(isset($_POST['B1'])){
Vall($Err,"AddLpPAge",$db,"1",$USER_PERMATION_Add);
}  
         




######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page(); 
?>
 