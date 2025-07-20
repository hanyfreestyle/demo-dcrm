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
            $ContentPage_Arr = array("Mod"=>"SalesFollow");
            $content = TicketView_ContentPage($USER_PERMATION_List,$ContentPage_Arr);
            $PageTitle = $Module_H1.$AdminLangFile['closedticket_old_ticket_h1'] ;
            $Short_Menu = '_Short_Menu.php';
            break;
            
            
              
#################################################################################################################################
###################################################    Config
#################################################################################################################################
        case 'Config':
            $content =  UserPerMatianCont('Inc_Php/Config.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'Config';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_tap_section_settings'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Config';
            break;
            
#################################################################################################################################
###################################################  Report Pages
#################################################################################################################################
       case 'Reports':
            $content =  UserPerMatianCont('Report/Sales_Daily.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Reports';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_reportsales'] ;
            $Short_Menu_Sel = 'ReportSales';
            $Short_Menu = '_Short_Menu.php';
            $Sction =  'ReportS' ;
            $Short_Menu_Sel_Sub = "Reports";
            break;
        case 'ReportSales':
            $content =  UserPerMatianCont('Report/Sales_Daily.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Reports';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_reportsales'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ReportSales';
            $Sction =  'ReportS' ;
            $Short_Menu_Sel_Sub = "Reports";
            break;        
         case 'ReportCust':
            $content =  UserPerMatianCont('Report/Customer_Daily.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Reports';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_reportcust'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ReportCust';
            $Sction =  'ReportS' ;
            $Short_Menu_Sel_Sub = "Reports";
            break;    
          case 'ReportFollow':
            $content =  UserPerMatianCont('Report/Sales_Monthly.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Reports';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_reportsales_moth'] ;
            $Short_Menu_Sel = 'ReportFollow';
            $Short_Menu = '_Short_Menu.php';
            $Sction =  'ReportS' ;
            $Short_Menu_Sel_Sub = "Reports";
            break;
        case 'ReportFollowCust':
            $content =  UserPerMatianCont('Report/Customer_Monthly.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'Reports';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_reportfollow_cust'] ;
            $Short_Menu_Sel = 'ReportFollowCust';
            $Short_Menu = '_Short_Menu.php';
            $Sction =  'ReportS' ;
            $Short_Menu_Sel_Sub = "Reports";
            break;
                        

#################################################################################################################################
###################################################  CustService Depart
#################################################################################################################################
        case 'TCustService':
            $content =  UserPerMatianCont('CustService_Ticket_List_All.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'TCustService';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_custservice_t_list'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'TCustService';
            $Sction =  'TCustService' ;
            $Short_Menu_Sel_Sub = "CustService";
            break;
            
         case 'ListToday':
            $content =  UserPerMatianCont('CustService_Ticket_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'TCustService';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_but_follow_today'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ListToday';
            $Sction =  'TCustService' ;
            $Short_Menu_Sel_Sub = "CustService";
            break;     
        case 'ListBack':
            $content =  UserPerMatianCont('CustService_Ticket_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'TCustService';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_but_follow_back'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ListBack';
            $Sction =  'TCustService' ;
            $Short_Menu_Sel_Sub = "CustService";
            break;
        case 'ListFollow':
            $content =  UserPerMatianCont_2('CustService_Ticket_List.php',$USER_PERMATION_List,CHOSEN_FOLLOW_UP);
            $ThisMenuIs_li = $ThisMenuIs.'TCustService';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_but_unfollow'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ListFollow';
            $Sction =  'TCustService' ;
            break;
        case 'ListNext':
            $content =  UserPerMatianCont('CustService_Ticket_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'TCustService';
            $PageTitle = $Module_H1.$AdminLangFile['salesdep_but_follow_next'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ListNext';
            $Sction =  'TCustService' ;
            break;
        case 'ClosedTicket':
            $content =  UserPerMatianCont('CustService_Ticket_List.php',$AdminConfig['subercustserv']);
            $ThisMenuIs_li = $ThisMenuIs.'TCustService';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_close_end'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'ClosedTicket';
            $Sction =  'TCustService' ;
            break;
        case 'CustViewTicket':
            $content =  UserPerMatianCont('CustService_Ticket_View.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'TCustService';
            $PageTitle = $Module_H1.$AdminLangFile['ticket_t_info'] ;
            $Short_Menu_Sel = 'CustViewTicket';
            $Short_Menu = '_Short_Menu.php';
            $Sction =  'TCustService' ;
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