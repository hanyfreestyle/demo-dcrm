<?php
if(!defined('WEB_ROOT')) {	exit;}



#################################################################################################################################
###################################################    UserAdd
################################################################################################################################# 
function UserAdd($db) {
    global $AdminLangFile ;
    global $GoogleCode ;
    $Google_Code = $GoogleCode->createSecret();
    $Err_user = ""; $Err_email =""; $Err_name =""; $Err_mobile  ="";
    $ThIsIsTest = '0';

    $user_name = Clean_Mypost($_POST['user_name']);
    $Name = Clean_Mypost($_POST['name']);
    $Email = Clean_Mypost($_POST['email']);
    $Mobile = Clean_Mypost($_POST['mobile']);
    $Group_state  = GetNameFromID("user_group",$_POST['group_id'],"state");
    $already = $db->H_Total_Count("SELECT * FROM tbl_user WHERE user_name = '$user_name' ");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_username_err']);
        $Err_user = '1';
    }
    $already = $db->H_Total_Count("SELECT * FROM tbl_user WHERE name = '$Name' ");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_name_err']);
        $Err_name = '1';
    }
    $already = $db->H_Total_Count("SELECT * FROM tbl_user WHERE email = '$Email' ");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_email_err']);
        $Err_email = '1';
    }
    $already = $db->H_Total_Count("SELECT * FROM tbl_user WHERE mobile = '$Mobile' ");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_mobile_err']);
        $Err_mobile = '1';
    }
    
    $server_data = array(
        'user_name' => $user_name,
        'name' => $Name ,
        'email' => $Email ,
        'mobile' => $Mobile ,
        'group_id' => $_POST['group_id'],
        'group_state' => $Group_state ,
        'state' => $_POST['state'],
        'user_password' => md5($_POST['new_user_pass']),
        'google_code'=> $Google_Code
    );

    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Err_user != '1' and $Err_name != '1' and $Err_email != '1' and $Err_mobile != '1' ){
            $db->AutoExecute("tbl_user",$server_data,AUTO_INSERT);
            CountTUserForGroup();
            Redirect_Page_2("index.php?view=List");
        }
    }
}


#################################################################################################################################
###################################################    UserEdit
################################################################################################################################# 
function UserEdit($db) {
    global $AdminLangFile ;
    global $db;
    $ThIsIsTest = '0';
    $photoUp['photo'] = "";
    $id = $_GET['id'];
    $Err_user = ""; $Err_email =""; $Err_name =""; $Err_mobile  ="";
    
    

    $user_name = Clean_Mypost($_POST['user_name']);
    $Name = Clean_Mypost($_POST['name']);
    $Email = Clean_Mypost($_POST['email']);
    $Mobile = Clean_Mypost($_POST['mobile']);
    $Group_state  = GetNameFromID("user_group",$_POST['group_id'],"state");
    $already = $db->H_Total_Count("SELECT * FROM tbl_user WHERE user_name = '$user_name' and user_id != $id");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_username_err']);
        $Err_user = '1';
    }
    $already = $db->H_Total_Count("SELECT * FROM tbl_user WHERE name = '$Name' and user_id != $id");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_name_err']);
        $Err_name = '1';
    }
    $already = $db->H_Total_Count("SELECT * FROM tbl_user WHERE email = '$Email' and user_id != $id");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_email_err']);
        $Err_email = '1';
    }
    $already = $db->H_Total_Count("SELECT * FROM tbl_user WHERE mobile = '$Mobile' and user_id != $id");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_mobile_err']);
        $Err_mobile = '1';
    }
    if(isset($_POST['user_follow']) and count($_POST['user_follow']) > '0'){
        $FollowUser = serialize($_POST['user_follow']);
    }else{
        $FollowUser = '0' ;
    }
    if($Err_user != '1' and $Err_name != '1' and $Err_email != '1' and $Err_mobile != '1' ){
        
   if(USER_PROFILE_UPDATE_IMG == '1'){
        $MoreConfig = array("PhotoID"=> $id);
        $photoUp = EditUserPhoto("tbl_user",$MoreConfig);
    }else{
        $photoUp['photo'] = $_POST['old_photo'] ;
    }

          $server_data = array(
                'user_name' => $user_name,
                'name' => $Name ,
                'email' => $Email ,
                'mobile' => $Mobile ,
                'group_id' => $_POST['group_id'],
                'group_state' => $Group_state ,
                'state' => $_POST['state'],
                'sales' => $_POST['sales'],
                'custserv' => PostIsset("custserv"),
                'user_follow' => $FollowUser ,
                'telegram_code' => $_POST['telegram_code'],
                'photo'=> $photoUp['photo'] ,
            );
        if(trim($_POST['new_user_pass'])!= ''){
             $NewPass = array(
                'user_password' => md5($_POST['new_user_pass']),
             );  
           $server_data = $server_data+$NewPass ;
        }    
            
        if($photoUp['photoErr'] != '1' ){
        if($ThIsIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("tbl_user",$server_data,AUTO_UPDATE,"user_id = $id");
            CountTUserForGroup();
            Redirect_Page_2(LASTREFFPAGE);
        }
        }
    }
}



