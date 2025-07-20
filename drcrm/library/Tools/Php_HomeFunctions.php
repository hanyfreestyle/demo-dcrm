<?php
if(!defined('WEB_ROOT')) {	exit;}
 

#################################################################################################################################
###################################################   GetAllConfig
#################################################################################################################################
function GetAllConfig() {
    global $pfw_db;
    global $db ;
    $row = $db->H_SelectOneRow("SELECT * FROM config  ");
    $SiteConfig = unserialize($row['web_config']);
    if( $_SESSION['WebLang'.$pfw_db] == 'En'){
        $photo = array(
            'photo_logo' => LOGOS_IMAGE_DIR_V.$row['photo_logo_en'],
            'header_photo' => LOGOS_IMAGE_DIR_V.$row['header_photo'],
        );
    }else{

        $photo = array(
            'photo_logo' => LOGOS_IMAGE_DIR_V.$row['photo_logo'],
            'header_photo' => LOGOS_IMAGE_DIR_V.$row['header_photo'],
        );

    }
    return array(
        'SiteConfig' => $SiteConfig,
        'Photo' => $photo,
    );
}

#################################################################################################################################
###################################################   GetLangState
#################################################################################################################################
function GetLangState() {
    global $pfw_db ;
    global $SiteConfig ;
    if(ADMINCPANELLANG == '1') {
        if($SiteConfig['weblang_s'] == '1'){
            if(isset($_GET['Lang'])) {
                $_SESSION['WebLang'.$pfw_db] = ChangeLang();
            }
            if(isset($_SESSION['WebLang'.$pfw_db])) {
                $WebSiteLang = $_SESSION['WebLang'.$pfw_db];
            } else {
                if($SiteConfig['weblang_kind'] == '0'){
                    $_SESSION['WebLang'.$pfw_db] = "Ar";
                    $WebSiteLang = $_SESSION['WebLang'.$pfw_db];
                }elseif($SiteConfig['weblang_kind'] == '1'){
                    $_SESSION['WebLang'.$pfw_db] = "En";
                    $WebSiteLang = $_SESSION['WebLang'.$pfw_db];
                }else{
                    $_SESSION['WebLang'.$pfw_db] = "Ar";
                    $WebSiteLang = $_SESSION['WebLang'.$pfw_db];
                }
            }
        }else{
            if($SiteConfig['weblang_kind'] == '0'){
                $_SESSION['WebLang'.$pfw_db] = "Ar";
                $WebSiteLang = $_SESSION['WebLang'.$pfw_db];
            }elseif($SiteConfig['weblang_kind'] == '1'){
                $_SESSION['WebLang'.$pfw_db] = "En";
                $WebSiteLang = $_SESSION['WebLang'.$pfw_db];
            }else{
                $_SESSION['WebLang'.$pfw_db] = "Ar";
                $WebSiteLang = $_SESSION['WebLang'.$pfw_db];
            }
        }
    } else {
        $_SESSION['WebLang'.$pfw_db] = "Ar";
        $WebSiteLang = $_SESSION['WebLang'.$pfw_db];
    }
    return $WebSiteLang ;
}

#################################################################################################################################
###################################################  GetCopyRight
#################################################################################################################################

function GetCopyRight($StartDate,$Lang,$CompanyName) {
    if($StartDate > date("Y")) {
        $StartDate = date("Y");
    }
    switch($Lang) {
        case 'Ar':
            $copyname = "جميع الحقوق محفوظة";
            if($StartDate == date("Y")) {
                $CopyRight = $copyname." &copy; ".date("Y")." ".$CompanyName;
            } else {
                $CopyRight = $copyname." &copy; ".$StartDate." - ".date("Y")." ".$CompanyName;
            }
            break;
        case 'En':
            $copyname = "All Rights Reserved";
            if($StartDate == date("Y")) {
                $CopyRight = $copyname." &copy; ".date("Y")." ".$CompanyName;
            } else {
                $CopyRight = $copyname." &copy; ".$StartDate." - ".date("Y")." ".$CompanyName;
            }
            break;
        default:
            $copyname = "All Rights Reserved";
            if($StartDate == date("Y")) {
                $CopyRight = $copyname." &copy; ".date("Y")." ".$CompanyName;
            } else {
                $CopyRight = $copyname." &copy; ".$StartDate." - ".date("Y")." ".$CompanyName;
            }
    }
    return $CopyRight;
}



/*







 */

?>