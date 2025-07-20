<?php
ob_start();
define('ADMIN_ONLY_LOGIN',"0");

function doLogin() {
    global $SiteName_SESSION;
    global $AdminUserKey_SESSION;
    global $pfw_db ;
    global $con ;

    $errorMessage = '';
    $userName = Clean_Mypost_Login($_POST['txtUserName']);
    $password = md5($_POST['txtPassword']);
    // first, make sure the username & password are not empty

    if($userName == '') {
        $errorMessage = 'Please Add Your User Name';
    } elseif($_POST['txtPassword'] == '') {
        $errorMessage = 'Please Add Your Password';
    } else {

        $ThisSQL = ("SELECT * FROM tbl_user WHERE user_name = '$userName' AND user_password ='$password' and state = '1' and group_state = '1'");

        if(ADMIN_ONLY_LOGIN == '1'){
            $ThisSQL = ("SELECT * FROM tbl_user WHERE user_name = '$userName' AND user_password ='$password' and state = '1' and group_state = '1' and user_id = '1' ");
        }else{
            $ThisSQL = ("SELECT * FROM tbl_user WHERE user_name = '$userName' AND user_password ='$password' and state = '1' and group_state = '1'");
        }

        $already = mysqli_num_rows(mysqli_query($con, $ThisSQL ));
        if($already == '1') {

            $_SESSION[$SiteName_SESSION] = md5($SiteName_SESSION);
            $sql = "SELECT * FROM tbl_user WHERE user_name = '$userName'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);

            if(GOOGLE_AUTH == '1'){
                $ga = new GoogleAuthenticator();
                $CheckResult = $ga->verifyCode($row['google_code'], intval($_POST['google_code']),GOOGLE_AUTH_TIME);// 2 = 2*30sec clock tolerance
                if($CheckResult != '1'){
                    doLogout();
                }
            }

            $ThisUserId = $row['user_id'] ;
            $_SESSION['adminusername'.$pfw_db] = $row['user_name'];
            $_SESSION['adminusergroup'.$pfw_db] = $row['group_id'];
            /*   Create The User Key */
            $_SESSION['adminSuserid'.$pfw_db] = $row['user_id'];
            $_SESSION['adminSusername'.$pfw_db] = $row['user_name'];
            $_SESSION['adminSuserpass'.$pfw_db] = $row['user_password'];
            $_SESSION['adminadminusergroup'.$pfw_db] = $row['group_id'];
            $_SESSION['GoogleCode'.$pfw_db] = $row['google_code'];

            $USERKEY =
                $_SESSION['adminSuserid'.$pfw_db].
                $_SESSION['adminSusername'.$pfw_db].
                $_SESSION['adminSuserpass'.$pfw_db].
                $_SESSION['adminusergroup'.$pfw_db].
                $_SESSION['GoogleCode'.$pfw_db];

            $_SESSION[$AdminUserKey_SESSION] = md5($USERKEY);

            $Last_login = time();
            $sql = "UPDATE tbl_user SET last_login = '$Last_login' , last_seen = '$Last_login' , seen_state = '1' WHERE user_id = '$ThisUserId' ";
            $result = mysqli_query($con,$sql) or die('Cannot add category'.mysql_error());

          ManAgePassDate($row);
            header('Location: index.php');
        } else {
            $errorMessage = 'Please check your login information';
        }
    }
    return $errorMessage;
}


#################################################################################################################################
###################################################    ManAgePassDate
#################################################################################################################################
function ManAgePassDate($row){
    global $pfw_db ;
    global $con ;
    $ThisUserId = $row['user_id'];
    if(EXPIRED_PASS_STATE == '1' and $row['user_id'] != '1' and $row['pass_expird'] != '2' ){
        //EXPIRED_PASS_DAYS ;
        $Today =  strtotime('today 00:00:00');
        $DatePassFrom_DB = $row['pass_date'];
        $End_Date = ( 86400 * EXPIRED_PASS_DAYS ) + $DatePassFrom_DB ;
        $Alert_Date = ($End_Date - (86400 * 3 )) ;

        if( $Today >= $End_Date ){
            $sql = "UPDATE tbl_user SET pass_expird  = '2' WHERE user_id = '$ThisUserId'";
            $result = mysqli_query($con,$sql) or die('Cannot add category'.mysql_error());
        }elseif($Today >=  $Alert_Date){
            $sql = "UPDATE tbl_user SET pass_expird  = '1' WHERE user_id = '$ThisUserId'";
            $result = mysqli_query($con,$sql) or die('Cannot add category'.mysql_error());
        }
        /*
          echo $Today.BR;
          echo $End_Date .BR;
          echo ConvertDateToCalender($End_Date).BR;
          echo $Alert_Date .BR;
          echo ConvertDateToCalender($Alert_Date).BR;
        */
    }
}



