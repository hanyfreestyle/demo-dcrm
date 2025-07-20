<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id","customer","2");
extract($row);

if($c_type == '5'){
    New_Print_Alert("4",$AdminLangFile['customer_edit_err_5']);
}else{
    if($row['birth_date'] != ""){
        $row['birth_date'] = ConvertDateToCalender_3($row['birth_date']);
    }else{
        $row['birth_date'] = "" ;
    }

    echo '<div class="row"><div class="col-md-12 Row_Top Row_Top_link">';
    echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['customer_profile'],"Profile&id=".$id,"btn-primary","fa-user").'</td>';
    echo '</div></div>';


    echo '<div style="clear: both!important;"></div>';

    Form_Open($ArrForm);
    $CustmerTYpeAddSecion = 'Customer_Add';
    require_once '../_Pages/Customer_Inc_Edit.php' ;

    Form_Close_New("2","List");

    if(isset($_POST['B1'])){
        Vall($Err,"CustomerEdit",$db,"1",$USER_PERMATION_Edit);
    }

}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>