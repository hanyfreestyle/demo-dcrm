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
###################################################    ListUnit
#################################################################################################################################
        case 'ListUnit':
            $content =  UserPerMatianCont('Project_List_2.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ListUnit';
            $PageTitle = $Module_H1.$AdminLangFile['contract_view_unit_tabel'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ListUnit';
            break;

        case 'ListCrunt_2':
            $content =  UserPerMatianCont('Project_List_2.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ListUnit';
            $PageTitle = $Module_H1.$AdminLangFile['contract_view_unit_tabel'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ListUnit';
            break;

        case 'ListLast_2':
            $content =  UserPerMatianCont('Project_List_2.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ListUnit';
            $PageTitle = $Module_H1.$AdminLangFile['contract_view_unit_tabel'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ListUnit';
            break;

        case 'TabelView':
            $content =  UserPerMatianCont('Tabel_List.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'ListUnit';
            $PageTitle = $Module_H1.$AdminLangFile['contract_view_unit_tabel'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ListUnit';
            break;

#################################################################################################################################
###################################################     
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

        case 'TabelRev':
            $content =  UserPerMatianCont('Tabel_List.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['contract_tabel_rese'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'List';
            break;


        case 'TabelCon':
            $content =  UserPerMatianCont('Tabel_List.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['contract_tabel_cont'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'List';
            break;

#################################################################################################################################
###################################################    ListUnit
#################################################################################################################################
        case 'Reservation_List':
            $content =  UserPerMatianCont('Reservation_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Reservation_List';
            $PageTitle = $Module_H1.$AdminLangFile['contract_reservation_list'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Reservation_List';
            $Reservation_type = '1';
            $Reservation_S = '0';
            break;
        case 'Canceled':
            $content =  UserPerMatianCont('Reservation_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Canceled';
            $PageTitle = $Module_H1.$AdminLangFile['contract_canceled_but'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Canceled';
            $Reservation_type = '1';
            $Reservation_S = '1';
            break;
        case 'Contract':
            $content =  UserPerMatianCont('Reservation_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Contract';
            $PageTitle = $Module_H1.$AdminLangFile['contract_contract_0'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Contract';
            $Reservation_type = '2';
            $Reservation_S = '0';
            break;
        case 'ContractD':
            $content =  UserPerMatianCont('Reservation_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ContractD';
            $PageTitle = $Module_H1.$AdminLangFile['contract_menu_con_c'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ContractD';
            $Reservation_type = '2';
            $Reservation_S = '1';
            break;

        case 'Reservation_View':
            $content =   UserPerMatianCont('Reservation_View.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Reservation_View';
            $PageTitle = $Module_H1.$AdminLangFile['contract_rev_view'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Reservation_View';
            break;

#################################################################################################################################
###################################################   Form Action 
#################################################################################################################################    
        case 'ContractDell':
            $content =  UserPerMatianCont('Contract_Dell.php',$USER_PERMATION_Dell);
            $ThisMenuIs_li = $ThisMenuIs.'Contract';
            $PageTitle = $Module_H1.$AdminLangFile['contract_con_dell_but'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Contract';
            break;
        case 'Reservation_Add':
            $content =  UserPerMatianCont('Reservation_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'Reservation_Add';
            $PageTitle = $Module_H1.$AdminLangFile['contract_reservation_add'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Reservation_Add';
            $ThisFormType = '1';
            break;
        case 'Contract_Add':
            $content =  UserPerMatianCont('Reservation_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'Reservation_Add';
            $PageTitle = $Module_H1.$AdminLangFile['contract_tabel_cont'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Reservation_Add';
            $ThisFormType = '2';
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