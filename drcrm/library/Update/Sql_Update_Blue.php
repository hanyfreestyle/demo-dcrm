<?php

/*  
$TabelName = "customer_notes";
 
CHANGE_Filde($TabelName,"date_add","var","50");
CHANGE_Filde($TabelName,"date_time","var","50");
CHANGE_Filde($TabelName,"user_name","var","100"); 
CHANGE_Filde($TabelName,"notes","text","");
CHANGE_Filde($TabelName,"cust_id","int","100");
CHANGE_Filde($TabelName,"user_id","int","100");

AddFildeToTabel($TabelName,"date_add","id","var","50","0");
AddFildeToTabel($TabelName,"date_time","date_add","var","50","0");
AddFildeToTabel($TabelName,"user_id","cust_id","int","50","0");
AddFildeToTabel($TabelName,"user_name","user_id","var","50","0");
AddFildeToTabel($TabelName,"notes","user_name","text","50","0");


#################################################################################################################################
###################################################   Vip Empty 
#################################################################################################################################
$db->H_Filde_DROP("sales_ticket","lead_type");
$db->H_Filde_DROP("sales_ticket","priority_id");
$db->H_Filde_DROP("sales_ticket_des","priority_id");

$sql = "DROP TABLE fi_city";
$db->H_DELETE($sql);

$sql = "DROP TABLE fi_country";
$db->H_DELETE($sql);

$sql = "DROP TABLE fs_lead_type";
$db->H_DELETE($sql);
*/


