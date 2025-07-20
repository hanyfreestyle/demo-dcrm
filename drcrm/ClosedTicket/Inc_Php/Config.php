<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_SelectOneRow("SELECT * FROM config_cat where cat_id = '$ConfigTabel' ");
$row =  unserialize($row['des']);
extract($row);
 
Form_Open($ArrForm);

New_Print_Alert("5",$AdminLangFile['mainform_config_h1']); 
$Err = MainConfigSection("closedticket","0") ;

 
$Arr = array("StartFrom" => '1',"Label" => 'on');

$YearArr = array(
'1' =>  "2018",
'2' =>  "2019",
'3' =>  "2020",
'4' =>  "2021",
'5' =>  "2022",
'6' =>  "2023",

);


 
$Err[] = NF_PrintSelect_2018("ArrFrom","crunt_year","col-md-3","crunt_year",$YearArr,"req",ArrIsset($row,"crunt_year","0"),$Arr);
    
    
echo '<div style="clear: both!important;"></div>';    


 
 
Form_Close("2");

if(isset($_POST['B1'])){
Vall($Err,"Config_Cat_only",$db,"1",$USER_PERMATION_Edit);
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>


