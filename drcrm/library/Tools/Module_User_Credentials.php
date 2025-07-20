<?php
#################################################################################################################################
###################################################   Credentials_For_Sales
#################################################################################################################################
function Credentials_For_Sales($Row,$MyArr=array()){
    global $AdminConfig ;
    global $RowUsreInfo  ;
    $Credentials_Add = "0";
    $Credentials_View = "0";

    if($AdminConfig['suberteamleader'] == '1'){
        $Credentials_Add = "1"; $Credentials_View = "1";
    }elseif($Row['user_id'] == $RowUsreInfo['user_id']){
        $Credentials_Add = "1"; $Credentials_View = "1";
    }elseif($AdminConfig['teamleader']== '1' and $RowUsreInfo['team_leader'] == '1'){
        $ThisAccountFollow = unserialize($RowUsreInfo['user_follow']);
        if (in_array($Row['user_id'], $ThisAccountFollow)) {
           $Credentials_Add = "1"; $Credentials_View = "1";
        }
    }
    return   $Credentials  = array('View'=> $Credentials_View ,'Add'=> $Credentials_Add );
}

#################################################################################################################################
###################################################    Credentials_For_CustService
#################################################################################################################################
function Credentials_For_CustService($Row,$MyArr=array()){
    global $AdminConfig ;
    global $RowUsreInfo  ;
    $Credentials_Add = "0";
    $Credentials_View = "0";

    if($AdminConfig['subercustserv'] == '1'){
        $Credentials_Add = "1"; $Credentials_View = "1";
    }elseif($Row['user_id'] == $RowUsreInfo['user_id']){
        $Credentials_Add = "1"; $Credentials_View = "1";
    }elseif($AdminConfig['custservleader']== '1' and $RowUsreInfo['custserv_leader'] == '1' or ($RowUsreInfo['custserv'] == '1'  and $RowUsreInfo['sales'] != '1')){
        $ThisAccountFollow = unserialize($RowUsreInfo['user_follow']);
        if (in_array($Row['user_id'], $ThisAccountFollow)) {
            $Credentials_Add = "1"; $Credentials_View = "1";
        }
    }
    return   $Credentials  = array('View'=> $Credentials_View ,'Add'=> $Credentials_Add );
}

 
#################################################################################################################################
###################################################    Credentials_For_CustService_Ticket
#################################################################################################################################
function Credentials_For_CustService_Ticket($Row){
    global $AdminConfig ;
    global $RowUsreInfo  ;
    $Credentials_Add = "0";
    $Credentials_View = "0";

    if($AdminConfig['subercustserv'] == '1'){
        $Credentials_Add = "1"; $Credentials_View = "1";
    }elseif($Row['user_id'] == $RowUsreInfo['user_id']){
        $Credentials_Add = "1"; $Credentials_View = "1";
    }elseif($AdminConfig['custservleader']== '1' and $RowUsreInfo['custserv_leader'] == '1'){
        $ThisAccountFollow = unserialize($RowUsreInfo['user_follow']);
        if (in_array($Row['user_id'], $ThisAccountFollow)) {
            $Credentials_View = "1" ; $Credentials_Add = "1";
        }
    }
    return   $Credentials  = array('View'=> $Credentials_View ,'Add'=> $Credentials_Add );
}



#################################################################################################################################
################################################### ListBox_Sales_Emp_Master
#################################################################################################################################
function ListBox_Master_Sales_Employee($MyArr=array()){
    global $ALang ;
    $Req = ArrIsset($MyArr,"req","req");
    $Label =ArrIsset($MyArr,"Label","on");
    $Active =ArrIsset($MyArr,"Active","1");
   
    $Arr = array("Label" => $Label,"Active" => $Active,'Order'=> "order by name desc" ,'OtherIdd' => 'user_id', "Filter_Filde"=> "sales" , "Filter_Vall"=> "1" );
    $Err[] = NF_PrintSelect_2018("Chosen",$ALang['leads_emp'],"col-md-3","user_id","tbl_user",$Req,"0",$Arr);
} 













