<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$GroupTabel = "config_meta" ;
$row = $db->H_CheckTheGet("id","id",$GroupTabel,"2");
$id = $row['id'];



if(isset($_GET['Confirm'])){

Image_Dell("2",$id,F_PATH_D,$GroupTabel,"photo","photo_t");  
$db->H_DELETE_FromId($GroupTabel,$id);
Redirect_Page_2("index.php?view=MetaTags");

}else{
New_Print_Alert("4",$AdminLangFile['mainform_confirm_dell_mass']." ".$row["cat_id"]);     
PrintDeleteButConfirm("MetaTags","MetaTagDell&id=".$id);
}

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page(); 
?>
 