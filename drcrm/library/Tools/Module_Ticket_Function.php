<?php
if(!defined('WEB_ROOT')) {	exit;}
 
#################################################################################################################################
###################################################  FollowDateConfirm  
#################################################################################################################################
function FollowDateConfirm(){
    global $AdminLangFile ;
    $FollowDateErr = ""; $FollowDate ="" ; $FollowTime ="";
    if( isset($_POST['follow_state']) and  $_POST['follow_state'] == '1'){
        $Today =  TimeForToday();
        if($_POST['follow_date'] == ""){
            SendJavaErrMass($AdminLangFile['salesdep_follow_date_err']);
            $FollowDateErr = "1" ;
        }else{
            $FollowDate =  strtotime($_POST['follow_date']);
            if($FollowDate < $Today ){
                SendJavaErrMass($AdminLangFile['salesdep_follow_date_err']);
                $FollowDateErr = "1" ;
            }
            if(isset($_POST['follow_time']) and  $_POST['follow_time'] != ""){
                $FollowTime = strtotime( $_POST['follow_time']) ;
                $RightTime = $FollowTime -  $Today ;
                $FollowTime = $FollowDate + $RightTime ;
                //  echo PrintFullTime($FollowTime).BR ;      
                if($FollowTime < time()){
                    SendJavaErrMass($AdminLangFile['salesdep_follow_date_err']);
                    $FollowDateErr = "1" ;
                }
            }else{
                $FollowTime = "";
            }
        }
    }else{
        if( isset($_POST['follow_date']) and $_POST['follow_date'] != ""){
            SendJavaErrMass($AdminLangFile['salesdep_follow_state_err']);
            $FollowDateErr = "1" ;
        }elseif(isset($_POST['follow_time']) and $_POST['follow_time'] != ""){
            SendJavaErrMass($AdminLangFile['salesdep_follow_state_err']);
            $FollowDateErr = "1" ;
        }else{
            $FollowDateErr = "0" ;
            $FollowDate = "" ;
        }
    }
    return array( "FollowDate" => $FollowDate ,"FollowTime" => $FollowTime ,"FollowDateErr" =>  $FollowDateErr  );
}

/*
function FollowDateConfirm(){
    global $AdminLangFile ;
  if($_POST['follow_state'] == '1'){
     $Today =  TimeForToday();
     if($_POST['follow_date'] == ""){
       SendJavaErrMass($AdminLangFile['salesdep_follow_date_err']); 
      $FollowDateErr = "1" ;   
     }else{
      $FollowDate =  strtotime($_POST['follow_date']); 
      if($FollowDate < $Today ){
       SendJavaErrMass($AdminLangFile['salesdep_follow_date_err']);   
      $FollowDateErr = "1" ;  
      }
      }
  }else{
   if($_POST['follow_date'] != ""){
    SendJavaErrMass($AdminLangFile['salesdep_follow_state_err']); 
    $FollowDateErr = "1" ;    
   }elseif($_POST['follow_time'] != ""){
    SendJavaErrMass($AdminLangFile['salesdep_follow_state_err']); 
    $FollowDateErr = "1" ; 
   }else{
   $FollowDateErr = "0" ;
   $FollowDate = "" ;  
   } 
  }
return array( "FollowDate" => $FollowDate ,"FollowDateErr" =>  $FollowDateErr  );
}
*/


#################################################################################################################################
###################################################   CheckdateForLastdate
#################################################################################################################################
function CheckdateForLastdate($SendDate){
   global $AdminLangFile ;
    $Err= "";
   $TimeForToday =  TimeForToday(); 
   $ForLastDate = $SendDate+(86400*6);
  if( $SendDate > $TimeForToday ){
        SendJavaErrMass($AdminLangFile['salesdep_date_err_2']);
        $Err = '1';
    }elseif($TimeForToday  > $ForLastDate ){
        SendJavaErrMass($AdminLangFile['salesdep_date_err_2']);
        $Err = '1';  
    }
   return $Err ;
}



