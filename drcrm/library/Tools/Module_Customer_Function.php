<?php
#################################################################################################################################
###################################################   CheckCountryState
#################################################################################################################################
function CheckCountryState(){
    global $AdminLangFile ;
    $Err_Country = "";
    if($_POST['live_id'] == '1'){
       if(intval($_POST['country_id']) != '204'){
        SendJavaErrMass($AdminLangFile['customer_nationality_err']);
        $Err_Country = '1' ;
       }else{
        $_POST['countrylive_id'] = '204' ; 
       }
    }elseif($_POST['live_id'] == '2'){
       if(intval($_POST['country_id']) != '204'){
        SendJavaErrMass($AdminLangFile['customer_nationality_err']);
        $Err_Country = '1' ;
       }
        if(intval($_POST['countrylive_id']) == '204' or intval($_POST['countrylive_id']) == '0'   ){
         SendJavaErrMass($AdminLangFile['customer_country_live_err']);
         $Err_Country = '1' ; 
       }
    }elseif($_POST['live_id'] == '3'){
       if(intval($_POST['country_id']) == '204'){
        SendJavaErrMass($AdminLangFile['customer_nationality_err']);
        $Err_Country = '1' ;
       }else{
        $_POST['countrylive_id'] = '204' ; 
       }   
    }elseif($_POST['live_id'] == '4'){
       if(intval($_POST['country_id']) == '204'){
        SendJavaErrMass($AdminLangFile['customer_nationality_err']);
        $Err_Country = '1' ;
       }
       if(intval($_POST['countrylive_id']) == '204' or intval($_POST['countrylive_id']) == '0'   ){
         SendJavaErrMass($AdminLangFile['customer_country_live_err']);
         $Err_Country = '1' ; 
       }     
    }    
     return $Err_Country ;
}

#################################################################################################################################
###################################################  CheckDuplicatesEntry
#################################################################################################################################
function CheckDuplicatesEntry($arr){
 $GetDate = array_values(array_filter($arr));  
 if(count(array_unique($GetDate))< count($GetDate)){
    $Err = "1" ;
 }else{
    $Err = "0";
  }
  return $Err ;
}
#################################################################################################################################
###################################################  PrintErrFromSQL_ForCust_2
#################################################################################################################################
function PrintErrFromSQL_ForCust_2($Val,$ErrMass,$MMID='0'){
    global $db ;
    global $AdminLangFile ;
    global $AdminPathHome ;
    global $AdminConfig ;
    $Err = "" ;
    
    if($MMID != '0'){
    $TestForEditLine = " and id != ".$MMID;    
    }else{
    $TestForEditLine = '';        
    }
     
     if(($_POST[$Val]) ){
    
     $CheckVall = Clean_Mypost($_POST[$Val]);
     if($Val == 'email'){
     $SQL = "SELECT id,name FROM customer WHERE email = '$CheckVall' $TestForEditLine ";    
     }elseif( $Val  == 'id_no'){
     $SQL = "SELECT id,name FROM customer WHERE id_no = '$CheckVall' $TestForEditLine ";   
     }else{
     $SQL = "SELECT id,name FROM customer WHERE ( mobile = '$CheckVall' or  mobile_2 = '$CheckVall' or phone = '$CheckVall') $TestForEditLine ";   
     }

     $already = $db->H_Total_Count($SQL);
     echo $already ;
     
     if($already > 0) {
        $Err = '1';
    
        $SendMass = "";
        $Name = $db->SelArr($SQL);
        for($i = 0; $i < count($Name); $i++) {
       
        $Link_Edit = $AdminPathHome."Customer/index.php?view=Edit&id=".$Name[$i]['id'] ;
        $Link_View = $AdminPathHome."Customer/index.php?view=Profile&id=".$Name[$i]['id'] ;
        $Target = "_blank" ;      
        
        $SendMass .= $ErrMass." ".$AdminLangFile['mainform_err_already_exists']." ";
        $SendMass .= $Name[$i]['name']." ".$AdminLangFile['mainform_err_record_id']." ".$Name[$i]['id'] ;  
         
        if($AdminConfig['customer_edit'] == '1'){
        $SendMass .=   BR.'<a href='.$Link_Edit.'  target= '.$Target.' >'.$AdminLangFile['customer_edit_cust_err'].'</a>'." ".BR ;
        }  
        
        if($AdminConfig['customer'] == '1'){
        $SendMass .=  '<a href='.$Link_View.'  target= '.$Target.' >'.$AdminLangFile['customer_view_cust_err'].'</a>'." " ;
        }    
        
        } 
        
        SendJavaErrMass_22 ($SendMass);        
     }
        
       return $Err ;
    }   
}

