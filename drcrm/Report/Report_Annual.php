<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php

if(isset($_POST['B1_Fliter'])){ 
if(intval($_POST['user_id']) == '0'){
    $UserSQlFilter = " " ;
}else{
   $UserSQlFilter = "and user_id = ".intval($_POST['user_id']) ; 
}
$YearSelMenu = $_POST['report_year'];
$YearFilter = GetYearFrom_List_To_Date($_POST['report_year']) ;
}else{
$ThisYear = FULLDate_ForToday();
$YearSelMenu =  GetYearFrom_Date_To_List($ThisYear['Year']);
$YearFilter = $ThisYear['Year'] ;
}


echo '<div style="clear: both!important;"></div>';

echo '<form class="FilterForm FilterFormStyle" method="POST" name="Filter" id="validate-form" data-parsley-validate >';
  /*
$Err[] = NF_PrintSelect("FromArr",$AdminLangFile['reportconfig_report_period'],"col-md-4","report_year",$YearListArr,"req",$YearSelMenu);
$Err[] = NF_PrintSelect("Chosen_User_3",$AdminLangFile['report_employee_name'],"col-md-4","user_id","tbl_user","option","0",$ConfigP['sales_cat']);
*/
echo '<div style="clear: both!important;"></div>';
 

echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['report_filter_but'].'" />';
echo '</div>';   
 
echo '</form>';   

   
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التجميع   

$SQLFiter = "SELECT id FROM sales_ticket WHERE date_month like '%-$YearFilter%' $UserSQlFilter ";   

$TotalCount = $db->H_Total_Count($SQLFiter); 

