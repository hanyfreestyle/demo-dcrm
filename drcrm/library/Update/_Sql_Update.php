<?php

/*
#################################################################################################################################
###################################################   حذف ملفات اللغة  
#################################################################################################################################  64- 2 = 44
/* 
$db->H_DELETE("DROP TABLE x_lang_var");
$db->H_DELETE("DROP TABLE x_lang_cat");
*/



#################################################################################################################################
###################################################  x_back_up , Lang  , Menu
################################################################################################################################# 44 - 5 = 39
/*
$TabelName = "x_back_up";
AddFildeToTabel($TabelName,"b_type","type","var","50","0");
AddFildeToTabel($TabelName,"date_month","b_type","var","50","0");
CHANGE_Filde($TabelName,"date_add","var","50");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"path","var","250");
CHANGE_Filde($TabelName,"type","int","0");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"b_type","var","50");
CHANGE_Filde($TabelName,"date_month","var","50");



$TabelName = "x_admin_menu_sub";
CHANGE_Filde($TabelName,"cat_id","int","0");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"path","var","100");
CHANGE_Filde($TabelName,"views","var","100");
CHANGE_Filde($TabelName,"admin_view","int","0");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"postion","int","0");

$TabelName = "x_admin_menu";
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"cat_id","var","100");
CHANGE_Filde($TabelName,"icon","var","100");
CHANGE_Filde($TabelName,"freestyle","int","0");
CHANGE_Filde($TabelName,"web_admin","int","0");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"count_unit","int","0"); 
CHANGE_Filde($TabelName,"count_unit_a","int","0");
CHANGE_Filde($TabelName,"postion","int","0");

$TabelName = "x_admin_lang_var";
CHANGE_Filde($TabelName,"cat_id","int","0");
CHANGE_Filde($TabelName,"var","var","200");
CHANGE_Filde($TabelName,"name","text","200");
CHANGE_Filde($TabelName,"name_en","text","200");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"postion","int","0");

$TabelName = "x_admin_lang_cat";
CHANGE_Filde($TabelName,"cat_id","var","100");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"count_unit","int","0"); 
CHANGE_Filde($TabelName,"count_unit_a","int","0");
CHANGE_Filde($TabelName,"postion","int","0");

*/









