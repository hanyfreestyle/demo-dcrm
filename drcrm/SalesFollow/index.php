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
 
$DepartmentView = "Customers_Service";
$SalesFollowPages = ""; 


if($AdminConfig[USERPERMATION] == '1') {
$view = (isset($_GET['view']) && $_GET['view'] != '')?$_GET['view']:'';
switch($view) {
    

#################################################################################################################################
###################################################    Config
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
            $ContentPage_Arr = array("Mod"=>"SalesFollow");
            $content = TicketView_ContentPage($USER_PERMATION_List,$ContentPage_Arr);
            $PageTitle = $Module_H1.$AdminLangFile['closedticket_old_ticket_h1'] ;
            break;
            
            

#################################################################################################################################
###################################################    CloseReview
#################################################################################################################################
        case 'CloseReview':
            $content =  UserPerMatianCont('SalesFollow_ListPage.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'SalesFollow';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_closed_tickets'] ;
            $Short_Menu_Sel = 'CloseReview';
            $Short_Menu_Sel_Sub = "SalesFollow";            
            $Section_View =  'CloseReview' ;
            break;      

        case 'ChangeClose':
            $content =  UserPerMatianCont('CloseTicket_ChangeClose.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_change_close_status'] ;
            $Short_Menu_Sel = '';
            break;

        case 'ReOpenTicket':
            $content =  UserPerMatianCont('CloseTicket_ReOpenTicket.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_reopen'] ;
            $Short_Menu_Sel = '';
            break;
       
      case 'AddFollow':
            $content =  UserPerMatianCont('CloseTicket_AddFollow.php',$USER_PERMATION_Edit);
            $ThisMenuIs_li = $ThisMenuIs.'';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_add_follow'] ;
            $Short_Menu_Sel = '';
            break;         
     
                        
#################################################################################################################################
###################################################    CloseFollow
#################################################################################################################################
        case 'CloseFollow':
            $content =  UserPerMatianCont('SalesFollow_ListPage.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'SalesFollow';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_closed_follow_h1'] ;
            $Short_Menu_Sel = 'CloseFollow';
            $Short_Menu_Sel_Sub = "SalesFollow";    
            $Section_View = "CloseReview";
            $SalesFollowPages = "1";      
            break;
                
        case 'ListToday':
            $content =  UserPerMatianCont('SalesFollow_ListPage.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'SalesFollow';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_closed_follow_h1'] ;
            $Short_Menu_Sel = 'CloseFollow';
            $Short_Menu_Sel_Sub = "ListToday";    
            $Section_View = "CloseReview";
            $SalesFollowPages = "1"; 
            break;
               
      case 'ListBack':
            $content =  UserPerMatianCont('SalesFollow_ListPage.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'SalesFollow';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_closed_follow_h1'] ;
            $Short_Menu_Sel = 'CloseFollow';
            $Short_Menu_Sel_Sub = "ListBack";    
            $Section_View = "CloseReview";
            $SalesFollowPages = "1";      
            break;            
        
      case 'ListNext':
            $content =  UserPerMatianCont('SalesFollow_ListPage.php',$USER_PERMATION_List);
            $ThisMenuIs_li = $ThisMenuIs.'SalesFollow';
            $PageTitle = $Module_H1.$AdminLangFile['custserv_closed_follow_h1'] ;
            $Short_Menu_Sel = 'CloseFollow';
            $Short_Menu_Sel_Sub = "ListNext";    
            $Section_View = "CloseReview";
            $SalesFollowPages = "1";      
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