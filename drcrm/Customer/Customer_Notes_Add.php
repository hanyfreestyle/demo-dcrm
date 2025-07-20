<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$row_cust = $db->H_CheckTheGet("id","id","customer","2");
$Cust_id = $row_cust['id'];


###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    بيانات  العميل  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@# 
echo '<div style="clear: both!important;"></div>';
PrintCustInfoCol_Sales($row_cust);
echo '<div style="clear: both!important;"></div>'; 
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    بيانات  العميل  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@# 
   
   
 
Form_Open($ArrForm);
New_Print_Alert("5",$AdminLangFile['customer_notes_add_but']); 
echo '<div style="clear: both!important;"></div>';

 


// hidden
echo '<input type="hidden" name="cust_id" value="'.$row_cust['id'].'" />';
echo '<input type="hidden" name="user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="user_name" value="'.$RowUsreInfo['name'].'" />';
 
 
$MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['customer_notes_des'],"des","1","0","req",$MoreS);
    
     
        
Form_Close_New("1","Profile&id=".$Cust_id);

if(isset($_POST['B1'])){
Vall($Err,"Customer_AddNew_Notes",$db,"1",$USER_PERMATION_Add);
}    
 

   
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();    




?>