#################################################################################################################################
###################################################  user_permission
################################################################################################################################# 39 - 1 = 38
/* 
$TabelName = "user_permission";  
AddFildeToTabel($TabelName,"teamleader","sendsms_dell","int","50","0");
AddFildeToTabel($TabelName,"userprofile","teamleader","int","50","0");

    $TabelName = "user_permission";
    $Name = $db->SelArr("SELECT * FROM $TabelName");
    for($i = 0; $i < count($Name); $i++) {
        $F_id = $Name[$i]['id'];
        $server_data = array (
            'userprofile'=> "1" ,
        );
       $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $F_id");
    }



$TabelName = "user_permission";  
AddFildeToTabel($TabelName,"custservleader","teamleader","int","50","0");
AddFildeToTabel($TabelName,"subercustserv","custservleader","int","50","0");

    $TabelName = "user_permission";
    $Name = $db->SelArr("SELECT * FROM $TabelName where id = '1'");
    for($i = 0; $i < count($Name); $i++) {
        $F_id = $Name[$i]['id'];
        $server_data = array (
            'subercustserv'=> "1" ,
        );
       $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $F_id");
    }
    
 

$TabelName = "user_permission";  
AddFildeToTabel($TabelName,"suberteamleader","teamleader","int","50","0");

    $TabelName = "user_permission";
    $Name = $db->SelArr("SELECT * FROM $TabelName where id = '1'");
    for($i = 0; $i < count($Name); $i++) {
        $F_id = $Name[$i]['id'];
        $server_data = array (
            'suberteamleader'=> "1" ,
        );
       $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $F_id");
    }
    
    
CHANGE_Filde($TabelName,"suberteamleader","int","0");


 
 
    

$TabelName = "user_permission";  
AddFildeToTabel($TabelName,"closedticket","salesdep_dell","int","50","0");
AddFildeToTabel($TabelName,"closedticket_add","closedticket","int","50","0");
AddFildeToTabel($TabelName,"closedticket_edit","closedticket_add","int","50","0");
AddFildeToTabel($TabelName,"closedticket_dell","closedticket_edit","int","50","0");

    $TabelName = "user_permission";
    $Name = $db->SelArr("SELECT * FROM $TabelName where id = '1'");
    for($i = 0; $i < count($Name); $i++) {
        $F_id = $Name[$i]['id'];
        $server_data = array (
            'closedticket'=> "1" ,
            'closedticket_add'=> "1" ,
            'closedticket_edit'=> "1" ,
            'closedticket_dell'=> "1" ,
        );
       $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $F_id");
    }        

    $server_data = array ('id'=> NULL ,
        'cat_id'=> "closedticket_config"  ,
        'des'=> 'a:9:{s:14:"perpage_banner";s:2:"10";s:12:"order_banner";s:1:"2";s:15:"defphoto_banner";s:1:"5";s:16:"datatabel_banner";s:1:"0";s:17:"perpage_developer";s:2:"10";s:15:"order_developer";s:1:"1";s:18:"defphoto_developer";s:1:"6";s:19:"datatabel_developer";s:1:"0";s:2:"B1";s:4:"Edit";}' ,
    );
    $add_server = $db->AutoExecute("config_cat",$server_data,AUTO_INSERT);


$TabelName = "user_permission";  
AddFildeToTabel($TabelName,"salesfollow","closedticket_dell","int","50","0");
AddFildeToTabel($TabelName,"salesfollow_add","salesfollow","int","50","0");
AddFildeToTabel($TabelName,"salesfollow_edit","salesfollow_add","int","50","0");
AddFildeToTabel($TabelName,"salesfollow_dell","salesfollow_edit","int","50","0");

    $TabelName = "user_permission";
    $Name = $db->SelArr("SELECT * FROM $TabelName where id = '1'");
    for($i = 0; $i < count($Name); $i++) {
        $F_id = $Name[$i]['id'];
        $server_data = array (
            'salesfollow'=> "1" ,
            'salesfollow_add'=> "1" ,
            'salesfollow_edit'=> "1" ,
            'salesfollow_dell'=> "1" ,
        );
       $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $F_id");
    }  

    $server_data = array ('id'=> NULL ,
        'cat_id'=> "salesfollow_config"  ,
        'des'=> 'a:9:{s:14:"perpage_banner";s:2:"10";s:12:"order_banner";s:1:"2";s:15:"defphoto_banner";s:1:"5";s:16:"datatabel_banner";s:1:"0";s:17:"perpage_developer";s:2:"10";s:15:"order_developer";s:1:"1";s:18:"defphoto_developer";s:1:"6";s:19:"datatabel_developer";s:1:"0";s:2:"B1";s:4:"Edit";}' ,
    );
    $add_server = $db->AutoExecute("config_cat",$server_data,AUTO_INSERT);
    
   

$TabelName = "user_permission"; 
CHANGE_Filde($TabelName,"group_id","int","0");
CHANGE_Filde($TabelName,"admin","int","0");
CHANGE_Filde($TabelName,"web_manage","int","0");
CHANGE_Filde($TabelName,"project","int","0");
CHANGE_Filde($TabelName,"project_add","int","0");
CHANGE_Filde($TabelName,"project_edit","int","0");
CHANGE_Filde($TabelName,"project_dell","int","0");
CHANGE_Filde($TabelName,"contract","int","0");
CHANGE_Filde($TabelName,"contract_add","int","0");
CHANGE_Filde($TabelName,"contract_edit","int","0");
CHANGE_Filde($TabelName,"contract_dell","int","0");
CHANGE_Filde($TabelName,"customer","int","0");
CHANGE_Filde($TabelName,"customer_add","int","0");
CHANGE_Filde($TabelName,"customer_edit","int","0");
CHANGE_Filde($TabelName,"customer_dell","int","0");
CHANGE_Filde($TabelName,"custserv","int","0");
CHANGE_Filde($TabelName,"custserv_add","int","0");
CHANGE_Filde($TabelName,"custserv_edit","int","0");
CHANGE_Filde($TabelName,"custserv_dell","int","0");
CHANGE_Filde($TabelName,"salesdep","int","0");
CHANGE_Filde($TabelName,"salesdep_add","int","0");
CHANGE_Filde($TabelName,"salesdep_edit","int","0");
CHANGE_Filde($TabelName,"salesdep_dell","int","0");
CHANGE_Filde($TabelName,"closedticket","int","0");
CHANGE_Filde($TabelName,"closedticket_add","int","0");
CHANGE_Filde($TabelName,"closedticket_edit","int","0");
CHANGE_Filde($TabelName,"closedticket_dell","int","0");
CHANGE_Filde($TabelName,"salesfollow","int","0");
CHANGE_Filde($TabelName,"salesfollow_add","int","0");
CHANGE_Filde($TabelName,"salesfollow_edit","int","0");
CHANGE_Filde($TabelName,"salesfollow_dell","int","0");
CHANGE_Filde($TabelName,"managedate","int","0");
CHANGE_Filde($TabelName,"managedate_add","int","0");
CHANGE_Filde($TabelName,"managedate_edit","int","0");
CHANGE_Filde($TabelName,"managedate_dell","int","0");
CHANGE_Filde($TabelName,"leads","int","0");
CHANGE_Filde($TabelName,"leads_add","int","0");
CHANGE_Filde($TabelName,"leads_edit","int","0");
CHANGE_Filde($TabelName,"leads_dell","int","0");
CHANGE_Filde($TabelName,"hotline","int","0");
CHANGE_Filde($TabelName,"hotline_add","int","0");
CHANGE_Filde($TabelName,"hotline_edit","int","0");
CHANGE_Filde($TabelName,"hotline_dell","int","0");
CHANGE_Filde($TabelName,"report","int","0");
CHANGE_Filde($TabelName,"report_add","int","0");
CHANGE_Filde($TabelName,"report_edit","int","0");
CHANGE_Filde($TabelName,"report_dell","int","0");
CHANGE_Filde($TabelName,"lppage","int","0");
CHANGE_Filde($TabelName,"lppage_add","int","0");
CHANGE_Filde($TabelName,"lppage_edit","int","0");
CHANGE_Filde($TabelName,"lppage_dell","int","0");
CHANGE_Filde($TabelName,"sendsms","int","0");
CHANGE_Filde($TabelName,"sendsms_add","int","0");
CHANGE_Filde($TabelName,"sendsms_edit","int","0");
CHANGE_Filde($TabelName,"sendsms_dell","int","0");
CHANGE_Filde($TabelName,"teamleader","int","0");
CHANGE_Filde($TabelName,"custservleader","int","0");
CHANGE_Filde($TabelName,"subercustserv","int","0");
CHANGE_Filde($TabelName,"userprofile","int","0");
*/





