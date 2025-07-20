<?php   
if(!defined('WEB_ROOT')) {	exit;}
 
    require_once '_Inc_Files_Var.php';

    if(isset($_SESSION['adminusername'.$pfw_db])){
    $ThisCountUserID = $_SESSION['adminusername'.$pfw_db] ;
    $sql = "SELECT * FROM tbl_user  where user_name = '$ThisCountUserID'";
    $result = mysqli_query($con,$sql);
    $RowUsreInfo = mysqli_fetch_array($result);
    if($RowUsreInfo['lang'] == '2'){
    define('ADMIN_WEB_LANG', "En" ); 
    }else{
    define('ADMIN_WEB_LANG', "Ar" ); 
    }
    }else{
    define('ADMIN_WEB_LANG', "Ar" );     
    }
       
   require_once  'LangFile/Lang_Admin_'.ADMIN_WEB_LANG.'.php';  
   $ALang = $AdminLangFile ;
   
   if(H_DEMO_SITE_NAME == 'ftah'){
   require_once '_Inc_Files_FType_F.php';
   }else{
   require_once '_Inc_Files_FType_D.php'; 
   } 
   

    /** Class */
    require_once 'Class/Class_Autokeyword.php';
    require_once 'Class/Class_DB.php';
    require_once 'Class/Class_Upload.php';
    require_once 'Class/Class_FormValidator.php';
    require_once 'Class/Class_DownLoadFile.php';
    require_once 'Class/GoogleAuthenticator.php';
    require_once 'Class/SMTP_Phpmailer.php';
    require_once 'Class/class.smtp.php';

    $db = new DB($pfw_host,$pfw_user,$pfw_pw,$pfw_db);
 

    require_once 'Form/FormTools.php';
    require_once 'Form/NewForm_2018.php';
    require_once 'Form/Form_Filter.php';
    require_once 'Form/UpLoadFile.php';
   
    #### CatFunctions  
    /*
    require_once 'Tools/Z_CatFunctions.php';
    require_once 'Tools/Z_MetaFunction.php';
    */
    
    #### Tools Functions  
    require_once 'Tools/Php_HomeFunctions.php';
    require_once 'Tools/Php_Datetime.php';
    require_once 'Tools/Php_Array_Functions.php';
    require_once 'Tools/Php_LetterFunction.php';
    require_once 'Tools/Php_Table_PrintFunction.php';
    require_once 'Tools/Php_Sql_Join.php';
    
    
    
    require_once 'Tools/Module_Admin.php';
    require_once 'Tools/Module_Chart.php';
    require_once 'Tools/Module_Project.php';
    require_once 'Tools/Module_LandingPage.php';
    
    
    require_once 'Tools/Module_Customer.php';   
    require_once 'Tools/Module_Customer_CheckRepet.php';
    require_once 'Tools/Module_Customer_Function.php';   
    require_once 'Tools/Module_Ticket.php';    
    require_once 'Tools/Module_Ticket_Function.php';
    require_once 'Tools/Module_Ticket_View.php';
        
    require_once 'Tools/Module_Customers_Service.php';
    require_once 'Tools/Module_Users.php';
    require_once 'Tools/Module_User_Credentials.php';
 
    require_once 'VarList.php';
    require_once 'Update/_Sql_Update.php'; 
    require_once 'Update/Sql_Update_Blue.php';
    require_once 'BackUpTools/MainFun.php';
    
    


       
     
   define('ADMINPRINT_S',"0");
   $UnsetAllSession = "cat_id,date,name,titel,name_2";
   if(!isset($_POST['B1'])){
   UnsetAllSession($UnsetAllSession);
   }
   if(ADMIN_WEB_LANG == 'En'){$NamePrint = 'name_en' ;  }else{ $NamePrint = 'name' ;}	
   

?>