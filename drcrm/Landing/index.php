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

#################################################################################################################################
###################################################   Config
#################################################################################################################################
        case 'Config':
            $content =  UserPerMatianCont('Config.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_tap_section_settings'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Config';
            break;

#################################################################################################################################
###################################################   ListPage
#################################################################################################################################
        case 'ListPage':
            $content =  UserPerMatianCont('Page_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ListPage';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_listpage'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ListPage';
            break;

        case 'PageAdd':
            $content =  UserPerMatianCont('Page_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'PageAdd';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_add_page'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PageAdd';
            break;

        case 'PageEdit':
            $content =  UserPerMatianCont('Page_Edit.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'PageEdit';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_edit_page'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PageEdit';
            break;

        case 'EditTracking':
            $content =  UserPerMatianCont('Page_Edit_Tracking.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'EditTracking';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_edit_page'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'EditTracking';
            break;
            
        case 'EditMobile':
            $content =  UserPerMatianCont('Page_Edit_Mobile.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'EditMobile';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_edit_page'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'EditMobile';
            break;

        case 'EditForm':
            $content =  UserPerMatianCont('Page_Edit_Form.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'EditMobile';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_edit_page'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'EditMobile';
            break;

        case 'PageOrder':
            $content =  UserPerMatianCont('Page_Order.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'PageOrder';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_order_page'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PageOrder';
            break;

        case 'PageDell':
            $content =  UserPerMatianCont('Page_Dell.php',$USER_PERMATION_Dell);
            $ThisMenuIs_li = $ThisMenuIs.'PageDell';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_dell'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PageDell';
            break;

#################################################################################################################################
###################################################   ViewBlock
#################################################################################################################################
        case 'ViewBlock':
            $content =  UserPerMatianCont('Block_View.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ViewBlock';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_view_content'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ViewBlock';
            break;

        case 'AddBlock':
            $content =  UserPerMatianCont('Block_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'AddBlock';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_block_type'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'AddBlock';
            break;

        case 'OrderBlock':
            $content =  UserPerMatianCont('Block_Order.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'AddBlock';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_block_type'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'AddBlock';
            break;

        case 'BlockEdit':
            $content =  UserPerMatianCont('Block_Edit.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'BlockEdit';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_edit_content'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'BlockEdit';
            break;

#################################################################################################################################
###################################################   PhotoCat
#################################################################################################################################
        case 'PhotoCat':
            $content =  UserPerMatianCont('PhotoCat_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'PhotoCat';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_list_cat'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PhotoCat';
            break;

        case 'PhotoCatAdd':
            $content =  UserPerMatianCont('PhotoCat_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'PhotoCatAdd';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_add_cat'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PhotoCatAdd';
            break;
        case 'PhotoCatEdit':
            $content =  UserPerMatianCont('PhotoCat_Edit.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'PhotoCatEdit';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_edit_cat'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PhotoCatEdit';
            break;


        case 'PhotoCatDell':
            $content =  UserPerMatianCont('PhotoCat_Dell.php',$USER_PERMATION_Dell);
            $ThisMenuIs_li = $ThisMenuIs.'PhotoCatDell';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_dell_cat'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PhotoCatDell';
            break;

#################################################################################################################################
###################################################   PhotoList
################################################################################################################################# 
        case 'PhotoList':
            $content =  UserPerMatianCont('Photo_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'PhotoList';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_viw_photo'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PhotoList';
            break;

        case 'AddPhoto':
            $content =  UserPerMatianCont('Photo_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'AddPhoto';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_add_photo'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'AddPhoto';
            break;

        case 'AddPhotoMultiple':
            $content =  UserPerMatianCont('Photo_Add_Multiple.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'AddPhotoMultiple';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_add_multiple_photo'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'AddPhotoMultiple';
            break;



        case 'PhotoEdit':
            $content =  UserPerMatianCont('Photo_Edit.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'PhotoEdit';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_edit_photo'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PhotoEdit';
            break;

        case 'OrderPhoto':
            $content =  UserPerMatianCont('Photo_Order.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'OrderPhoto';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_order_photo'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'OrderPhoto';
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