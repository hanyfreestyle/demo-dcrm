<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id",$GroupTabel,"2");
extract($row);

PageEditBut($id);


Form_Open($ArrForm);
#################################################################################################################################
###################################################   Welcome
#################################################################################################################################
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("5",$AdminLangFile['lppage_mob_h1']);  
if(isset($_POST['mob_state'])){
$mob_state = $_POST['mob_state'] ;    
}
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['lppage_mob_state'],"mob_state",$mob_state);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => '' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['lppage_mob_title'],"mob_title","","","option",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['lppage_mob_title'].ENLANG,"mob_title_en","","","option",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-minlength="11"' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['lppage_mob_num'],"mob_num","","","req",$MoreS);


$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['lppage_mob_des'],"mob_des","","","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['lppage_mob_des'].ENLANG,"mob_des_en","","","option",$MoreS);

 
 

Form_Close_New("2","ListPage");


if(isset($_POST['B1'])){
    if($_POST['mob_state'] == '1'){
        if($_POST['mob_des'] == "" or $_POST['mob_des_en'] == ""){
            SendJavaErrMass($AdminLangFile['lppage_welcome_err']);
        }else{
            if($ErrForm != '1'){
                Vall($Err,"PageLpEditMobile",$db,"1",$USER_PERMATION_Edit);
            }
        }
    }else{
        Vall($Err,"PageLpEditMobile",$db,"1",$USER_PERMATION_Edit);
    }
}

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
	
?>