#################################################################################################################################
###################################################  user_group   / tbl_user 
################################################################################################################################# 38 - 2 = 36

/*
$TabelName = "user_group"; 
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"count","int","0");
CHANGE_Filde($TabelName,"state","int","0");


$TabelName = "tbl_user" ;
$Name = $db->SelArr("SELECT * FROM $TabelName where group_id = '2'  ");
for($i = 0; $i < count($Name); $i++) {
    $ThISIDD = $Name[$i]['user_id'];
    $server_data = array ('sales'=> "1" );
    $add_server = $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"user_id = $ThISIDD");
}

AddFildeToTabel("tbl_user","custserv","team_leader","var","50","0");
AddFildeToTabel("tbl_user","custserv_leader","custserv","var","50","0");

$GoogleCode = new GoogleAuthenticator();
$Name = $db->SelArr("SELECT * FROM tbl_user  ");
for ($i = 0; $i < count($Name); $i++){
    $id = $Name[$i]['user_id'];
    $Code = $GoogleCode->createSecret();
    $server_data = array ('google_code'=> $Code);
    $db->AutoExecute("tbl_user",$server_data,AUTO_UPDATE,"user_id = $id");

}

$TabelName = "tbl_user";
CHANGE_Filde($TabelName,"group_state","int","0");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"email","var","100");
CHANGE_Filde($TabelName,"mobile","var","100");
CHANGE_Filde($TabelName,"last_login","var","100");
CHANGE_Filde($TabelName,"last_seen","var","100");
CHANGE_Filde($TabelName,"seen_state","int","0");
CHANGE_Filde($TabelName,"sales","int","0");
CHANGE_Filde($TabelName,"team_leader","int","0");
CHANGE_Filde($TabelName,"team_leader","int","0");
CHANGE_Filde($TabelName,"custserv","int","0");
CHANGE_Filde($TabelName,"custserv_leader","int","0");
CHANGE_Filde($TabelName,"pass_date","var","100");
CHANGE_Filde($TabelName,"pass_expird","int","0");
CHANGE_Filde($TabelName,"google_code","var","100");
CHANGE_Filde($TabelName,"telegram_code","var","100");
CHANGE_Filde($TabelName,"photo","var","250");
CHANGE_Filde($TabelName,"lang","var","20");
CHANGE_Filde($TabelName,"user_follow","text");
CHANGE_Filde($TabelName,"state","int","0");




#################################################################################################################################
###################################################   sms_report
#################################################################################################################################  36 - 1 = 35
$TabelName = "sms_report";
CHANGE_Filde($TabelName,"date_add","var","50");
CHANGE_Filde($TabelName,"date_time","var","50");
CHANGE_Filde($TabelName,"type","int","0");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"des","text","200");
CHANGE_Filde($TabelName,"count","int","0");
CHANGE_Filde($TabelName,"total","int","0");

*/



#################################################################################################################################
###################################################   sales_ticket_des
################################################################################################################################# 35 - 2 = 33
$TabelName = "sales_ticket";
/*
AddFildeToTabel($TabelName,"close_follow","state","int","200","1"); 
CHANGE_Filde($TabelName,"date_add","var","50");
CHANGE_Filde($TabelName,"date_month","var","50");
CHANGE_Filde($TabelName,"date_time","var","50");
CHANGE_Filde($TabelName,"lead_sours","int","0");
CHANGE_Filde($TabelName,"lead_type","int","0");
CHANGE_Filde($TabelName,"lead_cat","int","0");
CHANGE_Filde($TabelName,"ticket_cust","int","0");
CHANGE_Filde($TabelName,"cust_id","int","0");
CHANGE_Filde($TabelName,"user_id","int","0");
CHANGE_Filde($TabelName,"notes","text","0");
CHANGE_Filde($TabelName,"admin_id","int","0");
CHANGE_Filde($TabelName,"cash_id","int","0");
CHANGE_Filde($TabelName,"unit_id","int","0");
CHANGE_Filde($TabelName,"date_id","int","0");
CHANGE_Filde($TabelName,"bestcall_id","int","0");
CHANGE_Filde($TabelName,"time_id","int","0");
CHANGE_Filde($TabelName,"area_id","int","0");
CHANGE_Filde($TabelName,"pro_area","text","0");
CHANGE_Filde($TabelName,"follow_state","int","0");
CHANGE_Filde($TabelName,"follow_date","var","50");
CHANGE_Filde($TabelName,"follow_time","var","50");
CHANGE_Filde($TabelName,"visit_date","var","50");
CHANGE_Filde($TabelName,"visit_month","var","50");
CHANGE_Filde($TabelName,"priority_id","int","0");
CHANGE_Filde($TabelName,"c_type","int","0");
CHANGE_Filde($TabelName,"c_type_2","int","0");
CHANGE_Filde($TabelName,"visit_s","int","0");
CHANGE_Filde($TabelName,"rev_s","int","0");
CHANGE_Filde($TabelName,"rev_date","var","50");
CHANGE_Filde($TabelName,"rev_month","var","50");
CHANGE_Filde($TabelName,"rev_date_2","var","50");
CHANGE_Filde($TabelName,"cancel_date","var","50");
CHANGE_Filde($TabelName,"cancel_month","var","50");
CHANGE_Filde($TabelName,"contract_date","var","50");
CHANGE_Filde($TabelName,"contract_month","var","50");
CHANGE_Filde($TabelName,"cancel_s","int","0");
CHANGE_Filde($TabelName,"contract_s","int","0");
CHANGE_Filde($TabelName,"jop_id","int","0");
CHANGE_Filde($TabelName,"kind_id","int","0");
CHANGE_Filde($TabelName,"social_id","int","0");
CHANGE_Filde($TabelName,"live_id","int","0");
CHANGE_Filde($TabelName,"country_id","int","0");
CHANGE_Filde($TabelName,"countrylive_id","int","0");
CHANGE_Filde($TabelName,"city_id","int","0");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"close_follow","int","0");
CHANGE_Filde($TabelName,"close_date","var","50");
CHANGE_Filde($TabelName,"close_month","var","50");
CHANGE_Filde($TabelName,"close_date_2","var","50");
CHANGE_Filde($TabelName,"close_month_2","var","50");
CHANGE_Filde($TabelName,"close_type","int","0");
CHANGE_Filde($TabelName,"close_review","int","0");
CHANGE_Filde($TabelName,"contact_review","int","0");
CHANGE_Filde($TabelName,"support_review","int","0");
*/



 
	
