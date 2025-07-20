<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
 
Form_Open($ArrForm);

$CustmerTYpeAddSecion = 'Hotline_Add';
$CustmerTabelName = 'c_leads';
echo '<input type="hidden" name="sales_man" value="'.$AdminConfig['salesdep'].'" />';
require_once '../_Pages/Customer_Inc_Add.php' ;

Form_Close_New("1","List");

if(isset($_POST['B1'])){
    Vall($Err,"CustomerAdd",$db,"1",$USER_PERMATION_Add);
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();


?>
