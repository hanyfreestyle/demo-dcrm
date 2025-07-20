<?php
echo '<div style="clear: both!important;"></div>';

$already = $db->H_Total_Count($THESQL);
if ($already > 0){
?>
 
<table id="MyCustmer" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">
<thead><tr>

<?php
echo '<th width="30">ID</th>';
echo '<th width="70">'.$AdminLangFile['salesdep_date_add'].'</th>';
echo '<th width="150">'.$AdminLangFile['salesdep_cust_info'].'</th>';
echo '<th width="80">'.$AdminLangFile['customer_c_type'].'</th>';
echo '<th width="80">'.$AdminLangFile['customer_c_type_sub'].'</th>';

echo '<th width="100">'.$AdminLangFile['salesdep_user_name'].'</th>';

if($view == "ContractWait"){
echo '<th width="100">'.$AdminLangFile['ticket_f_rev_date_2'].'</th>';
} 

if($view == "CloseReview"){
echo '<th width="100">'.$AdminLangFile['salesdep_reason_for_close'].'</th>';   
} 
 
echo '<th width="50"></th>';
?>
</tr>
</thead>
<tbody>

<?php
   
 
 
$Name = $db->SelArr($THESQL);
 
for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  
$custIdd = $Name[$i]['cust_id'];

$C_type =  GetNameFromID("f_cust_type",$Name[$i]['c_type'],$NamePrint) ;
$C_type_2 =  GetNameFromID("f_cust_subtype",$Name[$i]['c_type_2'],$NamePrint) ;
$EmpnName =  GetNameFromID_User("tbl_user",$Name[$i]['user_id'],"name") ;

$CloseType =  GetNameFromID("fs_ticket_closed",$Name[$i]['close_type'],$NamePrint) ;

$sql_cust = "SELECT name,mobile,email FROM customer  where id = '$custIdd'";
$row_cust = $db->H_SelectOneRow($sql_cust);


echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.ConvertDateToCalender_2($Name[$i]['date_add']).'</td>'; 

echo '<td>';
echo $row_cust['name'] .BR;
echo $row_cust['mobile'] .BR ;
echo $row_cust['email'];
echo'</td>';

echo '<td>'.$C_type.'</td>';

echo '<td>'.$C_type_2.'</td>';
echo '<td>'.$EmpnName.'</td>';

if($view == "ContractWait"){
echo '<td>'.ConvertDateToCalender_2($Name[$i]['contract_date']).'</td>'; 
} 
 
if($view == "CloseReview"){
echo '<td>'.$CloseType.'</td>';
} 
 
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_view_but'],"ViewTicket&id=".$id,"btn-info","fa-search").'</td>';
  
echo '</tr>';
} 
 
	
?>                          
</tbody>
</table>
 
 
<?php
}else{ 
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';        
}
?>