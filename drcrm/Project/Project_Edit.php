<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



 
$row = $db->H_CheckTheGet("id","id","project","2");
$id = $row['id'];
 

 
Form_Open();


$Arr = array("Label" => 'on',"Active" => '1');      
$Err[] = NF_PrintSelect_2018("Chosen",$ALang['project_area_name'],"col-md-4","area_id","project_area","req",$row['area_id'],$Arr);	


 
 

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required"', 'Dir'=> "Ar_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['project_pro_name'],"name","1","0","req",$MoreS);


if(ADMINCPANELLANG == '1'){
$MoreS = array('Col' => "col-md-4",'required' => 'required','Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$ALang['project_pro_name'].ENLANG,"name_en","","0","req",$MoreS);
}

echo '<div style="clear: both!important;"></div>';


$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="alphanum" ','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['project_pro_code'],"pro_code","0","1","req",$MoreS);

$Val= array('0'=>$AdminLangFile['project_crunt_0'] ,'1'=> $AdminLangFile['project_crunt_1']);
$Err[] = NF_PrintRadio("2_Line","col-md-4",$AdminLangFile['project_crunt_s'],"crunt",$Val,$row['crunt']);

Form_Close_New("2","List");


if(isset($_POST['B1'])){
Vall($Err,"ProjectEdit",$db,"1",$USER_PERMATION_Edit);
}            


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>


 