#################################################################################################################################
###################################################   PrintCustomerInformation
#################################################################################################################################
function PrintCustomerInformation($CUSTID){
    global $db ;
$Row_Cust = $db->H_SelectOneRow("SELECT name,mobile,mobile_2,phone,email FROM customer where id = '$CUSTID' ");
$Date = "";
$Date .= $Row_Cust['name'].BR;
$Date .=  $Row_Cust['mobile'].BR;
$Date .= IffExistingVal($Row_Cust['mobile_2']);
$Date .= IffExistingVal($Row_Cust['phone']);
$Date .= IffExistingVal($Row_Cust['email']);
return $Date ;
}

#################################################################################################################################
###################################################   LoadTabelData_To_Arr
#################################################################################################################################
function LoadTabelData_To_Arr($State,$Tabel_Name,$LoadeFilde="id,name,name_en"){
    global $db ;
    if(intval($State != '0')){
    $LoadDate = $db->SelArr("SELECT $LoadeFilde FROM $Tabel_Name ");     
    }else{
    $LoadDate = array();    
    }
    return $LoadDate ;
}

#################################################################################################################################
###################################################   PrintLeadInformation
#################################################################################################################################
function PrintLeadInformation($row,$Arr=""){
 if(ADMIN_WEB_LANG == 'En'){$NamePrint = 'name_en' ;  }else{ $NamePrint = 'name' ;}	
 global $db ;
 global $AdminLangFile ;
 global $AdminConfig ;
 global $ConfigP ;
 global $T_ARRAY_CONFIG_DATA ;
 global $T_ARRAY_LEAD_TYPE ;
 global $T_ARRAY_LEAD_SOURS ;
 $RowCount = "";
 
 
 
####################################################################################################################################
///// طريقة التواصل
    
        $lead_type_n =  findValue_FromArr($T_ARRAY_LEAD_TYPE,"id",$row['lead_type'],$NamePrint);
        if(isset($Arr['FastView']) and $Arr['FastView'] == '1'){
        PrintFildInformation("col-md-3",$AdminLangFile['customer_lead_type'],$lead_type_n);  
        $RowCount = RowCountForLight_New($RowCount,"4");  
        }else{
        echo  $lead_type_n.BR;            
        }    
 
####################################################################################################################################     


 
####################################################################################################################################
///// مصدر التواصل
   
        $lead_sours_N = findValue_FromArr($T_ARRAY_LEAD_SOURS,"id",$row['lead_sours'],$NamePrint);
        if(isset($Arr['FastView']) and $Arr['FastView'] == '1'){
        PrintFildInformation("col-md-3",$AdminLangFile['customer_lead_sours'],$lead_sours_N);  
        $RowCount = RowCountForLight_New($RowCount,"4");              
        }else{
        echo  $lead_sours_N .BR;             
        }    
 
####################################################################################################################################


####################################################################################################################################
/////  الحملة الاعلانية   
    
        $lead_cat_N = findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['lead_cat'],$NamePrint);
        if(isset($Arr['FastView']) and $Arr['FastView'] == '1'){
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_lead_cat'],$lead_cat_N);  
        $RowCount = RowCountForLight_New($RowCount,"4");               
        }else{
        echo $lead_cat_N .BR;            
        }    
  
####################################################################################################################################    
}




#################################################################################################################################
###################################################   PrintLeadInformation
#################################################################################################################################
function PrintFollowInformation($row){
 if(ADMIN_WEB_LANG == 'En'){$NamePrint = 'name_en' ;  }else{ $NamePrint = 'name' ;}	
 global $db ;
 $FolloWInfo = "";

 if(intval($row['priority_id']) != '0'){
    
    $FolloWInfo  .= Rterun_Follow_Priority_Arr_ForTabel($row['priority_id']) ;  
    }else{
    $FolloWInfo .=""  ; 
 }
 
 if(intval($row['follow_date']) != '0'){
    $FolloWInfo  .= ConvertDateToCalender_2($row['follow_date']).BR ;  
    }else{
    $FolloWInfo .=""  ; 
 }
 
 if(intval($row['follow_time']) != '0'){
    $FolloWInfo  .= PrintFollowTime($row['follow_time']).BR ;  
    }else{
    $FolloWInfo .=""  ; 
 }
 

 
    return $FolloWInfo ;
}