#################################################################################################################################
###################################################    DateFiterForm_2018
#################################################################################################################################
function  DateFiterForm_2018($FilterDate=""){
    if($FilterDate == ""){
      $FilterDate = "date_add";  
    }
    $End_SQL_Line = " "  ;
    $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date(PostIsset('date_from'),$FilterDate,"From");
    $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date(PostIsset('date_to'),$FilterDate,"To");
    return $End_SQL_Line ;

}
#################################################################################################################################
###################################################   Filter_Employee_From_POST
#################################################################################################################################
function Filter_Employee_From_POST($Val){
    global $AdminConfig ;
    if(intval($Val) == '0'){
        if($AdminConfig['suberteamleader']== '1'){
            $UserPerm = "" ;
        }else{
            $UserPerm = Filter_Employee_By_Permission();
        }
    }else{

        $UserPerm = " and user_id =". intval($Val)  ;
    }
    return  $UserPerm ;
}
#################################################################################################################################
###################################################   Filter_Employee_By_Permission
#################################################################################################################################
function Filter_Employee_By_Permission(){
    global $AdminConfig ;
    global $RowUsreInfo  ;
    $ThisAccountFollow = array();
    if($AdminConfig['suberteamleader']== '1'){
        $UserPerm = "" ;
    }elseif($AdminConfig['teamleader']== '1' and $RowUsreInfo['team_leader'] == '1' ){

        if($RowUsreInfo['user_follow'] != '' and $RowUsreInfo['user_follow'] != '0'){
            $ThisAccountFollow = unserialize($RowUsreInfo['user_follow']);
            $UserPerm = GeThisAccountFollow_X($ThisAccountFollow);
        }else{
           $UserPerm = " and user_id = ". intval($RowUsreInfo['user_id'])  ;  
        }

    }else{
        $UserPerm = " and user_id = ". intval($RowUsreInfo['user_id'])  ;
    }
    return  $UserPerm ;
}
#################################################################################################################################
###################################################    GeThisAccountFollow_X
#################################################################################################################################
function GeThisAccountFollow_X($ThisAccountFollow){
    global $AdminConfig ;
    if(count($ThisAccountFollow) >= '1' ){
        $UserPer = " and ( ";
        for ($i = 0; $i < count($ThisAccountFollow); $i++) {
            if($i == '0'){
                $UserPer .= " user_id = ".$ThisAccountFollow[$i];
            }else{
                $UserPer .= " or user_id = ".$ThisAccountFollow[$i];
            }
        }
        $UserPer .= " )";
    }else{
        $UserPer = " and user_id = '0' ";
    }
    return  $UserPer ;
}
#################################################################################################################################
###################################################    Print_Alert_User
#################################################################################################################################
function Print_Alert_User($Name_Session,$ID_Session,$Button_Name,$MyArr=array()){
    global $ALang;
 
    if(isset($_POST[$Button_Name])){
        unset($_SESSION[$Name_Session]);
        unset($_SESSION[$ID_Session]);
        Redirect_Page_2(LASTREFFPAGE);
    }

    if(isset($_SESSION[$ID_Session]) and  intval($_SESSION[$ID_Session])!= '0'){
        $EmPName = GetNameFromID_User("tbl_user",$_SESSION[$ID_Session],"name");
        echo '<form action="#" method="post">';
        echo '<div class="alert alert-success alert-dismissable employee_results">';
        echo '<button type="submit" name="'.$Button_Name.'" class="close">×</button>';
        echo $ALang['leads_employee_results']." ".$EmPName;
        echo '</div>';
        echo '</form>';
    }
}

