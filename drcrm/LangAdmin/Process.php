<?php
if(!defined('WEB_ROOT')) {	exit;}
checkUser();
 

##############################################################################################################################################################
################################ Cat_Add
##############################################################################################################################################################

function CatAdd($db){
    global $CatTabel ;
    global $ConfigP ;
    global $AdminLangFile ;

    $cat_id = MaketheModeLink_Lang(Clean_Mypost($_POST['cat_id']));
    $cat_id = strtolower($cat_id);
    
    $already = $db->H_Total_Count("SELECT * FROM  $CatTabel WHERE cat_id = '$cat_id'");
    if($already > 0) {
    SendJavaErrMass($AdminLangFile['mainform_err_this_name_already_exists']);
    }else{
    
    $args = array();
    $args +=$server_data = array (
    'id'=> NULL ,
    'name'=> Clean_Mypost($_POST['name']),
    'cat_id'=> $cat_id,
    );

    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'name_en'=> Clean_Mypost($_POST['name_en']) 
    );    
    };    

   $add_server = $db->AutoExecute($CatTabel,$args,AUTO_INSERT);
   UnsetAllSession('name,name_en,cat_id');
   CatAdd_Redirect($ConfigP['catadd_redirect']);
   }
}

##############################################################################################################################################################
################################ EditCat
##############################################################################################################################################################

function CatEdit($db){
    global $CatTabel ;
    global $ConfigP ;
    global $AdminLangFile ;
    $id = $_GET['id'];
    
    
    $cat_id = MaketheModeLink_Lang(Clean_Mypost($_POST['cat_id']));
    $cat_id = strtolower($cat_id);
    
    $already = $db->H_Total_Count("SELECT * FROM  $CatTabel WHERE cat_id = '$cat_id' and id != '$id'");
    if($already > 0) {
    SendJavaErrMass($AdminLangFile['mainform_err_this_name_already_exists']);
    }else{
        
    $args = array();
    $args +=$server_data = array (
    'name'=> Clean_Mypost($_POST['name']),
    'cat_id'=> $cat_id,
    );

    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'name_en'=> Clean_Mypost($_POST['name_en']) 
    );    
    }; 
    $add_server = $db->AutoExecute($CatTabel,$args,AUTO_UPDATE,"id = $id"); 
    UnsetAllSession('name,name_en,cat_id');
    CatEdit_Redirect($ConfigP['catedit_redirect']) ;

    } 
}

##############################################################################################################################################################
################################ LangAdd
##############################################################################################################################################################

function Add($db){   
    global $GroupTabel ;
    global $LastAdd_S ;
    global $ConfigP;
    global $AdminLangFile ;
   
    
    $ThisISTest = '0';
    
   $var = MaketheModeLink_Lang(Clean_Mypost($_POST['var']));
   $var = strtolower($var);
   
   $TheCatID = $_POST['cat_id'];

   $already = $db->H_Total_Count("SELECT * FROM $GroupTabel WHERE var = '$var' and cat_id = '$TheCatID' ");

   if ($already > '0'  ){
   SendJavaErrMass($AdminLangFile['mainform_err_this_name_already_exists']);  
   }else{
    
    $name = Remove_HTML($_POST['name']);
    $name = stripslashes(htmlspecialchars_decode($name));    
    $name_en = Remove_HTML($_POST['name_en']);
    $name_en = stripslashes(htmlspecialchars_decode($name_en)); 
    
    
    $args = array();
   
    $args += $server_data = array ('id'=> NULL ,
    'cat_id'=> $_POST['cat_id'],
    'var'=> $var,
    'name'=> $name,
    'state'=> "1",
    ); 
    
    
    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'name_en'=> $name_en,
    );    
    };
    
       if($ThisISTest == '1'){
        print_r3($args);
       }else{
       $add_server = $db->AutoExecute(GROUPTABEL,$args,AUTO_INSERT);
       LastAddadmin($LastAdd_S);
       CountUnitFun();
       LangAdd_Redirect($ConfigP['unitadd_redirect']);  
       } 
   }
}    


##############################################################################################################################################################
################################ LangEdit
##############################################################################################################################################################

function Edit($db){
   global $GroupTabel ;
   global $ConfigP;
   global $AdminLangFile ;
   $id = $_GET['id'];
   $ThisISTest = '0';

   $var = MaketheModeLink_Lang(Clean_Mypost($_POST['var']));
   $var = strtolower($var);
   
   $TheCatID = $_POST['cat_id'];
   $already = $db->H_Total_Count("SELECT * FROM $GroupTabel WHERE var = '$var' and cat_id = '$TheCatID' and id != '$id' ");
   
   if ($already > '0'  ){
   SendJavaErrMass($AdminLangFile['mainform_err_this_name_already_exists']);
   }else{

    
    $name = Remove_HTML($_POST['name']);
    $name = stripslashes(htmlspecialchars_decode($name)); 
    $name = Removword($_POST['name']);   
    $name_en = Remove_HTML($_POST['name_en']);
    $name_en = stripslashes(htmlspecialchars_decode($name_en)); 
    
    
    
    $args = array();
    $args += $server_data = array (
    'cat_id'=> $_POST['cat_id'],
    'var'=> $var,
    'name'=> $name,
   ); 
    
    
    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'name_en'=> $name_en,
    );    
    };

    if($ThisISTest == '1'){
        print_r3($args);
    }else{
    $add_server = $db->AutoExecute(GROUPTABEL,$args,AUTO_UPDATE,"id = $id");    
    CountUnitFun();
    LangEdit_Redirect($ConfigP['unitedit_redirect'],$_POST['cat_id']);
    }
    }
}