function PrintFollowInformation_ForDesTabel($row){
 if(ADMIN_WEB_LANG == 'En'){$NamePrint = 'name_en' ;  }else{ $NamePrint = 'name' ;}	
 global $db ;
 $FolloWInfo = "";

 if(intval($row['follow_date']) != '0'){
    $FolloWInfo  .= ConvertDateToCalender_2($row['follow_date']).BR ;  
    }else{
    $FolloWInfo .=""  ; 
 }
 
 if(intval($row['follow_time']) != '0'){
    $FolloWInfo  .= PrintFollowTime($row['follow_time']).BR ;  
    }else{
    $FolloWInfo .=""  ; 
 }
 
 if(intval($row['priority_id']) != '0'){
    
    $Priority = Rterun_Follow_Priority_Arr_ForTabel($row['priority_id']) ;  
    }else{
    $Priority  = " "  ; 
 }
 
   // return $FolloWInfo ;
   return array("DateInfo"=> $FolloWInfo ,"Priority" => $Priority );
   
}


#################################################################################################################################
###################################################   
#################################################################################################################################
$Follow_State_Arr = array(
'1' => $AdminLangFile['ticket_follow_list_1'],
'2' => $AdminLangFile['ticket_follow_list_2'],
) ;
#################################################################################################################################
###################################################   
#################################################################################################################################
function Rterun_Follow_State_Arr($state) {
    global $AdminLangFile ;
   switch($state) {
     case "1":
       $order =  $AdminLangFile['ticket_follow_list_1'];
       break;
     case "2":
       $order =   $AdminLangFile['ticket_follow_list_2'] ;
       break;
     default:
       $order = "";
   }
   return $order;
 }
#################################################################################################################################
###################################################   
#################################################################################################################################
function Rterun_Follow_State_Arr_ForTabel($state) {
    global $AdminLangFile ;
   switch($state) {
     case "1":
       $order =  New_But_Alert("1",$AdminLangFile['ticket_follow_list_1']);
       break;
     case "2":
       $order =   New_But_Alert("4",$AdminLangFile['ticket_follow_list_2']);  
       break;
     default:
       $order = "";
   }
   return $order;
 }
 
#################################################################################################################################
###################################################   
################################################################################################################################# 
$Follow_Priority_Arr = array(
'1' => $AdminLangFile['ticket_priority_1'],
'2' => $AdminLangFile['ticket_priority_2'],
'3' => $AdminLangFile['ticket_priority_3'],
) ;

#################################################################################################################################
###################################################   
#################################################################################################################################
function Rterun_Follow_Priority_Arr_ForTabel($state) {
    global $AdminLangFile ;
   switch($state) {
     case "1":
       $order =  New_But_Alert("2",$AdminLangFile['ticket_priority_1']);
       break;
     case "2":
       $order =  New_But_Alert("3",$AdminLangFile['ticket_priority_2']);  
       break;
     case "3":
       $order =  New_But_Alert("4",$AdminLangFile['ticket_priority_3']);  
       break;
       
     default:
       $order = "";
   }
   return $order;
 }
#################################################################################################################################
###################################################   
#################################################################################################################################
$Follow_CallTime_Arr = array(
'1' => "9:00 AM",
'2' => "9:30 AM",
'3' => "10:00 AM",
'4' => "9:00 AM",
'5' => "9:30 AM",
'6' => "10:00 AM",
'7' => "9:00 AM",
'8' => "9:30 AM",
'9' => "10:00 AM",

) ;


