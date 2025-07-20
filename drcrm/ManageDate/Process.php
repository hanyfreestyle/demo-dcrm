<?php
if(!defined('WEB_ROOT')) {	exit;}
 

#################################################################################################################################
################################################### CustSubAdd  
#################################################################################################################################
function CustSubAdd($db){
    $Err = "";
    $Err_En = "";
    global $AdminLangFile ;
    global $Main_DataTabel ;
    global $Fs_ListUrl ;
    $ThisIsTest = '0';
    $CatId = Clean_Mypost($_POST['cat_id']) ;
    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;
    $server_data = array ('id'=> NULL ,
    'cat_id'=> $CatId  ,
    'name'=> $Name  ,
    'name_en'=> $Name_En  ,
    'state'=> "1"  ,
    );
  
   $already = $db->H_Total_Count("SELECT * FROM $Main_DataTabel where name = '$Name'  and  cat_id = '$CatId' ");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err']);
   $Err = '1'; 
   }
   
   $already = $db->H_Total_Count("SELECT * FROM $Main_DataTabel where name_en = '$Name_En'  and  cat_id = '$CatId' ");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err'].ENLANG);
   $Err_En = '1'; 
   }
   
    if($ThisIsTest == "1"){
    print_r3($server_data);
    }else{
       if($Err != '1' and  $Err_En != '1' ){
       $db->AutoExecute($Main_DataTabel,$server_data,AUTO_INSERT);
       Redirect_Page_2("index.php?view=".$Fs_ListUrl);
       }
    }
}

#################################################################################################################################
###################################################   
#################################################################################################################################
function CustSubEdit($db){
    $Err = "";
    $Err_En = "";
    global $AdminLangFile ; 
    global $Main_DataTabel ;
    global $Fs_ListUrl ;
    $ThisIsTest = '0';
    $id = $_GET['id'];
    $CatId = Clean_Mypost($_POST['cat_id']) ;
    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;
    $server_data = array (
    'name'=> $Name  ,
    'name_en'=> $Name_En  ,
    'cat_id'=> $CatId  ,
    );
    
   $already = $db->H_Total_Count("SELECT * FROM $Main_DataTabel where name = '$Name'  and  cat_id = '$CatId'  and id != $id");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err']);
   $Err = '1'; 
   }
   
   $already = $db->H_Total_Count("SELECT * FROM $Main_DataTabel where name_en = '$Name_En'  and  cat_id = '$CatId' and id != $id");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err'].ENLANG);
   $Err_En = '1'; 
   }
   
    if($ThisIsTest == "1"){
    print_r3($server_data);
    }else{
       if($Err != '1' and  $Err_En != '1' ){
       $db->AutoExecute($Main_DataTabel,$server_data,AUTO_UPDATE,"id = $id");
       Redirect_Page_2("index.php?view=".$Fs_ListUrl);
       }
    }
}
#################################################################################################################################
###################################################   AddData
#################################################################################################################################
function AddData($db){
    $Err = "";
    $Err_En = "";
    global $AdminLangFile ;
    global $Fs_DataTabel ;
    global $Fs_ListUrl ;
    $ThisIsTest = '0';
    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;
    $server_data = array ('id'=> NULL ,
    'name'=> $Name  ,
    'name_en'=> $Name_En  ,
    'state'=> "1"  ,
    );
   $already = $db->H_Total_Count("SELECT * FROM $Fs_DataTabel where name = '$Name' ");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err']);
   $Err = '1'; 
   }
   $already = $db->H_Total_Count("SELECT * FROM $Fs_DataTabel where name_en = '$Name_En' ");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err'].ENLANG);
   $Err_En = '1'; 
   } 
   if($ThisIsTest == '1'){
       print_r3($server_data);    
   }else{
       if($Err != '1' and  $Err_En != '1' ){
       $db->AutoExecute($Fs_DataTabel,$server_data,AUTO_INSERT);
       Redirect_Page_2("index.php?view=".$Fs_ListUrl);
       }
   }
}
#################################################################################################################################
###################################################   EditData
#################################################################################################################################
function EditData($db){
    $Err = "";
    $Err_En = "";
    global $AdminLangFile ;
    global $Fs_DataTabel ;
    global $Fs_ListUrl ;
    $ThisIsTest = '0';
    $id = $_GET['id'];
    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;
    $server_data = array ( 
    'name'=> $Name  ,
    'name_en'=> $Name_En  ,
    );
    
    
   $already = $db->H_Total_Count("SELECT * FROM $Fs_DataTabel where name = '$Name'  and id != $id  ");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err']);
   $Err = '1'; 
   }
   $already = $db->H_Total_Count("SELECT * FROM $Fs_DataTabel where name_en = '$Name_En' and id != $id  ");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err'].ENLANG);
   $Err_En = '1'; 
   } 
   
   if($ThisIsTest == '1'){
       print_r3($server_data);    
   }else{
   if($Err != '1' and  $Err_En != '1' ){
   $db->AutoExecute($Fs_DataTabel,$server_data,AUTO_UPDATE,"id = $id");
   Redirect_Page_2("index.php?view=".$Fs_ListUrl);
   }
   }
}

