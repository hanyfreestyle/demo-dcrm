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
###################################################    Config
#################################################################################################################################
        case 'Config':
            $content =  UserPerMatianCont('Config.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_tap_section_settings'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Config';
            break;

#################################################################################################################################
###################################################    AreaList
#################################################################################################################################

        case 'AreaList':
            $content =  UserPerMatianCont('Area_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'AreaList';
            $PageTitle = $Module_H1.$AdminLangFile['project_listarea'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'AreaList';
            break;

        case 'AreaAdd':
            $content =  UserPerMatianCont('Area_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'AreaAdd';
            $PageTitle = $Module_H1.$AdminLangFile['project_area_add'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'AreaAdd';
            break;

        case 'EditArea':
            $content =   UserPerMatianCont('Area_Edit.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'AreaEdit';
            $PageTitle = $Module_H1.$AdminLangFile['project_area_edit'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'AreaEdit';
            break;

        case 'DellArea':
            $content =  UserPerMatianCont('Area_Dell.php',$USER_PERMATION_Dell);
            $ThisMenuIs_li = $ThisMenuIs.'AreaDell';
            $PageTitle = $Module_H1.$AdminLangFile['project_area_dell'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'AreaDell';
            break;


#################################################################################################################################
###################################################    Project
#################################################################################################################################
        case 'List':
            $content =  UserPerMatianCont('Project_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['project_list_pro'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'List';
            break;

        case 'ListCrunt':
            $content =  UserPerMatianCont('Project_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['project_creunt_but'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'List';
            break;

        case 'ListLast':
            $content =  UserPerMatianCont('Project_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['project_last_but'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'List';
            break;

        case 'Search':
            $content =  UserPerMatianCont('Project_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['project_list_pro'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'List';
            break;

        case 'Add':
            $content =  UserPerMatianCont('Project_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'Add';
            $PageTitle = $Module_H1.$AdminLangFile['project_add_pro'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Add';
            break;

        case 'ProjectEdit':
            $content =   UserPerMatianCont('Project_Edit.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Project_Edit';
            $PageTitle = $Module_H1.$AdminLangFile['project_edit_pro'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Project_Edit';
            break;

        case 'ProjectDell':
            $content =  UserPerMatianCont('Project_Dell.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'ProjectDell';
            $PageTitle = $Module_H1.$AdminLangFile['project_project_dell'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ProjectDell';
            break;

#################################################################################################################################
###################################################    Project
#################################################################################################################################
        case 'Floor_Add':
            $content =   UserPerMatianCont('Floor_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'Floor_Add';
            $PageTitle = $Module_H1.$AdminLangFile['project_add_floor'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Floor_Add';
            break;

        case 'Floor_List':
            $content = UserPerMatianCont('Floor_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Floor_List';
            $PageTitle = $Module_H1.$AdminLangFile['project_floor_list'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Floor_List';
            break;

        case 'FloorDell':
            $content =  UserPerMatianCont('Floor_Dell.php',$USER_PERMATION_Dell);
            $ThisMenuIs_li = $ThisMenuIs.'FloorDell';
            $PageTitle = $Module_H1.$AdminLangFile['project_flo_del'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'FloorDell';
            break;

        case 'FloorEdit':
            $content =  UserPerMatianCont('Floor_Edit.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'FloorEdit';
            $PageTitle = $Module_H1.$AdminLangFile['project_flo_edit'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'FloorEdit';
            break;

        case 'UnitActive':
            $content =  UserPerMatianCont('Unit_Active.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'UnitActive';
            $PageTitle = $Module_H1.$AdminLangFile['project_active_unit'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'UnitActive';
            break;
#################################################################################################################################
###################################################    UnitList
#################################################################################################################################
        case 'UnitList':
            $content =  UserPerMatianCont('Unit_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'UnitList';
            $PageTitle = $Module_H1.$AdminLangFile['project_list_unit'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'UnitList';
            break;

        case 'Unit_Edit':
            $content =  UserPerMatianCont('Unit_Edit.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Unit_Edit';
            $PageTitle = $Module_H1.$AdminLangFile['project_edit_unit'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Unit_Edit';
            break;

        case 'Tabel':
            $content =  UserPerMatianCont('Tabel_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Tabel';
            $PageTitle = $Module_H1.$AdminLangFile['project_tabel_list'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Tabel';
            break;

#################################################################################################################################
###################################################    Tabel
#################################################################################################################################
        case 'Price_List':
            $content =   UserPerMatianCont('Price_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Price_List';
            $PageTitle = $Module_H1.$AdminLangFile['pro_price_list'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Price_List';
            break;

        case 'Price_Add':
            $content =   UserPerMatianCont('Price_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'Price_Add';
            $PageTitle = $Module_H1.$AdminLangFile['project_price_add'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Price_Add';
            break;

        case 'Price_Edit':
            $content =  UserPerMatianCont('Price_Edit.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Price_List';
            $PageTitle = $Module_H1.$AdminLangFile['pro_price_price_edit'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Price_List';
            break;

        case 'Price_Dell':
            $content =  UserPerMatianCont('Price_Dell.php',$USER_PERMATION_Dell);
            $ThisMenuIs_li = $ThisMenuIs.'Price_Dell';
            $PageTitle = $Module_H1.$AdminLangFile['pro_price_price_del'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Price_Dell';
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