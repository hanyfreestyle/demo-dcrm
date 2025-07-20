<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
  
$row = $db->H_CheckTheGet("id","id","facebook_data","2");
$id = $row['id'];
extract($row);
 

 

Form_Open($ArrForm);

 
echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'OnLine'=> '0','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['leads_c_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-minlength="11"' , 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['customer_mobile']."1","mobile","1","0","req-num",$MoreS);


$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'data-parsley-type="digits" data-parsley-minlength="11"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['customer_mobile']."2","mobile_2","400","0","optin-num",$MoreS);

 
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'data-parsley-type="email"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['customer_email'],"email","400","0","optin-email",$MoreS);


echo '<div style="clear: both!important;"></div> ';
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['salesdep_lead_info'],"notes","1","1","req",$MoreS);



Form_Close("2");
if(isset($_POST['B1'])){
Vall($Err,"EditImportLead",$db,"0",USERPERMATION_EDIT);
} 




        
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
 