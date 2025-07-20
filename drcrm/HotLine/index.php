<?php
require_once '../include/inc_reqfile.php';
require_once 'Inc_Php/_index_config.php';
require_once 'Inc_Php/Process.php';

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
            $content =  UserPerMatianCont('Inc_Php/Config.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_tap_section_settings'] ;
            $Short_Menu_Sel = 'Config';
            break;

        case 'Number':
            $content =  UserPerMatianCont('Number.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Number';
            $PageTitle = $Module_H1."Number" ;
            $Short_Menu_Sel = 'Number';
            break;

        case 'Add':
            $content =  UserPerMatianCont('HotLine_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'Add';
            $PageTitle = $Module_H1.$AdminLangFile['hotline_add'] ;
            $Short_Menu_Sel = 'Add';
            break;

        case 'FastAdd':
            $content =  UserPerMatianCont('HotLine_AddFast.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'FastAdd';
            $PageTitle = $Module_H1.$AdminLangFile['hotline_fast_add'] ;
            $Short_Menu_Sel = 'FastAdd';
            break;

        case 'List':
            $content =  UserPerMatianCont('HotLine_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['hotline_list'] ;
            $Short_Menu_Sel = 'List';
            break;

        case 'EditLead':
            $content =  UserPerMatianCont('HotLine_EditFast.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'FastAdd';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_edit'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'FastAdd';
            break;

        case 'Dell':
            $content =  UserPerMatianCont('HotLine_Dell.php',$USER_PERMATION_Dell);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['hotline_delete_customer'] ;
            $Short_Menu_Sel = 'List';
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