/*
 



#################################################################################################################################
###################################################  tbl_user
#################################################################################################################################

*/

 /*
#################################################################################################################################
################################################### config_data
#################################################################################################################################
$TabelName = "f_cust_subtype";
CHANGE_Filde($TabelName,"count","int"); 

$TabelName = "fs_lead_sours";
CHANGE_Filde($TabelName,"count","int"); 

#################################################################################################################################
################################################### config_data
#################################################################################################################################
$TabelName = "config_data";
CHANGE_Filde($TabelName,"count","int");
CHANGE_Filde($TabelName,"old_id","int");
CHANGE_Filde($TabelName,"s_id","int");

 

 

#################################################################################################################################
################################################### landpage
#################################################################################################################################
$TabelName = "landpage";
CHANGE_Filde($TabelName,"thanks_mob","var","50");
CHANGE_Filde($TabelName,"website_url","text");     
CHANGE_Filde($TabelName,"postion","int");
CHANGE_Filde($TabelName,"photo","var","250");
CHANGE_Filde($TabelName,"photo_t","var","250"); 
CHANGE_Filde($TabelName,"face_code","text");  
CHANGE_Filde($TabelName,"google_code","text");  
CHANGE_Filde($TabelName,"face_code_thanks","text");  
CHANGE_Filde($TabelName,"google_code_thanks","text");  
CHANGE_Filde($TabelName,"mob_state","int");
CHANGE_Filde($TabelName,"mob_num","var","50");  
CHANGE_Filde($TabelName,"mob_title","var","150"); 
CHANGE_Filde($TabelName,"mob_title_en","var","150");        
CHANGE_Filde($TabelName,"mob_des","text");  
CHANGE_Filde($TabelName,"mob_des_en","text");   
CHANGE_Filde($TabelName,"form_config","text");


#################################################################################################################################
################################################### landpage_block 
#################################################################################################################################
$TabelName = "landpage_block";
CHANGE_Filde($TabelName,"block_style","var","150");   
CHANGE_Filde($TabelName,"postion","int");


#################################################################################################################################
################################################### landpage_photo_cat 
#################################################################################################################################
$TabelName = "landpage_photo_cat";
CHANGE_Filde($TabelName,"des","text");  
CHANGE_Filde($TabelName,"des_en","text");   
CHANGE_Filde($TabelName,"postion","int");


#################################################################################################################################
################################################### landpage_photo 
#################################################################################################################################
$TabelName = "landpage_photo";
CHANGE_Filde($TabelName,"des","text");  
CHANGE_Filde($TabelName,"des_en","text");   
CHANGE_Filde($TabelName,"postion","int");
CHANGE_Filde($TabelName,"photo","var","250");
CHANGE_Filde($TabelName,"photo_t","var","250"); 



 
 
 
	

 

 
 
#################################################################################################################################
################################################### customer 
#################################################################################################################################
$TabelName = "customer";
CHANGE_Filde($TabelName,"add_id","var","50");
CHANGE_Filde($TabelName,"lead_sours","int");  
CHANGE_Filde($TabelName,"lead_cat","int");  
CHANGE_Filde($TabelName,"c_type","int");  
CHANGE_Filde($TabelName,"c_type_2","int");  
CHANGE_Filde($TabelName,"mobile_2","var","200");
CHANGE_Filde($TabelName,"phone","var","200");
CHANGE_Filde($TabelName,"email","var","200");
CHANGE_Filde($TabelName,"notes","text");
CHANGE_Filde($TabelName,"sub_count","int");
 

#################################################################################################################################
################################################### sales_ticket 
#################################################################################################################################
$TabelName = "sales_ticket";
CHANGE_Filde($TabelName,"notes","text");
CHANGE_Filde($TabelName,"project_id","int");
CHANGE_Filde($TabelName,"district_id","int");
CHANGE_Filde($TabelName,"service_type_id","int");
CHANGE_Filde($TabelName,"unit_type","int");
CHANGE_Filde($TabelName,"budget","var","50");
CHANGE_Filde($TabelName,"cash_id","int");
CHANGE_Filde($TabelName,"unit_id","int");
CHANGE_Filde($TabelName,"date_id","int");
CHANGE_Filde($TabelName,"bestcall_id","int");
CHANGE_Filde($TabelName,"time_id","int");
CHANGE_Filde($TabelName,"area_id","int");
CHANGE_Filde($TabelName,"follow_state","int");
CHANGE_Filde($TabelName,"follow_date","var","50");
CHANGE_Filde($TabelName,"follow_time","var","50");
CHANGE_Filde($TabelName,"area_id","int");  	
CHANGE_Filde($TabelName,"c_type_2","int");
CHANGE_Filde($TabelName,"close_date","var","50");
CHANGE_Filde($TabelName,"close_month","var","50");
CHANGE_Filde($TabelName,"close_type","int"); 
CHANGE_Filde($TabelName,"feedback","int"); 
CHANGE_Filde($TabelName,"visits","int");
CHANGE_Filde($TabelName,"rev","int");
CHANGE_Filde($TabelName,"cls","int");
CHANGE_Filde($TabelName,"cls_count","int");






 	


#################################################################################################################################
################################################### c_leads 
#################################################################################################################################
$TabelName = "c_leads";
CHANGE_Filde($TabelName,"add_id","var","50");
CHANGE_Filde($TabelName,"hotline","int");
CHANGE_Filde($TabelName,"sales_man","int");

CHANGE_Filde($TabelName,"project_id","int");
CHANGE_Filde($TabelName,"district_id","int");
CHANGE_Filde($TabelName,"service_type_id","int");
CHANGE_Filde($TabelName,"unit_type","int");

CHANGE_Filde($TabelName,"ch","int"); 
CHANGE_Filde($TabelName,"ch_2","int"); 
CHANGE_Filde($TabelName,"cust","int"); 
CHANGE_Filde($TabelName,"id_1","int");
CHANGE_Filde($TabelName,"id_2","int");
CHANGE_Filde($TabelName,"id_3","int");  
CHANGE_Filde($TabelName,"id_4","int");      



#################################################################################################################################
################################################### landpage_data 
#################################################################################################################################
$TabelName = "landpage_data";
CHANGE_Filde($TabelName,"lead_cat","int"); 
CHANGE_Filde($TabelName,"lead_type","int"); 
CHANGE_Filde($TabelName,"lead_sours","int"); 
CHANGE_Filde($TabelName,"unit_type","int"); 
CHANGE_Filde($TabelName,"service_type_id","int"); 
CHANGE_Filde($TabelName,"district_id","int"); 
CHANGE_Filde($TabelName,"project_id","int"); 
CHANGE_Filde($TabelName,"email","var","100");
CHANGE_Filde($TabelName,"notes","text");
CHANGE_Filde($TabelName,"state","int");  
CHANGE_Filde($TabelName,"f_url","var","200");
CHANGE_Filde($TabelName,"f_type","var","50");
CHANGE_Filde($TabelName,"f_ip","var","50");
CHANGE_Filde($TabelName,"f_city","var","50");
CHANGE_Filde($TabelName,"f_country","var","50");
CHANGE_Filde($TabelName,"date_add","var","50");
CHANGE_Filde($TabelName,"date_time","var","50");

*/



 


 
	
?>