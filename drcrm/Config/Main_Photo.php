<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$sql = "SELECT * FROM config ";
$row = $db->H_SelectOneRow($sql);

Form_Open($ArrForm);

$Err = array();  

$MainArr = array("Col"=> "col-md-6" ,"StopView" => '1','required' => '', "path"=> LOGOS_IMAGE_DIR_V ,'NewStyle'=> "DefaultLogo" ) ;




#################################################################################################################################
###################################################    Default Logo
#################################################################################################################################
echo '<div class="col-md-6">';
New_Print_Alert("5","Default Logo");  
$FildName = "photo_logo"; $Arr = $MainArr+array("name"=> $FildName ,"photo"=> $row[$FildName]);
New_PrintFilePhoto("Edit",$Arr);

$FildName = "photo_logo_en"; $Arr = $MainArr+array("name"=> $FildName ,"photo"=> $row[$FildName]);
New_PrintFilePhoto("Edit",$Arr);
echo '</div>';


#################################################################################################################################
###################################################   Developer Photo
#################################################################################################################################
echo '<div class="col-md-6">';
New_Print_Alert("5","Default Developer Photo");  

$FildName = "photo_developer"; $Arr = $MainArr+array("name"=> $FildName ,"photo"=> $row[$FildName]);
New_PrintFilePhoto("Edit",$Arr);

$FildName = "photo_developer_en"; $Arr = $MainArr+array("name"=> $FildName ,"photo"=> $row[$FildName]);
New_PrintFilePhoto("Edit",$Arr);
echo '</div>';

echo '<div style="clear: both!important;"></div>';


#################################################################################################################################
###################################################   Project  Photo
#################################################################################################################################

echo '<div class="col-md-6">';
New_Print_Alert("5","Default Project Photo");  

$FildName = "photo_project"; $Arr = $MainArr+array("name"=> $FildName ,"photo"=> $row[$FildName]);
New_PrintFilePhoto("Edit",$Arr);

$FildName = "photo_project_en"; $Arr = $MainArr+array("name"=> $FildName ,"photo"=> $row[$FildName]);
New_PrintFilePhoto("Edit",$Arr);
echo '</div>';

#################################################################################################################################
###################################################     Photo
#################################################################################################################################

echo '<div class="col-md-6">';
New_Print_Alert("5","Default Unit Photo");  

$FildName = "photo_unit"; $Arr = $MainArr+array("name"=> $FildName ,"photo"=> $row[$FildName]);
New_PrintFilePhoto("Edit",$Arr);

$FildName = "photo_unit_en"; $Arr = $MainArr+array("name"=> $FildName ,"photo"=> $row[$FildName]);
New_PrintFilePhoto("Edit",$Arr);
echo '</div>';

echo '<div style="clear: both!important;"></div>';




Form_Close("2");


if(isset($_POST['B1'])){
Vall($Err,"LogosEdit",$db,"1",$GroupPermation);
}


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page(); 
?>


 


 



 
