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


/////// فلترو الموظفين
Empl_ListBox_Filter();

 
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

if(isset($_POST['B1_Fliter'])){ 
$UserSQlFilter = Filter_Employee_From_POST($_POST['emp_id']);      
}else{
$UserSQlFilter = Filter_Employee_By_Permission() ;   
}    

$Countdayforloop =  CountDayForLoop($Start_Date,$End_Date) ; 
if($Countdayforloop < MAXIMUM_DAYS){  
   
    
    
$SQLFiter = "SELECT id FROM sales_ticket where  date_add >= $Start_Date and date_add <= $End_Date  $UserSQlFilter";    
$TotalCount = $db->H_Total_Count($SQLFiter);


if($TotalCount > '0'){
    

$Name = $db->SelArr($SQLFiter);  



echo '<div style="clear: both!important;"></div>'; 
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_tickets'],$TotalCount,"fa-hdd-o","alert-inverse");
ReportBlockPrint("col-md-3",$AdminLangFile['report_the_number_of_days'],$Countdayforloop,"fa-hdd-o","alert-inverse");
echo '<div style="clear: both!important;"></div>';
  
  
  
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التقرير الاول      
    
           
echo '<div style="clear: both!important;"></div>';    
echo  New_Print_Alert("1",$AdminLangFile['report_events_report']);
 
echo '<div style="clear: both!important;"></div>';

$SQLFiter_55 = "SELECT id FROM sales_ticket where visit_s = '1' and visit_date >= $Start_Date and visit_date <= $End_Date  $UserSQlFilter";   
$VisitReport = $db->H_Total_Count($SQLFiter_55) ;
$Line = intval($VisitReport) .BR." ( ".round(($VisitReport / $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_visits'],$Line,"fa-car","alert-info");


$SQLFiter_55 = "SELECT id FROM sales_ticket where rev_s = '1' and rev_date >= $Start_Date and rev_date <= $End_Date  $UserSQlFilter";   
$RevReport = $db->H_Total_Count($SQLFiter_55) ;
$Line = intval($RevReport) .BR." ( ".round(($RevReport / $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_reservations'],$Line,"fa-calendar","alert-warning");

$SQLFiter_55 = "SELECT id FROM sales_ticket where cancel_s = '1' and cancel_date >= $Start_Date and cancel_date <= $End_Date  $UserSQlFilter";   
$CancelReport = $db->H_Total_Count($SQLFiter_55) ;
$Line = intval($CancelReport) .BR." ( ".round(($CancelReport / $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_reservation_canceled'],$Line,"fa-trash-o");

$SQLFiter_55 = "SELECT id FROM sales_ticket where contract_s = '1' and contract_date >= $Start_Date and contract_date <= $End_Date  $UserSQlFilter";   
$ContractReport = $db->H_Total_Count($SQLFiter_55) ;
$Line = intval($ContractReport) .BR." ( ".round(($ContractReport/ $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_contract'],$Line,"fa-dollar","alert-success");  
  
echo '<div style="clear: both!important;"></div>';          


$Countdayforloop =  CountDayForLoop($Start_Date,$End_Date) ;     
    
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   الايكون     




    
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التقرير الاول      
    
           

 
###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقرير الزيارات
###################################################################################################################################################
###################################################################################################################################################
$data = array();

$ChartLoop = $db->SelArr("SELECT * FROM fs_report_chart where cat_id = 't_visits' ");
for($i = 0; $i < count($ChartLoop); $i++) {
  
  
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
   
  $DateFiter = $ChartLoop[$i]['f_date'];
  $already = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE $DateFiter = '$Start_Date_Print' $UserSQlFilter ");

  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $NewData =  array(
     'label' => $ChartLoop[$i][$NamePrint]." ". $TotalCount,
     'color' =>  $ChartLoop[$i]['color'],
     'data' => $MonthData_Send
   );
  array_push($data,$NewData);   
}  

 

$fp = fopen('json/'.$ThSisUser.'_visits.json', 'w');
fwrite($fp, json_encode($data));
fclose($fp);

echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_visits.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقرير الزيارات
###################################################################################################################################################
###################################################################################################################################################
 


#-------------------------------------------------------------------------------------------------------------------------------------------------
echo '<div style="clear: both!important;"></div>'.BR.BR;  
New_Print_Alert("1",$AdminLangFile['report_followup_report']);

$Countdayforloop =  CountDayForLoop($Start_Date,$End_Date) ; 

 
###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقارير التذاكر الجديدة
###################################################################################################################################################
###################################################################################################################################################
  $Arr_NewTickets = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  

  $already = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE date_add = '$Start_Date_Print' $UserSQlFilter ");
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $Count_Ticket =  array(
     'label' => $AdminLangFile['report_new_ticket']." ". $TotalCount,
     'color' =>  "#5ab1ef",
     'data' => $MonthData_Send
   );

array_push($Arr_NewTickets,$Count_Ticket);   
$fp = fopen('json/'.$ThSisUser.'_new_tickets.json', 'w');
fwrite($fp, json_encode($Arr_NewTickets));
fclose($fp);

echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_new_tickets.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR; 

###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقارير التذاكر الجديدة
###################################################################################################################################################
###################################################################################################################################################
 


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقارير المتابعات
###################################################################################################################################################
###################################################################################################################################################

 $Arr_Follow = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $SQL = "SELECT id FROM sales_ticket_des WHERE count_type = '2' and  date_add = '$Start_Date_Print' $UserSQlFilter ";
  $already = $db->H_Total_Count($SQL);
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $Count_Follow =  array(
     'label' => $AdminLangFile['report_followup']." ". $TotalCount,
     'color' =>  "#7cbf62",
     'data' => $MonthData_Send
   );
  array_push($Arr_Follow,$Count_Follow);   
  
  
$fp = fopen('json/'.$ThSisUser.'_follow.json', 'w');
fwrite($fp, json_encode($Arr_Follow));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_follow.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;  


###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقارير المتابعات
###################################################################################################################################################
###################################################################################################################################################




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

###################################################################################################################################################
###################################################################################################################################################
#################################################################### المتابعات للتذاكر الجديدة
###################################################################################################################################################
###################################################################################################################################################

  $Arr_Follow = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $SQL = "SELECT id FROM sales_ticket_des WHERE count_type = '2' and  date_add = '$Start_Date_Print' and ticket_date = '$Start_Date_Print'  $UserSQlFilter ";
  $already = $db->H_Total_Count($SQL);
  
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $Count_New_Follow =  array(
     'label' => $AdminLangFile['report_chart_new_follow']." ". $TotalCount,
     'color' =>  "#f5994e",
     'data' => $MonthData_Send
   );
  array_push($Arr_Follow,$Count_New_Follow);   
  
  
$fp = fopen('json/'.$ThSisUser.'_follow_new.json', 'w');
fwrite($fp, json_encode($Arr_Follow));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_follow_new.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;    


###################################################################################################################################################
###################################################################################################################################################
#################################################################### المتابعات للتذاكر الجديدة
###################################################################################################################################################
###################################################################################################################################################


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

###################################################################################################################################################
###################################################################################################################################################
#################################################################### المتابعات للتذاكر السابقة
###################################################################################################################################################
###################################################################################################################################################

  $Arr_Follow_Old = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $SQL = "SELECT id FROM sales_ticket_des WHERE count_type = '2' and  date_add = '$Start_Date_Print' and ticket_date != '$Start_Date_Print'  $UserSQlFilter ";
  $already = $db->H_Total_Count($SQL);

  
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $Count_Old_Follow =  array(
     'label' => $AdminLangFile['report_old_ticket_follow']." ". $TotalCount,
     'color' =>  "#f35839",
     'data' => $MonthData_Send
   );
  array_push($Arr_Follow_Old,$Count_Old_Follow);   
  
  
$fp = fopen('json/'.$ThSisUser.'_follow_old.json', 'w');
fwrite($fp, json_encode($Arr_Follow_Old));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_follow_old.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;    


###################################################################################################################################################
###################################################################################################################################################
#################################################################### المتابعات للتذاكر السابقة
###################################################################################################################################################
###################################################################################################################################################




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

###################################################################################################################################################
###################################################################################################################################################
#################################################################### تقرير العملاء 
###################################################################################################################################################
###################################################################################################################################################
  
  $Arr_CustCount = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  
  $HetSQl  = "SELECT * FROM sales_ticket_des WHERE count_type = '2' and date_add = '$Start_Date_Print' $UserSQlFilter " ;
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
  $Count_Cusetmer =  array(
     'label' =>$AdminLangFile['report_clients']." ". $TotalCount,
     'color' =>  "#5ab1ef",
     'data' => $MonthData_Send
   );
  array_push($Arr_CustCount,$Count_Cusetmer);   
  


$fp = fopen('json/'.$ThSisUser.'_custcount.json', 'w');
fwrite($fp, json_encode($Arr_CustCount));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_custcount.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';

echo '<div style="clear: both!important;"></div>'.BR.BR;  

###################################################################################################################################################
###################################################################################################################################################
#################################################################### تقرير العملاء 
###################################################################################################################################################
###################################################################################################################################################



 $AllData = array();
 array_push($AllData,$Count_Follow); 
 array_push($AllData,$Count_New_Follow); 
 array_push($AllData,$Count_Old_Follow); 
 
 $fp = fopen('json/'.$ThSisUser.'_all_case.json', 'w');
 fwrite($fp, json_encode($AllData));
 fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_all_case.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@


 $AllData = array();
 array_push($AllData,$Count_Follow); 
 array_push($AllData,$Count_Cusetmer); 
 
 
 $fp = fopen('json/'.$ThSisUser.'_all_case_2.json', 'w');
 fwrite($fp, json_encode($AllData));
 fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_all_case_2.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';




}else{
Alert_NO_Content(); 
}
 
}else{
New_Print_Alert("4",$AdminLangFile['mainform_max_day_err_01']." ".MAXIMUM_DAYS." ".$AdminLangFile['mainform_max_day_err_02']); 
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>    
 