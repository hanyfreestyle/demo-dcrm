<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


  

if(isset($_POST['B1_Fliter'])){ 
$Start_Date = strtotime($_POST['date_from']); 
$End_Date =  strtotime($_POST['date_to']); 
if(intval($_POST['user_id']) == '0'){
    $UserSQlFilter = " " ;
}else{
   $UserSQlFilter = "and user_id = ".intval($_POST['user_id']) ; 
}
   
}else{
UnsetAllSession('date_from,date_to');
$Report_period =  ReportPeriod($ConfigP['report_period']);
$Start_Date = $Report_period['start']; 
$End_Date = $Report_period['end']; 
$row['date_from'] = ConvertDateToCalender_3($Start_Date) ;   
$row['date_to'] = ConvertDateToCalender_3($End_Date) ; 
$UserSQlFilter ="";
}


echo '<form class="FilterForm FilterFormStyle" method="POST" name="Filter" id="validate-form" data-parsley-validate >';
  
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("DateEdit",$AdminLangFile['report_from_date'],"date_from","0","0","option",$MoreS);  

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("DateEdit",$AdminLangFile['report_to_date'],"date_to","0","0","option",$MoreS);

$Arr = array("Label" => 'on'  ,"OtherIdd"=>"user_id", "Filter_Filde"=> "group_id" , "Filter_Vall"=> $ConfigP['sales_cat']);      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","user_id","tbl_user","option",0,$Arr);
 
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
}else{

if(isset($_POST['B1_Fliter'])){     
$Countdayforloop =  CountDayForLoop_Confirm($_POST['date_from'],$_POST['date_to']) ;  
}else{
$Countdayforloop ="";    
}   

if($Countdayforloop < MAXIMUM_DAYS){  
    
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التجميع   



$SQLFiter = "SELECT id FROM sales_ticket where state = '5' and  close_date >= $Start_Date and close_date <= $End_Date  $UserSQlFilter";  
 
$TotalCount = $db->H_Total_Count($SQLFiter);

if($TotalCount > '0'){
    

$Name = $db->SelArr($SQLFiter);  


 
$Countdayforloop =  CountDayForLoop($Start_Date,$End_Date) ;     
    
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   الايكون     
echo '<div style="clear: both!important;"></div>'; 
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_tickets'],$TotalCount,"fa-hdd-o","alert-inverse");
ReportBlockPrint("col-md-3",$AdminLangFile['report_the_number_of_days'],$Countdayforloop,"fa-hdd-o","alert-inverse");


echo '<div style="clear: both!important;"></div>';
  
    

  
        

$data = array();








$Countdayforloop =  CountDayForLoop($Start_Date,$End_Date) ;  



#################################################################################################################################
###################################################   
#################################################################################################################################
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   Chart 2

echo '<div style="clear: both!important;"></div>'.BR.BR;  
echo '<div style="clear: both!important;"></div>';  
New_Print_Alert("1",$AdminLangFile['report_closedticket_r']);




#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ التعاقد
  $Arr_Contrac_Tickets = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  
 
  $already = $db->H_Total_Count("SELECT id FROM sales_ticket where state = '5' and close_type = '1' and close_date = '$Start_Date_Print' $UserSQlFilter ");
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $NewData_01 =  array(
     'label' => $AdminLangFile['custserv_closed_for_contracting']." ". $TotalCount,
     'color' =>  "#7cbf62",
     'data' => $MonthData_Send
   );
   

array_push($Arr_Contrac_Tickets,$NewData_01);   
$fp = fopen('json/'.$ThSisUser.'_contract_tickets.json', 'w');
fwrite($fp, json_encode($Arr_Contrac_Tickets));
fclose($fp);

echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_contract_tickets.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;    
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ التعاقد



#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ مغلقة للارشفة
  $Arr_Archive_Tickets = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $already = $db->H_Total_Count("SELECT id FROM sales_ticket where state = '5' and close_type = '2' and close_date = '$Start_Date_Print' $UserSQlFilter ");
  
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $NewData_02 =  array(
     'label' => $AdminLangFile['custserv_closed_for_archiving']." ". $TotalCount,
     'color' =>  "#5ab1ef",
     'data' => $MonthData_Send
   );
  array_push($Arr_Archive_Tickets,$NewData_02);   
  
  
$fp = fopen('json/'.$ThSisUser.'_archive_tickets.json', 'w');
fwrite($fp, json_encode($Arr_Archive_Tickets));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_archive_tickets.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;    

#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ مغلقة للارشفة

 




#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$  مغلقة للخسارة  
  $Arr_Loss_Tickets = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $already = $db->H_Total_Count("SELECT id FROM sales_ticket where state = '5' and close_type = '3' and close_date = '$Start_Date_Print' $UserSQlFilter ");
  
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $NewData_03 =  array(
     'label' => $AdminLangFile['custserv_closed_for_loss']." ". $TotalCount,
     'color' =>  "#f35839",
     'data' => $MonthData_Send
   );
  array_push($Arr_Loss_Tickets,$NewData_03);   
  
  
$fp = fopen('json/'.$ThSisUser.'_loss_tickets.json', 'w');
fwrite($fp, json_encode($Arr_Loss_Tickets));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_loss_tickets.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;    

#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$  مغلقة للخسارة  



 
 

 $AllData = array();
 array_push($AllData,$NewData_01); 
 array_push($AllData,$NewData_02); 
 array_push($AllData,$NewData_03); 
 
 $fp = fopen('json/'.$ThSisUser.'_all_closed.json', 'w');
 fwrite($fp, json_encode($AllData));
 fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_all_closed.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
 

}else{
echo '<div style="clear: both!important;"></div>';   
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';   
}



}else{
New_Print_Alert("4",$AdminLangFile['mainform_max_day_err_01']." ".MAXIMUM_DAYS." ".$AdminLangFile['mainform_max_day_err_02']); 
}

}  




###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>      