#################################################################################################################################
###################################################   PrintTicketInformation
#################################################################################################################################
function PrintTicketInformation($row,$row_cust){
    global $AdminLangFile ;
    global $AdminPathHome ;
    global $NamePrint ;
    global $AdminConfig ;
    global $ConfigP ;
    global $T_ARRAY_CONFIG_DATA ;
    global $T_ARRAY_LEAD_TYPE ;
    global $T_ARRAY_LEAD_SOURS ;
    $RowCount = "";
  
Print_PagePanel_OPen("col-md-12",$AdminLangFile['ticket_h1'],"1","0","Parent_Infos");  


PrintFildInformation("col-md-3",$AdminLangFile['ticket_cust_name'],$row_cust['name']);
PrintFildInformation("col-md-3",$AdminLangFile['ticket_cust_mobile'],$row_cust['mobile']);

 
$c_type_n = GetNameFromID("f_cust_subtype",$row_cust['c_type_2'],$NamePrint);
PrintFildInformation("col-md-3",$AdminLangFile['ticket_cust_type'],$c_type_n);    
 

$user_id_n = GetNameFromID_User("tbl_user",$row['user_id'],"name") ;
PrintFildInformation("col-md-3",$AdminLangFile['ticket_emp_name'],$user_id_n);
echo '<div style="clear: both!important;"></div>';


###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    Row 1   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#    


####################################################################################################################################
///// طريقة التواصل
    if( F_LEAD_TYPE  == 1 ){
        if(intval($row['lead_type'])!= 0 ){
        $lead_type_n =  findValue_FromArr($T_ARRAY_LEAD_TYPE,"id",$row['lead_type'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['customer_lead_type'],$lead_type_n);  
        $RowCount = RowCountForLight_New($RowCount,"4");  
        }
    }
####################################################################################################################################     


####################################################################################################################################
///// مصدر التواصل
    if( F_LEAD_SOURS  == 1 ){
        if(intval($row['lead_sours'])!= 0 ){
        $lead_sours_N = findValue_FromArr($T_ARRAY_LEAD_SOURS,"id",$row['lead_sours'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['customer_lead_sours'],$lead_sours_N);  
        $RowCount = RowCountForLight_New($RowCount,"4");              
        }
    }
####################################################################################################################################

####################################################################################################################################
/////  الحملة الاعلانية   
    if( F_LEAD_CAT  == 1  ){
        if(intval($row['lead_cat'])!= 0 ){
        $lead_cat_N = findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['lead_cat'],$NamePrint);        
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_lead_cat'],$lead_cat_N);  
        $RowCount = RowCountForLight_New($RowCount,"4"); 
        }              
    } 
####################################################################################################################################    







####################################################################################################################################
/////  طريقة السداد
    if(  F_CASH_ID  == 1 and $row['cash_id'] ){
        $cash_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['cash_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_cash_id'],$cash_id_N);  
        $RowCount = RowCountForLight_New($RowCount,"4");               
    } 
#################################################################################################################################### 


####################################################################################################################################
///// ميعاد الاستلام
    if(  F_DATE_RECEIPT_ID  == 1 and $row['date_id'] ){
        $date_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['date_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_date_id'],$date_id_N);  
        $RowCount = RowCountForLight_New($RowCount,"4");               
    } 
#################################################################################################################################### 


####################################################################################################################################
///// النموذج
    if(  F_UNIT_TYPE_ID  == 1 and $row['unit_id'] ){
        $date_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['unit_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_unit_id'],$date_id_N);  
        $RowCount = RowCountForLight_New($RowCount,"4");               
    } 
#################################################################################################################################### 


####################################################################################################################################
///// المساحة
    if(  F_AREA_ID  == 1 and $row['area_id'] ){
        $date_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['area_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_area_id'],$date_id_N);  
        $RowCount = RowCountForLight_New($RowCount,"4");               
    } 
#################################################################################################################################### 

####################################################################################################################################
///// أنسب وقت للإتصال
    if(  F_CALL_TIME_ID  == 1 and $row['time_id'] ){
        $date_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['time_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_time_id'],$date_id_N);  
        $RowCount = RowCountForLight_New($RowCount,"4");               
    } 
#################################################################################################################################### 

####################################################################################################################################
///// طريقة التواصل المفضلة
    if(  F_BEST_CALL_ID  == 1 and $row['bestcall_id'] ){
        $date_id_N =  findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$row['bestcall_id'],$NamePrint);
        PrintFildInformation("col-md-3",$AdminLangFile['ticket_bestcall_id'],$date_id_N);  
        $RowCount = RowCountForLight_New($RowCount,"4");               
    } 
#################################################################################################################################### 