if($TotalCount > '0'){

$Name = $db->H_SelArrOnlyRow($SQLFiter);  

     
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   الايكون     
echo '<div style="clear: both!important;"></div>'; 
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_tickets'],$TotalCount,"fa-hdd-o","alert-inverse");
echo '<div style="clear: both!important;"></div>';
  
    
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التقرير الاول      
    
           
echo '<div style="clear: both!important;"></div>';    
echo  New_Print_Alert("1",$AdminLangFile['report_events_report']);
 
echo '<div style="clear: both!important;"></div>';

$SQLFiter_55 = "SELECT id FROM sales_ticket where visit_s = '1' and visit_month like  '%-$YearFilter%'   $UserSQlFilter";   
$VisitReport = $db->H_Total_Count($SQLFiter_55);
$Line = intval($VisitReport) .BR." ( ".round(($VisitReport / $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_visits'],$Line,"fa-car","alert-info");


$SQLFiter_55 = "SELECT id FROM sales_ticket where rev_s = '1' and rev_month  like '%-$YearFilter%'  $UserSQlFilter";   
$RevReport = $db->H_Total_Count($SQLFiter_55);
$Line = intval($RevReport) .BR." ( ".round(($RevReport / $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_reservations'],$Line,"fa-calendar","alert-warning");

$SQLFiter_55 = "SELECT id FROM sales_ticket where cancel_s = '1' and cancel_month like '%-$YearFilter%' $UserSQlFilter";   
$CancelReport =$db->H_Total_Count($SQLFiter_55);
$Line = intval($CancelReport) .BR." ( ".round(($CancelReport / $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_reservation_canceled'],$Line,"fa-trash-o");

$SQLFiter_55 = "SELECT id FROM sales_ticket where contract_s = '1' and contract_month like '%-$YearFilter%'  $UserSQlFilter";   
$ContractReport = $db->H_Total_Count($SQLFiter_55);
$Line = intval($ContractReport) .BR." ( ".round(($ContractReport/ $TotalCount )* 100, 0) ." % )" ;
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_contract'],$Line,"fa-dollar","alert-success");  
  
echo '<div style="clear: both!important;"></div>'; 

$Countdayforloop = '12';

## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   Chart 1
$data = array();

$ChartLoop = $db->SelArr("SELECT * FROM fs_report_chart where cat_id = 't_visits'  ");
for($i = 0; $i < count($ChartLoop); $i++) {
  
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $DateFiter = $ChartLoop[$i]['f_date_m'];
  $DateFiterLike = $x.'-'.$YearFilter ;  
  $ThisSQlLL = "SELECT id FROM sales_ticket WHERE $DateFiter = '$DateFiterLike' $UserSQlFilter " ;
  $already = $db->H_Total_Count($ThisSQlLL);
  $MonthData =  array(GetMonthName_For_chart($x), $already); 

  array_push($MonthData_Send,$MonthData);  
  $TotalCount = $TotalCount +  $already ;
  }
  $NewData =  array(
     'label' => $ChartLoop[$i][$NamePrint]." ". $TotalCount,
     'color' =>  $ChartLoop[$i]['color'],
     'data' => $MonthData_Send
   );
  array_push($data,$NewData);   
}  

 

$fp = fopen('json/'.$ThSisUser.'_visits_y.json', 'w');
fwrite($fp, json_encode($data));
fclose($fp);

echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_visits_y.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';










#################################################################################################################################
###################################################   
#################################################################################################################################
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   Chart 2

echo '<div style="clear: both!important;"></div>'.BR.BR;  
echo '<div style="clear: both!important;"></div>';  
New_Print_Alert("1",$AdminLangFile['report_followup_report']);


 
$Countdayforloop =  "12";  
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ التذاكر الجديدة
  $Arr_NewTickets = array();
  
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
   $DateFiterLike = $x.'-'.$YearFilter ;   
  $already = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE date_month = '$DateFiterLike' $UserSQlFilter ");
  
 
  $MonthData =  array(GetMonthName_For_chart($x), $already); 
  array_push($MonthData_Send,$MonthData);  
    
  $TotalCount = $TotalCount +  $already ;
  }
  $NewData_01 =  array(
     'label' => $AdminLangFile['report_new_ticket']." ". $TotalCount,
     'color' =>  "#5ab1ef",
     'data' => $MonthData_Send
   );

array_push($Arr_NewTickets,$NewData_01);   
$fp = fopen('json/'.$ThSisUser.'_tickets_y.json', 'w');
fwrite($fp, json_encode($Arr_NewTickets));
fclose($fp);

echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_tickets_y.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;    
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ التذاكر الجديدة






#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ عدد المتابعات    
  $Arr_Follow = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $DateFiterLike = $x.'-'.$YearFilter ;    
  $SQL = "SELECT id FROM sales_ticket_des WHERE count_type = '2' and  date_month = '$DateFiterLike' $UserSQlFilter ";
  $already = $db->H_Total_Count($SQL);
  
   
  $MonthData =  array(GetMonthName_For_chart($x), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $NewData_02 =  array(
     'label' => $AdminLangFile['report_followup']." ". $TotalCount,
     'color' =>  "#f35839",
     'data' => $MonthData_Send
   );
  array_push($Arr_Follow,$NewData_02);   
  
  
$fp = fopen('json/'.$ThSisUser.'_follow_y.json', 'w');
fwrite($fp, json_encode($Arr_Follow));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_follow_y.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;    

#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ عدد المتابعات    




  
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$  عدد العملاء     
  
  $Arr_CustCount = array();
  
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $DateFiterLike = $x.'-'.$YearFilter ; 
  $HetSQl  = "SELECT id,cat_id FROM sales_ticket_des WHERE count_type = '2' and date_month = '$DateFiterLike' $UserSQlFilter " ;
  $already = $db->H_Total_Count($HetSQl);
  if($already > '0'){
  $Name = $db->SelArr($HetSQl);  
  $VisitReport = assc_array_count_values( $Name ,"cat_id");
  $already_Send = count($VisitReport); 
  }else{
  $already_Send = "0";  
  }
  $MonthData =  array(GetMonthName_For_chart($x), $already_Send); 
  
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already_Send ;
  }
  $NewData_03 =  array(
     'label' =>$AdminLangFile['report_clients']." ". $TotalCount,
     'color' =>  "#7cbf62",
     'data' => $MonthData_Send
   );
  array_push($Arr_CustCount,$NewData_03);   
  


$fp = fopen('json/'.$ThSisUser.'_custcount_y.json', 'w');
fwrite($fp, json_encode($Arr_CustCount));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_custcount_y.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';

echo '<div style="clear: both!important;"></div>'.BR.BR;  
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$  عدد العملاء    


 $AllData = array();
 array_push($AllData,$NewData_01); 
 array_push($AllData,$NewData_02); 
 array_push($AllData,$NewData_03); 
 
 $fp = fopen('json/'.$ThSisUser.'_all_case_y.json', 'w');
 fwrite($fp, json_encode($AllData));
 fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_all_case_y.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';

}else{
echo '<div style="clear: both!important;"></div>';   
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';   
}
 

?>      

</div></div>
