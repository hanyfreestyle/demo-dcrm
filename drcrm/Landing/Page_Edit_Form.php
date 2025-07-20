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

if($row['form_config'] != ""){
    $MyFormDate = unserialize($row['form_config']);
    $email_req  =$MyFormDate['email_req'];
    $unit_req  = $MyFormDate['unit_req'];
    if(count($MyFormDate['unit_type']) != '0'){
        $unit_type = $MyFormDate['unit_type'];
    }else{
        $unit_type = "";
    }
}else{
    $unit_type = "";
    $email_req  ="";
    $unit_req  = "";
}


New_Print_Alert("5","Edit Form");  

echo '<div style="clear: both!important;"></div>';

NF_PrintRadio_Active ("2_Line","col-md-4","Email Required","email_req",$email_req);    
NF_PrintRadio_Active ("2_Line","col-md-4","Unit Type View","unit_req",$unit_req);  


echo '<div style="clear: both!important;"></div>';
New_Print_Alert("5","Unit Type"); 




$MySQL = "SELECT * FROM config_data where cat_id = 'f_unit_type' and state = '1' ";
$Err = UserFollowSel("SQL","col-md-12","col-md-3","","unit_type",$MySQL,"req","2",$unit_type);

echo '<div style="clear: both!important;"></div>';
 

Form_Close_New("2","ListPage");


if(isset($_POST['B1'])){
Vall($Err,"PageLpEditForm",$db,"1",$USER_PERMATION_Edit);
}

function PageLpEditForm($db){
    $id = $_GET['id'];
    $ThisIsTest = '0' ;
    $form_config = serialize($_POST);
    $server_data = array ('form_config'=> $form_config );

    if($ThisIsTest == '1'){
        print_r3($server_data);
    }else{
        $db->AutoExecute("landpage",$server_data,AUTO_UPDATE,"id = $id");
        Redirect_Page_2(LASTREFFPAGE);
    }
}


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();

	
?>