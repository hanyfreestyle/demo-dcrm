<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



 
if(isset($_POST['B1_Fliter'])){ 
   
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


$Arr = array("Label" => 'on'  ,"OtherIdd"=>"user_id", "Filter_Filde"=> "group_id" , "Filter_Vall"=> $ConfigP['sales_cat']);      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","user_id","tbl_user","option",0,$Arr);



echo '<div style="clear: both!important;"></div>';
 

echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['report_filter_but'].'" />';
echo '</div>';   
 
echo '</form>';



 
echo '<div style="clear: both!important;"></div>';	





if(isset($_POST['B1_Fliter'])){ 
$End_SQL_Line = CustmerSqlFiterLine(); 
$Countdayforloop =  CountDayForLoop_Confirm($_POST['date_from'],$_POST['date_to']) ;   
$SQLFiter = "SELECT id,lead_sours,lead_type FROM sales_ticket where id != '0' $End_SQL_Line ";     
}else{
$SQLFiter = "SELECT id,lead_sours,lead_type FROM sales_ticket where date_add >= $Start_Date and date_add <= $End_Date"; 
$Countdayforloop ="";   
}    
 
 
if($Countdayforloop < MAXIMUM_DAYS){



echo '<div style="clear: both!important;"></div>';	



$TotalCount = $db->H_Total_Count($SQLFiter);
 
if($TotalCount > 0) {
$Name = $db->SelArr($SQLFiter);

$CelCountForList = "col-md-3" ;
 

ReportBlockPrint("col-md-3",$AdminLangFile['report_totalcount'],$TotalCount,"fa-hdd-o","alert-inverse");
 
echo '<div style="clear: both!important;"></div>';

$Lead_Sours =  GetChartVallFromArr($Name,"lead_sours","fs_lead_sours");
$Arr = array("Tabel"=> $Lead_Sours, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr("col-md-4","Chart_Lead_Sours",$AdminLangFile['report_lead_sours'],$Arr,"1"); 


$Lead_type =  GetChartVallFromArr($Name,"lead_type","fs_lead_type");
$Arr = array("Tabel"=> $Lead_type, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr("col-md-4","Chart_Lead_type",$AdminLangFile['report_lead_type'],$Arr,"1"); 


	

 
    
echo '<div style="clear: both!important;"></div>';
 

    for ($i = 0; $i <  count($Lead_Sours); $i++) {
     
        $lead_soursId = $Lead_Sours[$i]['id'];
        $TotalCount = $Lead_Sours[$i]['count'];
        if(isset($_POST['B1_Fliter'])){ 
        $Name = $db->SelArr("SELECT * FROM sales_ticket where lead_sours = '$lead_soursId' $End_SQL_Line  ");
        }else{
        $Name = $db->SelArr("SELECT * FROM sales_ticket where lead_sours = '$lead_soursId' and date_add >= $Start_Date and date_add <= $End_Date ");            
        }
        $Lead_type =  GetChartVallFromArr($Name,"lead_type","fs_lead_type");
    
        $Arr = array("Tabel"=> $Lead_type, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount );
        CharPrintArr("col-md-4","Chart_Lead_typeInfio".$i,$Lead_Sours[$i]['name'],$Arr,"1");
     
        $RowCount = RowCountForLight_2($RowCount); 
    }
}else{
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';      
}

}else{
New_Print_Alert("4",$AdminLangFile['mainform_max_day_err_01']." ".MAXIMUM_DAYS." ".$AdminLangFile['mainform_max_day_err_02']); 
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page(); 

?>