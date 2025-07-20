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



$Arr = array("Label" => 'on'  ,"OtherIdd"=>"user_id", "Filter_Filde"=> "state" , "Filter_Vall"=> '1');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","user_id","tbl_user","option",0,$Arr);

 
echo '<div style="clear: both!important;"></div>';
 

echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['report_filter_but'].'" />';
echo '</div>';   
 
echo '</form>';



echo '<div style="clear: both!important;"></div>';	


if(isset($_POST['B1_Fliter'])){ 
$End_SQL_Line = OtherSqlFiterLine($DateFilde); 

$SQLFiter = "SELECT * FROM sales_ticket where $StateFilde = '1' $End_SQL_Line ";     
}else{
$SQLFiter = "SELECT * FROM sales_ticket where $StateFilde = '1' and $DateFilde >= $Start_Date and $DateFilde <= $End_Date  ";    
}    

//echo $SQLFiter ;


echo '<div style="clear: both!important;"></div>';	


$TotalCount = $db->H_Total_Count($SQLFiter); 

if($TotalCount > 0) {
$Name = $db->SelArr($SQLFiter);

$Name_f_cust_type = $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
$Name_f_cust_subtype = $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");


$CelCountForList = "col-md-4" ;
$RowCountThree ="3"; 

ReportBlockPrint("col-md-3",$AdminLangFile['report_totalcount'],$TotalCount,"fa-hdd-o","alert-inverse");
 
echo '<div style="clear: both!important;"></div>';

$Cust_type =  GetChartVallFromArr_2018($Name,"c_type",$Name_f_cust_type);
$Arr = array("Tabel"=> $Cust_type, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Cust_type",$AdminLangFile['report_cust_type_h1'],$Arr,"1"); 
$RowCount = RowCountForLight_New($RowCount,$RowCountThree);

$Cust_type_2 =  GetChartVallFromArr_2018($Name,"c_type_2",$Name_f_cust_subtype);
$Arr = array("Tabel"=> $Cust_type_2, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Cust_type_2",$AdminLangFile['report_cust_type2_h1'],$Arr,"1"); 
$RowCount = RowCountForLight_New($RowCount,$RowCountThree);

###################################################  
if(F_LEAD_TYPE == 1){
$Name_fs_lead_type = $db->SelArr("SELECT id,name,name_en FROM fs_lead_type");    
$Lead_type =  GetChartVallFromArr_2018($Name,"lead_type",$Name_fs_lead_type);
$Arr = array("Tabel"=> $Lead_type, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Lead_type",$AdminLangFile['report_lead_type'],$Arr,"1"); 
$RowCount = RowCountForLight_New($RowCount,$RowCountThree);  
}


###################################################  
if(F_LEAD_SOURS == 1){
$Name_fs_lead_sours = $db->SelArr("SELECT id,name,name_en FROM fs_lead_sours");    
$Lead_Sours =  GetChartVallFromArr_2018($Name,"lead_sours",$Name_fs_lead_sours);
$Arr = array("Tabel"=> $Lead_Sours, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_Lead_Sours",$AdminLangFile['report_lead_sours'],$Arr,"1"); 
$RowCount = RowCountForLight_New($RowCount,$RowCountThree);  
}


###################################################   
$User_id =  GetChartVallFromArr_To_user($Name,"user_id","tbl_user");
$Arr = array("Tabel"=> $User_id, "LIMIT" => $ConfigP['cust_chart_count'], "TotalCount" => $TotalCount ); 
CharPrintArr($CelCountForList,"Chart_User_id",$AdminLangFile['report_employee'],$Arr,"1"); 
$RowCount = RowCountForLight_New($RowCount,$RowCountThree);
    
 
if(isset($_POST['B1_Fliter'])){ 
New_Print_Alert("5",$MassH1);    
echo '<div style="clear: both!important;"></div>';
?>

<table id="MyCustmer" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">
<thead><tr>

<?php
echo '<th width="30">ID</th>';
echo '<th width="70">'.$AdminLangFile['report_date_added'].'</th>';
echo '<th width="70">'.$Date_Lang.'</th>';
echo '<th width="100">'.$Period_Lang.'</th>';
echo '<th width="100">'.$AdminLangFile['report_customer_data'].'</th>';
echo '<th width="100">'.$AdminLangFile['report_lead_type_t'].'</th>';
echo '<th width="120">'.$AdminLangFile['salesdep_td_last_notes'].'</th>';
echo '<th width="100">'.$AdminLangFile['report_employee_name_t'].'</th>';

echo '<th width="50"></th>';

?>
</tr>
</thead>
<tbody>

<?php
if(F_LEAD_TYPE == 1){
$Lead_Type_Arr =  $db->SelArr("SELECT id,name,name_en FROM fs_lead_type");   
}
if(F_LEAD_SOURS == 1){
$Lead_Sours_Arr =  $db->SelArr("SELECT id,name,name_en FROM fs_lead_sours");    
}



$C_Type_Arr =  $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
$C_Type2_Arr =  $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");  
 
 
for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  

$CustName = GetNameFromID("customer",$Name[$i]['cust_id'],"name");
$CustMobile = GetNameFromID("customer",$Name[$i]['cust_id'],"mobile");
$EmpnName =  GetNameFromID_User("tbl_user",$Name[$i]['user_id'],"name") ;

if(F_LEAD_TYPE == 1){
$lead_type = findValue_FromArr($Lead_Type_Arr,"id",$Name[$i]['lead_type'],$NamePrint);    
}
if(F_LEAD_SOURS == 1){
$lead_sours = findValue_FromArr($Lead_Sours_Arr,"id",$Name[$i]['lead_sours'],$NamePrint);    
}



$c_type = findValue_FromArr($C_Type_Arr,"id",$Name[$i]['c_type'],$NamePrint);
$c_type2 = findValue_FromArr($C_Type2_Arr,"id",$Name[$i]['c_type_2'],$NamePrint);


echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>';
echo ConvertDateToCalender_2($Name[$i]['date_add']);
echo'</td>';
 
 
if($view == 'Cancellation'){
echo '<td>';
echo ConvertDateToCalender_2($Name[$i]["rev_date"]).BR;
echo ConvertDateToCalender_2($Name[$i]["cancel_date"]);

echo'</td>';
echo '<td>'.Time_Ago_2($Name[$i]['rev_date'],$Name[$i]["cancel_date"]).'</td>';   
     
}else{
echo '<td>'.ConvertDateToCalender_2($Name[$i][$DateFilde]).'</td>'; 
echo '<td>'.Time_Ago_2($Name[$i]['date_add'],$Name[$i][$DateFilde]).'</td>';   
    
} 



echo '<td>';
echo $CustName .BR;
if($USER_PERMATION_Dell){
echo $CustMobile .BR ;    
}
echo'</td>';

echo '<td>';
echo $lead_type.BR ;
echo $lead_sours.BR ;
echo '<div class="td_line"></div>';
echo $c_type .BR;
echo $c_type2 .BR;
echo'</td>';


echo '<td width="200">'.nl2br($Name[$i]['notes']).'</td>'; 

echo '<td>'.$EmpnName.'</td>';    

Button_ListPage_TicketView($id,$Button_TicketView_Arr);


echo '</tr>';
} 
 
	
?>   
                     
</tbody>
</table>
<?php
    
}    

}else{
Alert_NO_Content();      
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();


?>
 