#################################################################################################################################
###################################################    CountTUserForGroup
################################################################################################################################# 
function CountTUserForGroup(){
    global $db ;
    $Name = $db->SelArr("SELECT * FROM user_group ");
    for($i = 0; $i < count($Name); $i++) {
        $TheCat_id  = $Name[$i]['id'];
        $count = $db->H_Total_Count("SELECT * FROM tbl_user WHERE group_id = '$TheCat_id'");
        $server_data = array ('count'=> $count );
        $db->AutoExecute("user_group",$server_data,AUTO_UPDATE,"id = $TheCat_id");
    };
}



#################################################################################################################################
###################################################   CatAdd
################################################################################################################################# 
function CatAdd($db){
    $Err = "";
    global $AdminLangFile ;
    $Name = Clean_Mypost($_POST['name']) ;
    $server_data = array ('id'=> NULL ,
        'name'=> $Name  ,
    );
    $already = $db->H_Total_Count("SELECT * FROM user_group where name = '$Name' ");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_cat_add_err']);
        $Err = '1';
    }
    if($Err != '1'){
        $db->AutoExecute("user_group",$server_data,AUTO_INSERT);
        Redirect_Page_2("index.php?view=Cat_List");
    }
}

#################################################################################################################################
###################################################    CatEdit
################################################################################################################################# 
function CatEdit($db){
    $Err = "";
    global $AdminLangFile ;
    $id = $_GET['id'];
    $Name = Clean_Mypost($_POST['name']) ;
    $server_data = array (
        'name'=> $Name  ,
        'state'=> Clean_Mypost($_POST['state'])   ,
    );
    $already = $db->H_Total_Count("SELECT * FROM user_group where name = '$Name' and id != $id ");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_cat_add_err']);
        $Err = '1';
    }
    if($Err != '1'){
        $db->AutoExecute("user_group",$server_data,AUTO_UPDATE,"id = $id");
        UpdateUserStateFromcat($id,$_POST['state']);
        Redirect_Page_2("index.php?view=Cat_List");
    }
}
#################################################################################################################################
###################################################    UpdateUserStateFromcat
################################################################################################################################# 
function UpdateUserStateFromcat($Group_id,$Group_State){
    global $db ;
    $SQL = "SELECT * FROM tbl_user where group_id = '$Group_id' " ;
    $already = $db->H_Total_Count($SQL);
    if($already > '0'){
        $Name = $db->SelArr($SQL);
        for($i = 0; $i < count($Name); $i++) {
            $TheCat_id  = $Name[$i]['user_id'];
            $server_data = array ('group_state'=> $Group_State );
            $db->AutoExecute("tbl_user",$server_data,AUTO_UPDATE,"user_id = $TheCat_id");
        };
    }
}
#################################################################################################################################
###################################################    EditPermation
################################################################################################################################# 
function EditPermation($db){
    $Err= "";
    $id = $_GET['id'];
    $server_data = array (
        'web_manage'=> $_POST['web_manage']  ,
    );
    if($Err != '1'){
        $db->AutoExecute("user_permission",$server_data,AUTO_UPDATE,"group_id = $id");
        Redirect_Page_2(LASTREFFPAGE);
    }
}