/*
$TabelName = "sales_ticket_des";
CHANGE_Filde($TabelName,"cat_id","int","0");
CHANGE_Filde($TabelName,"cust_id","int","0");
CHANGE_Filde($TabelName,"date_add","var","50");
CHANGE_Filde($TabelName,"ticket_date","var","50");
CHANGE_Filde($TabelName,"date_time","var","50");
CHANGE_Filde($TabelName,"date_month","var","50");
CHANGE_Filde($TabelName,"follow_date","var","50");
CHANGE_Filde($TabelName,"follow_time","var","50");
CHANGE_Filde($TabelName,"priority_id","int","0");
CHANGE_Filde($TabelName,"follow_type","int","0");
CHANGE_Filde($TabelName,"follow_state","int","0");
CHANGE_Filde($TabelName,"des","text","");
CHANGE_Filde($TabelName,"user_id","int","0");
CHANGE_Filde($TabelName,"user_name","var","100");
CHANGE_Filde($TabelName,"add_type","int","0");
CHANGE_Filde($TabelName,"count_type","int","0");
*/



/*
#################################################################################################################################
###################################################   reservation
################################################################################################################################# 33 - 1 = 32 
$TabelName = "reservation";
CHANGE_Filde($TabelName,"type","int","0");
CHANGE_Filde($TabelName,"unit_id","int","0");
CHANGE_Filde($TabelName,"pro_id","int","0");
CHANGE_Filde($TabelName,"floor_id","int","0");
CHANGE_Filde($TabelName,"emp_id","int","0");
CHANGE_Filde($TabelName,"cust_id","int","0");
CHANGE_Filde($TabelName,"cust2_id","int","0");
CHANGE_Filde($TabelName,"cust3_id","int","0");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"ref_num","var","100");
CHANGE_Filde($TabelName,"new_date","var","100");
CHANGE_Filde($TabelName,"ref_num_2","var","100");
CHANGE_Filde($TabelName,"ref","var","100"); 
CHANGE_Filde($TabelName,"rev_date","var","100"); 
CHANGE_Filde($TabelName,"cont_date","var","100"); 
CHANGE_Filde($TabelName,"dell_date","var","100");
CHANGE_Filde($TabelName,"dell_num","var","100");
CHANGE_Filde($TabelName,"unit_name","var","200"); 
CHANGE_Filde($TabelName,"pro_name","var","200");
CHANGE_Filde($TabelName,"floor_name","var","200"); 
CHANGE_Filde($TabelName,"emp_name","var","200");
CHANGE_Filde($TabelName,"cust_name","var","200"); 
CHANGE_Filde($TabelName,"cust2_name","var","200");
CHANGE_Filde($TabelName,"cust3_name","var","200");
CHANGE_Filde($TabelName,"notes","text","");
CHANGE_Filde($TabelName,"notes_2","text","");
CHANGE_Filde($TabelName,"dell_notes","text"," "); 
*/



#################################################################################################################################
###################################################   project 
################################################################################################################################# 32 - 6 = 26

/*
$TabelName = "project";  
AddFildeToTabel($TabelName,"name_en","name","var","200","0"); 
AddFildeToTabel($TabelName,"state","name_en","int","50","0");

    $TabelName = "project";
    $Name = $db->SelArr("SELECT * FROM $TabelName");
    for($i = 0; $i < count($Name); $i++) {
        $F_id = $Name[$i]['id'];
        $server_data = array (
            'name_en'=> $Name[$i]['name'] ,
            'state'=> "1" ,
        );
       $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $F_id");
    }

    
$TabelName = "project";    
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"pro_code","var","100");
CHANGE_Filde($TabelName,"area_id","int","0");
CHANGE_Filde($TabelName,"crunt","int","0");
CHANGE_Filde($TabelName,"floor_count","int","0");
CHANGE_Filde($TabelName,"unit_count","int","0");
CHANGE_Filde($TabelName,"rev","int","0");
CHANGE_Filde($TabelName,"rev_c","int","0");
CHANGE_Filde($TabelName,"con","int","0");
CHANGE_Filde($TabelName,"con_c","int","0");

  */  


