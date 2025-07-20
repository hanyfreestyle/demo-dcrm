<?php
if(!defined('WEB_ROOT')) {	exit;}

 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$row = $db->H_CheckTheGet("id","id",$GroupTabel,"2");
extract($row);

PageEditBut($id);

 
 


Form_Open($ArrForm);
 
#################################################################################################################################
###################################################   
#################################################################################################################################

echo '<div style="clear: both!important;"></div>';
New_Print_Alert("5",$AdminLangFile['lppage_h1_javecode']);  
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextAreaEdit","Google Code","google_code","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextAreaEdit","FaceBook Code","face_code","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextAreaEdit","Google Code Thanks","google_code_thanks","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextAreaEdit","FaceBook Code Thanks","face_code_thanks","0","0","option",$MoreS);


echo '<div style="clear: both!important;"></div>';


 

Form_Close_New("2","ListPage");


if(isset($_POST['B1'])){
Vall($Err,"PageLpEditTracking",$db,"1",$USER_PERMATION_Edit);
}            



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();	
?>




 