#################################################################################################################################
###################################################  PrintPerMtionChek
################################################################################################################################# 
function PrintPerMtionChek($Name,$MainName,$row){
    global $AdminGroup ;
    if(isset($AdminGroup[$MainName]) and  $AdminGroup[$MainName] == '1'){
        if($row[$MainName] == '1'){$ViewState = 'checked=""';}else{$ViewState = '';}
        if(isset($row[$MainName."_add"]) and  $row[$MainName."_add"] == '1'){$AddState = 'checked=""';}else{$AddState = '';}
        if(isset($row[$MainName."_edit"]) and $row[$MainName."_edit"] == '1'){$EditState = 'checked=""';}else{$EditState = '';}
        if(isset($row[$MainName."_dell"]) and $row[$MainName."_dell"] == '1'){$DellState = 'checked=""';}else{$DellState = '';}
        echo '<tr>';
        echo '<td>'.$Name.'</td>';
        echo '<td align="center">';
        echo '<label class="switch">';
        echo '<input class="UpdateFildeState" fstate="'.$MainName.'" type="checkbox" id="'.$row['id'].'" ftype="bedrooms" '.$ViewState.' >';
        echo '<span></span>';
        echo '</label>';
        echo '</td>';
        if(isset($row[$MainName."_add"])){
            echo '<td align="center">';
            echo '<label class="switch">';
            echo '<input class="UpdateFildeState" fstate="'.$MainName."_add".'" type="checkbox" id="'.$row['id'].'" ftype="bedrooms" '.$AddState.' >';
            echo '<span></span>';
            echo '</label>';
            echo '</td>';
        }else{
            echo '<td align="center"></td>';
        }
        if(isset($row[$MainName."_edit"])){
            echo '<td align="center">';
            echo '<label class="switch">';
            echo '<input class="UpdateFildeState" fstate="'.$MainName."_edit".'" type="checkbox" id="'.$row['id'].'" ftype="bedrooms" '.$EditState.' >';
            echo '<span></span>';
            echo '</label>';
            echo '</td>';
        }else{
            echo '<td align="center"></td>';
        }
        if(isset($row[$MainName."_dell"])){
            echo '<td align="center">';
            echo '<label class="switch">';
            echo '<input class="UpdateFildeState" fstate="'.$MainName."_dell".'" type="checkbox" id="'.$row['id'].'" ftype="bedrooms" '.$DellState.' >';
            echo '<span></span>';
            echo '</label>';
            echo '</td>';
        }else{
            echo '<td align="center"></td>';
        }
        echo '</tr>';
    }
}

#################################################################################################################################
###################################################    GroupStatePrint
################################################################################################################################# 
function GroupStatePrint($State){
    if($State == '1'){
        $Icon = '<img src="../include/img/ico_active_16.png"  />';
    }else{
        $Icon = '<img src="../include/img/ico_inactive_16.png"  />';
    }
    return $Icon ;
}
#################################################################################################################################
###################################################    RterunOrder_ForUser
#################################################################################################################################
function RterunOrder_ForUser($state) {
   switch($state) {
     case "1":
       $order = '  ORDER BY user_id DESC ';
       break;
     case "2":
       $order = ' ORDER BY user_id ASC ';
       break;
     default:
       $order = ' ORDER BY user_id DESC ';
   }
   return $order;
}
#################################################################################################################################
###################################################    Rterun_ActiveMode
#################################################################################################################################
function Rterun_ActiveMode_For_User($state) {
    switch($state) {
        case "0":
            $order = "";
            break;
        case "1":
            $order = " and state = '1' ";
            break;
        default:
            $order = '';
    }
    return $order;
}

#################################################################################################################################
###################################################   Get_SqlCat_ID
#################################################################################################################################
function Get_Filter_If_Isset($GetName,$FildeName,$ArrCome=array()){
     
    if(isset($_GET[$GetName])){
        $GetVal = Clean_Mypost($_GET[$GetName]);
        $SqlCat_ID = " and $FildeName = '$GetVal' "    ;
    }else{
        $SqlCat_ID = " "    ;
    }
    return $SqlCat_ID ;
}
#################################################################################################################################
###################################################    ActAllUnit_NewUser
################################################################################################################################# 
function ActAllUnit_NewUser($Tabel){
    global $db;
    if(isset($_POST['id_id'])) {
        $EmailCount = count($_POST['id_id']);
        for ($i = 0; $i < $EmailCount; $i++) {
            $id = $_POST['id_id'][$i];
            $server_data = array('state' => "1");
            $db->AutoExecute($Tabel, $server_data, AUTO_UPDATE, "user_id = $id");
        }
    }
}

#################################################################################################################################
###################################################    UnActAllUnit_NewUser
################################################################################################################################# 
function UnActAllUnit_NewUser($Tabel){
    global $db;
    if(isset($_POST['id_id'])){
        $EmailCount = count($_POST['id_id']);
        for ($i = 0; $i < $EmailCount; $i++){
            $id =  $_POST['id_id'][$i]  ;
            $server_data = array ('state'=> "0");
            $db->AutoExecute($Tabel,$server_data,AUTO_UPDATE,"user_id = $id");
        }
    }
}

