<?php
if(!defined('WEB_ROOT')) {	exit;}





 
#################################################################################################################################
###################################################  User_Check_Password_Expird  
#################################################################################################################################
function User_Check_Password_Expird(){
    global $RowUsreInfo ;
    global $AdminLangFile ;
    $Today =  strtotime('today 00:00:00');
    $DatePassFrom_DB = $RowUsreInfo['pass_date'];
    $End_Date = ( 86400 * intval(EXPIRED_PASS_DAYS) ) + intval($DatePassFrom_DB) ;
    if($RowUsreInfo['pass_expird'] == '1'){
        $Mass = $AdminLangFile['users_pass_exp_err_mass_1']." ".ConvertDateToCalender_2($End_Date)." ";
        $Mass .= $AdminLangFile['users_pass_exp_err_mass_2'];
        New_Print_Alert("3",$Mass);
    }elseif($RowUsreInfo['pass_expird'] == '2'){
        $Mass = $AdminLangFile['users_pass_exp_err_mass_3'];
        New_Print_Alert("4",$Mass);
    }
}

#################################################################################################################################
###################################################  Print_Change_Password_Form
#################################################################################################################################
function Print_Change_Password_Form(){
    global $AdminLangFile ;
    global $db ;
    Form_Open();
 //PassWord
    $MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
    $Err[] = NF_PrintInput("PassWord",$AdminLangFile['users_old_password'],"old_pass","","","req",$MoreS);
 
    $MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-minlength="2"' ,'Dir'=> "En_Lang");
    $Err[] = NF_PrintInput("PassWord",$AdminLangFile['users_new_password'],"new_pass","","","req",$MoreS);
    $MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required   data-parsley-equalto="#new_pass"' ,'Dir'=> "En_Lang");
    $Err[] = NF_PrintInput("PassWord",$AdminLangFile['users_confirm_your_new_password'],"confirm_pass","","","req",$MoreS);
   
    Form_Close("2");
    if(isset($_POST['B1'])){
        Vall($Err,"ChangeUserPassword",$db,"1","1");
    }
}


#################################################################################################################################
###################################################  ChangeUserPassword
#################################################################################################################################
function ChangeUserPassword($db){
    $ThIsIsTest = '0';$Err="";
    global $AdminLangFile ;
    global $RowUsreInfo ;
    if(isset($_SESSION["PassErr"])){
        $_SESSION["PassErr"] = $_SESSION["PassErr"]+1 ;
    }else{
        $_SESSION["PassErr"] = "0" ;
    }
    $user_idid = $RowUsreInfo['user_id'];
    
    $OldPass_Form = md5($_POST['old_pass']);
    $OldPass_DB = $RowUsreInfo['user_password'];
    $NewPassTest = md5($_POST['new_pass']);
    
    if(($OldPass_Form == $OldPass_DB ) and ( $NewPassTest != $OldPass_DB )){
     
        if($_POST['new_pass'] != $_POST['confirm_pass']){
            SendJavaErrMass("This value should be the same.");
            $Err = "1";
        }
        if(preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['new_pass'] ) === 0){
            SendJavaErrMass($AdminLangFile['users_new_password_err']);
            $Err = "1";
        }
        if($Err != '1'){
            $server_data = array (
                'user_password'=>  md5($_POST['new_pass']),
                'pass_date'=>  TimeForToday(),
                'pass_expird'=> "0",
            );
            if($ThIsIsTest == '1'){
                print_r3($server_data);
            }else{
                $db->AutoExecute("tbl_user",$server_data,AUTO_UPDATE,"user_id = $user_idid");
                doLogout();
            }
        }
       
    }else{
        SendJavaErrMass($AdminLangFile['users_password_does_not_match']);
        if($_SESSION["PassErr"] >= '3'){
            unsetsss('PassErr');
            doLogout();
        }
    }
}

