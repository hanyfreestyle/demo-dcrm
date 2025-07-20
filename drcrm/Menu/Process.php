<?php
if(!defined('WEB_ROOT')) {	exit;}
checkUser();
 

##############################################################################################################################################################
################################ Cat_Add
##############################################################################################################################################################

function Cat_Add($db){
    global $ConfigP ;

    $args = array();
    $args +=$server_data = array (
    'id'=> NULL ,
    'name'=> Clean_Mypost($_POST['name']),
    'cat_id'=> Clean_Mypost($_POST['cat_id']),
    'icon'=> Clean_Mypost($_POST['icon']),
    'web_admin'=> Clean_Mypost($_POST['web_admin']),
    'state'=> "1",
    );

    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'name_en'=> Clean_Mypost($_POST['name_en']) 
    );    
    };
   $add_server = $db->AutoExecute(CAT_TABEL,$args,AUTO_INSERT);
   CatAdd_Redirect($ConfigP['catadd_redirect']);
}



function Cat_Edit($db){
    global $ConfigP ;
    $id = $_GET['id']; 
    $args = array();
    $args +=$server_data = array (
    'name'=> Clean_Mypost($_POST['name']),
    'cat_id'=> Clean_Mypost($_POST['cat_id']),
    'icon'=> Clean_Mypost($_POST['icon']),
    'web_admin'=> Clean_Mypost($_POST['web_admin']),
    'state'=> "1",
    );

    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'name_en'=> Clean_Mypost($_POST['name_en']) 
    );    
    };    

   $add_server = $db->AutoExecute(CAT_TABEL,$args,AUTO_UPDATE,"id = $id");
   CatEdit_Redirect($ConfigP['catedit_redirect']);
}




function Add($db){   
    global $ConfigP;
    global $LastAdd_S ;

    $args = array();
   
    $args += $server_data = array ('id'=> NULL ,
  
    'name'=> Clean_Mypost($_POST['name']),
    'cat_id'=> Clean_Mypost($_POST['cat_id']),
    'views'=> $_POST['views'],
    'path'=> $_POST['path'],
    'admin_view'=> $_POST['admin_view'],
    
    'state'=> "1",
    ); 
    
    
    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'name_en'=> Clean_Mypost($_POST['name_en']),
    );    
    };
    
    

    $add_server = $db->AutoExecute(GROUPTABEL,$args,AUTO_INSERT);
    UnsetAllSession('name,name_en,views,cat_id,path');
    LastAddadmin($LastAdd_S);
    CountUnitFun();
    UnitAdd_Redirect($ConfigP['unitadd_redirect']); 
} 

function Edit($db){
    global $ConfigP ;
    $id = $_GET['id']; 
    $args = array();
    $args +=$server_data = array (
    'name'=> Clean_Mypost($_POST['name']),
    'cat_id'=> Clean_Mypost($_POST['cat_id']),
    'path'=> Clean_Mypost($_POST['path']),
    'views'=> Clean_Mypost($_POST['views']),
    'admin_view'=> $_POST['admin_view'],
     );

    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'name_en'=> Clean_Mypost($_POST['name_en']) 
    );    
    };    

   $add_server = $db->AutoExecute(GROUPTABEL,$args,AUTO_UPDATE,"id = $id");
   unsetsss("name,name_en,path,views");
   CountUnitFun();
   UnitEdit_Redirect($ConfigP['unitedit_redirect']);
}



?>