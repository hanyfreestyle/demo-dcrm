<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$ThSisUser = "user_".$RowUsreInfo['user_id'] ; 

if(isset($_POST['B1_Fliter'])){ 
$Start_Date = strtotime($_POST['date_from']); 
$End_Date =  strtotime($_POST['date_to']); 
   
}else{
UnsetAllSession('date_from,date_to');
$Report_period =  ReportPeriod($ConfigP['report_period']);
$Start_Date = $Report_period['start']; 
$End_Date = $Report_period['end']; 
$row['date_from'] = ConvertDateToCalender_3($Start_Date) ;   
$row['date_to'] = ConvertDateToCalender_3($End_Date) ; 
}


echo '<form class="FilterForm FilterFormStyle" method="POST" name="Filter" id="validate-form" data-parsley-validate >';
  
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("DateEdit",$AdminLangFile['report_from_date'],"date_from","0","0","option",$MoreS);  

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("DateEdit",$AdminLangFile['report_to_date'],"date_to","0","0","option",$MoreS);

if($AdminConfig['leads']=='1'){
Sales_Group_List_For_Leads();
}elseif($AdminConfig['teamleader']=='1'){
Sales_Group_List_For_TeamLeader();
}else{
echo '<input type="hidden" name="emp_id" value="'.$RowUsreInfo['user_id'].'" />';
}


echo '<div style="clear: both!important;"></div>'.BR;

$Arr = array("Label" => 'off',"Active" => '0');
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_chose_all_state'],"col-md-3","ticket_state","fs_ticket_state","optin","0",$Arr);  

$Arr = array("Label" => 'off',"Active" => '0');
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_all_cust'],"col-md-3","cust_type","f_cust_type","optin","0",$Arr);  

if(isset($_POST['cust_type']) and intval($_POST['cust_type']) != '0' ){
$Arr = array("Label" => 'off',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> $_POST['cust_type'] );
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_filter_all_cust_2'],"col-md-3","cust_type_2","f_cust_subtype","optin","0",$Arr);    
} 

echo '<div style="clear: both!important;"></div>';
echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['report_filter_but'].'" />';
echo '</div>';   
 
echo '</form>';   


#################################################################################################################################
###################################################   
#################################################################################################################################

if($End_Date < $Start_Date  ){
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("4",$AdminLangFile['leads_date_err']);
$ErrDate = '1' ;
} 
    
    
    
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التجميع   
/*
if(isset($_POST['B1_Fliter'])){ 
$End_SQL_Line = CustmerSqlFiterLine();     
$UserSQlFilter = Filter_Employee_From_POST($_POST['emp_id']);         
}else{
$End_SQL_Line = CustmerSqlFiterLine();     
$UserSQlFilter = Filter_Employee_By_Permission() ;     
}    
*/
  
$End_SQL_Line = CustmerSqlFiterLine();    
$Countdayforloop =  CountDayForLoop($Start_Date,$End_Date) ; 



if($Countdayforloop < MAXIMUM_DAYS){  
    
$SQLFiter = "SELECT id,state,c_type,c_type_2 FROM sales_ticket where  date_add >= $Start_Date and date_add <= $End_Date $UserPerm $End_SQL_Line";    
//$SQLFiter = "SELECT id,state,c_type,c_type_2 FROM sales_ticket where  date_add >= $Start_Date and date_add <= $End_Date  $UserSQlFilter $End_SQL_Line";    
$TotalCount = $db->H_Total_Count($SQLFiter);

if($TotalCount > '0'){
    

$Name = $db->SelArr($SQLFiter);
$Countdayforloop =  CountDayForLoop($Start_Date,$End_Date) ;


## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   الايكون     
echo '<div style="clear: both!important;"></div>'; 
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_tickets'],$TotalCount,"fa-hdd-o","alert-inverse");
ReportBlockPrint("col-md-3",$AdminLangFile['report_the_number_of_days'],$Countdayforloop,"fa-hdd-o","alert-inverse");



echo '<div style="clear: both!important;"></div>'.BR.BR;  
New_Print_Alert("1",$AdminLangFile['report_followup_report']);

$ConfigP['cust_chart_count'] = "10";
$CelCountForList = "col-md-3" ;
 

 
$Ticket_state =  GetChartVallFromArr($Name,"state","fs_ticket_state");

$Arr = array("Tabel"=> $Ticket_state, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Ticket_state",$AdminLangFile['report_ticket_state_r'],$Arr,"1"); 


$Cust_type =  GetChartVallFromArr($Name,"c_type","f_cust_type");
$Arr = array("Tabel"=> $Cust_type, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Cust_type",$AdminLangFile['report_cust_type_h1'],$Arr,"1"); 


$Cust_type_2 =  GetChartVallFromArr($Name,"c_type_2","f_cust_subtype");
$Arr = array("Tabel"=> $Cust_type_2, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Cust_type_2",$AdminLangFile['report_cust_type2_h1'],$Arr,"1"); 




}else{
Alert_NO_Content(); 
}
 
 
}else{
New_Print_Alert("4",$AdminLangFile['mainform_max_day_err_01']." ".MAXIMUM_DAYS." ".$AdminLangFile['mainform_max_day_err_02']); 
}
 
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

 
?>    
 