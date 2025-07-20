<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


if($AdminConfig['admin'] == '1'){

    $row = $db->H_CheckTheGet("id","id","x_back_up","2");
    $id = $row['id'];
if(isset($_GET['Confirm'])){
Image_Dell("1",$id,BACK_PHOTO_FOLDER,"x_back_up","path","");
$db->H_DELETE_FromId("x_back_up",$id);
Redirect_Page_2("index.php?view=PhotoFullList");
}else{
echo '<div id="ErrMass" class="ErrMass_Div"></div>';  
PrintDeleteButConfirm("PhotoFullList","DellPhoto&id=".$id);

SendJavaErrMass($AdminLangFile['mainform_confirm_dell_mass']." ".$row['name']);
}
 

}


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 