<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);




Form_Open($ArrForm);
$SQLForCat = "SELECT * FROM  user_group where id != '1' ";
$Arr = array("Label" => 'on',"Active" => '0', "SQL_Line_Send"=> $SQLForCat);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['users_cat_name'],"col-md-4","group_id","user_group","req","0",$Arr);


$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="alphanum" data-parsley-minlength="5" ','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['users_user_name'],"user_name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['users_new_pass'],"new_user_pass","0","1","optin",$MoreS);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required', 'Dir'=> "Ar_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['users_name'],"name","1","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="email"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['users_email'],"email","1","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-minlength="11"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['users_mobile'],"mobile","1","0","req",$MoreS);

echo '<div style="clear: both!important;"></div>';


echo '<div style="clear: both!important;"></div>';

NF_PrintRadio_Active ("2_Line","col-md-6",$AdminLangFile['users_user_state'],"state","1");



Form_Close("1");


if(isset($_POST['B1'])){
Vall($Err,"UserAdd",$db,"1",$AdminConfig['admin']);
}            

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>

 