<?php
 
 require_once '../include/inc_reqfile.php';
 require_once '_index_config.php';
 require_once 'Process.php';

 
$ConfigP = GetCatConfig($ConfigTabel);

 $AdminConfig = checkUser();
 $USER_PERMATION_List = $AdminConfig[USERPERMATION];
 $USER_PERMATION_Add = $AdminConfig[USERPERMATION_ADD];
 $USER_PERMATION_Edit = $AdminConfig[USERPERMATION_EDIT];
 $USER_PERMATION_Dell = $AdminConfig[USERPERMATION_DELL];
 
 
if($AdminConfig[USERPERMATION] == '1') {
$view = (isset($_GET['view']) && $_GET['view'] != '')?$_GET['view']:'';
switch($view) {

case 'Config':
$content =  UserPerMatianCont('Config.php',$USER_PERMATION_Edit);
$ThisMenuIs_li = $ThisMenuIs.'Config';
$PageTitle = $Module_H1.$AdminLangFile['mainform_tap_section_settings'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'Config';
break; 


case 'Send_AR':
$content =  UserPerMatianCont('Send_Filter.php',$USER_PERMATION_Add); 
$ThisMenuIs_li = $ThisMenuIs.'Send_AR';
$PageTitle = $Module_H1.$AdminLangFile['sms_send_ar'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'Send_AR';
$sms_type = '1';
break; 


case 'Send_EN':
$content =  UserPerMatianCont('Send_Filter.php',$USER_PERMATION_Add); 
$ThisMenuIs_li = $ThisMenuIs.'Send_EN';
$PageTitle = $Module_H1.$AdminLangFile['sms_send_en'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'Send_EN';
$sms_type = '2';
break; 


case 'Report':
$content =  UserPerMatianCont('Send_Report.php',$USER_PERMATION_Add); 
$ThisMenuIs_li = $ThisMenuIs.'Report';
$PageTitle = $Module_H1.$AdminLangFile['sms_report'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'Report';
break; 

case 'Dell':
$content =  UserPerMatianCont('Sms_Dell.php',$USER_PERMATION_Dell);
$ThisMenuIs_li = $ThisMenuIs.'List';
$PageTitle = $Module_H1.$AdminLangFile['mainform_delete'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'List';
break; 


case 'BirthDay':
$content =  UserPerMatianCont('Send_BirthDay.php',$USER_PERMATION_Add); 
$ThisMenuIs_li = $ThisMenuIs.'BirthDay';
$PageTitle = $Module_H1.$AdminLangFile['sms_send_en'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'BirthDay';
$sms_type = '2';
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