<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


Form_Open($ArrForm);
 
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_cat_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_cat_name'].ENLANG,"name_en","1","1","req",$MoreS);

 
echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['lppage_details'],"des","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['lppage_details'].ENLANG,"des_en","0","0","option",$MoreS);
 
echo '<div style="clear: both!important;"></div>';


Form_Close_New("1","PhotoCat");

if(isset($_POST['B1'])){
Vall($Err,"AddPhotoCat",$db,"1",$USER_PERMATION_Add);
}            

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
 

 
?>
 