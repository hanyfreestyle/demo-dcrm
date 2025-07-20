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
###################################################   ViewTicket
#################################################################################################################################
        case 'ViewTicket':
            $ContentPage_Arr = array("Mod"=>"SalesDep");
            $content = TicketView_ContentPage($USER_PERMATION_List,$ContentPage_Arr);
            $PageTitle = $Module_H1.$AdminLangFile['closedticket_old_ticket_h1'] ;
            break;



        case 'DeleteTicketComment':
            $content =  UserPerMatianCont('../_Pages/Ticket_DeleteComment.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'';
            $PageTitle = $Module_H1." حذف متابعه" ;
            $Short_Menu_Sel = '';
            $DepartMent = 'SalesDep';
            break;


        case 'AddMoreContact':
            $content =  UserPerMatianCont('../_Pages/Customer_MoreContact_Add.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'AddMoreContact';
            $PageTitle = $Module_H1.$ALang['customer_add_more_contact'] ;
            $Short_Menu_Sel = 'AddMoreContact';
            $DepartMent = 'SalesDep';
            break;

#################################################################################################################################
###################################################  Config
#################################################################################################################################
        case 'Config':
            $content =  UserPerMatianCont('Inc_Php/Config.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_tap_section_settings'] ;
            $Short_Menu_Sel = 'Config';
            break;

        case 'TimeLine':
            $content =  UserPerMatianCont('Ticket_ListTimeLine.php',$USER_PERMATION_List);
            $ThisMenuIs = strtoupper('salesdep');
            $MenuSection = 'Tasks';
            $ThisMenuIs_li = $ThisMenuIs.'TimeLine';
            $PageTitle = $Module_H1."جدول المواعيد" ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'TimeLine';
            break;



        case 'KeyWord':
            $content =  UserPerMatianCont('Ticket_KeyWord_Search.php',$AdminConfig['admin']);
            $ThisMenuIs = strtoupper('salesdep');
            $MenuSection = 'KeyWord';
            $ThisMenuIs_li = $ThisMenuIs.'TimeLine';
            $PageTitle = $Module_H1."البحث عن محتوى" ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'KeyWord';
            break;


#################################################################################################################################
###################################################  Admin
#################################################################################################################################
        case 'ChangeEmployee':
            $content =  UserPerMatianCont_2('Admin/Change_Employee.php',$AdminConfig['admin'],ADMIN_CHANGE_EMPLOYEE);
            $ThisMenuIs_li = $ThisMenuIs.'ChangeEmployee';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_change_employee'] ;
            $Short_Menu_Sel = 'ChangeEmployee';
            break;

        case 'ChangeDate':
            $content =  UserPerMatianCont_2('Admin/Change_Date.php',$AdminConfig['admin'],ADMIN_CHANGE_DATE);
            $ThisMenuIs_li = $ThisMenuIs.'ChangeDate';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_change_date'] ;
            $Short_Menu_Sel = 'ChangeDate';
            break;

        case 'AdminEditT':
            $content =  UserPerMatianCont('Admin/AdminEditT.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1."تعديل تذكرة رقم" ;
            break;

        case 'DeleteVisit':
            $content =  UserPerMatianCont('Admin/Delete_Visit.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1."حذف زيارة" ;
            break;





        case 'ContractWait':
            $content =  UserPerMatianCont_2('Admin/Ticket_Close_Contract.php',$AdminConfig['leads'],MOD_TICKET_ADD_CONTRACT);
            $ThisMenuIs_li = $ThisMenuIs.'ContractWait';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_addcontract'] ;
            $Short_Menu_Sel = 'ContractWait';
            break;

        case 'CloseReview':
            $content =  UserPerMatianCont('Admin/Ticket_Close_Review.php',$AdminConfig['leads']);
            $ThisMenuIs_li = $ThisMenuIs.'CloseReview';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_close_review'] ;
            $Short_Menu_Sel = 'CloseReview';
            break;


        case 'TicketSearch':
            $content =  UserPerMatianCont('Admin/Ticket_Search.php',$AdminConfig['leads']);
            $ThisMenuIs_li = $ThisMenuIs.'TicketSearch';
            $PageTitle = $Module_H1." بحث برقم التذكره" ;
            $Short_Menu_Sel = 'TicketSearch';
            break;


        case 'Transfer':
            $content =  UserPerMatianCont('Admin/Ticket_User_Transfer.php',$AdminConfig['admin']);
            $ThisMenuIs_li = $ThisMenuIs.'Transfer';
            $PageTitle = $Module_H1."نقل جماعى ";
            $Short_Menu_Sel = 'Transfer';
            break;






#################################################################################################################################
###################################################  List Page
#################################################################################################################################
        case 'ListAllCust':
            $content =  UserPerMatianCont('Sales_Cust_List_All.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ListAllCust';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_list_all_cust'] ;
            $Short_Menu_Sel = 'ListAllCust';
            break;

        case 'ListNew':
            $content =  UserPerMatianCont('Sales_Cust_List_New.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ListNew';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_but_new_cust'] ;
            $Short_Menu_Sel = 'ListNew';
            break;

        case 'ListToday':
            $content =  UserPerMatianCont('Ticket_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ListToday';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_but_follow_today'] ;
            $Short_Menu_Sel = 'ListToday';
            break;

        case 'ListBack':
            $content =  UserPerMatianCont('Ticket_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ListBack';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_but_follow_back'];
            $Short_Menu_Sel = 'ListBack';
            break;


        case 'ListNext':
            $content =  UserPerMatianCont('Ticket_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ListNext';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_but_follow_next'];
            $Short_Menu_Sel = 'ListNext';
            break;

        case 'ListFollow':
            $content =  UserPerMatianCont_2('Ticket_List.php',$USER_PERMATION_List,CHOSEN_FOLLOW_UP);
            $ThisMenuIs_li = $ThisMenuIs.'ListFollow';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_but_unfollow'];
            $Short_Menu_Sel = 'ListFollow';
            break;

        case 'VisitsList':
            $content =  UserPerMatianCont_2('Vip_VisitsList.php',$USER_PERMATION_List,MOD_TICKET_ADD_VISIT);
            $ThisMenuIs_li = $ThisMenuIs.'VisitsList';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_visits_but'] ;
            $Short_Menu_Sel = 'VisitsList';
            break;

        case 'ReservationsList':
            $content =  UserPerMatianCont_2('Vip_VisitsList.php',$USER_PERMATION_List,MOD_TICKET_ADD_RESERVATION);
            $ThisMenuIs_li = $ThisMenuIs.'ReservationsList';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_reservations_but'] ;
            $Short_Menu_Sel = 'ReservationsList';
            break;

#################################################################################################################################
###################################################  Report Page
#################################################################################################################################
        case 'Report':
            $content =  UserPerMatianCont('Report/Report.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Report';
            $PageTitle = $Module_H1.$AdminLangFile['report_today_report'] ;
            $Short_Menu_Sel = 'Report';
            break;

        case 'FollowReport':
            $content =  UserPerMatianCont('Report/Report_Follow.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'FollowReport';
            $PageTitle = $Module_H1.$AdminLangFile['report_followreport'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'FollowReport';
            break;

        case 'TicketsReport':
            $content =  UserPerMatianCont('Report/Report_Tickets.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'TicketsReport';
            $PageTitle = $Module_H1.$AdminLangFile['report_ticketsreport'] ;
            $Short_Menu_Sel = 'TicketsReport';
            break;



#################################################################################################################################
###################################################    View Pages
#################################################################################################################################
        case 'ViewFastNew':
            $content =  UserPerMatianCont('Sales_Cust_Fast_View.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ListNew';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_fast_view'] ;
            $Short_Menu_Sel = 'ListNew';
            break;


        case 'ViewNew':
            $content =  UserPerMatianCont('Sales_Cust_Full_View.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ListNew';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_but_new_cust'] ;
            $Short_Menu_Sel = 'ListNew';
            break;



#################################################################################################################################
###################################################    Add Action Page Pages
#################################################################################################################################
        case 'UpdateTicket':
            $content =  UserPerMatianCont('Ticket_State_Update.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'UpdateTicket';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_update'] ;
            $Short_Menu_Sel = 'UpdateTicket';
            break;

        case 'UpdateCust':
            $content =  UserPerMatianCont('Sales_Cust_Update.php',$USER_PERMATION_Add);
            $ThisMenuIs_li = $ThisMenuIs.'ListNew';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_cust_update_info'] ;
            $Short_Menu_Sel = 'ListNew';
            break;

        case 'AddVisit':
            $content =  UserPerMatianCont_2('Ticket_Add_Visit.php',$USER_PERMATION_Add,MOD_TICKET_ADD_VISIT);
            $ThisMenuIs_li = $ThisMenuIs.'AddVisit';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_add_visit'] ;
            $Short_Menu_Sel = 'AddVisit';
            break;

        case 'AddRev':
            $content =  UserPerMatianCont_2('Ticket_Add_Rev.php',$USER_PERMATION_Add,MOD_TICKET_ADD_RESERVATION);
            $ThisMenuIs_li = $ThisMenuIs.'AddRev';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_add_rev'] ;
            $Short_Menu_Sel = 'AddRev';
            break;

        case 'CancelRev':
            $content =  UserPerMatianCont_2('Ticket_Add_Cancel.php',$USER_PERMATION_Add,MOD_TICKET_ADD_RESERVATION);
            $ThisMenuIs_li = $ThisMenuIs.'AddRev';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_cancel_but'] ;
            $Short_Menu_Sel = 'AddRev';
            break;

        case 'AskHelp':
            $content =  UserPerMatianCont_2('Ticket_State_AskHelp.php',$USER_PERMATION_Add,MOD_TICKET_ASKHELP);
            $ThisMenuIs_li = $ThisMenuIs.'AskHelp';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_ask_help'] ;
            $Short_Menu_Sel = 'AskHelp';
            break;



#################################################################################################################################
###################################################    Closed Page
#################################################################################################################################
        case 'CloseTicket':
            $content =  UserPerMatianCont('Ticket_State_Close.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'CloseTicket';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_close_end'] ;
            $Short_Menu_Sel = 'CloseTicket';
            break;

        case 'AddContract':
            $content =  UserPerMatianCont_2('Ticket_Add_Contract.php',$USER_PERMATION_Edit,MOD_TICKET_ADD_CONTRACT);
            $ThisMenuIs_li = $ThisMenuIs.'AddRev';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_addcontract'] ;
            $Short_Menu_Sel = 'AddRev';
            break;

#################################################################################################################################
###################################################   Default
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