##############################################################################################################################################################
################################ PriceMange
##############################################################################################################################################################
function PriceMange(){
    global $db ;
    global $ConfigP ;
    global $GroupTabel ;
    global $CatTabel ;
    global $AdminLangFile ;
    $TheCat_Id =  CheckTheGet("id","id",$CatTabel,"خطأ","خطأ");
    $EmailCount = count($_POST['id_id']);

    for ($i = 0; $i < $EmailCount; $i++){
    $id =  $_POST['id_id'][$i]  ;
    
    $var = MaketheModeLink_Lang(Clean_Mypost($_POST['var'][$i]));
    $var = strtolower($var);
   
    $already = $db->H_Total_Count("SELECT * FROM $GroupTabel WHERE var = '$var' and cat_id = '$TheCat_Id' and id != '$id' ");
   if ($already > '0'  ){
   SendJavaErrMass($AdminLangFile['mainform_err_this_name_already_exists']);  
   }else{
    /*   
    echo "i :".$i.BR ;
    echo "Id :".$id.BR ; 
    echo "CatId :".$TheCat_Id.BR ;
    echo "Var :".$var.BR ;
    echo "Name :".$_POST['name'][$i].BR ;
    echo "Name En :".$_POST['name_en'][$i].BR ;
     
    echo "--------------------------".BR ;
 */
    

    $args = array();
    $args +=$server_data = array (
    'var'=> $var, 
    'name'=> $_POST['name'][$i],
    );
    
    if(ADMINCPANELLANG == '1'){
    $args +=$server_data = array ( 
    'name_en'=> $_POST['name_en'][$i],
    );    
    }

    $add_server = $db->AutoExecute($GroupTabel,$args,AUTO_UPDATE,"id = $id");
  
    }
    
    }
}



##############################################################################################################################################################
################################ DelUnit
##############################################################################################################################################################

function DelUnit(){
    global $db ;
    global $GroupTabel ;
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
    $id =  $_POST['id_id'][$i]  ;
   $db->H_DELETE_FromId($GroupTabel,$id);
  }
  CountUnitFun();
}


#################################################################################################################################
###################################################   UpdateAdminLang
#################################################################################################################################
function UpdateAdminLang(){
    global $db ;
$Name = $db->SelArr("SELECT * FROM x_admin_lang_cat_2 ");
for($i = 0; $i < count($Name); $i++) {
    $server_data = array ( 'id'=> NULL ,
    'cat_id'=> $Name[$i]['cat_id'],
    'name'=> $Name[$i]['name'],
    'name_en'=> $Name[$i]['name_en'],
    'postion'=> $Name[$i]['id'],
    );  
     $add_server = $db->AutoExecute("x_admin_lang_cat",$server_data,AUTO_INSERT);
 } 
$Name = $db->SelArr("SELECT * FROM x_admin_lang_cat "); 
 for($i = 0; $i < count($Name); $i++) {
  $thisiD = $Name[$i]['id'] ;
  $old_id =  $Name[$i]['postion'] ;
    $Name_2 = $db->SelArr("SELECT * FROM x_admin_lang_var_2 where cat_id = $old_id ");
    for($x = 0; $x < count($Name_2); $x++) {
    $Name_2[$x][''];  
    $server_data = array ( 'id'=> NULL ,
    'cat_id'=> $thisiD,
    'var'=> $Name_2[$x]['var'],
    'name'=> $Name_2[$x]['name'],
    'name_en'=> $Name_2[$x]['name_en'],
    'state'=> "1",
    );  
  //  print_r3($server_data);
   $add_server = $db->AutoExecute("x_admin_lang_var",$server_data,AUTO_INSERT);  
    } 
 }
}



function GetCatVar($OldId,$NewId,$DoThis="0"){
    global $db ;

    $Name_2 = $db->SelArr("SELECT * FROM x_admin_lang_var_2 where cat_id = $OldId ");
    for($x = 0; $x < count($Name_2); $x++) {
    $Name_2[$x][''];  
    $server_data = array ( 'id'=> NULL ,
    'cat_id'=> $NewId,
    'var'=> $Name_2[$x]['var'],
    'name'=> $Name_2[$x]['name'],
    'name_en'=> $Name_2[$x]['name_en'],
    'state'=> "1",
    );  
  //  print_r3($server_data);
  if($DoThis == '1'){
   $add_server = $db->AutoExecute("x_admin_lang_var",$server_data,AUTO_INSERT); 
  }else{
    print_r3($server_data);
  }
     
    } 
    
    
}


?>