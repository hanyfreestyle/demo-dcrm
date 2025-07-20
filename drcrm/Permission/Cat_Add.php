<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);




Form_Open($ArrForm);

$MoreS = array('Col' => "col-md-6", 'required' => 'required');
$Err[] = NF_PrintInput("Text",$AdminLangFile['users_cat_name'],"name","1","1","req",$MoreS);

Form_Close("1");


if(isset($_POST['B1'])){
Vall($Err,"CatAdd",$db,"1",$USER_PERMATION_Add);
}
            
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>
 