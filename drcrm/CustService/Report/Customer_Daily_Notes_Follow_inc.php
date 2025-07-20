<?php


$EmpnName =  GetNameFromID_User("tbl_user",$_POST['emp_id'],"name") ;
$THELINK ="";
$ConfigP['datatabel'] = "0";



///// Open_Header
$TaBelArr = array();
TableOpen_Header($TaBelArr);

Table_TH_Print('1',"ID","50");
Table_TH_Print("1",$AdminLangFile['ticket_t_add_date'],"100"); 
Table_TH_Print('1',$AdminLangFile['ticket_cust_name'],"200");
Table_TH_Print('1',$AdminLangFile['ticket_t_des'],"300");
Table_TH_Print('1',"","50");

///// TableClose_Header
TableClose_Header();


   
$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
$Name = $db->SelArr($THESQL);
}else{
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
}

    
for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  
$CustIsD   = $Name[$i]['cust_id'];  


$sql = "SELECT id,name,mobile FROM customer where id = '$CustIsD'";
$row_cust = $db->H_SelectOneRow($sql);
 




echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>'; 
echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>'; 
echo '<td>'.$row_cust['name'].BR.$row_cust['mobile'].'</td>';
echo '<td>'.nl2br($Name[$i]['notes']).'</td>';

$Full_Url = "Customer/index.php?view=Profile&id=";
$Url =  $AdminPathHome.$Full_Url.$CustIsD ;
Table_TD_Print('1',NF_PrintBut_TD("Full_Url",$ALang['customer_profile'],$Url,"btn-primary","fa-user","1"),"C");
echo '</tr>';
} 
}


///// CloseTabel   
CloseTabel();
	
?>