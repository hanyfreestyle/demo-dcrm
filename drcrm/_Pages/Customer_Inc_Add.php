<?php
if (!defined('WEB_ROOT')) {
    exit;
}
if (F_FULL_COUNTRY == '1') {
    require_once "../_Pages/Country_Javascript.php";
}

echo '<input type="hidden" name="user_id" value="' . $RowUsreInfo['user_id'] . '" />';


$MoreS = array('Col' => "col-md-6", 'Placeholder' => "", 'required' => 'required ', 'Dir' => "Ar_Lang");
$Err[] = NF_PrintInput("Text", $AdminLangFile['customer_name'], "name", "1", "1", "req", $MoreS);

if (F_KIND_ID == 1) {
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc", "Filter_Filde" => "cat_id", "Filter_Vall" => TABEL_KIND);
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_kind'], "col-md-3", "kind_id", "config_data", "req", "0", $Arr);
}

if (F_SOCIAL_ID == 1) {
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc", "Filter_Filde" => "cat_id", "Filter_Vall" => TABEL_SOCIAL);
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_social_type'], "col-md-3", "social_id", "config_data", "optin", "0", $Arr);
}


echo '<div style="clear: both!important;"></div>';

#################################################################################################################################
###################################################  Row 1
#################################################################################################################################

if (F_LEAD_TYPE == 1) {
    $Arr = array("Label" => 'on', "Active" => '0');
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_lead_type'], "col-md-3", "lead_type", "fs_lead_type", "req", "0", $Arr);
}

if (F_LEAD_SOURS == 1) {
    $Arr = array("Label" => 'on', "Active" => '0');
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_lead_sours'], "col-md-3", "lead_sours", "fs_lead_sours", "req", "0", $Arr);
}

if (F_LEAD_CAT == 1) {
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc", "Filter_Filde" => "cat_id", "Filter_Vall" => TABEL_LEAD_CAT);
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['hotline_ad_campaign'], "col-md-3", "lead_cat", "config_data", "req", "0", $Arr);
}


if ($CustmerTYpeAddSecion == 'Customer_Add') {
    echo '<input type="hidden"  name="c_type" value="1"/>';
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc", "Filter_Filde" => "cat_id", "Filter_Vall" => "1");
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_c_type_sub'], "col-md-3", "c_type_2", "f_cust_subtype", "req", "0", $Arr);
} elseif ($CustmerTYpeAddSecion == 'AddContract') {
    echo '<input type="hidden"  name="c_type" value="6"/>';
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc", "Filter_Filde" => "cat_id", "Filter_Vall" => "6");
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_c_type_sub'], "col-md-3", "c_type_2", "f_cust_subtype", "req", "0", $Arr);
} elseif ($CustmerTYpeAddSecion == 'Hotline_Add') {
    echo '<input type="hidden"  name="c_type" value="5"/>';
    echo '<input type="hidden"  name="c_type_2" value="1"/>';
}

echo '<div style="clear: both!important;"></div>';

#################################################################################################################################
###################################################  Row 2
#################################################################################################################################

if ($CustmerTYpeAddSecion == 'AddContract') {
    $MobileRqqqqq = "";
    $MobileRqqqqq_2 = "";
} else {
    $MobileRqqqqq = 'required data-parsley-type="digits" data-parsley-minlength="11"';
    $MobileRqqqqq_2 = "req-num";
}


$MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => $MobileRqqqqq, 'Dir' => "En_Lang");
$Err[] = NF_PrintInput("Text", $AdminLangFile['customer_mobile'] . "1", "mobile", "1", "0", $MobileRqqqqq_2, $MoreS);

$MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => 'data-parsley-type="digits" data-parsley-minlength="11"', 'Dir' => "En_Lang");
$Err[] = NF_PrintInput("Text", $AdminLangFile['customer_mobile'] . "2", "mobile_2", "400", "0", "optin-num", $MoreS);

$MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => 'data-parsley-type="digits" data-parsley-minlength="7"', 'Dir' => "En_Lang");
$Err[] = NF_PrintInput("Text", $AdminLangFile['customer_phone'], "phone", "400", "0", "optin-num", $MoreS);

$MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => 'data-parsley-type="email"', 'Dir' => "En_Lang");
$Err[] = NF_PrintInput("Text", $AdminLangFile['customer_email'], "email", "400", "0", "optin-email", $MoreS);

echo '<div style="clear: both!important;"></div>';
#################################################################################################################################
###################################################  Row 3
#################################################################################################################################

if (F_FULL_COUNTRY == 1) {

    $Arr = array("Label" => 'on', "Active" => '0');
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_live_type'], "col-md-3", "live_id", "f_live", "req", "0", $Arr);



    $Lsit_SQL_Line = "SELECT * FROM fi_country ";
    $Arr = array("Label" => 'on', 'SQL_Line_Send' => $Lsit_SQL_Line, 'StopListStyle' => '0');
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_nationality'], "col-md-3", "country_id", "fi_country", "req", 0, $Arr);


    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_country_live'], "col-md-3", "countrylive_id", "fi_country", "req", 0, $Arr);


    $Arr = array("Label" => 'on', "Active" => '0');
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_city'], "col-md-3", "city_id", "fi_city", "req", "0", $Arr);
    $RowCount = RowCountForLight_New($RowCount);

} else {
    if (F_COUNTRY_ID == 1) {
        $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc");
        $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_nationality'], "col-md-3", "country_id", "fi_country", "req", "0", $Arr);
        $RowCount = RowCountForLight_New($RowCount);
    }

    if (F_CITY_ID == 1) {
        $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc");
        $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_city'], "col-md-3", "city_id", "fi_city", "req", "0", $Arr);
        $RowCount = RowCountForLight_New($RowCount);
    }

}


#################################################################################################################################
###################################################  Row 4
#################################################################################################################################

############################  الديانة 
if (F_RELIGION == 1) {
    $Arr = array("StartFrom" => '1', "Label" => 'on');
    $Err[] = NF_PrintSelect_2018("ArrFrom", $AdminLangFile['customer_religion_h1'], "col-md-3", "religion", $Religion_Arr, "req", "", $Arr);
    $RowCount = RowCountForLight_New($RowCount);
}

############################  الوظيفة
if (F_JOP_ID == 1) {
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc", "Filter_Filde" => "cat_id", "Filter_Vall" => TABEL_JOP);
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_jop'], "col-md-3", "jop_id", "config_data", "optin", "0", $Arr);
    $RowCount = RowCountForLight_New($RowCount);
}


############################ رقم الهوية
if (F_ID_NO == 1) {
    $MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => 'data-parsley-type="digits" data-parsley-minlength="6"', 'Dir' => "En_Lang");
    $Err[] = NF_PrintInput("Text", $AdminLangFile['customer_national_id'], "id_no", "0", "0", "optin-num", $MoreS);
    $RowCount = RowCountForLight_New($RowCount);
}

############################ تاريخ الميلاد
if (F_BIRTH_DATE == 1) {
    $MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => '');
    $Err[] = NF_PrintInput("Date2", $AdminLangFile['customer_birth_date'], "birth_date", "0", "0", "option", $MoreS);
    $RowCount = RowCountForLight_New($RowCount);
}


echo '<div style="clear: both!important;"></div>';
#################################################################################################################################
###################################################  Row 5
#################################################################################################################################

if (F_ADDRESS == '1') {
    $MoreS = array('Col' => "col-md-6", 'Placeholder' => "", 'required' => '');
    $Err[] = NF_PrintInput("TextArea", $AdminLangFile['customer_address'], "address", "0", "0", "option", $MoreS);
}

$MoreS = array('Col' => "col-md-6", 'Placeholder' => "", 'required' => '');
$Err[] = NF_PrintInput("TextArea", $AdminLangFile['customer_notes'], "notes", "0", "0", "option", $MoreS);

echo '<div style="clear: both!important;"></div>';
#################################################################################################################################
###################################################  Row 6
#################################################################################################################################

?>