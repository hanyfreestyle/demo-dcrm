<?php

if (!defined('WEB_ROOT')) {
    exit;
}
if (F_FULL_COUNTRY == '1') {
    require_once "../_Pages/Country_Javascript.php";
}

$MoreS = array('Col' => "col-md-6", 'Placeholder' => "", 'required' => 'required ', 'Dir' => "Ar_Lang");
$Err[] = NF_PrintInput("TextEdit", $AdminLangFile['customer_name'], "name", "1", "1", "req", $MoreS);


if (F_KIND_ID == 1) {
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc", "Filter_Filde" => "cat_id", "Filter_Vall" => TABEL_KIND);
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_kind'], "col-md-3", "kind_id", "config_data", "req", $kind_id, $Arr);
}

if (F_SOCIAL_ID == 1) {
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc", "Filter_Filde" => "cat_id", "Filter_Vall" => TABEL_SOCIAL);
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_social_type'], "col-md-3", "social_id", "config_data", "optin", $social_id, $Arr);
}

echo '<div style="clear: both!important;"></div>';

#################################################################################################################################
###################################################  Row 1
#################################################################################################################################

$c_type_n = GetNameFromID("f_cust_type", $row['c_type'], $NamePrint);
PrintFildInformation("col-md-3", $AdminLangFile['customer_type'], $c_type_n);

if ($c_type == '1' or $c_type == '6') {
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc", "Filter_Filde" => "cat_id", "Filter_Vall" => $row['c_type']);
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_c_type_sub'], "col-md-3", "c_type_2", "f_cust_subtype", "req", $c_type_2, $Arr);

} else {
    if (intval($c_type_2) != '0') {
        $c_type_2_n = GetNameFromID("f_cust_subtype", $row['c_type_2'], $NamePrint);
        PrintFildInformation("col-md-3", $AdminLangFile['salesdep_td_c_type2'], $c_type_2_n);
        echo '<input type="hidden" name="c_type_2" value="' . $c_type_2 . '" />';
    }
}
echo '<div style="clear: both!important;"></div>';

#################################################################################################################################
###################################################
#################################################################################################################################

if (F_LEAD_TYPE == 1 and $AdminConfig['customer_edit'] == 1) {
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc");
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_lead_type'], "col-md-3", "lead_type", "fs_lead_type", "req", $lead_type, $Arr);
} else {
    $lead_type_n = findValue_FromArr($T_ARRAY_LEAD_TYPE, "id", $lead_type, $NamePrint);
    PrintFildInformation("col-md-3", $AdminLangFile['customer_lead_type'], $lead_type_n);
    echo '<input type="hidden" name="lead_type" value="' . $lead_type . '" />';
}
if (F_LEAD_SOURS == 1 and $AdminConfig['customer_edit'] == 1) {
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc");
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_lead_sours'], "col-md-3", "lead_sours", "fs_lead_sours", "req", $lead_sours, $Arr);
} else {
    $lead_sours_n = findValue_FromArr($T_ARRAY_LEAD_SOURS, "id", $lead_sours, $NamePrint);
    PrintFildInformation("col-md-3", $AdminLangFile['customer_lead_sours'], $lead_sours_n);
    echo '<input type="hidden" name="lead_sours" value="' . $lead_sours . '" />';
}

if (F_LEAD_CAT == 1 and $AdminConfig['customer_edit'] == 1) {
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc", "Filter_Filde" => "cat_id", "Filter_Vall" => TABEL_LEAD_CAT);
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['hotline_ad_campaign'], "col-md-3", "lead_cat", "config_data", "req", $lead_cat, $Arr);
} else {
    $lead_cat_n = findValue_FromArr($T_ARRAY_CONFIG_DATA, "id", $lead_cat, $NamePrint);
    PrintFildInformation("col-md-3", $AdminLangFile['hotline_ad_campaign'], $lead_cat_n);
    echo '<input type="hidden" name="lead_cat" value="' . $lead_cat . '" />';
}
echo '<div style="clear: both!important;"></div>';


#################################################################################################################################
###################################################  Row 2
#################################################################################################################################

if ($c_type == '6') {
    $MobileRqqqqq = "";
    $MobileRqqqqq_2 = "";
} else {
    $MobileRqqqqq = 'required data-parsley-type="digits" data-parsley-minlength="11"';
    $MobileRqqqqq_2 = "req-num";
}

$MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => $MobileRqqqqq, 'Dir' => "En_Lang");
$Err[] = NF_PrintInput("TextEdit", $AdminLangFile['customer_mobile'] . "1", "mobile", "1", "0", $MobileRqqqqq_2, $MoreS);

$MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => 'data-parsley-type="digits" data-parsley-minlength="11"', 'Dir' => "En_Lang");
$Err[] = NF_PrintInput("TextEdit", $AdminLangFile['customer_mobile'] . "2", "mobile_2", "400", "0", "optin-num", $MoreS);

$MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => 'data-parsley-type="digits" data-parsley-minlength="7"', 'Dir' => "En_Lang");
$Err[] = NF_PrintInput("TextEdit", $AdminLangFile['customer_phone'], "phone", "400", "0", "optin-num", $MoreS);

$MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => 'data-parsley-type="email"', 'Dir' => "En_Lang");
$Err[] = NF_PrintInput("TextEdit", $AdminLangFile['customer_email'], "email", "400", "0", "optin-email", $MoreS);

echo '<div style="clear: both!important;"></div>';

if (F_FULL_COUNTRY == 1) {
    $RowCount = 0;

    $Arr = array("Label" => 'on', "Active" => '0');
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_live_type'], "col-md-3", "live_id", "f_live", "req", $live_id, $Arr);

    $country_id = intval(204);
    $Lsit_SQL_Line = "SELECT * FROM fi_country where id = '$country_id' ";
    $Arr = array("Label" => 'on', 'SQL_Line_Send' => $Lsit_SQL_Line, 'StopListStyle' => '1');
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_nationality'], "col-md-3", "country_id", "fi_country", "req", $country_id, $Arr);


    $Lsit_SQL_Line = "SELECT * FROM fi_country  ";
    $Arr = array("Label" => 'on', 'SQL_Line_Send' => $Lsit_SQL_Line, 'StopListStyle' => '1');
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_country_live'], "col-md-3", "countrylive_id", "fi_country", "req", $countrylive_id, $Arr);


    $Arr = array("Label" => 'on', "Active" => '0');
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_city'], "col-md-3", "city_id", "fi_city", "req", $city_id, $Arr);


} else {
    if (F_COUNTRY_ID == 1) {
        $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc");
        $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_nationality'], "col-md-3", "country_id", "fi_country", "req", $country_id, $Arr);
        $RowCount = RowCountForLight_New($RowCount);
    }

    if (F_CITY_ID == 1) {
        $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc");
        $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_city'], "col-md-3", "city_id", "fi_city", "req", $city_id, $Arr);
        $RowCount = RowCountForLight_New($RowCount);
    }

}
echo '<div style="clear: both!important;"></div>';

#################################################################################################################################
###################################################  Row 3
#################################################################################################################################


#################################################################################################################################
###################################################  Row 4
#################################################################################################################################
############################  الديانة 
if (F_RELIGION == 1) {
    $Arr = array("StartFrom" => '1', "Label" => 'on');
    $Err[] = NF_PrintSelect_2018("ArrFrom", $AdminLangFile['customer_religion_h1'], "col-md-3", "religion", $Religion_Arr, "req", $religion, $Arr);

}

if (F_JOP_ID == 1) {
    $Arr = array("Label" => 'on', "Active" => '0', 'Order' => "order by count desc", "Filter_Filde" => "cat_id", "Filter_Vall" => TABEL_JOP);
    $Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['customer_jop'], "col-md-3", "jop_id", "config_data", "optin", $jop_id, $Arr);

}


if (F_ID_NO == 1) {
    $MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => 'data-parsley-type="digits" data-parsley-minlength="6"', 'Dir' => "En_Lang");
    $Err[] = NF_PrintInput("TextEdit", $AdminLangFile['customer_national_id'], "id_no", "0", "0", "optin-num", $MoreS);

}

if (F_BIRTH_DATE == 1) {
    $MoreS = array('Col' => "col-md-3", 'Placeholder' => "", 'required' => '');
    $Err[] = NF_PrintInput("DateEdit2", $AdminLangFile['customer_birth_date'], "birth_date", "0", "0", "option", $MoreS);

}

echo '<div style="clear: both!important;"></div>';

if (F_ADDRESS == '1') {
    $MoreS = array('Col' => "col-md-6", 'Placeholder' => "", 'required' => '');
    $Err[] = NF_PrintInput("TextAreaEdit", $AdminLangFile['customer_address'], "address", "0", "0", "option", $MoreS);
}

$MoreS = array('Col' => "col-md-6", 'Placeholder' => "", 'required' => '');
$Err[] = NF_PrintInput("TextAreaEdit", $AdminLangFile['customer_notes'], "notes", "0", "0", "option", $MoreS);
echo '<input type="hidden" name="state" value="' . $state . '" />';

echo '<div style="clear: both!important;"></div>';

?>