####################################################################################################################################
///// الاحياء
    if(  F_PROJECT_AREA  == 1 and $row['pro_area'] ){
        echo '<div style="clear: both!important;"></div>';
        $q_type = QtypePrint_2("project_area",$row['pro_area']) ;
        PrintFildInformation("col-md-12",$AdminLangFile['ticket_pro_area'],$q_type);  
        $RowCount = RowCountForLight_New($RowCount,"4");               
    } 
#################################################################################################################################### 



####################################################################################################################################
///// الاحياء
    if(  F_COURS  == 1 and $row['cours_id'] ){
        echo '<div style="clear: both!important;"></div>';
        $q_type = QtypePrint_2("config_data",$row['cours_id']) ;
        PrintFildInformation("col-md-12",$AdminLangFile['managedate_cours_but'],$q_type);  
        $RowCount = RowCountForLight_New($RowCount,"4");               
    } 
#################################################################################################################################### 



if($AdminConfig['admin']== '1'){
 echo '<div style="clear: both!important;"></div>';
echo '<div class="row"><div class="col-md-12 Mbut CloseForm_Ar">';
$ThisssURRRR = $AdminPathHome."SalesDep/index.php?view=AdminEditT&id=".$row['id'];
echo  NF_PrintBut_TD('Full_Url',$AdminLangFile['mainform_edit'],$ThisssURRRR,"btn-info","fa-pencil").BR;
echo '</div></div>';
 
}

Print_PagePanel_Close();     

}

#################################################################################################################################
###################################################   QtypePrint_2
#################################################################################################################################
function QtypePrint_2($TabelData,$Cat_ID ){
    $LinePrin = "";
$Cat_ID = substr($Cat_ID,1, -1);
$NewCatId =  explode("-",$Cat_ID);
for ($i = 0; $i < count($NewCatId); $i++) {
  $Print_Name = GetNameFromID($TabelData,$NewCatId[$i],"name");
  $LinePrin = $LinePrin. '<li class="f_qtypeLi">'.$Print_Name.'</li>' ; 
}
   return $LinePrin ; 
}


#################################################################################################################################
###################################################   ConfirmUpdateMass
#################################################################################################################################
function ConfirmUpdateMass($Ticket_Id,$Cust_Id){
    global $AdminLangFile ;
    $CustName  = GetNameFromID("customer",$Cust_Id,"name");
$Mass = $AdminLangFile['ticket_ticket_mass_update_1']." ".$Ticket_Id.BR; 
$Mass .= $AdminLangFile['ticket_ticket_mass_update_2']." ".$CustName.BR; 
New_Print_Alert("3",$Mass);  
}



#################################################################################################################################
###################################################   VisitTabelPrint
#################################################################################################################################
function VisitTabelPrint($row,$row2){
    global $AdminLangFile ;
    global $AdminConfig ;
    global $ContentPage_Arr ;
    
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead>';
echo '<tr>';
echo '<th width="150">'.$AdminLangFile['ticket_visit_date'].'</th>'; 
echo '<th width="400">'.$AdminLangFile['ticket_visit_des'].'</th>';

if($AdminConfig['admin'] == '1' and $ContentPage_Arr['Mod'] == 'SalesDep' ){
echo '<th width="20"></th>';    
}

echo '</tr>';
echo '</thead>';
echo '<tbody>';
echo '<tr>';
echo '<td>'.ConvertDateToCalender_2($row['visit_date']).'</td>';
echo '<td>'.$row2['des'].'</td>';

if($AdminConfig['admin'] == '1' and $ContentPage_Arr['Mod'] == 'SalesDep' ){
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_delete'],"DeleteVisit&id=".$row2['id'],"btn-danger","fa-window-close").'</td>';    
}

echo '</tr>';
echo '</tbody>';
echo '</table>';
}
#################################################################################################################################
###################################################   ReservationTabelPrint
#################################################################################################################################
function ReservationTabelPrint($row,$row2){
    global $AdminLangFile ;
    global $row ;
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead>';
echo '<tr>';
echo '<th width="100">'.$AdminLangFile['ticket_f_rev_date'].'</th>'; 
echo '<th width="100">'.$AdminLangFile['ticket_f_rev_date_2'].'</th>'; 
echo '<th width="400">'.$AdminLangFile['ticket_f_rev_des'].'</th>'; 
echo '</tr>';
echo '</thead>';
echo '<tbody>';
echo '<tr>';
echo '<td>'.ConvertDateToCalender_2($row['rev_date']).'</td>';
echo '<td>'.ConvertDateToCalender_2($row['rev_date_2']).'</td>';
echo '<td>'.$row2['des'].'</td>';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}