#################################################################################################################################
###################################################   CountFunctionForCust
#################################################################################################################################
function  CountFunctionForCust(){
CountFildFromTabel("f_cust_type","customer","c_type","count");    
}

#################################################################################################################################
###################################################   CustmerSqlFiterLineFromPost_Date
#################################################################################################################################
function CustmerSqlFiterLineFromPost_Date($Post_Name,$Filde_Name,$State){
   if($State == "From"){
       if( $Post_Name  == ''){
        $LineSend = "" ;
       }else{
        $Post_Name =  strtotime($Post_Name);
        $LineSend = " and ".$Filde_Name."  >= " .$Post_Name ; 
       }   
   }elseif($State == "To"){
      if( $Post_Name  == ''){
        $LineSend = "" ;
       }else{
        $Post_Name =  strtotime($Post_Name);
        $LineSend = " and ".$Filde_Name."  <= " .$Post_Name ; 
       }    
   }
   return $LineSend ;
}
#################################################################################################################################
###################################################   CustmerSqlFiterLineFromPost
#################################################################################################################################
function CustmerSqlFiterLineFromPost($Post_Name,$Filde_Name){
   $Post_Name = intval($Post_Name) ;
    if($Post_Name  == '0'){
    $LineSend = "" ;
   }else{
    $LineSend = " and ".$Filde_Name." = " .$Post_Name ; 
   } 
    return $LineSend ;
}


function CustmerSqlFiterLineFromPost_2018($Post_Name, $Filde_Name){
    if(isset($_POST[$Post_Name])){
        $Post_Name = intval($_POST[$Post_Name]) ;
        if($Post_Name  == '0'){
            $LineSend = "" ;
        }else{
            $LineSend = " and ".$Filde_Name." = " .$Post_Name ;
        }
        return $LineSend ;

    }
}

#################################################################################################################################
###################################################   CustmerSqlFiterLineFromPostAsLike
#################################################################################################################################
function CustmerSqlFiterLineFromPostAsLike($Post_Name,$Filde_Name){
   $Post_Name = intval($Post_Name) ;
   if($Post_Name  == '0'){
    $LineSend = "" ;
   }else{
    $Post_Name = "-".$Post_Name."-" ;
    $LineSend = " and ".$Filde_Name." like " .$Post_Name; 
    //$q_type_v = "-".intval($_POST['qtype'])."-"; 
     $LineSend  = " and ". $Filde_Name. " like '%$Post_Name%' " ; 
   } 
    return $LineSend ;
}




#################################################################################################################################
###################################################  Print Customer Profile 
#################################################################################################################################

