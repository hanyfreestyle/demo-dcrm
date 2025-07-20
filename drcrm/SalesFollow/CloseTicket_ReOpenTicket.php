<?php
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id","sales_ticket","2");
$id = $row['id'];


if($row['state'] == '4'){

Diar_Print_Close_Ticket_Top_Info($row);


Form_Open($ArrForm);

echo '<div style="clear: both!important;"></div>';

if( F_LEAD_TYPE == 1){
$Arr = array("Label" => 'on',"Active" => '0');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_lead_type'],"col-md-3","lead_type","fs_lead_type","req","",$Arr); 
$RowCount = RowCountForLight_New($RowCount);
}

if( F_LEAD_SOURS == 1){
$Arr = array("Label" => 'on',"Active" => '0');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_lead_sours'],"col-md-3","lead_sours","fs_lead_sours","req","",$Arr); 
$RowCount = RowCountForLight_New($RowCount);
}
 
if(F_LEAD_CAT == 1){
$Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_LEAD_CAT);      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['hotline_ad_campaign'],"col-md-3","lead_cat","config_data","req","",$Arr);
$RowCount = RowCountForLight_New($RowCount);    
}
 
 
$Arr = array("Label" => 'on'  ,"OtherIdd"=>"user_id", "Filter_Filde"=> "sales" , "Filter_Vall"=> "1");      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","user_id","tbl_user","req",0,$Arr);	

  
echo '<div style="clear: both!important;"></div>';
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['customer_notes'],"des","0","0","req",$MoreS);



//hidden 
echo '<input type="hidden" name="cust_id" value="'.$row['cust_id'].'" />';
echo '<input type="hidden" name="ticket_id" value="'.$row['id'].'" />';
echo '<input type="hidden" name="admin_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="ticket_cust" value="3" />';
echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
echo '<input type="hidden" name="ticket_date" value="'.$row['date_add'].'" />'; 

Form_Close_New("1","CloseReview");

if(isset($_POST['B1'])){
if($Err != '1'){    
Vall($Err,"ReOpenTicket",$db,"1",$USER_PERMATION_Add);
}  
}            

}else{
ErrMassPer(); 
}


 


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>



 