/*
$TabelName = "project_area";  
AddFildeToTabel($TabelName,"name_en","name","var","200","0"); 
AddFildeToTabel($TabelName,"state","name_en","int","50","0");

    
$Name = $db->SelArr("SELECT * FROM $TabelName");
    for($i = 0; $i < count($Name); $i++) {
        $F_id = $Name[$i]['id'];
        $server_data = array (
            'name_en'=> $Name[$i]['name'] ,
            'state'=> "1" ,
        );
       $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $F_id");
    }

$TabelName = "project_area"; 
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"count","int","0");
CHANGE_Filde($TabelName,"postion","int","0");
*/



/*
$TabelName = "project_floor";  
AddFildeToTabel($TabelName,"name_en","name","var","200","0"); 

    $Name = $db->SelArr("SELECT * FROM $TabelName");
    for($i = 0; $i < count($Name); $i++) {
        $F_id = $Name[$i]['id'];
        $server_data = array (
            'name_en'=> $Name[$i]['name'] ,
        );
       $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $F_id");
    }

$TabelName = "project_floor"; 
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"pro_id","int","0");
CHANGE_Filde($TabelName,"f_code","int","0");
CHANGE_Filde($TabelName,"unit","int","0");

*/

/*
$TabelName = "project_floor_name";  
AddFildeToTabel($TabelName,"name_en","name","var","200","0"); 

    $Name = $db->SelArr("SELECT * FROM $TabelName");
    for($i = 0; $i < count($Name); $i++) {
        $F_id = $Name[$i]['id'];
        $server_data = array (
            'name_en'=> $Name[$i]['name'] ,
        );
       $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $F_id");
    }
    


$TabelName = "project_floor_name";  
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"code","int","0");
*/


/*


$TabelName = "project_price"; 
CHANGE_Filde($TabelName,"pro_id","int","0");
CHANGE_Filde($TabelName,"count","int","0");
CHANGE_Filde($TabelName,"last_date","var","100");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"total_price","var","100");
CHANGE_Filde($TabelName,"unit_m_price","var","100");
CHANGE_Filde($TabelName,"reser_price","var","100");
CHANGE_Filde($TabelName,"contract_price","var","100");
CHANGE_Filde($TabelName,"monthly_price","var","100");
CHANGE_Filde($TabelName,"monthly_des","var","100");
CHANGE_Filde($TabelName,"st_date","var","100");
CHANGE_Filde($TabelName,"end_date","var","100");
CHANGE_Filde($TabelName,"g_data","text","");
CHANGE_Filde($TabelName,"t_data","text","");
*/




/*
$TabelName = "project_unit"; 
CHANGE_Filde($TabelName,"price_id","int","0");
CHANGE_Filde($TabelName,"pro_id","int","0");
CHANGE_Filde($TabelName,"floor_id","int","0");
CHANGE_Filde($TabelName,"f_code","int","0");
CHANGE_Filde($TabelName,"u_code","var","100");
CHANGE_Filde($TabelName,"p_code","var","100");
CHANGE_Filde($TabelName,"u_num","var","100");
CHANGE_Filde($TabelName,"type","var","100");
CHANGE_Filde($TabelName,"u_area","var","100");
CHANGE_Filde($TabelName,"g_area","var","100");
CHANGE_Filde($TabelName,"notes","text","");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"rev_id","int","0");
CHANGE_Filde($TabelName,"avtive","int","0");
*/


#################################################################################################################################
###################################################     landpage
################################################################################################################################# 26 - 5 = 21

/*
$db->H_DELETE("ALTER TABLE landpage DROP COLUMN service_type_id ");        
$db->H_DELETE("ALTER TABLE landpage DROP COLUMN location_id ");
AddFildeToTabel("landpage","form_config","thanks_mob","text","50","0");
*/



/*
$TabelName = "landpage"; 
CHANGE_Filde($TabelName,"lead_cat","int","0");
CHANGE_Filde($TabelName,"lead_type","int","0");
CHANGE_Filde($TabelName,"lead_sours","int","0");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_m","var","200");
CHANGE_Filde($TabelName,"des","text","");
CHANGE_Filde($TabelName,"g_name","var","200");
CHANGE_Filde($TabelName,"g_des","text",""); 
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"name_m_en","var","200");
CHANGE_Filde($TabelName,"des_en","text","");
CHANGE_Filde($TabelName,"g_name_en","var","200");
CHANGE_Filde($TabelName,"g_des_en","text",""); 
CHANGE_Filde($TabelName,"photo","var","250");
CHANGE_Filde($TabelName,"photo_t","var","250");
CHANGE_Filde($TabelName,"mob_state","int","0");
CHANGE_Filde($TabelName,"mob_num","var","50");
CHANGE_Filde($TabelName,"mob_title","var","200");
CHANGE_Filde($TabelName,"mob_title_en","var","200");	
CHANGE_Filde($TabelName,"mob_des","text","");  
CHANGE_Filde($TabelName,"mob_des_en","text","");  
CHANGE_Filde($TabelName,"face_code","text","");  
CHANGE_Filde($TabelName,"google_code","text","");  
CHANGE_Filde($TabelName,"google_code_thanks","text","");  
CHANGE_Filde($TabelName,"face_code_thanks","text","");  
CHANGE_Filde($TabelName,"thanks_title","var","200");
CHANGE_Filde($TabelName,"thanks_title_en","var","200");
CHANGE_Filde($TabelName,"thanks_des","text","");  
CHANGE_Filde($TabelName,"thanks_des_en","text",""); 
CHANGE_Filde($TabelName,"website_url","text","");   
CHANGE_Filde($TabelName,"thanks_mob","var","50");    
CHANGE_Filde($TabelName,"form_config","text","");  	 
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"postion","int","0");    
*/



  

