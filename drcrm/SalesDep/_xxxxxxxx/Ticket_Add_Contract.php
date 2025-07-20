<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">

<?php
if(!isset($_POST['B1'])){
UnsetAllSession('contract_date');
}

$row = $db->H_CheckTheGet("id","id","sales_ticket","2");

if($row['user_id'] == $RowUsreInfo['user_id'] or $AdminConfig['leads'] == '1' ){

if($row['contract_s'] == '0' and $row['c_type'] != '5'){
    

echo '<div style="clear: both!important;"></div>';
 

if(isset($_GET['CourseID'])){
Form_Open($ArrForm);
//hidden  
echo '<input type="hidden" name="ticket_id" value="'.$row['id'].'" />';
echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
echo '<input type="hidden" name="cust_id" value="'.$row['cust_id'].'" />'; 
echo '<input type="hidden" name="ticket_date" value="'.$row['date_add'].'" />'; 

require_once 'Ticket_Add_Contract_Form.php';    
    
    
    
Form_Close_New("1","ViewTicket&id=".$row['id']);
    
if(isset($_POST['B1'])){
$ThisErr = ""; 
for ($i = 1; $i <= 3; $i++) {   
 if($_POST['val'][$i] >= '0' and trim($_POST['des'][$i])== ""){
    SendJavaErrMass($AdminLangFile['course_invoice_erradd']);
    $ThisErr = '1';
 }   
}    
if($ThisErr != '1'){
 Vall($Err,"Add_Invoce",$db,"1",$USER_PERMATION_Edit);   
}
}
        
}else{
    
    Form_Open($ArrForm);
    echo '<input type="hidden" name="ticket_id" value="'.$row['id'].'" />';
    $Arr = array("Label" => 'on',"Active" => '1');
    $Err[] = NF_PrintSelect_2018("Chosen","تحديد الدورة ","col-md-3","course_no","course","req",0,$Arr);
    Form_Close_New("1","ViewTicket&id=".$row['id']);
   
    if(isset($_POST['B1'])){
            Vall($Err,"AddContract_Url",$db,"1",$USER_PERMATION_Edit);
    }
}











 






 

  
           




}else{
ErrMassPer(); 
}


}else{
ErrMassPer();      
} 
 
function AddContract_Url($db){
    Redirect_Page_2("index.php?view=AddContract&id=".$_POST['ticket_id']."&CourseID=".$_POST['course_no']);
} 
 	
?>
 
</div></div>