<?php
if (!defined('WEB_ROOT')) {
  exit;
}


######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

Form_Open();

$Err = [];

$Arr = array ("Label" => 'on', "Active" => '1');
$Err[] = NF_PrintSelect_2018("Chosen", $ALang['project_area_name'], "col-md-4", "area_id", "project_area", "req", 0, $Arr);


$MoreS = array ('Col' => "col-md-4", 'required' => 'required', 'Dir' => "Ar_Lang");
$Err[] = NF_PrintInput("Text", $ALang['project_pro_name'], "name", "", "0", "req", $MoreS);

if (ADMINCPANELLANG == '1') {
  $MoreS = array ('Col' => "col-md-4", 'required' => 'required', 'Dir' => "En_Lang");
  $Err[] = NF_PrintInput("Text", $ALang['project_pro_name'] . ENLANG, "name_en", "", "0", "req", $MoreS);
}

echo '<div style="clear: both!important;"></div>';

$MoreS = array ('Col' => "col-md-4", 'Placeholder' => "", 'required' => 'required data-parsley-type="alphanum" ', 'Dir' => "En_Lang");
$Err[] = NF_PrintInput("Text", $ALang['project_pro_code'], "pro_code", "0", "1", "req", $MoreS);

$Val = array ('0' => $AdminLangFile['project_crunt_0'], '1' => $AdminLangFile['project_crunt_1']);
$Err[] = NF_PrintRadio("2_Line", "col-md-4", $AdminLangFile['project_crunt_s'], "crunt", $Val, "1");


Form_Close_New("1", "List");

if (isset($_POST['B1'])) {
  Vall($Err, "PrjectAdd", $db, "1", $USER_PERMATION_Add);
}


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();


?>