#################################################################################################################################
###################################################    checkUser
#################################################################################################################################
function checkUser() {
    global $SiteName_SESSION;
    global $AdminUserKey_SESSION;
    global $pfw_db;
    global $con ;




    if(!isset($_SESSION[$SiteName_SESSION]) or !isset($_SESSION[$AdminUserKey_SESSION])) {
         doLogout();

    } else {
        // Check The Session Value
        if($_SESSION[$SiteName_SESSION] != md5($SiteName_SESSION)) {
//            doLogout();

        }


        // Check The Session User Name
        if(!isset($_SESSION['adminSuserid'.$pfw_db]) or !isset($_SESSION['adminSuserpass'.$pfw_db])
            or !isset($_SESSION['adminusergroup'.$pfw_db])  or !isset($_SESSION['GoogleCode'.$pfw_db]) ){
             doLogout();
        }

        if(!isset($_SESSION['adminSusername'.$pfw_db])) {
             doLogout();
        } else {
            $UserName = $_SESSION['adminSusername'.$pfw_db];
        }
        $sql = "SELECT * FROM tbl_user where user_name = '$UserName' and state = '1' and group_state = '1'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);

        $LastSeen = time() - $row['last_seen'];
        if($LastSeen > GetTimeOutStamp(USER_TIME_OUT) ){
             doLogout();
        }else{
            $Last_login = time();
            $sql = "UPDATE tbl_user SET last_seen = '$Last_login' , seen_state = '1' WHERE user_name = '$UserName' ";
            $result = mysqli_query($con,$sql) or die('Cannot add category'.mysql_error());
        }

        $adminSiteKey =
            $row['user_id'].
            $row['user_name'].
            $row['user_password'].
            $row['group_id'].
            $row['google_code'];
        $adminSiteKey = md5($adminSiteKey);
        if($adminSiteKey != $_SESSION[$AdminUserKey_SESSION]) {
            doLogout();
            Redirect_Page("index.php");
        }

        $group_id = $_SESSION['adminusergroup'.$pfw_db];
        $AdminConfig = mysqli_query($con,"SELECT * FROM user_permission where group_id = '$group_id' ");
        $AdminConfig = mysqli_fetch_array($AdminConfig);
    }
    // the user want to logout
    if(isset($_GET['logout'])) {
         doLogout();
    }
    return $AdminConfig;
}

#################################################################################################################################
################################################### doLogout
#################################################################################################################################
function doLogout() {
    global $AdminPathHome;
    global $SiteName_SESSION;
    global $AdminUserKey_SESSION;
    global $pfw_db;
    global $con;
    //session_destroy();
    $UserName = $_SESSION['adminSusername'.$pfw_db];
    $sql = "UPDATE tbl_user SET seen_state = '0' WHERE user_name = '$UserName' ";
    $result = mysqli_query($con,$sql) or die('Cannot add category'.mysql_error());

    unset($_SESSION[$SiteName_SESSION]);
    unset($_SESSION[$AdminUserKey_SESSION]);
    unset($_SESSION['adminusername'.$pfw_db]);
    unset($_SESSION['adminusergroup'.$pfw_db]);
    unset($_SESSION['adminSuserid'.$pfw_db]);
    unset($_SESSION['adminSusername'.$pfw_db]);
    unset($_SESSION['adminSuserpass'.$pfw_db]);
    unset($_SESSION['adminadminusergroup'.$pfw_db]);
    unset($_SESSION['GoogleCode'.$pfw_db]);
    header('Location: '.$AdminPathHome.'login.php');
    exit;
}

#################################################################################################################################
###################################################    SendMassgeforuser
#################################################################################################################################
function SendMassgeforuser() {
    redirect_to2("index.php","Access not authorized. Please contact your administrator ");
}
function SendMassgeforuser2() {
    redirect_to2("../index.php","Access not authorized. Please contact your administrator ");
}

function GetTimeOutStamp($TimeOut){
    $TimeOut =  intval($TimeOut);
    $TimeOut = $TimeOut * 60 ;
    return $TimeOut ;
}

#################################################################################################################################
###################################################   Clean_Mypost_Login
#################################################################################################################################
function Clean_Mypost_Login($value) {
    global $con;

    $rep1 = array("|--AND--|","|-AND-|");
    $rep2 = array("&","+");
    $value = str_replace($rep1,$rep2,$value);

    $value = trim($value);
    $value = XSS_Remove_Login($value);

    $value = htmlspecialchars($value);
//    if (!get_magic_Quotes_gpc()) {
//        $value = addslashes(strip_tags($value));
//    } else {
//        $value = strip_tags($value);
//    }

    $rep1 = array("'",'"','<','>','«','»',"?","¿",'%','‰');
    $rep2 = array("&#8217;","&#34",'&#60;','&#62;',"&#171;","&#187;","&#63;","&#63;","&#37;","&#37;");
    $value = str_replace($rep1,$rep2,$value);

//    if (get_magic_Quotes_gpc()) {
//        $value = stripslashes($value);
//    }
    $value = mysqli_real_escape_string($con,$value);
    return $value;
}
function XSS_Remove_Login($data) {
    # Fix &entity\n;
    $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
    # Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
    # Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
    # Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
    # Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
    do {
        # Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    }
    while ($old_data !== $data);
    # we are done...
    return $data;
}
function print_r30($val) {

    echo '<div style="float: left; width: 500px;">';
    echo '<pre>';
    print_r($val);
    echo '</pre>';
    echo '</div>';
    echo '<div style="clear: both!important;"></div>';

}
?>