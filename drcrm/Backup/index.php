<?php
 
 require_once '../include/inc_reqfile.php';
 require "ThirdParty/vendor/autoload.php";
 define('BACKUP_FOLDER_DIR',__DIR__."/File/");


define('MAX_FULL_BACK',"2");
define('MAX_MONTHLY_BACK',"3");  
define('FULL_SOURS_PHOTO_DIR',SRV_ROOT .'images/');
define('MONTH_SOURS_PHOTO_DIR',SRV_ROOT .'images/'.CURRENT_PATH);
define('BACK_PHOTO_FOLDER',__DIR__."/FilePhoto/");


 
 
 
$AdminConfig = checkUser();
$USER_PERMATION_List = $AdminConfig["admin"];
$Module_H1 =  $AdminLangFile['backup_h1']." | ";
 
if($AdminConfig["admin"] == '1') {
$ThisMenuIs ="";
$view = (isset($_GET['view']) && $_GET['view'] != '')?$_GET['view']:'';
switch($view) {

#################################################################################################################################
###################################################    Sql
#################################################################################################################################

        case 'List':
            $content =  UserPerMatianCont('BackUp_SQL_List.php',$AdminConfig["admin"]);
            $ThisMenuIs_li = $ThisMenuIs.'List';
            $PageTitle = $Module_H1.$AdminLangFile['backup_list'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'List';
            break;

        case 'Add':
            $content =  UserPerMatianCont('BackUp_SQL_Add.php',$AdminConfig["admin"]);
            $ThisMenuIs_li = $ThisMenuIs.'Add';
            $PageTitle = $Module_H1.$AdminLangFile['backup_add'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Add';
            break;

        case 'DownLoad':
            $content =  UserPerMatianCont('BackUp_SQL_DownLoad.php',$AdminConfig["admin"]);
            $ThisMenuIs_li = $ThisMenuIs.'DownLoad';
            $PageTitle = $Module_H1.$AdminLangFile['backup_download'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'DownLoad';
            break;


        case 'Dell':
            $content =  UserPerMatianCont('BackUp_SQL_Dell.php',$AdminConfig["admin"]);
            $ThisMenuIs_li = $ThisMenuIs.'Dell';
            $PageTitle = $Module_H1.$AdminLangFile['backup_dell'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Dell';
            break;


#################################################################################################################################
###################################################    Photo
#################################################################################################################################

        case 'PhotoFullList':
            $content =  UserPerMatianCont_2('BackUp_Photo_List.php',$AdminConfig["admin"],IMAGES_BACK_UP);
            $ThisMenuIs_li = $ThisMenuIs.'PhotoFullList';
            $PageTitle = $Module_H1.$AdminLangFile['backup_full_backup_photo'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PhotoFullList';
            $b_type = 'f_photo';
            break;

        case 'PhotoMonthlyList':
            $content =  UserPerMatianCont_2('BackUp_Photo_List.php',$AdminConfig["admin"],IMAGES_BACK_UP);
            $ThisMenuIs_li = $ThisMenuIs.'PhotoMonthlyList';
            $PageTitle = $Module_H1.$AdminLangFile['backup_monthly_backup_photo'];;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PhotoMonthlyList';
            $b_type = 'm_photo';
            break;
            


        case 'PhotoFullAdd':
            $content =  UserPerMatianCont_2('BackUp_Photo_Add_Full.php',$AdminConfig["admin"],IMAGES_BACK_UP);
            $ThisMenuIs_li = $ThisMenuIs.'PhotoFullList';
            $PageTitle = $Module_H1.$AdminLangFile['backup_create_full_back_up'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PhotoFullList';
            break;

        case 'PhotoMonthlyAdd':
            $content =  UserPerMatianCont_2('BackUp_Photo_Add_Monthly.php',$AdminConfig["admin"],IMAGES_BACK_UP);
            $ThisMenuIs_li = $ThisMenuIs.'PhotoMonthlyList';
            $PageTitle = $Module_H1.$AdminLangFile['backup_create_monthly_back_up'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'PhotoMonthlyList';
            break;

        case 'DellPhoto':
            $content =  UserPerMatianCont_2('BackUp_Photo_Dell.php',$AdminConfig["admin"],IMAGES_BACK_UP);
            $ThisMenuIs_li = $ThisMenuIs.'Dell';
            $PageTitle = $Module_H1.$AdminLangFile['backup_dell'] ;
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Dell';
            break;

        case 'CopyFile':
            $content =  UserPerMatianCont_2('BackUp_Photo_Copy.php',$AdminConfig["admin"],IMAGES_BACK_UP);
            $ThisMenuIs_li = $ThisMenuIs.'Dell';
            $PageTitle = $Module_H1.$AdminLangFile['backup_copy_file'];
            $Short_Menu = '_Short_Menu.php';
            $Short_Menu_Sel = 'Dell';
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