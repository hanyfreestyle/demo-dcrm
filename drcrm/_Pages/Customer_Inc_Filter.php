<?php
if(!defined('WEB_ROOT')) {	exit;}
 
if(isset($_POST['B1_Fliter'])){ 
   
}else{
    UnsetAllSession('date_from,date_to');
    if(isset($ConfigP['report_period'])){
    $Report_period =  ReportPeriod($ConfigP['report_period']);
    $Start_Date = $Report_period['start']; 
    $End_Date = $Report_period['end']; 
    $row['date_from'] = ConvertDateToCalender_3($Start_Date) ;   
    $row['date_to'] = ConvertDateToCalender_3($End_Date) ;
    }
}



if($ReqFilterDate == '1'){
$ReqFilde = "required";    
}else{
$ReqFilde = "";    
}


echo '<form class="FilterForm FilterFormStyle" method="POST" name="Filter" id="validate-form" data-parsley-validate >';
 
if($ConfigP['filter_cont'] == '1'){
Print_PagePanel_OPen("col-md-12",$AdminLangFile['reportconfig_filter_results_h1'],"0","0","Parent_Infos");  
}


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => $ReqFilde);
$Err[] = NF_PrintInput("DateEdit2",$AdminLangFile['report_from_date'],"date_from","0","0","option",$MoreS);  

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => $ReqFilde);
$Err[] = NF_PrintInput("DateEdit2",$AdminLangFile['report_to_date'],"date_to","0","0","option",$MoreS);




if($view == 'TicketRport' or $view == 'TicketRport2020'){
 
$Arr = array("Label" => 'on' ,"OtherIdd"=>"user_id", "Filter_Filde"=> "sales" , "Filter_Vall"=> "1");      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","user_id","tbl_user","option",0,$Arr);


if(TICKET_STATE == '1'){
$Arr = array("Label" => 'on',"Active" => '0');
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_chose_all_state'],"col-md-3","ticket_state","fs_ticket_state","optin","0",$Arr); 
}  
echo '<div style="clear: both!important;"></div>';
} 

#################################################################################################################################
###################################################   
#################################################################################################################################

echo '<div style="clear: both!important;"></div>';

 
$Arr = array("Label" => 'off',"Active" => '0');
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_all_cust'],"col-md-3","cust_type","f_cust_type","optin","0",$Arr); 


if(isset($_POST['cust_type']) and intval($_POST['cust_type']) != '0' ){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> $_POST['cust_type']);
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_all_cust_2'],"col-md-3","cust_type_2","f_cust_subtype","optin","0",$Arr); 
}


if(F_LEAD_TYPE == 1){
$Arr = array("Label" => 'off',"Active" => '0');
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_leads_type'],"col-md-3","lead_type","fs_lead_type","optin","0",$Arr);   
}


if(F_LEAD_SOURS == 1){
$Arr = array("Label" => 'off',"Active" => '0');
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_leads_sours'],"col-md-3","lead_sours","fs_lead_sours","optin","0",$Arr);      
}



echo '<div style="clear: both!important;"></div>';
#################################################################################################################################
###################################################   
#################################################################################################################################


if($view == 'TicketRport'){
############################ حالة العميل للتذكرة 
if(isset($ConfigP['c_ticket_cust']) and $ConfigP['c_ticket_cust'] == '1' and C_TICKET_CUST == 1){
$Arr = array("Label" => 'off',"Active" => '0');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_customer_status_for_ticket'],"col-md-3","ticket_cust","fs_ticket_cust","optin",0,$Arr);	
}
}

############################ الحملات    
if( isset($ConfigP['c_lead_cat']) and  $ConfigP['c_lead_cat'] == '1' and F_LEAD_CAT == 1 ){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_LEAD_CAT);
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_chose_all_campaign'],"col-md-3","lead_cat","config_data","optin","0",$Arr);   
}

############################  المهن
if( isset($ConfigP['c_jop'])and  $ConfigP['c_jop'] == '1' and F_JOP_ID == 1){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_JOP);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_jop'],"col-md-3","jop_id","config_data","optin","0",$Arr);
}

############################  النوع
if(isset($ConfigP['c_kind']) and  $ConfigP['c_kind'] == '1' and F_KIND_ID == 1 ){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_KIND);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_kind'],"col-md-3","kind_id","config_data","optin","0",$Arr);
}
   
   
############################  الحالة الاجتماعية
if( isset($ConfigP['c_social']) and $ConfigP['c_social'] == '1' and F_SOCIAL_ID == 1 ){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_SOCIAL);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_social'],"col-md-3","social_id","config_data","optin","0",$Arr);
}

   
############################  الديانة 
if( F_RELIGION == 1 ){
$Arr = array("StartFrom" => '1',"Label" => 'off');  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['customer_religion_h1'],"col-md-3","religion",$Religion_Arr,"optin","",$Arr);
}     
     


      
   
############################  الاقامة
if(isset($ConfigP['c_live']) and  $ConfigP['c_live'] == '1' and F_FULL_COUNTRY == 1){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" );    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_live'],"col-md-3","live_id","f_live","optin","0",$Arr);
}



############################  الجنسية
if(isset($ConfigP['nationality']) and $ConfigP['nationality'] == '1' and F_COUNTRY_ID == 1){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" );      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_fiter_nationality'],"col-md-3","country_id","fi_country","optin","0",$Arr);
}
   
   
   
############################  دولة الاقامة
if( isset($ConfigP['country_live']) and  $ConfigP['country_live'] == '1' and F_FULL_COUNTRY == 1){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" );      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_country'],"col-md-3","countrylive_id","fi_country","optin","0",$Arr);
}
      
############################  المحافظة
if( isset($ConfigP['c_city']) and  $ConfigP['c_city'] == '1' and F_CITY_ID == '1'){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" );          
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_city'],"col-md-3","city_id","fi_city","optin","0",$Arr);
}
   
   
  
   
############################   وسائل الدفع
if($view == 'TicketRport' and F_CASH_ID == 1 ){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_CASH);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_chose_all_payment_methods'],"col-md-3","cash_id","config_data","optin","0",$Arr);
}

     
############################  فترة الاستلام
if( $view == 'TicketRport' and F_DATE_RECEIPT_ID == 1){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_DATE_RECEIPT);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_chose_all_date_receipt'],"col-md-3","date_id","config_data","optin","0",$Arr);
}
   
############################  المساحات 
if(  $view == 'TicketRport' and F_AREA_ID == 1){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_AREA);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_choose_all_unit_area'],"col-md-3","area_id","config_data","optin","0",$Arr);
}

############################  نوع الوحده
if(  $view == 'TicketRport' and F_UNIT_TYPE_ID == 1){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_UNIT_TYPE);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_choose_all_unit_type'],"col-md-3","unit_id","config_data","optin","0",$Arr);
}

############################  الاحياء
if(  $view == 'TicketRport' and F_PROJECT_AREA == 1){
$Arr = array("Label" => 'off',"Active" => '0');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_choose_all_area'],"col-md-3","pro_area","project_area","optin",0,$Arr);	
}

 
############################  الدورات
if(  $view == 'TicketRport' and F_COURS == 1){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_COURS);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['managedate_cours_but'],"col-md-3","cours_id","config_data","optin","0",$Arr);
}
 



echo '<div style="clear: both!important;"></div>';
echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['report_filter_but'].'" />';
echo '</div>';   
 
if($ConfigP['filter_cont'] == '1'){
Print_PagePanel_Close();       
}

 
echo '</form>';

echo '<div style="clear: both!important;"></div>'.BR.BR;
?>