#################################################################################################################################
###################################################    
#################################################################################################################################
function Empl_ListBox_Filter(){
    global $AdminConfig ;
    global $RowUsreInfo ;
    if($AdminConfig['suberteamleader']=='1'){
    Sales_Group_List_For_Leads();
    }elseif($AdminConfig['teamleader']=='1'){
    Sales_Group_List_For_TeamLeader();
    }else{
    echo '<input type="hidden" name="emp_id" value="'.$RowUsreInfo['user_id'].'" />';
    }
}
#################################################################################################################################
###################################################   Sales_Group_List_For_Leads
#################################################################################################################################
function Sales_Group_List_For_Leads(){
    global $AdminLangFile;
    global $Employee_IDD ;
    $Arr = array("Label" => 'on',"Active" => '1','Order'=> "order by name desc" ,'OtherIdd' => 'user_id', "Filter_Filde"=> "sales" , "Filter_Vall"=> "1" );
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","emp_id","tbl_user","optin",$Employee_IDD,$Arr);
}
#################################################################################################################################
###################################################   Sales_Group_List_For_TeamLeader
#################################################################################################################################
function Sales_Group_List_For_TeamLeader(){
    global $AdminLangFile;
    global $Employee_IDD ;
    $UserSQlFilter =  Filter_Employee_By_Permission() ;
    $SendSql = $MySql = "SELECT * FROM tbl_user where user_id != 0 $UserSQlFilter ";
    $Arr = array("Label" => 'on',"Active" => '1','Order'=> "order by name desc" ,'OtherIdd' => 'user_id', "SQL_Line_Send"=> $SendSql   );
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","emp_id","tbl_user","optin",$Employee_IDD,$Arr);
}




#################################################################################################################################
###################################################   ListBox_Sales_Employee_Filter 
#################################################################################################################################
function ListBox_Sales_Employee_Filter(){
    global $AdminConfig ;
    global $RowUsreInfo ;
    //// مبعات او خدمة عملاء كامل الصلاحيات
    if($AdminConfig['suberteamleader'] == '1' or $AdminConfig['subercustserv'] == '1' ){
    ListBox_Sales_Employee_For_Admin();
    }elseif( 
    ($AdminConfig['custservleader']== '1' and $RowUsreInfo['custserv_leader'] == '1') or
    ($AdminConfig['teamleader']== '1' and $RowUsreInfo['team_leader'] == '1') or
    ( $RowUsreInfo['custserv'] == '1'  and $RowUsreInfo['sales'] != '1' ) 
    ){
    ListBox_Sales_Employee_For_TeamLeader();
    }else{
    echo '<input type="hidden" name="emp_id" value="'.$RowUsreInfo['user_id'].'" />';    
    }
}
#################################################################################################################################
###################################################   ListBox_Sales_Employee_For_Admin
#################################################################################################################################
function ListBox_Sales_Employee_For_Admin(){
    global $AdminLangFile;
    global $Employee_IDD ;
    $Arr = array("Label" => 'on',"Active" => '1','Order'=> "order by name desc" ,'OtherIdd' => 'user_id', "Filter_Filde"=> "sales" , "Filter_Vall"=> "1" );
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","emp_id","tbl_user","optin",$Employee_IDD,$Arr);
}

#################################################################################################################################
###################################################   ListBox_Sales_Employee_For_TeamLeader
#################################################################################################################################
function ListBox_Sales_Employee_For_TeamLeader(){
    global $AdminLangFile;
    global $Employee_IDD ;

    $UserSQlFilter =  My_Sales_Employee_Filter_From_Permission() ;
    
    $SendSql = $MySql = "SELECT * FROM tbl_user where sales = '1' $UserSQlFilter ";
    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by name desc" ,'OtherIdd' => 'user_id', "SQL_Line_Send"=> $SendSql   );
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","emp_id","tbl_user","optin",$Employee_IDD,$Arr);
    
} 

