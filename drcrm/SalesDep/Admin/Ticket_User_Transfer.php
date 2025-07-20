<?php
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



if(isset($_POST['TransferToUser'])) {
    if($AdminConfig['admin'] == '1') {
        TransferToUser();
    } else {
        SendMassgeforuser();
    }
}

if(isset($_POST['FliterTransfer'])){

$SectionName = "transfer";
$ThisTabelName = "sales_ticket";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;





    
$User_id =  $_POST['emp_id']   ;


$THESQL = "SELECT * FROM $ThisTabelName WHERE state = '2' and user_id = '$User_id' " ;
$THELINK = "view=".$view;  
 


$already = $db->H_Total_Count($THESQL);

if ($already > 0){


echo '<div style="clear: both!important;"></div>'; 
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_tickets'],$already,"fa-hdd-o","alert-inverse");
echo '<div style="clear: both!important;"></div>';

echo '<div id="ErrMass" class="ErrMass_Div"></div>';
echo '<form name="myform" action="#" method="post"  id="validate-form" data-parsley-validate enctype="multipart/form-data" >';


echo '<div class="row PanelMin TopButAction"><div class="col-md-12">';    

$Arr = array("Label" => 'on',"Active"=> '0',"OtherIdd"=>"user_id", "Filter_Filde"=> "sales" , "Filter_Vall"=>"1" );      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['leads_emp'],"col-md-3","emp_id","tbl_user","req",0,$Arr);	


//hidden
echo '<input type="hidden" value="'.$User_id.'" name="old_id" />';
echo '<button type="submit"  name="TransferToUser" class="mb-sm btn btn-danger">نقل</button>'; 

echo '</div></div><div style="clear: both;"></div>';  


if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
echo '<table id="MyCustmer" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
echo '<thead><tr>';  
}else{
echo '<div class="panel panel-default"><div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead><tr>';
}



Table_TH_Print('1',"ID","30");
Table_TH_Print('1',$AdminLangFile['salesdep_date_add'],"70");
Table_TH_Print('1',$AdminLangFile['salesdep_customer_information'],"100");
Table_TH_Print('1',$AdminLangFile['salesdep_evaluation'],"120"); 
Table_TH_Print('1',$AdminLangFile['salesdep_td_last_notes'],"200"); 
Table_TH_Print('1',$AdminLangFile['salesdep_user_name'],"100");  
Table_TH_Print('1',"","30");
echo '<th  class="TD_50" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';


 
echo '</tr></thead><tbody>';



if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
$Name = $db->SelArr($THESQL);
}else{
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
}



 
for($i = 0; $i < count($Name); $i++) {
     
$id = $Name[$i]['id'];  
 

echo '<tr>';

Table_TD_Print('1',$Name[$i]['id'],"C");
 

echo '<td>';
echo ConvertDateToCalender_2($Name[$i]['date_add']).BR;
echo '<div class="td_line"></div>';
echo PrintFullTime($Name[$i]['date_time']);
echo'</td>';

echo '<td>';
echo  PrintCustomerInformation($Name[$i]['cust_id']);
echo'</td>';

echo '<td>';
echo  findValue_FromArr($T_ARRAY_CUST_TYPE,"id",$Name[$i]['c_type'],$NamePrint).BR;
if($Name[$i]['c_type'] != 5){
echo '<div class="td_line"></div>';
echo findValue_FromArr($T_ARRAY_CUST_TYPESUB,"id",$Name[$i]['c_type_2'],$NamePrint);
}
echo '</td>';

 
echo '<td>'.nl2br($Name[$i]['notes']).'</td>';

$EmpnName =   findValue_FromArr($T_ARRAY_USERS_NAME,"user_id",$Name[$i]['user_id'],"name");  
echo '<td>'.$EmpnName.'</td>';



 
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['salesdep_view_but'],"ViewTicket&id=".$id,"btn-info","fa-search","1").'</td>';


echo '<td align="center">'.PrintCheckBox_New($id).'</td>';

echo '</tr>';

} 




///// CloseTabel   
CloseTabel();


}else{ 
Alert_NO_Content();   
}


}else{
#######################################################################
echo '<div id="ErrMass" class="ErrMass_Div"></div>';
echo '<div style="clear: both!important;"></div>';
echo '<form class="FilterForm" method="POST" name="Filter" id="validate-form" data-parsley-validate enctype="multipart/form-data">';

$Arr = array("Label" => 'on',"Active"=> '0',"OtherIdd"=>"user_id", "Filter_Filde"=> "sales" , "Filter_Vall"=>"1" );      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['leads_emp'],"col-md-3","emp_id","tbl_user","req",0,$Arr);	
 
echo '<div class="col-md-1 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="FliterTransfer" class="ArButForm btn btn-default" value="'.$AdminLangFile['salesdep_fiter_but'].'" />';
echo '</div>';   

echo '</form>'; 

echo '<div style="padding-bottom: 500px;"></div>';    
}



###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();


function TransferToUser(){
    global $db;
    global $AdminLangFile ;
    $ThisIsTest = "0";
    $Err="";

    if(isset($_POST['id_id'])){
        
    if($_POST['emp_id'] == $_POST['old_id']){
        SendJavaErrMass($AdminLangFile['salesdep_change_err']);
        $Err = '1';
    }

    if($Err != '1'){
            $EmailCount = count($_POST['id_id']);

            for ($i = 0; $i < $EmailCount; $i++){
                $id =  $_POST['id_id'][$i]  ;
                $Ticket_Update = array (
                    'user_id' =>  $_POST['emp_id'] ,
                );
                if($ThisIsTest == '1'){
                 print_r3($Ticket_Update);   
                }else{
                $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $id");   
                }
            }
    }
        $_POST['B1_Fliter'] = '';
        $_POST['emp_id'] = $_POST['old_id'];        
    }else{
        SendJavaErrMass("لم يتم تحديد محتوى للنقل");
        $_POST['B1_Fliter'] = '';
        $_POST['emp_id'] = $_POST['old_id'];
    }
}

	
?>                              