#################################################################################################################################
###################################################  GetDefaultUserProfile
################################################################################################################################# 
function GetDefaultUserProfile($RowOfohtto){
    if($RowOfohtto != ""){
        $PhotoUrl = USERPROFILE_IMAGE_DIR_V.$RowOfohtto ;
    }else{
        $PhotoUrl = D_USER_ADMIN_IMG ;
    }
    return $PhotoUrl ;
}

#################################################################################################################################
###################################################  EditUserProfile
################################################################################################################################# 
function EditUserProfile($db){
    global $AdminLangFile;
    $user_id = $_POST['user_id'];
    $photoUp['photoErr'] = ''; $Err_email = '' ; $Err_mobile = "";
    $ThisIsTest = "0" ;

    $Email = Clean_Mypost($_POST['email']);
    $Mobile = Clean_Mypost($_POST['mobile']);
    
    $already = $db->H_Total_Count("SELECT * FROM tbl_user WHERE email = '$Email' and user_id != $user_id");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_email_err']);
        $Err_email = '1';
    }
    $already = $db->H_Total_Count("SELECT * FROM tbl_user WHERE mobile = '$Mobile' and user_id != $user_id");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['users_mobile_err']);
        $Err_mobile = '1';
    }
    
    if($Err_email != '1' and $Err_mobile != '1' ){
        
       

    if(USER_PROFILE_UPDATE_IMG == '1'){
        $MoreConfig = array("PhotoID"=> $user_id);
        $photoUp = EditUserPhoto("tbl_user",$MoreConfig);
    }else{
        $photoUp['photo'] = $_POST['old_photo'] ;
    }

    $server_data = array (
        'email'=> $Email ,    
        'mobile'=> $Mobile ,
        'photo'=> $photoUp['photo'] ,
    );

    if($photoUp['photoErr'] != '1' ){
        if($ThisIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("tbl_user",$server_data,AUTO_UPDATE,"user_id = $user_id");
            Redirect_Page_2("index.php?view=UserProfile");
        }
    }
    
  }   
}

#################################################################################################################################
###################################################  EditUserPhoto
#################################################################################################################################
function EditUserPhoto($GroupTabel,$ArrConfig=""){
    global $db ;
    $photoUp['photoErr'] ="";
    if(isset($ArrConfig['FileName'])){
        $FileName = $ArrConfig['FileName'] ;
    }else{
        $FileName = "photo";
    }

    if(isset($ArrConfig['PhotoID'])){
        $id = $ArrConfig['PhotoID'];
    }else{
        $id = $_GET['id'];
    }

    if(isset($ArrConfig['Path'])){
        $Path = $ArrConfig['Path'];
    }else{
        $Path = F_PATH ;
    }

    if(isset($ArrConfig['PathDelete'])){
        $PathDelete = $ArrConfig['PathDelete'];
    }else{
        $PathDelete = F_PATH_D ;
    }

    if(isset($ArrConfig['Filed_Photo'])){
        $Filed_Photo = $ArrConfig['Filed_Photo'];
    }else{
        $Filed_Photo = "photo";
    }

    $FileC = array ('width'=> "250",
        'height'=> "250",
        'color'=> "#FFFFFF",
        'size'=> "400",
        'M_width'=> "1024",
        'M_height'=> "1024",
        'resize_P'=> '6',
        'mark'=> '0',
        'png_state'=> '0',
        'file_rename'=> '0',
    );

    $row = $db->H_SelectOneRow("select * from $GroupTabel where user_id = '$id' ");

    if ($_FILES[$FileName]['size'] != '0') {
        $photoUp =   UploadOnePhoto($FileName,$Path,$FileC);
        $photo = CURRENT_PATH .  $photoUp['photo'] ;

        if ($photoUp['photoErr'] != '1'  ) {
            Image_Dell_User("1",$id,$PathDelete,$GroupTabel,$Filed_Photo);
        }
    } else {
        $photo = $row[$Filed_Photo];
    }

    $data = array(
        'photoErr' => $photoUp['photoErr'],
        'photo' => $photo ,
    );

    return $data ;

}

