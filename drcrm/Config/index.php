<?php
 
 require_once '../include/inc_reqfile.php';
 require_once '_index_config.php';
 require_once 'Process.php';
 $AdminConfig = checkUser();
 $USER_PERMATION_Edit = $AdminConfig['web_manage'] ;
 $GroupPermation = $AdminConfig['web_manage'];
 $ThisMenuIs = strtoupper('Config');
 $Module_H1 = $AdminLangFile['webconfig_main_h1']." | ";
 $ConfigP = GetCatConfig($ConfigTabel);
 
 
if($AdminConfig['admin'] == '1' or $USER_PERMATION_Edit  == '1' ) {
$view = (isset($_GET['view']) && $_GET['view'] != '')?$_GET['view']:'';
switch($view) {

    case 'Config':
        $content =  UserPerMatianCont('Config.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'Config';
        $PageTitle = $Module_H1.$AdminLangFile['mainform_menu_settings'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'Config';
        break;

#################################################################################################################################
###################################################   MetaTags 
#################################################################################################################################
    case 'MetaTags':
        $content =  UserPerMatianCont('MetaTags_List.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'MetaTags';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_but_meta_tags']." | ".$AdminLangFile['mainform_h1_list'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'MetaTags';
        break;

    case 'MetaTagAdd':
        $content =  UserPerMatianCont('MetaTags_Add.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'MetaTags';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_but_meta_tags'] ." | ".$AdminLangFile['mainform_h1_add'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'MetaTags';
        break;
        
     case 'MetaTagEdit':
        $content =  UserPerMatianCont('MetaTags_Edit.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'MetaTags';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_but_meta_tags'] ." | ".$AdminLangFile['mainform_h1_edit'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'MetaTags';
        break;       

     case 'MetaTagDell':
        $content =  UserPerMatianCont('MetaTags_Dell.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'MetaTags';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_but_meta_tags'] ." | ".$AdminLangFile['mainform_h1_dell'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'MetaTags';
        break;       
        
#################################################################################################################################
###################################################   WebConfig 
#################################################################################################################################        
    case 'WebConfig':
        $content =  UserPerMatianCont('Config_Web.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'WebConfig';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_web'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'WebConfig';
        break;                

#################################################################################################################################
###################################################    Email Account
#################################################################################################################################        
    case 'ConfigEmail':
        $content =  UserPerMatianCont('Config_Email.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'ConfigEmail';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_email_list'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'ConfigEmail';
        break;
        
     case 'AddEmail':
        $content =  UserPerMatianCont('Config_Email_Add.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'ConfigEmail';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_email_add_new_h1'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'ConfigEmail';
        break;
            
    case 'EditEmail':
        $content =  UserPerMatianCont('Config_Email_Edit.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'ConfigEmail';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_email_edit'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'ConfigEmail';
        break;
                   
        
#################################################################################################################################
###################################################    Photo Size
#################################################################################################################################        
    case 'PhotoSize':
        $content =  UserPerMatianCont('Config_PhotoSize_List.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'PhotoSize';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_but_photosize'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'PhotoSize';
        break;      

    case 'PhotoSizeAdd':
        $content =  UserPerMatianCont('Config_PhotoSize_Add.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'PhotoSize';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_but_photosize'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'PhotoSize';
        break;
        
     case 'PhotoSizeEdit':
        $content =  UserPerMatianCont('Config_PhotoSize_Add.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'PhotoSize';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_but_photosize'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'PhotoSize';
        break;
      
#################################################################################################################################
###################################################    Main Photo
#################################################################################################################################        
     case 'MainPhoto':
        $content =  UserPerMatianCont('Main_Photo.php',$USER_PERMATION_Edit);
        $ThisMenuIs_li = $ThisMenuIs.'MainPhoto';
        $PageTitle = $Module_H1.$AdminLangFile['webconfig_default_image'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'MainPhoto';
        break;
      
#################################################################################################################################
###################################################    
#################################################################################################################################        
      


#################################################################################################################################
###################################################    
#################################################################################################################################        
 


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