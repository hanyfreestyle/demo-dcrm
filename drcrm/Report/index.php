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

#################################################################################################################################
###################################################   ViewTicket
#################################################################################################################################
        case 'ViewTicket':
            $ContentPage_Arr = array("Mod"=>"Report");
            $content = TicketView_ContentPage($USER_PERMATION_List,$ContentPage_Arr);
            $PageTitle = $Module_H1.$AdminLangFile['closedticket_old_ticket_h1'] ;
            break;



#################################################################################################################################
###################################################   Report Pages
#################################################################################################################################
        case 'Annual':
            $content =  UserPerMatianCont('Report_Annual.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Annual';
            $PageTitle = $Module_H1.$AdminLangFile['report_annual_report'] ;
            $Short_Menu_Sel = 'Annual';
            break;

        case 'ClosedTicket':
            $content =  UserPerMatianCont_2('Report_ClosedTicket.php',$USER_PERMATION_List,F_LEAD_TYPE);
            $ThisMenuIs_li = $ThisMenuIs.'ClosedTicket';
            $PageTitle = $Module_H1.$AdminLangFile['report_closedticket_r'] ;
            $Short_Menu_Sel = 'ClosedTicket';
            break;

        case 'General':
            $content =  UserPerMatianCont('Report_General.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'General';
            $PageTitle = $Module_H1.$AdminLangFile['report_general'] ;
            $Short_Menu_Sel = 'General';
            break;

        case 'CustView':
            $content =  UserPerMatianCont('Report_CustView.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'CustView';
            $PageTitle = $Module_H1.$AdminLangFile['report_cust_report'] ;
            $Short_Menu_Sel = 'CustView';
            break;

        case 'TicketRport':
            $content =  UserPerMatianCont('Report_Ticket.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'TicketRport';
            $PageTitle = $Module_H1.$AdminLangFile['report_ticket_report'] ;
            $Short_Menu_Sel = 'TicketRport';
            break;
            
        case 'TicketRport2020':
            $content =  UserPerMatianCont('Report_Ticket_2020.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'TicketRport2020';
            $PageTitle = $Module_H1.$AdminLangFile['report_ticket_report'] ;
            $Short_Menu_Sel = 'TicketRport2020';
            break;
            

        case 'LeadSours':
            $content =  UserPerMatianCont_2('Report_LeadSours.php',$USER_PERMATION_List,F_LEAD_SOURS);
            $ThisMenuIs_li = $ThisMenuIs.'LeadSours';
            $PageTitle = $Module_H1.$AdminLangFile['report_lead_sours_report'] ;
            $Short_Menu_Sel = 'LeadSours';
            break;

        case 'LeadType':
            $content =  UserPerMatianCont_2('Report_LeadsType.php',$USER_PERMATION_List,F_LEAD_TYPE);
            $ThisMenuIs_li = $ThisMenuIs.'LeadsType';
            $PageTitle = $Module_H1.$AdminLangFile['report_leads_type_report'] ;
            $Short_Menu_Sel = 'LeadType';
            break;



#################################################################################################################################
###################################################   Report Other Pages
#################################################################################################################################

        case 'Visits':
            $content =  UserPerMatianCont('Report_OtherStates.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Visits';
            $PageTitle = $Module_H1.$AdminLangFile['report_visits_report'] ;
            $Short_Menu_Sel = 'Visits';
            $StateFilde = "visit_s";
            $DateFilde = "visit_date";
            $DesFilde = "visit_des";
            $Date_Lang = $AdminLangFile['report_date_of_visit'];
            $Period_Lang = $AdminLangFile['report_period_of_visit'];
            $Des_Lang = $AdminLangFile['report_visit_details'];
            $MassH1 = $AdminLangFile['report_visits_information_mass'];
            break;


        case 'Reservation':
            $content =  UserPerMatianCont('Report_OtherStates.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Reservation';
            $PageTitle = $Module_H1.$AdminLangFile['report_reservation_report'] ;
            $Short_Menu_Sel = 'Reservation';
            $StateFilde = "rev_s";
            $DateFilde = "rev_date";
            $DesFilde = "rev_des";
            $Date_Lang = $AdminLangFile['report_reservation_date'];
            $Period_Lang = $AdminLangFile['report_period_of_reservation'];
            $Des_Lang = $AdminLangFile['report_reservation_des'];
            $MassH1 = $AdminLangFile['report_reservation_details'];
            break;

        case 'Cancellation':
            $content =  UserPerMatianCont('Report_OtherStates.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Contract';
            $PageTitle = $Module_H1.$AdminLangFile['report_cancellation_report'] ;
            $Short_Menu_Sel = 'Cancellation';
            $StateFilde = "cancel_s";
            $DateFilde = "cancel_date";
            $DesFilde = "cancel_des";
            $Date_Lang = $AdminLangFile['report_cancellation_date'];
            $Period_Lang = $AdminLangFile['report_period_of_cancellation'];
            $Des_Lang = $AdminLangFile['report_cancellation_details'];
            $MassH1 = $AdminLangFile['report_cancellation_details_t'];
            break;


        case 'Contract':
            $content =  UserPerMatianCont('Report_OtherStates.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Contract';
            $PageTitle = $Module_H1.$AdminLangFile['report_contract_report'] ;
            $Short_Menu_Sel = 'Contract';
            $StateFilde = "contract_s";
            $DateFilde = "contract_date";
            $DesFilde = "contract_des";
            $Date_Lang = $AdminLangFile['report_contract_date'];
            $Period_Lang = $AdminLangFile['report_period_of_contract'];
            $Des_Lang = $AdminLangFile['report_contract_details'];
            $MassH1 = $AdminLangFile['report_contract_details_t'];
            break;



default:
       $content =  '../include/Page_Empty.php';
       $PageTitle = $Module_H1.$AdminLangFile['mainform_emptypage'];
      
   }
} else {
   SendMassgeforuser2();
}
require_once $TemplatePhth;

?>