#################################################################################################################################
###################################################   Image_Dell_User
#################################################################################################################################
function Image_Dell_User($state,$id,$Path,$Tabel,$photo,$photo2 = "") {
    global $db ;
    if($state == '1') {
        $sql = "SELECT * FROM $Tabel WHERE user_id = '$id'";
        $row = $db->H_SelectOneRow($sql);
        $deleted = @unlink($Path.$row[$photo]);
        return $deleted;
    }
}
function Image_Dell_User_But($id){
    global $db;
    
    Image_Dell_User("1",$id,F_PATH_D,"tbl_user","photo","");
    $server_data = array ('photo'=> "");
    $add_server = $db->AutoExecute("tbl_user",$server_data,AUTO_UPDATE,"user_id = $id");
    Redirect_Page_2(LASTREFFPAGE);
    
}
    

    
#################################################################################################################################
###################################################    UpdateSeenState
#################################################################################################################################
function PrintUserOnline($Row){
    $TimeAgo = Time_Ago_2(time(),$Row['last_seen']);
    $PhotoUrl = GetDefaultUserProfile($Row['photo']);
    echo '<div class="col-sm-2"><div class="panel widget"><div class="panel-body bg-success text-center">';
    echo '<p><img src="'.$PhotoUrl.'" alt="" class="img-thumbnail img-circle img-responsive thumb64x UserOnlineImg"></p>';
    echo '<p class="onlineusername"><strong>'.$Row['name'].'</strong></p>';
    echo '<p>Last Seen : '.$TimeAgo.'</p>';
    //echo  NF_PrintBut_TD('1',"ddddddddddd","Cat_Dell&id=".$Row['user_id'],"btn-danger","fa-window-close");
    echo '</div></div>';
    echo '</div>';
}

#################################################################################################################################
###################################################    UpdateSeenState
#################################################################################################################################
function UpdateSeenState(){
    global $db ;
    $Sql = "SELECT * FROM tbl_user where seen_state = '1' and user_id != '1' ";
    $already = $db->H_Total_Count($Sql);
    if($already > '0'){
        $Name = $db->SelArr($Sql);
        for($i = 0; $i < count($Name); $i++) {
            $user_id = $Name[$i]['user_id'];
            $LastSeen = time() - $Name[$i]['last_seen'];
            if($LastSeen > GetTimeOutStamp(USER_TIME_OUT) ){
                $server_data = array ('seen_state'=> "0" );
                $add_server = $db->AutoExecute("tbl_user",$server_data,AUTO_UPDATE,"user_id = $user_id");
            }
        }
    }

}

#################################################################################################################################
###################################################    Google_Auth_Message
#################################################################################################################################
function Google_Auth_Message(){
    global $RowUsreInfo ;
    global $AdminLangFile ;
    $ga = new GoogleAuthenticator();
    $qrCodeUrl = $ga->getQRCodeGoogleUrl(GOOGLE_AUTH_SITE_NAME,$RowUsreInfo['google_code'],GOOGLE_AUTH_SITE_NAME);
    $Mass  = $AdminLangFile['users_auth_m_01']." ".$RowUsreInfo['name'].BR;
    $Mass .= nl2br($AdminLangFile['users_auth_m_02']).BR;
    $Mass .= $AdminLangFile['users_auth_m_03']." ".$RowUsreInfo['google_code'].BR;

    echo '<div class="row PanelMin GAuth_Message"><div class="col-md-12">';
    echo '<div class="col-md-3">';
    echo "<img src=".$qrCodeUrl." />";
    echo '</div>';
    echo '<div class="col-md-9">';
    New_Print_Alert("4",$Mass);
    echo '</div>';
    echo '</div></div>';
}

?>