<?php
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id","sales_ticket","2");
$id = $row['id'];
extract($row);




Diar_Print_Close_Ticket_Top_Info($row);

Form_Open();

echo '<div style="clear: both!important;"></div>'.BR.BR; 
New_Print_Alert("2",$AdminLangFile['custserv_add_follow']); 

$Arr = array("Label" => 'on',"ListType" => '2' );
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['ticket_priority_sel_name'],"col-md-2","priority_id",$Follow_Priority_Arr,"optin","0",$Arr);


$Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_FOLLOW_TYPE);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['salesdep_f_follow_type'],"col-md-3","follow_type","config_data","req","0",$Arr); 

echo '<input type="hidden" name="follow_state" value="1" />';  
$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => "required");
$Err[] = NF_PrintInput("Date",$AdminLangFile['salesdep_f_follow_date'],"follow_date","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-2",'Placeholder'=> "",'required' => '','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Time",$AdminLangFile['ticket_follow_calltime'],"follow_time","1","1","optin",$MoreS);


 
echo '<div style="clear: both!important;"></div>';
$MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['custserv_comment'],"des","0","0","req",$MoreS);

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
Vall($Err,"AddClosedFollow",$db,"1",$USER_PERMATION_Add);
}            







###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

 


 

?> 
