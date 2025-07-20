<?php
require_once '../include/inc_reqfile.php';
require_once 'Inc_Php/_index_config.php';
require_once 'Inc_Php/Process.php';
$ConfigP = GetCatConfig($ConfigTabel);
$GoogleCode = new GoogleAuthenticator();
$AdminConfig = checkUser();


$USER_PERMATION_List = $AdminConfig[USERPERMATION];
$USER_PERMATION_Add = $AdminConfig[USERPERMATION_ADD];
$USER_PERMATION_Edit = $AdminConfig[USERPERMATION_EDIT];
$USER_PERMATION_Dell = $AdminConfig[USERPERMATION_DELL];

if($AdminConfig['admin'] == '1' and $AdminGroup['permission'] == '1') {
    $view = (isset($_GET['view']) && $_GET['view'] != '')?$_GET['view']:'';
   
    switch($view) {

#################################################################################################################################
###################################################   Config
#################################################################################################################################
        case 'Config':
            $content =  UserPerMatianCont('Inc_Php/Config.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_tap_section_settings'] ;
            $Short_Menu_Sel = 'Config';
            break;

#################################################################################################################################
###################################################   Config
#################################################################################################################################
        case 'Regulations':
            $content =  UserPerMatianCont('Regulations_List.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Regulations';
            $PageTitle = $Module_H1."ادارة اللوائح";
            $Short_Menu_Sel = 'Regulations';
            $AddBut = "RegulationsAdd";
            $EditBut = "RegulationsEdit";
            $OrderBut = "RegulationsOrder";
            $CatId_Type = "1";
            break;
            
        case 'RegulationsAdd':
            $content =  UserPerMatianCont('Regulations_Add.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Regulations';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_but_addnew'] ;
            $Short_Menu_Sel = 'Regulations';
            $ListPage = 'Regulations';
            $CatId_Type = "1";
            $PageType = 'Add';
            break;
            
        case 'RegulationsEdit':
            $content =  UserPerMatianCont('Regulations_Add.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Regulations';
            $PageTitle = $Module_H1."تعديل" ;
            $Short_Menu_Sel = 'Regulations';
            $ListPage = 'Regulations';
            $CatId_Type = "1";
            $PageType = 'Edit';
            break;
            
         case 'RegulationsOrder':
            $content =  UserPerMatianCont('Regulations_Order.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Regulations';
            $PageTitle = $Module_H1."ترتيب" ;
            $Short_Menu_Sel = 'Regulations';
            $ListPage = 'Regulations';
            $CatId_Type = "1";
            break;                       


            
        case 'Notes':
            $content =  UserPerMatianCont('Regulations_List.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Notes';
            $PageTitle = $Module_H1."ادارة الملاحظات" ;
            $Short_Menu_Sel = 'Notes';
            $AddBut = "NotesAdd";
            $EditBut = "NotesEdit";
            $OrderBut = "NotesOrder";
            $CatId_Type = "2";
            break;


        case 'NotesAdd':
            $content =  UserPerMatianCont('Regulations_Add.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Notes';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_but_addnew'] ;
            $Short_Menu_Sel = 'Notes';
            $ListPage = 'Notes';
            $CatId_Type = "2";
            $PageType = 'Add';
            break;
            
        case 'NotesEdit':
            $content =  UserPerMatianCont('Regulations_Add.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Notes';
            $PageTitle = $Module_H1."تعديل" ;
            $Short_Menu_Sel = 'Notes';
            $ListPage = 'Notes';
            $CatId_Type = "2";
            $PageType = 'Edit';
            break;
            
         case 'NotesOrder':
            $content =  UserPerMatianCont('Regulations_Order.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Notes';
            $PageTitle = $Module_H1."ترتيب" ;
            $Short_Menu_Sel = 'Notes';
            $ListPage = 'Notes';
            $CatId_Type = "2";
            break;                       




#################################################################################################################################
###################################################    Permission Cat
#################################################################################################################################    
        case 'Cat_List':
            $content =  UserPerMatianCont('Cat_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Cat_List';
            $PageTitle = $Module_H1.$AdminLangFile['users_cat_list'] ;
            $Short_Menu_Sel = 'Cat_List';
            break;

        case 'Cat_Add':
            $content =  UserPerMatianCont('Cat_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'Cat_Add';
            $PageTitle = $Module_H1.$AdminLangFile['users_cat_add'] ;
            $Short_Menu_Sel = 'Cat_Add';
            break;

        case 'Cat_Edit':
            $content =  UserPerMatianCont('Cat_Edit.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Cat_Edit';
            $PageTitle = $Module_H1.$AdminLangFile['users_cat_edit'] ;
            $Short_Menu_Sel = 'Cat_Edit';
            break;

        case 'Cat_Dell':
            $content =  UserPerMatianCont('Cat_Dell.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'Cat_Dell';
            $PageTitle = $Module_H1.$AdminLangFile['users_dell_cat'] ;
            $Short_Menu_Sel = 'Cat_Dell';
            break;

        case 'Cat_Permission':
            $content =  UserPerMatianCont('Cat_Permission.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'Cat_Permission';
            $PageTitle = $Module_H1.$AdminLangFile['users_per'] ;
            $Short_Menu_Sel = 'Cat_Permission';
            break;

        case 'Cat_Active':
            $content =  UserPerMatianCont('Cat_Active.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'Cat_Active';
            $PageTitle = $Module_H1.$AdminLangFile['users_active_cat'] ;
            $Short_Menu_Sel = 'Cat_Active';
            break;


#################################################################################################################################
###################################################    UserS
#################################################################################################################################    
        case 'List':
            $content =  UserPerMatianCont('User_List.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['users_list_user'] ;
            $Short_Menu_Sel = 'List';
            break;
      
        case 'Add':
            $content =  UserPerMatianCont('User_Add.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'Add';
            $PageTitle = $Module_H1.$AdminLangFile['users_add_user'] ;
            $Short_Menu_Sel = 'Add';
            break;

        case 'Edit':
            $content =  UserPerMatianCont('User_Edit.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'Edit';
            $PageTitle = $Module_H1.$AdminLangFile['users_user_edit'] ;
            $Short_Menu_Sel = 'Edit';
            break;
      
      case 'LoginInfo':
            $content =  UserPerMatianCont('User_List_LoginInfo.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'LoginInfo';
            $PageTitle = $Module_H1.$AdminLangFile['users_but_login_information'] ;
            $Short_Menu_Sel = 'LoginInfo';
            break;
    
        case 'OnlineList':
            $content =  UserPerMatianCont('User_OnlineList.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'OnlineLsit';
            $PageTitle = $Module_H1.$AdminLangFile['users_online_user'] ;
            $Short_Menu_Sel = 'OnlineLsit';
            break;
                        
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