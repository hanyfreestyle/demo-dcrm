<?php
 require_once '../include/inc_reqfile.php';
 require_once 'Inc_Php/_index_config.php';
 require_once 'Inc_Php/Process.php';
 require_once 'Inc_Php/Process_ImportDate.php';



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
###################################################   ViewTicket
#################################################################################################################################
        case 'ViewTicket':
            $ContentPage_Arr = array("Mod"=>"SalesDep");
            $content = TicketView_ContentPage($USER_PERMATION_List,$ContentPage_Arr);
            $PageTitle = $Module_H1.$AdminLangFile['closedticket_old_ticket_h1'] ;
            break;


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
###################################################   ReportDate
#################################################################################################################################
        case 'ReportDate':
            $content =  UserPerMatianCont('Leads_Report.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ReportDate';
            $PageTitle = $Module_H1.$AdminLangFile['leads_report_date'] ;
            $Short_Menu_Sel = 'ReportDate';
            break;

#################################################################################################################################
###################################################    ImportLeads
#################################################################################################################################
        case 'ImportLeads':
            $content =  UserPerMatianCont('Data_Import_Form.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'ImportLeads';
            $PageTitle = $Module_H1.$AdminLangFile['leads_importleads'] ;
            $Short_Menu_Sel = 'ImportLeads';
            $ImportLeads = "1";
            break;

        case 'ListImportLeads':
            $content =  UserPerMatianCont('Data_Import_List.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'ImportLeads';
            $PageTitle = $Module_H1.$AdminLangFile['leads_importleads'] ;
            $Short_Menu_Sel = 'ListImportLeads';
            $ImportLeads = "1";
            $DataState = "1";
            break;

        case 'ListWrongData':
            $content =  UserPerMatianCont('Data_Import_List.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'ImportLeads';
            $PageTitle = $Module_H1." List Wrong Data " ;
            $Short_Menu_Sel = 'ListWrongData';
            $ImportLeads = "1";
            $DataState = "0";
            break;

        case 'EditImportLead':
            $content =  UserPerMatianCont('Data_Import_Edit.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ImportLeads';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_edit'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ImportLeads';
            $ImportLeads = "1";
            break;

        case 'DeleteAllData':
            $content =  UserPerMatianCont('Data_Import_Delete_All.php',$USER_PERMATION_Dell);
            $Short_Menu_Sel = 'DeleteAllData';
            $PageTitle = $Module_H1."Delete All Data" ;
            $ImportLeads = "1";
            break;


#################################################################################################################################
###################################################   List Leads
#################################################################################################################################
        case 'List':
            $content =  UserPerMatianCont('Leads_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['leads_list'] ;
            $Short_Menu_Sel = 'List';
            $List_But = "btn-danger" ;
            $ListCust_But  = "btn-success" ;
            $ListSales_But  = "btn-success" ;
            $DistributionDell = '1';
            break;

        case 'ListCust':
            $content =  UserPerMatianCont('Leads_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['leads_list'] ;
            $Short_Menu_Sel = 'List';
            $List_But =  "btn-success" ;
            $ListCust_But  = "btn-danger" ;
            $ListSales_But  = "btn-success" ;
            break;



#################################################################################################################################
###################################################    Delete
#################################################################################################################################
        case 'DellLead':
            $content =  UserPerMatianCont('Leads_Delete.php',$USER_PERMATION_Dell);
            $PageTitle = $Module_H1.$ALang['leads_delete_new_leads'] ;
            break;

        case 'DeleteNewLeads':
            $content =  UserPerMatianCont('Leads_Delete_List.php',$USER_PERMATION_Dell);
            $PageTitle = $Module_H1.$ALang['leads_delete_new_leads'] ;
            $Short_Menu_Sel = 'DeleteNewLeads';
            $DistributionDell = '1';
            $CustType = '0';
            break;

        case 'DeleteRepeatLeads':
            $content =  UserPerMatianCont('Leads_Delete_List.php',$USER_PERMATION_Dell);
            $PageTitle = $Module_H1.$ALang['leads_delete_repeat_leads'] ;
            $Short_Menu_Sel = 'DeleteRepeatLeads';
            $DistributionDell = '1';
            break;

         case 'DeleteCustomerLeads':
            $content =  UserPerMatianCont('Leads_Delete_List.php',$USER_PERMATION_Dell);
            $PageTitle = $Module_H1.$ALang['leads_delete_existing_clients'];
            $Short_Menu_Sel = 'DeleteCustomerLeads';
            $DistributionDell = '1';
            $CustType = '1';
            break;

        case 'DeleteAll':
            $content =  UserPerMatianCont('Leads_Delete_All.php',$USER_PERMATION_Dell);
            $Short_Menu_Sel = 'DeleteAll';
            $PageTitle = $Module_H1.$ALang['leads_delete_all_data'];
            $DistributionDell = '1';
            break;


        case 'ExportNew':
            $content =  UserPerMatianCont('Leads_Export.php',$USER_PERMATION_Dell);
            $Short_Menu_Sel = 'ExportNew';
            $PageTitle = $Module_H1."Export New Leads" ;
            $DistributionDell = '1';
            $CustType = '0';
            break;


        case 'ExportCustomer':
            $content =  UserPerMatianCont('Leads_Export.php',$USER_PERMATION_Dell);
            $Short_Menu_Sel = 'ExportCustomer';
            $PageTitle = $Module_H1."Export Existing Clients" ;
            $DistributionDell = '1';
            $CustType = '1';
            break;


        case 'ExportAll':
            $content =  UserPerMatianCont('Leads_Export.php',$USER_PERMATION_Dell);
            $Short_Menu_Sel = 'ExportAll';
            $PageTitle = $Module_H1."Export All Leads" ;
            $DistributionDell = '1';
            $CustType = 'All';
            break;




#################################################################################################################################
###################################################   List Custmer
#################################################################################################################################

        case 'AddCustToUser':
            $content =  UserPerMatianCont('Leads_Add_Customer_To_User.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'AddCustToUser';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_open_ticket'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'AddCustToUser';
            break;

        case 'AddUser':
            $content =  UserPerMatianCont('Leads_Add_Leads_To_User.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'AddUser';
            $PageTitle = $Module_H1.$AdminLangFile['leads_list'] ;
            $Short_Menu_Sel = 'AddUser';
            break;



#################################################################################################################################
###################################################   AddUser
#################################################################################################################################
        case 'LandingPage':
            $content =  UserPerMatianCont('LandingPage.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'LandingPage';
            $PageTitle = $Module_H1.$AdminLangFile['lppage_list_new_date'] ;
            $Short_Menu_Sel = 'LandingPage';
            $DataState = '1';
            break;
#################################################################################################################################
###################################################   default
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