#################################################################################################################################
###################################################    Change_Authentication_Code
################################################################################################################################# 
function Change_Authentication_Code($Tabel){
    global $db;
    global $GoogleCode ;
    $ThIsIsTest = '0';
    if(isset($_POST['id_id'])){
        $EmailCount = count($_POST['id_id']);
        for ($i = 0; $i < $EmailCount; $i++){
            $id =  $_POST['id_id'][$i]  ;
            $Code = $GoogleCode->createSecret();
            $server_data = array ('google_code'=> $Code);
            if($ThIsIsTest == '1'){
                print_r3($server_data);
            }else{
             $db->AutoExecute($Tabel,$server_data,AUTO_UPDATE,"user_id = $id");   
            }
        }
    }
}




#################################################################################################################################
###################################################    UserFollowSel
################################################################################################################################# 
function UserFollowSel($StateType,$Col,$Col_2,$Label,$Name,$Val,$Req,$Req_V,$ch){
    global $db ;
    if($Req == 'req'){
        $PrintReq =   'required="" data-parsley-mincheck="'.$Req_V.'"';
    }else{
        $PrintReq =   '';
    }
    switch ($StateType) {
        case 'SQL':
            echo '<div class="'.$Col.' col-sm-12 col-xs-12 form-group DirRight">';
            echo '<label class="control-label Checkbox_label " >'.$Label.'</label>';
            if($ch != '0' and  $ch != '' ){
                $Amenities_Arr = unserialize($ch);
            }else{
                $Amenities_Arr = array();
            }
            $query  = $Val ;
            $User_Name = $db->SelArr($query);
            for($x = 0; $x < count($User_Name); $x++) {
                if($ch != '0' and count($Amenities_Arr) > '0'){
                    if (in_array($User_Name[$x]['user_id'], $Amenities_Arr)) {
                        $checkedState = "checked";
                    }else{
                        $checkedState = "";
                    }
                }else{
                    $checkedState = "";
                }
                echo '<div class="'.$Col_2.' Checkbox_Cont DirRight">';
                echo '<label> ';
                echo '<input class="input_checkbox" type="checkbox" id="'.$Name.$User_Name[$x]['user_id'].'" name="'.$Name.'[]"  '.$PrintReq.' value="'.$User_Name[$x]['user_id'].'" '.$checkedState.'>';
                echo  $User_Name[$x]['name'].' </label>';
                echo '</div>';
            }
            echo '</div>';
            break;
            
     case 'UserWithGroup':
            echo '<div class="'.$Col.' col-sm-12 col-xs-12 form-group DirRight">';
            echo '<label class="control-label Checkbox_label " >'.$Label.'</label>';
            if($ch != '0' and  $ch != '' ){
                $Amenities_Arr = unserialize($ch);
            }else{
                $Amenities_Arr = array();
            }
            
            $GroupList = $db->SelArr("SELECT * FROM user_group where state = '1' and  count != '0' and id != '1' ");
            for($xx = 0; $xx < count($GroupList); $xx++) {
               $ThisGrouPId =  $GroupList[$xx]['id'];
                
            echo '<div class="UserGroupName">'.$GroupList[$xx]['name']."</div>";    
                   
            $query  =  "SELECT * FROM tbl_user where user_id != '1' and group_id = '$ThisGrouPId' and state = '1' ";
            $User_Name = $db->SelArr($query);
            for($x = 0; $x < count($User_Name); $x++) {
                if($ch != '0' and count($Amenities_Arr) > '0'){
                    if (in_array($User_Name[$x]['user_id'], $Amenities_Arr)) {
                        $checkedState = "checked";
                    }else{
                        $checkedState = "";
                    }
                }else{
                    $checkedState = "";
                }
                echo '<div class="'.$Col_2.' Checkbox_Cont DirRight">';
                echo '<label> ';
                echo '<input class="input_checkbox" type="checkbox" id="'.$Name.$User_Name[$x]['user_id'].'" name="'.$Name.'[]"  '.$PrintReq.' value="'.$User_Name[$x]['user_id'].'" '.$checkedState.'>';
                echo  $User_Name[$x]['name'].' </label>';
                echo '</div>';
            }
            echo '<div style="clear: both!important;"></div>';
             } 
            
            echo '</div>';
            break;
                        
        default:
            echo "Error";
    }
}




