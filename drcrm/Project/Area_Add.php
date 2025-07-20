<?php
if(!defined('WEB_ROOT')) {exit;}
 


######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

 



Form_Open();

$MoreS = array('Col' => "col-md-6",'required' => 'required','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['project_area_name'],"name","","0","req",$MoreS);

if(ADMINCPANELLANG == '1'){
$MoreS = array('Col' => "col-md-6",'required' => 'required','Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['project_area_name'].ENLANG,"name_en","","0","req",$MoreS);
}


 
Form_Close_New("1","AreaList");

if(isset($_POST['B1'])){
Vall($Err,"AreaAdd",$db,"1",$USER_PERMATION_Add);
}            


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();


?>
