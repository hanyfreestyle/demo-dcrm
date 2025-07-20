<?php
 
 require_once '../include/inc_reqfile.php';
 require_once '_index_config.php';
 require_once 'Process.php';

 //$ConfigP = GetCatConfig($ConfigTabel);

 $AdminConfig = checkUser();
 $USER_PERMATION_List = $AdminConfig[USERPERMATION];
 $USER_PERMATION_Add = $AdminConfig[USERPERMATION_ADD];
 $USER_PERMATION_Edit = $AdminConfig[USERPERMATION_EDIT];
 $USER_PERMATION_Dell = $AdminConfig[USERPERMATION_DELL];
 
 
if($AdminConfig[USERPERMATION] == '1') {
$view = (isset($_GET['view']) && $_GET['view'] != '')?$_GET['view']:'';
switch($view) {

case 'ChangePassword':
$content =  UserPerMatianCont('ChangePassword.php',$AdminConfig[USERPERMATION]);
$ThisMenuIs_li = $ThisMenuIs.'ChangePassword';
$PageTitle = $Module_H1.$AdminLangFile['users_changepassword'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'ChangePassword';
break; 

case 'UserProfile':
$content =  UserPerMatianCont('UserProfile.php',$AdminConfig[USERPERMATION]);
$ThisMenuIs_li = $ThisMenuIs.'UserProfile';
$PageTitle = $Module_H1.$AdminLangFile['users_user_profile'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'UserProfile';
break; 


        case 'TeamLeader':
            $content =  UserPerMatianCont('TeamLeader_Sales.php',$AdminConfig[USERPERMATION]);
            $ThisMenuIs = strtoupper('TeamLeader');
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_tap_section_settings'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'TeamLeader';
            break;

         case 'CustTeamLeader':
            $content =  UserPerMatianCont('TeamLeader_CustServ.php',$AdminConfig[USERPERMATION]);
            $ThisMenuIs = strtoupper('salesdep');
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_tap_section_settings'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Config';
            break;        

         case 'Regulations':
            $content =  UserPerMatianCont('Regulations.php',"1");
            $ThisMenuIs = strtoupper('Regulations');
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1." اللوائح" ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Regulations';
            $Cat_IdType = "1";
            break;   
  
  
           case 'Notes':
            $content =  UserPerMatianCont('Regulations.php',"1");
            $ThisMenuIs = strtoupper('Notes');
            $ThisMenuIs_li = $ThisMenuIs.'Notes';
            $PageTitle = $Module_H1." اللوائح" ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Notes';
            $Cat_IdType = "2";
            break;   
             

default:
       $content =  '../include/Page_Empty.php';
       $PageTitle = $Module_H1.$AdminLangFile['mainform_emptypage'];
       $Short_Menu = '_Short_Menu.php';
   }
} else {
   SendMassgeforuser2();
}
require_once $TemplatePhth;

?>