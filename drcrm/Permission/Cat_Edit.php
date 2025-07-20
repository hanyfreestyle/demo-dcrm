<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);




$row = $db->H_CheckTheGet("id","id","user_group","2");
$id = $row['id'];
extract($row);

if($id != '1'){

 


Form_Open($ArrForm);



echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required"', 'Dir'=> "Ar_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['users_cat_name'],"name","1","0","req",$MoreS);

NF_PrintRadio_Active ("2_Line","col-md-6",$AdminLangFile['users_cat_state'],"state",$state);



Form_Close("2");


if(isset($_POST['B1'])){
Vall($Err,"CatEdit",$db,"1",$AdminConfig['admin']);
}            
   
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
 