#################################################################################################################################
###################################################    UpdatePassState
#################################################################################################################################
function UpdatePassState(){
    global $db ;
    global $pfw_db ;
    global $con ;
    if(EXPIRED_PASS_STATE == '1'){
        $ThsssSQL = "select * from tbl_user where user_id != '1' and pass_expird != '2'  " ;
        $already = $db->H_Total_Count($ThsssSQL);
        if($already > '0'){
            $Name = $db->SelArr($ThsssSQL);
            for($i = 0; $i < count($Name); $i++) {
                $ThisUserId = $Name[$i]['user_id'];
                $Today =  strtotime('today 00:00:00');
                $DatePassFrom_DB = $Name[$i]['pass_date'];
                $End_Date = ( 86400 * EXPIRED_PASS_DAYS ) + $DatePassFrom_DB ;
                $Alert_Date = ($End_Date - (86400 * 3 )) ;
      
                if( $Today >= $End_Date ){
                    $sql = "UPDATE tbl_user SET pass_expird  = '2' WHERE user_id = '$ThisUserId'";
                    $result = mysqli_query($con,$sql) or die('Cannot add category'.mysql_error());
                }elseif($Today >=  $Alert_Date){
                    $sql = "UPDATE tbl_user SET pass_expird  = '1' WHERE user_id = '$ThisUserId'";
                    $result = mysqli_query($con,$sql) or die('Cannot add category'.mysql_error());
                }else{
                    $sql = "UPDATE tbl_user SET pass_expird  = '0' WHERE user_id = '$ThisUserId'";
                    $result = mysqli_query($con,$sql) or die('Cannot add category'.mysql_error());
                }
            }
        }
    }
}

#################################################################################################################################
###################################################    PrintUserPassTime
################################################################################################################################# 
function PrintUserPassTime($Row){
    // echo $Row['pass_expird'];
    global $ALang ;
    $Today =  strtotime('today 00:00:00');
    $DatePassFrom_DB = $Row['pass_date'];
    $End_Date = ( 86400 * EXPIRED_PASS_DAYS ) + $DatePassFrom_DB ;

    if($Row['pass_expird'] == '0'){
        $PriintTimeAgot_L = $End_Date   - $Today ;
        $PriintTimeAgot_L = $PriintTimeAgot_L / 86400 ;
        $PriintTimeAgot = New_But_Alert("1",$PriintTimeAgot_L." ".$ALang['users_expired_day']);
    }elseif($Row['pass_expird'] == '1'){
        $PriintTimeAgot_L = $End_Date   - $Today ;
        $PriintTimeAgot_L = $PriintTimeAgot_L / 86400 ;
        $PriintTimeAgot = New_But_Alert("3",$PriintTimeAgot_L." ".$ALang['users_expired_day']);
    }elseif($Row['pass_expird'] == '2'){
        $PriintTimeAgot = New_But_Alert("4",$ALang['users_password_expired']);
    }
    return $PriintTimeAgot ;
}

#################################################################################################################################
###################################################    PrintUserTimeAgo
################################################################################################################################# 
function PrintUserTimeAgo($Time){
    $PP = time() - $Time ;
    $Day3 = 86400 * 4 ;
    if($PP <= 86400){
        $Alert_N = "1";
    }elseif($PP <= $Day3 ){
        $Alert_N = "3";
    }else{
        $Alert_N = "4";
    }

    $PriintTimeAgot_L = Time_Ago_2(time(),$Time);
    $PriintTimeAgot = New_But_Alert($Alert_N,$PriintTimeAgot_L);
    return $PriintTimeAgot ;
}

#################################################################################################################################
###################################################   ForceChange
################################################################################################################################# 
function ForceChange($Tabel){
    global $db;
    if(isset($_POST['id_id'])){
        $EmailCount = count($_POST['id_id']);
        for ($i = 0; $i < $EmailCount; $i++){
            $id =  $_POST['id_id'][$i]  ;
            $server_data = array ('pass_expird'=> "2");
            $db->AutoExecute($Tabel,$server_data,AUTO_UPDATE,"user_id = $id");
        }
    }
}



/*
    #################################################################################################################################
    ###################################################    Print_UserFollow
    ################################################################################################################################# 
    function Print_UserFollow($Category_id,$Amenities_Id){
        $Cat_Id = "-".$Category_id."-" ;
        $MySQL = "SELECT * FROM tbl_user ";
        NF_PrintCheckbox("SQL","col-md-12","col-md-6",$AdminLangFile['properties_amenities'],"amenities_id",$MySQL,"reqx","3",$Amenities_Id);
    }
    #################################################################################################################################
    ###################################################    PrintUserPassTime
    ################################################################################################################################# 
    function GroupStatePrint_Time($State){
        if($State == '0' or $State == '1'){
            $Icon = '<img src="../include/img/ico_active_16.png"  />';
        }else{
           $Icon =  '<img src="../include/img/ico_inactive_16.png"  />';
        }
        return $Icon ;
    }
*/

?>