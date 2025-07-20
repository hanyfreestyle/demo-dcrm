<?php
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


 
FormFilter_CustService();



 
if($End_Date < $Start_Date  ){
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("4",$AdminLangFile['leads_date_err']);
$ErrDate = '1' ;
} 
    
    
if($ErrDate != '1'){
    
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التجميع   
$UserSQlFilter = $UserPerm ;
$Countdayforloop =  CountDayForLoop($Start_Date,$End_Date) ; 



if($Countdayforloop < MAXIMUM_DAYS){  
   
$data = array();

#-------------------------------------------------------------------------------------------------------------------------------------------------
echo '<div style="clear: both!important;"></div>'.BR.BR;  

###################################################################################################################################################
###################################################################################################################################################
#################################################################### تقارير المتابعات
###################################################################################################################################################
###################################################################################################################################################
 
  $Start_Date_Print = $Start_Date ; $TotalCount = "0"; $MonthData_Send = array();  
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $SQL = "SELECT id FROM sales_ticket_des WHERE count_type = '3'  and  date_add = '$Start_Date_Print' $UserSQlFilter ";
  $already = $db->H_Total_Count($SQL);
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $Arr = array('F_Name'=> 'count_follow','Color'=> "#7cbf62" ,'Label'=>$AdminLangFile['report_followup_report'], 'M_Send' => $MonthData_Send,'Total'=> $TotalCount );
  $Chart_Count_Follow = Chart30_One_Arr($Arr);
  
  
  
###################################################################################################################################################
###################################################################################################################################################
#################################################################### تقرير العملاء 
###################################################################################################################################################
###################################################################################################################################################
  $Arr_CustCount = array(); $Start_Date_Print = $Start_Date ; $TotalCount = "0"; $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $HetSQl  = "SELECT * FROM sales_ticket_des WHERE count_type = '3' and date_add = '$Start_Date_Print' $UserSQlFilter " ;
  $already = $db->H_Total_Count($HetSQl);
  if($already > '0'){
  $Name = $db->SelArr($HetSQl);  
  $VisitReport = assc_array_count_values( $Name ,"cat_id");
  $already_Send = count($VisitReport); 
  }else{
  $already_Send = "0";  
  }
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already_Send); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already_Send ;
  }
  
  $Arr = array('F_Name'=> 'count_cust','Color'=> "#5ab1ef" ,'Label'=>$AdminLangFile['report_clients'], 'M_Send' => $MonthData_Send,'Total'=> $TotalCount );
  $Chart_Count_Cusetmer = Chart30_One_Arr($Arr);
 
  
  
  
###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقارير المتابعات 
  New_Print_Alert("1",$AdminLangFile['report_followup_report']);
  Chart30_View($Chart_Count_Follow['jsonFile']);



###################################################################################################################################################
###################################################################################################################################################
#################################################################### تقرير العملاء 
  Chart30_View($Chart_Count_Cusetmer['jsonFile']);
  
 


}else{
New_Print_Alert("4",$AdminLangFile['mainform_max_day_err_01']." ".MAXIMUM_DAYS." ".$AdminLangFile['mainform_max_day_err_02']); 
}

}
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>    