/*
AddFildeToTabel("landpage_block","menu_s","state","int","50","0");
*/

/*
$TabelName = "landpage_block"; 
CHANGE_Filde($TabelName,"type","int","0");
CHANGE_Filde($TabelName,"cat_id","int","0");
CHANGE_Filde($TabelName,"var","var","100");
CHANGE_Filde($TabelName,"block_style","var","100");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"des","text","");       
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"menu_s","int","0");
CHANGE_Filde($TabelName,"postion","int","0");
*/


/*
$db->H_DELETE("ALTER TABLE landpage_data DROP COLUMN location_id ");
AddFildeToTabel("landpage_data","district_id","service_type_id","int","50","0");
AddFildeToTabel("landpage_data","project_id","district_id","int","50","0");
*/

/*
$TabelName = "landpage_data"; 
CHANGE_Filde($TabelName,"date_add","var","50");
CHANGE_Filde($TabelName,"date_time","var","50");
CHANGE_Filde($TabelName,"lead_cat","int","0");
CHANGE_Filde($TabelName,"lead_type","int","0");
CHANGE_Filde($TabelName,"lead_sours","int","0");
CHANGE_Filde($TabelName,"unit_type","int","0");
CHANGE_Filde($TabelName,"service_type_id","int","0");
CHANGE_Filde($TabelName,"district_id","int","0");
CHANGE_Filde($TabelName,"project_id","int","0");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"name","var","250");
CHANGE_Filde($TabelName,"mobile","var","100");
CHANGE_Filde($TabelName,"email","var","150");
CHANGE_Filde($TabelName,"notes","text","150");
CHANGE_Filde($TabelName,"f_url","var","250");
CHANGE_Filde($TabelName,"f_type","var","50");
CHANGE_Filde($TabelName,"f_ip","var","50");
CHANGE_Filde($TabelName,"f_city","var","50");
CHANGE_Filde($TabelName,"f_country","var","50");
*/


/*
$TabelName = "landpage_photo";
CHANGE_Filde($TabelName,"cat_id","int","0");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"des","text","");
CHANGE_Filde($TabelName,"des_en","text","200");
CHANGE_Filde($TabelName,"photo","var","250");
CHANGE_Filde($TabelName,"photo_t","var","250");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"postion","int","0");

$TabelName = "landpage_photo_cat";
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"des","text","");
CHANGE_Filde($TabelName,"des_en","text","200");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"postion","int","0");

*/

#################################################################################################################################
###################################################     Other
################################################################################################################################# 21 - 11 = 10

/*
$TabelName = "f_live";
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"count","int","0");


$TabelName = "f_cust_type";
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"url","var","100");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"count","int","0");


$TabelName = "f_cust_subtype";
CHANGE_Filde($TabelName,"cat_id","int","0");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"count","int","0");



$TabelName = "fs_ticket_state";
CHANGE_Filde($TabelName,"name","var","100");
CHANGE_Filde($TabelName,"name_en","var","100");
CHANGE_Filde($TabelName,"state","int","0");

 
$TabelName = "fs_ticket_cust";
CHANGE_Filde($TabelName,"name","var","100");
CHANGE_Filde($TabelName,"name_en","var","100");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"count","int","0");
 

$TabelName = "fs_ticket_closed";
CHANGE_Filde($TabelName,"name","var","100");
CHANGE_Filde($TabelName,"name_en","var","100");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"count","int","0");

$TabelName = "fs_report_chart";
CHANGE_Filde($TabelName,"name","var","100");
CHANGE_Filde($TabelName,"name_en","var","100");
CHANGE_Filde($TabelName,"cat_id","var","100");
CHANGE_Filde($TabelName,"val","var","100");
CHANGE_Filde($TabelName,"f_date","var","100");
CHANGE_Filde($TabelName,"f_date_m","var","100");
CHANGE_Filde($TabelName,"color","var","100");

 
$TabelName = "fs_lead_type";
CHANGE_Filde($TabelName,"name","var","100");
CHANGE_Filde($TabelName,"name_en","var","100");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"count","int","0");

$TabelName = "fs_lead_sours";
CHANGE_Filde($TabelName,"name","var","100");
CHANGE_Filde($TabelName,"name_en","var","100");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"count","int","0");


$TabelName = "fi_country";
CHANGE_Filde($TabelName,"name","var","100");
CHANGE_Filde($TabelName,"name_en","var","100");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"count","int","0");
CHANGE_Filde($TabelName,"count_live","int","0");
CHANGE_Filde($TabelName,"code","var","50");



$TabelName = "fi_city";
CHANGE_Filde($TabelName,"name","var","100");
CHANGE_Filde($TabelName,"name_en","var","100");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"count","int","0");
*/