function PrintCustomerProfile($row,$C_6="6",$C_3="3",$C_12="12"){
    global $AdminLangFile ;
    $RowCount= "";

     
    if(ADMIN_WEB_LANG == 'En'){$NamePrint = 'name_en' ;  }else{ $NamePrint = 'name' ;}	
    
    PrintFildInformation("col-md-2","ID",$row['id']);
    PrintFildInformation("col-md-5",$AdminLangFile['customer_name'],$row['name']);
    
    if($row['date_add']){
    $date_add_n = ConvertDateToCalender_2($row['date_add']);    
    }
    PrintFildInformation("col-md-2",$AdminLangFile['customer_date_add'],$date_add_n);
    
    $user_id_n = GetNameFromID_User("tbl_user",$row['user_id'],"name") ;
    PrintFildInformation("col-md-3" ,$AdminLangFile['customer_add_user'],$user_id_n);
    
    echo '<div style="clear: both!important;"></div>';
    
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    Row 1   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#    
  
    $c_type_n = GetNameFromID("f_cust_type",$row['c_type'],$NamePrint);
    PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_c_type'],$c_type_n);
    $RowCount = RowCountForLight_New($RowCount);
    
    
    $c_type_2_n = GetNameFromID("f_cust_subtype",$row['c_type_2'],$NamePrint);
    PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_c_type_sub'],$c_type_2_n);
    $RowCount = RowCountForLight_New($RowCount);
 
    
    if(F_LEAD_TYPE  == 1){      
    $lead_type_n = GetNameFromID("fs_lead_type",$row['lead_type'],$NamePrint);
    PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_lead_type'],$lead_type_n);
    $RowCount = RowCountForLight_New($RowCount);
    }
    
   
    if( F_LEAD_SOURS  == 1 ){
    $lead_sours_n = GetNameFromID("fs_lead_sours",$row['lead_sours'],$NamePrint);
    PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_lead_sours'],$lead_sours_n);
    $RowCount = RowCountForLight_New($RowCount);
    }




 
if($row['lead_cat'] And F_LEAD_CAT == 1 ){
$lead_cat_n = GetNameFromID("config_data",$row['lead_cat'],$NamePrint);
PrintFildInformation("col-md-".$C_3,$AdminLangFile['ticket_lead_cat'],$lead_cat_n);
$RowCount = RowCountForLight_New($RowCount);
}
 
if($row['mobile']){
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_mobile'],$row['mobile']);
$RowCount = RowCountForLight_New($RowCount);
}

if($row['mobile_2']){
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_mobile']."2",$row['mobile_2']);
$RowCount = RowCountForLight_New($RowCount);
}

if($row['phone']){
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_phone'],$row['phone']);
$RowCount = RowCountForLight_New($RowCount);
}


if($row['email']){
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_email'],$row['email']);
$RowCount = RowCountForLight_New($RowCount);
}


if($row['live_id'] and F_FULL_COUNTRY == 1){
$live_id_n = GetNameFromID("f_live",$row['live_id'],$NamePrint);
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_live_type'],$live_id_n);
$RowCount = RowCountForLight_New($RowCount);
}


if($row['country_id'] And F_COUNTRY_ID == 1){
$country_id_n = GetNameFromID("fi_country",$row['country_id'],$NamePrint);
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_nationality'],$country_id_n);
$RowCount = RowCountForLight_New($RowCount);
}

if($row['countrylive_id'] and F_FULL_COUNTRY == 1){
$countrylive_id_n = GetNameFromID("fi_country",$row['countrylive_id'],$NamePrint);
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_country_live'],$countrylive_id_n);
$RowCount = RowCountForLight_New($RowCount);
}

if($row['city_id'] And F_CITY_ID == 1){
$city_id_n = GetNameFromID("fi_city",$row['city_id'],$NamePrint);
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_city'],$city_id_n );
$RowCount = RowCountForLight_New($RowCount);
}

if($row['kind_id'] And F_KIND_ID == 1 ){
$kind_id_n = GetNameFromID("config_data",$row['kind_id'],$NamePrint);
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_kind'],$kind_id_n);
}

if($row['social_id'] And F_SOCIAL_ID == 1){
$social_id_n = GetNameFromID("config_data",$row['social_id'],$NamePrint);
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_social_type'],$social_id_n);
}
if($row['jop_id'] And F_JOP_ID == 1 ){
$jop_id_n = GetNameFromID("config_data",$row['jop_id'],$NamePrint);
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_jop'],$jop_id_n);
$RowCount = RowCountForLight_New($RowCount);
}

if($row['id_no'] and F_ID_NO == 1){
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_national_id'],$row['id_no']);
$RowCount = RowCountForLight_New($RowCount);
}

if($row['birth_date']  and F_BIRTH_DATE == 1 ){
if($row['birth_date']){
$birth_date_n = ConvertDateToCalender_2($row['birth_date']);
}
PrintFildInformation("col-md-".$C_3,$AdminLangFile['customer_birth_date'],$birth_date_n);

$RowCount = RowCountForLight_New($RowCount);
}
  

###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@    Row 6   @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@#   

echo '<div style="clear: both!important;"></div>'; 
PrintFildInformation("col-md-".$C_12,$AdminLangFile['customer_notes'],$row['notes']);
echo '<div style="clear: both!important;"></div>';
}

#################################################################################################################################
###################################################   PrintCustInfoCol
#################################################################################################################################
function PrintCustInfoCol_Sales ($row_cust,$CustNum=""){
    global $AdminLangFile ;
    global $AdminPathHome ;
    global $db ;
    global $USER_PERMATION_Dell ;
    global $view ;
    Print_PagePanel_OPen("",$AdminLangFile['customer_profile_info']." ".$CustNum,"0","0","Parent_Infox");
    PrintCustomerProfile($row_cust,$C_6="6",$C_3="3",$C_12="12");
    if($row_cust['sub_count'] > '0'){
      //  require_once '../Customer_Inc/Profile/Inc_Profile_List_More.php';
    } 
    if($view == "HHHHH"){
    echo '<a data-toggle="modal" data-target="#Mody" class="btn btn-xs TdBut Butquick btn-primary">
    <i class="fa fa-upload "></i> ' .$AdminLangFile['customer_add_more_contact'].' </a>'; 
    }

    Print_PagePanel_Close();
}






	
?>