#################################################################################################################################
###################################################   CatIdAddData
#################################################################################################################################
function CatIdAddData($db){
    $Err = "";
    $Err_En = "";
    global $AdminLangFile ;
    global $Fs_DataTabel ;
    global $Fs_ListUrl ;
    $ThsiIsTest = '0';
    $ConfigTabel = "config_data";
    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;
    $server_data = array ('id'=> NULL ,
    'name'=> $Name  ,
    'name_en'=> $Name_En  ,
    'cat_id'=> $Fs_DataTabel  ,
    'state'=> "1"  ,
    );
   $already = $db->H_Total_Count("SELECT * FROM $ConfigTabel where cat_id = '$Fs_DataTabel' and  name = '$Name' ");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err']);
   $Err = '1'; 
   }
   $already = $db->H_Total_Count("SELECT * FROM $ConfigTabel where cat_id = '$Fs_DataTabel' and name_en = '$Name_En' ");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err'].ENLANG);
   $Err_En = '1'; 
   } 
   if($Err != '1' and  $Err_En != '1' ){
   if($ThsiIsTest == '1'){
   print_r3($server_data) ;   
   }else{
   $db->AutoExecute($ConfigTabel,$server_data,AUTO_INSERT);
   Redirect_Page_2("index.php?view=".$Fs_ListUrl);
   } 
   }
}

#################################################################################################################################
################################################### CatIdEditData  
#################################################################################################################################
function CatIdEditData($db){
    $Err = "";
    $Err_En = "";
    global $AdminLangFile ;
    global $Fs_DataTabel ;
    global $Fs_ListUrl ;
    $ThsiIsTest = '0';
    $id = $_GET['id'];
    $ConfigTabel = "config_data";
    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;
    $server_data = array ( 
    'name'=> $Name  ,
    'name_en'=> $Name_En  ,
    );
   $already = $db->H_Total_Count("SELECT * FROM $ConfigTabel where cat_id = '$Fs_DataTabel' and  name = '$Name' and id != $id ");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err']);
   $Err = '1'; 
   }
   $already = $db->H_Total_Count("SELECT * FROM $ConfigTabel where cat_id = '$Fs_DataTabel' and name_en = '$Name_En' and id != $id ");
   if($already > 0) {
   SendJavaErrMass($AdminLangFile['mainform_name_add_err'].ENLANG);
   $Err_En = '1'; 
   } 
   if($Err != '1' and  $Err_En != '1' ){
   if( $ThsiIsTest == '1'){
    print_r3($server_data);
   }else{
   $db->AutoExecute($ConfigTabel,$server_data,AUTO_UPDATE,"id = $id");
   Redirect_Page_2("index.php?view=".$Fs_ListUrl);
   }
   }
}

#################################################################################################################################
###################################################   
#################################################################################################################################


?>