#################################################################################################################################
###################################################    facebook_data   
################################################################################################################################# 10 - 2 = 8 

/*
$TabelName = "facebook_data";
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"mobile","var","100");
CHANGE_Filde($TabelName,"mobile_2","var","100");
CHANGE_Filde($TabelName,"email","var","150");
CHANGE_Filde($TabelName,"lead_sours","int","0");
CHANGE_Filde($TabelName,"lead_type","int","0");
CHANGE_Filde($TabelName,"lead_cat","int","0");
CHANGE_Filde($TabelName,"notes","text","0");
CHANGE_Filde($TabelName,"state","int","0");

*/

/*
AddFildeToTabel("c_leads","religion","kind_id","int","50","0");
AddFildeToTabel("c_leads","address","notes","text","50","0");
*/

/*

$TabelName = "c_leads";
CHANGE_Filde($TabelName,"date_add","var","50");
CHANGE_Filde($TabelName,"date_time","var","50");
CHANGE_Filde($TabelName,"add_id","var","50");
CHANGE_Filde($TabelName,"user_id","int","0");
CHANGE_Filde($TabelName,"lead_sours","int","0");
CHANGE_Filde($TabelName,"lead_type","int","0");
CHANGE_Filde($TabelName,"lead_cat","int","0");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"c_type","int","0");
CHANGE_Filde($TabelName,"c_type_2","int","0");
CHANGE_Filde($TabelName,"mobile","var","100");
CHANGE_Filde($TabelName,"mobile_2","var","100");
CHANGE_Filde($TabelName,"phone","var","100");
CHANGE_Filde($TabelName,"email","var","150");
CHANGE_Filde($TabelName,"city_id","int","0");
CHANGE_Filde($TabelName,"country_id","int","0");
CHANGE_Filde($TabelName,"countrylive_id","int","0");
CHANGE_Filde($TabelName,"birth_date","var","50");
CHANGE_Filde($TabelName,"birth_day","var","50");
CHANGE_Filde($TabelName,"birth_month","var","50");
CHANGE_Filde($TabelName,"id_no","var","50");
CHANGE_Filde($TabelName,"jop_id","int","0");  
CHANGE_Filde($TabelName,"social_id","int","0");
CHANGE_Filde($TabelName,"kind_id","int","0");
CHANGE_Filde($TabelName,"religion","int","0");
CHANGE_Filde($TabelName,"live_id","int","0");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"sub_count","int","0");
CHANGE_Filde($TabelName,"hotline","int","0");
CHANGE_Filde($TabelName,"sales_man","int","0");
CHANGE_Filde($TabelName,"ch","int","0");
CHANGE_Filde($TabelName,"ch_2","int","0");
CHANGE_Filde($TabelName,"cust","int","0");
CHANGE_Filde($TabelName,"id_1","int","0");
CHANGE_Filde($TabelName,"id_2","int","0");
CHANGE_Filde($TabelName,"id_3","int","0");
CHANGE_Filde($TabelName,"id_4","int","0");
CHANGE_Filde($TabelName,"notes","text","");
CHANGE_Filde($TabelName,"address","text","");
*/


#################################################################################################################################
###################################################   cust_ticket_des  cust_ticket  
################################################################################################################################# 8 - 2 = 6
/*
$TabelName = "cust_ticket_des";
CHANGE_Filde($TabelName,"cat_id","int","0");
CHANGE_Filde($TabelName,"cust_id","int","0");
CHANGE_Filde($TabelName,"date_add","var","50");
CHANGE_Filde($TabelName,"ticket_date","var","50");
CHANGE_Filde($TabelName,"date_time","var","50");
CHANGE_Filde($TabelName,"date_month","var","50");
CHANGE_Filde($TabelName,"follow_date","var","50");
CHANGE_Filde($TabelName,"follow_time","var","50");
CHANGE_Filde($TabelName,"priority_id","int","0");
CHANGE_Filde($TabelName,"follow_type","int","0");
CHANGE_Filde($TabelName,"follow_state","int","0");
CHANGE_Filde($TabelName,"des","text","");
CHANGE_Filde($TabelName,"user_id","int","0");
CHANGE_Filde($TabelName,"user_name","var","100");


$TabelName = "cust_ticket";
CHANGE_Filde($TabelName,"date_add","var","50");
CHANGE_Filde($TabelName,"date_month","var","50");
CHANGE_Filde($TabelName,"date_time","var","50");
CHANGE_Filde($TabelName,"cust_id","int","0");
CHANGE_Filde($TabelName,"user_id","int","0");
CHANGE_Filde($TabelName,"reason_id","int","0");
CHANGE_Filde($TabelName,"notes","text","");
CHANGE_Filde($TabelName,"admin_id","int","0");
CHANGE_Filde($TabelName,"follow_state","int","0");
CHANGE_Filde($TabelName,"follow_date","var","50");
CHANGE_Filde($TabelName,"follow_time","var","50");
CHANGE_Filde($TabelName,"priority_id","int","0");
CHANGE_Filde($TabelName,"close_date","var","50");
CHANGE_Filde($TabelName,"close_month","var","50");
CHANGE_Filde($TabelName,"state","int","0");
*/

