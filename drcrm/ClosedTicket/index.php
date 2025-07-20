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
            $PageTitle = $Module_H1.$AdminLangFile['mainform_menu_settings'] ;
            $Short_Menu_Sel = 'Config';
            break;
            
            
#################################################################################################################################
###################################################   ViewTicket
#################################################################################################################################
        case 'ViewTicket':
            $ContentPage_Arr = array("Mod"=>"ClosedTicket");
            $content = TicketView_ContentPage($USER_PERMATION_List,$ContentPage_Arr);
            $PageTitle = $Module_H1.$AdminLangFile['closedticket_old_ticket_h1'] ;
            break;
            
            
#################################################################################################################################
###################################################   List Page
#################################################################################################################################
        case 'List':
            $content =  UserPerMatianCont('List_Page.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['mainform_h1_list'] ;
            $Short_Menu_Sel = 'List';
            break;



#################################################################################################################################
###################################################   Closed Ticket
#################################################################################################################################
        case 'Closed1':
            $content =  UserPerMatianCont('Closed_Ticket_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ClosedT';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_closed_for_contracting'] ;
            $Short_Menu_Sel = 'Closed1';
            $Sction =  'ClosedTicket' ;
            $CloseType = '1';
            $OPenBlank = "1";
            break;

        case 'Closed2':
            $content =  UserPerMatianCont('Closed_Ticket_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ClosedT';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_closed_for_archiving'] ;
            $Short_Menu_Sel = 'Closed2';
            $Sction =  'ClosedTicket' ;
            $CloseType = '2';
            $OPenBlank = "1";
            break;

        case 'Closed3':
            $content =  UserPerMatianCont('Closed_Ticket_List.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'ClosedT';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_closed_for_loss'] ;
            $Short_Menu_Sel = 'Closed3';
            $Sction =  'ClosedTicket' ;
            $CloseType = '3';
            $OPenBlank = "1";
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