#################################################################################################################################
###################################################   Filter_Employee_From_POST_CustService
#################################################################################################################################
function My_Sales_Employee_Filter_From_POST($Val){
    global $AdminConfig ;
    if(intval($Val) == '0'){
        if($AdminConfig['suberteamleader'] == '1' or $AdminConfig['subercustserv'] == '1' ){
            $UserPerm = "" ;
        }else{
            $UserPerm = My_Sales_Employee_Filter_From_Permission();
        }
    }else{

        $UserPerm = " and user_id =". intval($Val)  ;
    }
    return  $UserPerm ;
}

#################################################################################################################################
###################################################   Filter_Employee_By_Permission_CustService
#################################################################################################################################
function My_Sales_Employee_Filter_From_Permission(){
    global $AdminConfig ;
    global $RowUsreInfo  ;

    if($AdminConfig['suberteamleader'] == '1' or $AdminConfig['subercustserv'] == '1' ){
        $UserPerm = "" ;
    }elseif(
        ($AdminConfig['custservleader']== '1' and $RowUsreInfo['custserv_leader'] == '1') or
        ($AdminConfig['teamleader']== '1' and $RowUsreInfo['team_leader'] == '1') or
        ( $RowUsreInfo['custserv'] == '1'  and $RowUsreInfo['sales'] != '1' )
    ){

        if($RowUsreInfo['user_follow'] != '' and $RowUsreInfo['user_follow'] != '0'){
            $ThisAccountFollow = unserialize($RowUsreInfo['user_follow']);
        //    $ThisAccountFollow = KeepOnlySales($ThisAccountFollow);
             $UserPerm = My_Sales_Employee_GeThisAccountFollow($ThisAccountFollow);
        }else{
            $UserPerm = " and user_id = ". intval($RowUsreInfo['user_id'])  ;
        }

    }else{
        $UserPerm = " and user_id = ". intval($RowUsreInfo['user_id'])  ;
    }
    return  $UserPerm ;
}


#################################################################################################################################
###################################################    GeThisAccountFollow_CustService
#################################################################################################################################
function My_Sales_Employee_GeThisAccountFollow($ThisAccountFollow){
    if(count($ThisAccountFollow) >= '1' ){
        $UserPer = " and ( ";
        for ($i = 0; $i < count($ThisAccountFollow); $i++) {
            if($i == '0'){
                $UserPer .= " user_id = ".$ThisAccountFollow[$i];
            }else{
                $UserPer .= " or user_id = ".$ThisAccountFollow[$i];
            }
        }
        $UserPer .= " )";
    }else{
        $UserPer = " and user_id = '0' ";
    }
    return  $UserPer ;
}


#################################################################################################################################
################################################### Empl_ListBox_Master
#################################################################################################################################
function Empl_ListBox_Master($Req="1",$Titel="1",$Arr=""){
    global $AdminLangFile ;
    if($Req == '1'){
        $Req = "req";
    }else{
        $Req = "option";
    }
    if($Titel == "1"){
        $Label = "on";
    }else{
        $Label = "off";
    }
    $Arr = array("Label" => $Label,"Active" => '0','Order'=> "order by name desc" ,'OtherIdd' => 'user_id', "Filter_Filde"=> "sales" , "Filter_Vall"=> "1" );
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['leads_emp'],"col-md-3","user_id","tbl_user",$Req,"0",$Arr);
}







#################################################################################################################################
###################################################    Unset_Alert_User
#################################################################################################################################
/*
function Unset_Alert_User(){
    global $AdminLangFile;
    if(isset($_SESSION['UserPermission_ID']) and  intval($_SESSION['UserPermission_ID'])!= '0'){
        $EmPName = GetNameFromID_User("tbl_user",$_SESSION['UserPermission_ID'],"name");
        echo '<form action="#" method="post">';
        echo '<div class="alert alert-success alert-dismissable employee_results">';
        echo '<button type="submit" name="clear_user" class="close">×</button>';
        echo $AdminLangFile['leads_employee_results']." ".$EmPName;
        echo '</div>';
        echo '</form>';
    }
}
*/







	
?>