#################################################################################################################################
###################################################     customer  / customer_sub
################################################################################################################################# 6 - 2 = 4

/*
$TabelName = "customer_sub";
CHANGE_Filde($TabelName,"cust_id","int","0");
CHANGE_Filde($TabelName,"rel","var","200");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"mobile","var","200");
CHANGE_Filde($TabelName,"mobile_2","var","200");
CHANGE_Filde($TabelName,"email","var","200");

*/




/*
AddFildeToTabel("customer","address","notes","text","50","0");

*/


/*
$TabelName = "customer";
CHANGE_Filde($TabelName,"date_add","var","50");
CHANGE_Filde($TabelName,"user_id","int","0");
CHANGE_Filde($TabelName,"add_id","var","50");
CHANGE_Filde($TabelName,"lead_sours","int","0");
CHANGE_Filde($TabelName,"lead_type","int","0");
CHANGE_Filde($TabelName,"lead_cat","int","0");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"c_type","int","0");
CHANGE_Filde($TabelName,"c_type_2","int","0");
CHANGE_Filde($TabelName,"mobile","var","100");
CHANGE_Filde($TabelName,"mobile_2","var","100");
CHANGE_Filde($TabelName,"phone","var","100");
CHANGE_Filde($TabelName,"email","var","150");
CHANGE_Filde($TabelName,"city_id","int","0");
CHANGE_Filde($TabelName,"country_id","int","0");
CHANGE_Filde($TabelName,"countrylive_id","int","0");
CHANGE_Filde($TabelName,"birth_date","var","50");
CHANGE_Filde($TabelName,"birth_day","var","50");
CHANGE_Filde($TabelName,"birth_month","var","50");
CHANGE_Filde($TabelName,"id_no","var","50");
CHANGE_Filde($TabelName,"jop_id","int","0");  
CHANGE_Filde($TabelName,"social_id","int","0");
CHANGE_Filde($TabelName,"kind_id","int","0");
CHANGE_Filde($TabelName,"religion","int","0");
CHANGE_Filde($TabelName,"live_id","int","0");
CHANGE_Filde($TabelName,"notes","text","");
CHANGE_Filde($TabelName,"address","text","");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"sub_count","int","0");
*/




#################################################################################################################################
###################################################    config_meta
################################################################################################################################# 4- 1 = 3

/*
AddFildeToTabel("config_meta","banner_id","banner_catid","int","50","0");
AddFildeToTabel("config_meta","banner_state","banner_id","int","50","0");
AddFildeToTabel("config_meta","photo","banner_state","var","250","0");
AddFildeToTabel("config_meta","photo_t","photo","var","250","0");
AddFildeToTabel("config_meta","state","photo_t","int","50","0");



$TabelName = "config_meta"; 
CHANGE_Filde($TabelName,"cat_id","int","0");
CHANGE_Filde($TabelName,"g_name","var","200");
CHANGE_Filde($TabelName,"g_des","text",""); 
CHANGE_Filde($TabelName,"g_key","text","");
CHANGE_Filde($TabelName,"g_name_en","var","200");
CHANGE_Filde($TabelName,"g_des_en","text",""); 
CHANGE_Filde($TabelName,"g_key_en","text","");
CHANGE_Filde($TabelName,"header_h3","var","200");
CHANGE_Filde($TabelName,"header_h6","var","200");
CHANGE_Filde($TabelName,"header_h3_en","var","200");
CHANGE_Filde($TabelName,"header_h6_en","var","200");	
CHANGE_Filde($TabelName,"banner_catid","int","0");
CHANGE_Filde($TabelName,"banner_id","int","0");   
CHANGE_Filde($TabelName,"banner_state","int","0");
CHANGE_Filde($TabelName,"header_photo","var","250");
CHANGE_Filde($TabelName,"photo","var","250");
CHANGE_Filde($TabelName,"photo_t","var","250");
CHANGE_Filde($TabelName,"state","int","0");
CHANGE_Filde($TabelName,"postion","int","0");   
*/



#################################################################################################################################
###################################################    config_data
#################################################################################################################################  3 - 1 = 2

/*
$TabelName = "config_data"; 
CHANGE_Filde($TabelName,"s_id","int","0");
CHANGE_Filde($TabelName,"cat_id","var","100");
CHANGE_Filde($TabelName,"name","var","200");
CHANGE_Filde($TabelName,"name_en","var","200");
CHANGE_Filde($TabelName,"old_id","int","0");
CHANGE_Filde($TabelName,"count","int","0");
CHANGE_Filde($TabelName,"state","int","0");
*/



/*

    $server_data = array ('id'=> NULL ,
        'cat_id'=> "config_config"  ,
        'des'=> 'a:9:{s:14:"perpage_banner";s:2:"10";s:12:"order_banner";s:1:"2";s:15:"defphoto_banner";s:1:"5";s:16:"datatabel_banner";s:1:"0";s:17:"perpage_developer";s:2:"10";s:15:"order_developer";s:1:"1";s:18:"defphoto_developer";s:1:"6";s:19:"datatabel_developer";s:1:"0";s:2:"B1";s:4:"Edit";}' ,
    );
    $add_server = $db->AutoExecute("config_cat",$server_data,AUTO_INSERT);
*/

?>