#################################################################################################################################
###################################################   ContractTabelPrint
#################################################################################################################################
function ContractTabelPrint($row,$row2){
    global $AdminLangFile ;
    global $row ;
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead>';
echo '<tr>';
echo '<th width="100">'.$AdminLangFile['ticket_contract_date'].'</th>'; 
echo '<th width="400">'.$AdminLangFile['ticket_contract_des'].'</th>'; 
echo '</tr>';
echo '</thead>';
echo '<tbody>';
echo '<tr>';
echo '<td>'.ConvertDateToCalender_2($row['contract_date']).'</td>';
echo '<td>'.$row2['des'].'</td>';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}


#################################################################################################################################
###################################################   ReservationCancelTabelPrint
#################################################################################################################################
function ReservationCancelTabelPrint($row,$row2){
    global $AdminLangFile ;
    global $row ;
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead>';
echo '<tr>';
echo '<th width="100">'.$AdminLangFile['ticket_cancel_date'].'</th>'; 
echo '<th width="400">'.$AdminLangFile['ticket_cancel_des'].'</th>'; 
echo '</tr>';
echo '</thead>';
echo '<tbody>';
echo '<tr>';
echo '<td>'.ConvertDateToCalender_2($row['cancel_date']).'</td>';
echo '<td>'.$row2['des'].'</td>';
echo '</tr>';
echo '</tbody>';
echo '</table>';
}
 
#################################################################################################################################
###################################################  TD_Visit_Icon  TD_REV_Icon
#################################################################################################################################
function TD_Visit_Icon($Vall){
    if($Vall['visit_s'] == '1'){
    $Viss_DD = ConvertDateToCalender_2($Vall['visit_date']);    
    $But = NF_PrintBut_TD('2',$Viss_DD,"ViewTicket&id=".$Vall['id'],"btn-success IconXX","fa-car") ;      
    }else{
    $But = "" ;     
    }
    return  $But ;
}
function TD_REV_Icon($Vall){
    if($Vall['rev_s'] == '1' and  $Vall['cancel_s'] == '0' ){
    $Viss_DD = ConvertDateToCalender_2($Vall['rev_date'])."|"; 
    $Viss_DD .= ConvertDateToCalender_2($Vall['rev_date_2']);     
    $But = NF_PrintBut_TD('2',$Viss_DD,"ViewTicket&id=".$Vall['id'],"btn-warning IconXX","fa-calendar") ;  
    }elseif($Vall['rev_s'] == '1' and  $Vall['cancel_s'] == '1'){
    $Viss_DD = ConvertDateToCalender_2($Vall['cancel_date']);
    $But = NF_PrintBut_TD('2',$Viss_DD,"ViewTicket&id=".$Vall['id'],"btn-danger IconXX","fa-trash-o") ;      
    }else{
    $But = "" ;     
    }
    return  $But ;
}


#################################################################################################################################
###################################################   FilterEmpFullLine
#################################################################################################################################
function FilterEmpFullLine($PerM_Cat){
    global $AdminConfig ;
    global $RowUsreInfo  ;
    if($AdminConfig[$PerM_Cat]== '1'){
    $UserPerm = "" ;    
    }else{
    $UserPerm = " and user_id = ". intval($RowUsreInfo['user_id'])  ;    
    }
    return  $UserPerm ; 
}
function FilterEmpFromFilter($Val){
    if(intval($Val) == '0'){
    $UserPerm = "" ;    
    }else{
    $UserPerm = " and user_id =". intval($Val)  ;    
    }
    return  $UserPerm ; 
}
function FilterEmp($Val){
    if(intval($Val) == '0'){
    $UserPerm = "" ;    
    }else{
    $UserPerm = " and user_id =". intval($Val)  ;    
    }
    return  $UserPerm ; 
}

