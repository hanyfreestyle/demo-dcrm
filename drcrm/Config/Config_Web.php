<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 

$row = $db->H_SelectOneRow("SELECT * FROM config ");
$row =  unserialize($row['web_config']);
extract($row);
 
	
 

 


Form_Open($ArrForm);
//New_Print_Alert("5",$AdminLangFile['webconfig_web']);

$Val= array('0'=> $AdminLangFile['webconfig_closed'] ,'1'=> $AdminLangFile['webconfig_open']);
$Err[] = NF_PrintRadio("2_Line","col-md-3",$AdminLangFile['webconfig_web_state'],"webstate",$Val,$webstate);

/*
if($webstate == "1"){
$today =time();
$today = $today+(60*60*24*3);
$date = ConvertDateToCalender_3($today);
$row['date'] =  $date ;
}else{
$date = ConvertDateToCalender_3($date);
$row['date'] =  $date ;    
}

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("DateEdit",$AdminLangFile['webconfig_open_date'],"date","1","0","req",$MoreS);


$Val= array('0'=>$WebConfig['Web_Open_State_Manually'] ,'1'=> $WebConfig['Web_Open_State_Automatically']);
$Err[] = NF_PrintRadio("2_Line","col-md-3",$WebConfig['Web_Open_State'],"webstate_open",$Val,$webstate_open);
*/


$Err[] = NF_PrintRadio_Active("2_Line","col-md-3","Right Mode","rightmode",$rightmode);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required" ', 'Dir'=> "Ar_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['webconfig_site_name'],"name","1","1","req",$MoreS);
if(ADMINCPANELLANG == '1'){
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['webconfig_site_name'].ENLANG,"name_en","1","1","req",$MoreS);
}

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="url"', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['webconfig_site_url'],"weburl","1","1","req",$MoreS);


echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','Dir'=> "Ar_Lang"  );
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['webconfig_close_message'],"webstate_mass","1","0","req",$MoreS);

if(ADMINCPANELLANG == '1'){
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','Dir'=> "En_Lang"  );
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['webconfig_close_message'].ENLANG,"webstate_mass_en","1","0","req",$MoreS);
}
echo '<div style="clear: both!important;"></div>';

if( ADMINCPANELLANG == '1'){
New_Print_Alert("5",$AdminLangFile['webconfig_language_settings']);
    
$Err[] = NF_PrintRadio_Active ("1_Line","col-md-4",$AdminLangFile['webconfig_allow_language_change'],"weblang_s",$weblang_s);
$Val= array('0'=>$AdminLangFile['webconfig_arabic'],'1'=> $AdminLangFile['webconfig_english']);
$Err[] = NF_PrintRadio("1_Line","col-md-6",$AdminLangFile['webconfig_default_language'],"weblang_kind",$Val,$weblang_kind);
echo '<div style="clear: both!important;"></div>';
}


#################################################################################################################################
###################################################    
#################################################################################################################################

New_Print_Alert("5",$AdminLangFile['webconfig_currencysetting']);
$Err[] = NF_PrintRadio_Active ("2_Line","col-md-4",$AdminLangFile['webconfig_change_currency_state'],"currency_s",$currency_s);
$Val= array('0'=>"EGP",'1'=> "USD");
$Err[] = NF_PrintRadio("2_Line","col-md-4",$AdminLangFile['webconfig_default_currency'],"currency_kind",$Val,$currency_kind);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="number"', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['webconfig_usd_value'],"usd_value","1","1","req",$MoreS);


#################################################################################################################################
###################################################    
#################################################################################################################################
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("5",$AdminLangFile['webconfig_social']);

$Err[] = NF_PrintRadio_Active ("1_Line","col-md-6",$AdminLangFile['webconfig_sharing_sites'],"addthis_cont",$addthis_cont);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-type="url"', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit","Facebook","facebook","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-type="url"', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit","Twitter","twitter","1","0","req-url",$MoreS);
echo '<div style="clear: both!important;"></div>';


$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-type="url"', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit","Youtube","youtube","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-type="url"', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit","Google+","google_plus","1","1","req",$MoreS);
echo '<div style="clear: both!important;"></div>';


$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-type="url"', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit","Instagram","instagram","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-type="url"', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit","Linkedin","linkedin","1","1","req",$MoreS);
echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("TextEdit","Google Api","google_api","1","1","req",$MoreS);

echo '<div style="clear: both!important;"></div>';



Form_Close("2");

if(isset($_POST['B1'])){
Vall($Err,"WebConfig",$db,"1",$GroupPermation);
}

?>





</div></div>