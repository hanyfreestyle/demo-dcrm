<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
 


CountFildFromTabel("f_cust_subtype","customer","c_type_2","count");
CountFildFromTabel("fs_lead_sours","customer","lead_sours","count");
CountFildFromTabel("fs_lead_type","customer","lead_type","count");
CountFildFromTabel("fi_country","customer","country_id","count");
CountFildFromTabel("fi_city","customer","city_id","count");


if(F_SOCIAL_ID == 1 ){
CountFildFromTabel_CatID(TABEL_SOCIAL,"customer","social_id","count");
}
if(F_JOP_ID == 1){
CountFildFromTabel_CatID(TABEL_JOP,"customer","jop_id","count");
}
if(F_JOP_ID == 1){
CountFildFromTabel_CatID(TABEL_KIND,"customer","kind_id","count");
}

if(F_LEAD_CAT == 1){
CountFildFromTabel_CatID(TABEL_LEAD_CAT,"sales_ticket","lead_cat","count"); 
}


if(F_CASH_ID == 1 ){
CountFildFromTabel_CatID(TABEL_CASH,"sales_ticket","cash_id","count");     
}

if(F_CASH_ID == 1 ){
CountFildFromTabel_CatID(TABEL_AREA,"sales_ticket","area_id","count");       
}

if(F_BEST_CALL_ID == 1 ){
CountFildFromTabel_CatID(TABEL_BEST_CALL,"sales_ticket","bestcall_id","count");       
}

if(F_CALL_TIME_ID == 1 ){
CountFildFromTabel_CatID(TABEL_CALL_TIME,"sales_ticket","time_id","count");       
}

if(F_DATE_RECEIPT_ID == 1 ){
CountFildFromTabel_CatID(TABEL_DATE_RECEIPT,"sales_ticket","date_id","count");       
}

if(F_DATE_RECEIPT_ID == 1 ){
CountFildFromTabel_CatID(TABEL_UNIT_TYPE,"sales_ticket","unit_id","count");       
}


if(F_REASON_T_ID == 1 ){
CountFildFromTabel_CatID(TABEL_REASON_TICKET,"cust_ticket","reason_id","count");       
}



echo New_Print_Alert("1",$AdminLangFile['managedate_update_date_mass']); 


 

	
?>
</div></div>