function FilterReason($Val){
    if(intval($Val) == '0'){
    $UserPerm = "" ;    
    }else{
    $UserPerm = " and reason_id =". intval($Val)  ;    
    }
    return  $UserPerm ; 
}

#################################################################################################################################
###################################################    Diar_Print_Open_New_Sales_Ticket
#################################################################################################################################
function  Diar_Print_Open_New_Sales_Ticket($row,$already,$MyArr=array()){
    global $ALang ;
    global $USER_PERMATION_Add ;
    global $RowUsreInfo ;
    global $db ;
    $RowCount="";
    $Err= array();
    $row_leads = ArrIsset($MyArr,"Row_Leads",array());
    
   
    
    $Customer_ID =  $row['id'];

###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    بيانات  العميل
    Diar_Print_CustomerInfo($Customer_ID);
    echo '<div style="clear: both!important;"></div>';

###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   تذاكر سابقة للعميل
    #Diar_Print_OldTicket("0",$Customer_ID);
    Diar_Print_ArchivedTicket_2023("0",$Customer_ID);
    echo '<div style="clear: both!important;"></div>';


###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   عرض الفورم
    if($already > 0) {
        New_Print_Alert("4",$ALang['ticket_open_ticket_err']);
    }else{
        New_Print_Alert("2",$ALang['ticket_add_new_ticket']);


        Form_Open();
##########################################################################################################################################################
##########################################################################################################################################################
    echo '<input type="hidden" name="from_where" value="'.$MyArr['From_Where'].'" />';
    if(!isset($row_leads['id'])){$row_leads['id']="";}
    echo '<input type="hidden" name="c_leads" value="'.$row_leads['id'].'" />';
    echo '<input type="hidden" name="cust_id" value="'.$Customer_ID.'" />';
    echo '<input type="hidden" name="ticket_cust" value="2" />';
    echo '<input type="hidden" name="admin_id" value="'.$RowUsreInfo['user_id'].'" />';
    echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
    echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
           
    if( F_LEAD_TYPE == 1){
    if(!isset($row_leads['lead_type'])){$row_leads['lead_type']="";}    
    $Arr = array("Label" => 'on',"Active" => '0');      
    $Err[] = NF_PrintSelect_2018("Chosen",$ALang['customer_lead_type'],"col-md-3","lead_type","fs_lead_type","req",$row_leads['lead_type'],$Arr); 
    $RowCount = RowCountForLight_New($RowCount);
    }
    
    if( F_LEAD_SOURS == 1){
    if(!isset($row_leads['lead_sours'])){$row_leads['lead_sours']="";}        
    $Arr = array("Label" => 'on',"Active" => '0');      
    $Err[] = NF_PrintSelect_2018("Chosen",$ALang['customer_lead_sours'],"col-md-3","lead_sours","fs_lead_sours","req",$row_leads['lead_sours'],$Arr); 
    $RowCount = RowCountForLight_New($RowCount);
    }
     
    if(F_LEAD_CAT == 1){
    if(!isset($row_leads['lead_cat'])){$row_leads['lead_cat']="";}          
    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_LEAD_CAT);      
    $Err[] = NF_PrintSelect_2018("Chosen",$ALang['hotline_ad_campaign'],"col-md-3","lead_cat","config_data","req",$row_leads['lead_cat'],$Arr);
    $RowCount = RowCountForLight_New($RowCount);    
    }
    
    ListBox_Master_Sales_Employee();
    
    echo '<div style="clear: both!important;"></div>';
    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required');
    $Err[] = NF_PrintInput("TextAreaEdit",$ALang['customer_notes'],"notes","0","0","req",$MoreS);
##########################################################################################################################################################        
##########################################################################################################################################################         
Form_Close_New("1",$MyArr['BackUrl']);

        if(isset($_POST['B1'])){
            Vall($Err,"OPen_Ticket_To_Customer",$MyArr,"1",$MyArr['USER_PERMATION_Add']);
        }
    }
}


   
?>