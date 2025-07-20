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
 
 $ThisIsFilterPage= "";
 $C_Type_C ="";
if($AdminConfig[USERPERMATION] == '1' ) {
$view = (isset($_GET['view']) && $_GET['view'] != '')?$_GET['view']:'';
switch($view) {
    
    
#################################################################################################################################
###################################################    Config
#################################################################################################################################
        case 'DeleteCustomer':
            $content =  UserPerMatianCont('Inc_Php/Delete_Customer.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1." حذف عميل " ;
            $Short_Menu_Sel = 'Config';
            break;

         case 'AddMoreContact':
            $content =  UserPerMatianCont('../_Pages/Customer_MoreContact_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'AddMoreContact';
            $PageTitle = $Module_H1.$ALang['customer_add_more_contact'] ;
            $Short_Menu_Sel = 'AddMoreContact';
            $DepartMent = 'CustmerService';
            break;
            
#################################################################################################################################
###################################################    Config
#################################################################################################################################
        case 'Config':
            $content =  UserPerMatianCont('Inc_Php/Config.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_tap_section_settings'] ;
            $Short_Menu_Sel = 'Config';
            break;
            
        case 'UpDate':
            $content =  UserPerMatianCont('Inc_Php/UpDate.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'UpDate';
            $PageTitle = $Module_H1.$AdminLangFile['managedate_update']  ;
            $Short_Menu_Sel = 'UpDate';
            break;
            
#################################################################################################################################
###################################################   ViewTicket
#################################################################################################################################
        case 'ViewTicket':
            $ContentPage_Arr = array("Mod"=>"Customer");
            $content = TicketView_ContentPage($USER_PERMATION_List,$ContentPage_Arr);
            $PageTitle = $Module_H1.$AdminLangFile['closedticket_old_ticket_h1'] ;
            break;
            
#################################################################################################################################
###################################################    Add 
#################################################################################################################################

        case 'Add':
            $content =  UserPerMatianCont('Customer_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'Add';
            $PageTitle = $Module_H1.$AdminLangFile['customer_add'] ;
            $Short_Menu_Sel = 'Add';
            break;

        case 'AddContract':
            $content =  UserPerMatianCont_2('Customer_Add_Contract.php',$USER_PERMATION_Add,F_CUSTOMER_CONTRACT);
            $ThisMenuIs_li = $ThisMenuIs.'AddContract';
            $PageTitle = $Module_H1.$AdminLangFile['customer_add'] ;
            $Short_Menu_Sel = 'AddContract';
            break;

         case 'Edit':
            $content =   UserPerMatianCont('Customer_Edit.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Edit';
            $PageTitle = $Module_H1.$AdminLangFile['customer_edit'] ;
            $Short_Menu_Sel = 'Edit';
            $PopUpPageS = 'XXX';
            $PopUpPage_Name = "Customer_Add_More.php";
            $DirURL = "Edit";
            break;


#################################################################################################################################
###################################################     List Customer
#################################################################################################################################

        case 'List':
            $content =  UserPerMatianCont('Customer_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Current';
            $PageTitle = $Module_H1.$ThisPageName  ;
            $Short_Menu_Sel = 'Current';
            $CustmerFilter = '1';
            break;
            
            
        case 'Current':
            $content =  UserPerMatianCont('Customer_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Current';
            $PageTitle = $Module_H1.$ThisPageName  ;
            $Short_Menu_Sel = 'Current';
            $CustmerFilter = '1';
            break;

        case 'Possible':
            $content =  UserPerMatianCont('Customer_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Possible';
            $PageTitle = $Module_H1.$ThisPageName  ;
            $Short_Menu_Sel = 'Possible';
            $CustmerFilter = '2';
            break;

        case 'Archived':
            $content =  UserPerMatianCont('Customer_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Archived';
            $PageTitle = $Module_H1.$ThisPageName  ;
            $Short_Menu_Sel = 'Archived';
            $CustmerFilter = '3';
            break;

        case 'Loss':
            $content =  UserPerMatianCont('Customer_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Loss';
            $PageTitle = $Module_H1.$ThisPageName  ;
            $Short_Menu_Sel = 'Loss';
            $CustmerFilter = '4';
            break;

        case 'NewCust':
            $content =  UserPerMatianCont('Customer_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'NewCust';
            $PageTitle = $Module_H1.$ThisPageName  ;
            $Short_Menu_Sel = 'NewCust';
            $CustmerFilter = '5';
            break;

        case 'ContractCust':
            $content =  UserPerMatianCont_2('Customer_List.php',$USER_PERMATION_List,F_CUSTOMER_CONTRACT);
            $ThisMenuIs_li = $ThisMenuIs.'ContractCust';
            $PageTitle = $Module_H1.$ThisPageName  ;
            $Short_Menu_Sel = 'ContractCust';
            $CustmerFilter = '6';
            break;

            
#################################################################################################################################
###################################################    Search
#################################################################################################################################
        case 'Search':
            $content =  UserPerMatianCont('Customer_Search.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Search';
            $PageTitle = $Module_H1.$AdminLangFile['customer_customer_search'] ;
            $Short_Menu_Sel = 'Search';
            break;

#################################################################################################################################
###################################################    FilterCust
#################################################################################################################################
        case 'FilterCust':
            $content =  UserPerMatianCont('Customer_Filter.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'FilterCust';
            $PageTitle = $Module_H1.$AdminLangFile['customer_filter'] ;
            $Short_Menu_Sel = 'FilterCust';
            break;

#################################################################################################################################
###################################################    ExportCust
#################################################################################################################################
        case 'ExportCust':
            $content =  UserPerMatianCont('Customer_Export.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'ExportCust';
            $PageTitle = $Module_H1.$AdminLangFile['customer_exportcust'] ;
            $Short_Menu_Sel = 'ExportCust';
            break;


#################################################################################################################################
###################################################  Profile Page
#################################################################################################################################
        case 'Profile':
            $content =  UserPerMatianCont('Customer_Profile.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['customer_profile'] ;
            $Short_Menu_Sel = 'List';
            $DirURL = "Profile";
            $Cust_AddMoreContact = "1";
            break;

        case 'OpenTicketSales':
            $content =  UserPerMatianCont('Ticket_Open_Sales.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'OpenTicketSales';
            $PageTitle = $Module_H1.$AdminLangFile['customer_add_new_ticket'] ;
            $Short_Menu_Sel = 'OpenTicketSales';
            break;

        case 'OpenTicketCustService':
            $content =  UserPerMatianCont('Ticket_Open_CustService.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'OpenTicketSales';
            $PageTitle = $Module_H1.$AdminLangFile['customer_add_new_ticket'] ;
            $Short_Menu_Sel = 'OpenTicketSales';
            break;
            
#################################################################################################################################
###################################################  Notes
#################################################################################################################################
        case 'NotesAddNew':
            $content =  UserPerMatianCont('Customer_Notes_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'';
            $PageTitle = $Module_H1.$AdminLangFile['customer_notes_add_but'] ;
            $Short_Menu_Sel = '';
            break;

        case 'NotesDelete':
            $content =  UserPerMatianCont('Customer_Notes_Delete.php',$USER_PERMATION_Dell);
            $ThisMenuIs_li = $ThisMenuIs.'';
            $PageTitle = $Module_H1.$AdminLangFile['customer_dell_notes_h1'] ;
            $Short_Menu_Sel = '';
            break;

        /*


        case 'ViewOldTicket':
        $content =  UserPerMatianCont('Ticket_View_Old.php',$USER_PERMATION_List);
        $ThisMenuIs_li = $ThisMenuIs.'ViewOldTicket';
        $PageTitle = $Module_H1.$AdminLangFile['ticket_previous_tickets'] ;
        $Short_Menu = '_Short_Menu.php';
        $Short_Menu_Sel = 'ViewOldTicket';
        break;


        */

#################################################################################################################################
###################################################  default
#################################################################################################################################
        default:
            $content =  '../include/Page_Empty.php';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_emptypage'];
            $Short_Menu = '_Short_Menu.php';


break; 
   }
} else {
   SendMassgeforuser2();
}
require_once $TemplatePhth;

?>