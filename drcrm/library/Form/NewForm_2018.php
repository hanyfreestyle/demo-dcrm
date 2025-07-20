<?php
if (!defined('WEB_ROOT')) {
  exit;
}


#################################################################################################################################
###################################################   NF_PrintInput
#################################################################################################################################
function NF_PrintInput($StateType, $Label, $Name, $reqAstrex, $Mass, $req, $Arr = "") {
  global $AdminWebLang;
  if (isset($_POST[$Name])) {
    $_SESSION[$Name] = $_POST[$Name];
  }
  if (!empty($Arr['required'])) {
    $exx = explode(" ", $Arr['required']);
    if ($exx['0'] == 'required') {
      $req_span = '&nbsp; <span class="requiredText">*</span>';
    } else {
      $req_span = '&nbsp; ';
    }
  } else {
    $req_span = '&nbsp; ';
  }
  if ($Label) {
    $Print_Label = '<label class="control-label">' . $Label . $req_span . '</label>';
  } else {
    $Print_Label = "";
  }
  if (!isset($Arr['Placeholder'])) {
    $Arr['Placeholder'] = "";
  }
  if (!isset($Arr['Dir'])) {
    $Arr['Dir'] = "";
  }
  switch ($StateType) {
    case 'PassWord':
      if (!isset($Arr['Dir'])) {
        $Arr['Dir'] = "";
      }
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight ">';
      echo $Print_Label;
      echo '<input type="password" name="' . $Name . '" id="' . $Name . '" class="TypeText form-control ' . $Arr['Dir'] . '" 
        value="' . hetsee_2($Name) . '" placeholder="' . $Arr['Placeholder'] . '" ' . $Arr['required'] . '  > ';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      break;
    case 'Text':
      if (!isset($Arr['Dir'])) {
        $Arr['Dir'] = "";
      }
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight ">';
      echo $Print_Label;
      echo '<input type="text" name="' . $Name . '" id="' . $Name . '" class="TypeText form-control ' . $Arr['Dir'] . '" 
        value="' . hetsee_2($Name) . '" placeholder="' . $Arr['Placeholder'] . '" ' . $Arr['required'] . '  > ';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      break;
    case 'TextEdit':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<input type="text" name="' . $Name . '" id="' . $Name . '" class="TypeText form-control ' . $Arr['Dir'] . '"  value="' . hetseeEdit_2($Name, $Name) . '" placeholder="' . $Arr['Placeholder'] . '" ' . $Arr['required'] . '  > ';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      break;
    case 'Date':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<div data-pick-time="false" class="datetimepicker input-group ">';
      echo '<input type="text" name="' . $Name . '" id="' . $Name . '" class="form-control "  value="' . hetsee_2($Name) . '"  readonly="" ' . $Arr['required'] . '  > ';
      echo '<span class="input-group-addon"><span class="fa fa-calendar"></span></span>';
      echo '</div>';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      break;
    case 'Date2':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<div data-pick-time="false" class="datetimepicker input-group ">';
      echo '<input type="text" name="' . $Name . '" id="' . $Name . '" class="form-control "
        value="' . hetsee_2($Name) . '"  readonly=""  ' . $Arr['required'] . '  > ';
      echo '<span class="input-group-addon"><span class="fa fa-calendar"></span></span>';
      echo '<span class="RemovIconForCalander" myid="' . $Name . '"><span class="fa fa-times"></span></span>';
      echo '</div>';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      break;
    case 'DateEdit':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<div data-pick-time="false" class="datetimepicker input-group ">';
      echo '<input type="text" name="' . $Name . '" id="' . $Name . '" class="form-control " 
        value="' . hetseeEdit_2($Name, $Name) . '"  readonly="" ' . $Arr['required'] . '  > ';
      echo '<span class="input-group-addon"><span class="fa fa-calendar"></span></span>';
      echo '</div>';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      break;
    case 'DateEdit2':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<div data-pick-time="false" class="datetimepicker input-group ">';
      echo '<input type="text" name="' . $Name . '" id="' . $Name . '" class="form-control " 
        value="' . hetseeEdit_2($Name, $Name) . '"  readonly="" ' . $Arr['required'] . '  > ';
      echo '<span class="input-group-addon"><span class="fa fa-calendar"></span></span>';
      echo '<span class="RemovIconForCalander" myid="' . $Name . '"><span class="fa fa-times"></span></span>';
      echo '</div>';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      break;
    case 'Time':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<div data-pick-date="false" class="datetimepicker input-group ">';
      echo '<input type="text" name="' . $Name . '" id="' . $Name . '" class="form-control "
        value="' . hetsee_2($Name) . '" readonly="" ' . $Arr['required'] . '  > ';
      echo '<span class="input-group-addon"><span class="fa fa-clock-o"></span></span>';
      echo '<span class="RemovIconForCalander" myid="' . $Name . '"><span class="fa fa-times"></span></span>';
      echo '</div>';
      echo '</div>';
      break;
    case 'TextArea':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<textarea id="' . $Name . '" ' . $Arr['required'] . ' class="form-control ' . $Arr['Dir'] . ' " name="' . $Name . '" >' . hetsee_2($Name) . '</textarea>';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      break;
    case 'TextAreaEdit':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<textarea id="' . $Name . '" ' . $Arr['required'] . ' class="form-control ' . $Arr['Dir'] . ' " name="' . $Name . '" >' . hetseeEdit_2($Name, $Name) . '</textarea>';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      break;

    case 'EditTextArea':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<textarea id="' . $Name . '" ' . $Arr['required'] . ' class="form-control ' . $Arr['Dir'] . ' " name="' . $Name . '" >' . hetseeEdit_2019($Name, $Name) . '</textarea>';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      break;
    case 'Number':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight ">';
      echo $Print_Label;
      echo '<input type="text" name="' . $Name . '" id="' . $Name . '" class="TypeText BB_Number form-control En_Lang "
        value="' . hetsee_2($Name) . '"' . $Arr['required'] . '  > ';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      ?>
        <script type="text/javascript">
            $(function () {
                $('#<?php echo $Name ?>').number(true, 0);
            });
        </script>
      <?php
      break;
    case 'NumberEdit':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<input type="text" name="' . $Name . '" id="' . $Name . '" class="TypeText BB_Number form-control En_Lang " 
        value="' . hetseeEdit_2($Name, $Name) . '" ' . $Arr['required'] . '  > ';
      echo '</div>';
      FormPrintOneLine(isset($Arr['OnLine']), $Arr);
      ?>
        <script type="text/javascript">
            $(function () {
                $('#<?php echo $Name ?>').number(true, 0);
            });
        </script>
      <?php
      break;
    case 'Color':
      echo '<div class="form-field clear">';
      echo $Print_Label;
      echo '<input type="text" readonly="" value="' . hetseeEdit_2($Name, $Name) . '" name="' . $Name . '" class="text_en izzyColor" style="width: 80px;" id="' . $Name . '"/>';
      echo '</div>';
      break;
    default:
      echo "ErrorXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
  }
  if ($Mass == "0") {
    if ($AdminWebLang == 'En') {
      $Mass = 'Please Add ' . " " . $Label;
    } else {
      $Mass = 'برجاء اضافة' . " " . $Label;
    }
  }
  $err = GetTheErrMass($StateType, $Label, $Name, "", $Mass, $req);
  return $err;
}


#################################################################################################################################
###################################################   NF_PrintSelect_2018
#################################################################################################################################
function NF_PrintSelect_2018($StateType, $Label, $Size, $Name, $catTabel, $req, $catid = "0", $Arr = "") {
  global $db;
  global $AdminLangFile;
  global $WebSiteLang;
  global $ConfigP;
  if (isset($_POST[$Name])) {
    $_SESSION[$Name] = $_POST[$Name];
  } else {
    $_SESSION[$Name] = $catid;
  }
  if ($req == "req") {
    $req_span = '&nbsp;  <span class="requiredText">*</span>';
    $reqV = 'required';
  } else {
    $req_span = '&nbsp; ';
    $reqV = '';
  }
  if (!isset($Arr['Ajex_01'])) {
    $Arr['Ajex_01'] = "";
  }
  if (!isset($Arr['SubPrintFilde'])) {
    $Arr['SubPrintFilde'] = "";
  }
  switch ($StateType) {
    case 'Chosen':
      echo '<div class="' . $Size . ' col-sm-12 col-xs-12 form-group DirRight">';
      if (isset($Arr['Label']) and $Arr['Label'] == 'on') {
        echo '<label class="control-label select_label " >' . $Label . $req_span . '</label>';
      }
      if ((isset($ConfigP['filter_cont']) and $ConfigP['filter_cont'] == '1') or (isset($Arr['StopListStyle']) and $Arr['StopListStyle'] == '1')) {
        $MyFormStyleForList = 'form-control chosen-select_3';
      } else {
        $MyFormStyleForList = 'chosen-select input-md chosen-select_2';
      }
      if (!isset($Arr['OtherIdd'])) {
        $ListPrintIDDD = 'id';
      } else {
        $ListPrintIDDD = $Arr['OtherIdd'];
      }
      //// Start List
      echo '<select name="' . $Name . '" id="' . $Name . '" ' . $Arr['Ajex_01'] . ' class="' . $MyFormStyleForList . '" ' . $reqV . '>';
      if (isset($Arr['Label']) and $Arr['Label'] == 'on') {
        echo '<option value="">' . $AdminLangFile['mainform_print_form_please_select'] . " " . $Label . '</option>';
      } else {
        echo '<option value="">' . $Label . '</option>';
      }
      if (isset($Arr['Order'])) {
        $OrderLine = $Arr['Order'];
      } else {
        $OrderLine = " ";
      }
      if (isset($Arr['Filter_Filde'])) {
        $Filter_Filde = $Arr['Filter_Filde'];
        $Filter_Vall = $Arr['Filter_Vall'];
        $MySql = "SELECT * FROM $catTabel where $Filter_Filde = '$Filter_Vall' $OrderLine ";
      } else {
        $MySql = "SELECT * FROM $catTabel $OrderLine";
      }
      if (isset($Arr['SQL_Line_Send'])) {
        $MySql = $Arr['SQL_Line_Send'];
      }

      $Sql_List = $db->SelArr($MySql);
      if (is_array($Sql_List)) {
        for ($i = 0; $i < count($Sql_List); $i++) {
          if (isset($Arr['OtherAr'])) {
            $Sql_List[$i]['name'] = $Sql_List[$i][$Arr['OtherAr']];
          }
          if (isset($Arr['OtherEn'])) {
            $Sql_List[$i]['name_en'] = $Sql_List[$i][$Arr['OtherEn']];
          }
          if (isset($Arr['SiteList']) and $Arr['SiteList'] == '1') {
            if ($WebSiteLang == 'En' and isset($Sql_List[$i]['name_en'])) {
              $Sql_List[$i]['name'] = $Sql_List[$i]['name_en'];
            }
          } else {
            if (ADMIN_WEB_LANG == 'En' and isset($Sql_List[$i]['name_en'])) {
              $Sql_List[$i]['name'] = $Sql_List[$i]['name_en'];
            }
          }
          if (isset($Arr['SubPrintFilde'])) {
            if (isset($Sql_List[$i][$Arr['SubPrintFilde']])) {
              $SubPrintFilde = $Sql_List[$i][$Arr['SubPrintFilde']];
            } else {
              $SubPrintFilde = "";
            }
          } else {
            $SubPrintFilde = "";
          }
          if (isset($Arr['Active']) and $Arr['Active'] == '1') {
            if ($Sql_List[$i]['state'] == '1' or $_SESSION[$Name] == $Sql_List[$i][$ListPrintIDDD]) {
              echo '<option value="' . $Sql_List[$i][$ListPrintIDDD] . '" ';
              if ($_SESSION[$Name] == $Sql_List[$i][$ListPrintIDDD]) {
                echo "selected";
              }
              echo '>' . $Sql_List[$i]['name'] . " " . $SubPrintFilde . '</option>';
            }
          } else {
            echo '<option value="' . $Sql_List[$i][$ListPrintIDDD] . '" ';
            if ($_SESSION[$Name] == $Sql_List[$i][$ListPrintIDDD]) {
              echo "selected";
            }
            echo '>' . $Sql_List[$i]['name'] . " " . $SubPrintFilde . '</option>';
          }
        }
      }


      echo '</select>';
      echo '</div>';
      break;
    case 'ArrFrom':
      echo '<div class="' . $Size . ' col-sm-12 col-xs-12 form-group DirRight">';
      if (isset($Arr['Label']) and $Arr['Label'] == 'on') {
        echo '<label class="control-label select_label " >' . $Label . $req_span . '</label>';
      }
      if ((isset($ConfigP['filter_cont']) and $ConfigP['filter_cont'] == '1') or (isset($Arr['StopListStyle']) and $Arr['StopListStyle'] == '1')) {
        $MyFormStyleForList = 'form-control chosen-select_3';
      } else {
        $MyFormStyleForList = 'chosen-select input-md chosen-select_2';
      }
      echo '<select name="' . $Name . '" id="' . $Name . '" ' . $Arr['Ajex_01'] . ' class="' . $MyFormStyleForList . '" ' . $reqV . '>';
      if (isset($Arr['Label']) and $Arr['Label'] == 'on') {
        echo '<option value="">' . $AdminLangFile['mainform_print_form_please_select'] . " " . $Label . '</option>';
      } else {
        echo '<option value="">' . $Label . '</option>';
      }
      if (isset($Arr['StartFrom'])) {
        $THe_I_Start_From = intval($Arr['StartFrom']);
      } else {
        $THe_I_Start_From = '1';
      }
      $CountArrForLoop = count($catTabel);
      if ($THe_I_Start_From == '0') {
        $CountArrForLoop = $CountArrForLoop - 1;
      }
      for ($i = $THe_I_Start_From; $i <= $CountArrForLoop; $i++) {
        if (isset($Arr['ChangePrintVall']) and $Arr['ChangePrintVall'] == '1') {
          echo '<option value="' . $catTabel[$i] . '"';
          if ($_SESSION[$Name] == $catTabel[$i]) {
            echo "selected";
          };
          echo '>' . $catTabel[$i] . '</option>';
        } else {
          echo '<option value="' . $i . '"';
          if ($_SESSION[$Name] == $i) {
            echo "selected";
          };
          echo '>' . $catTabel[$i] . '</option>';
        }
      }
      echo '</select>';
      echo '</div>';
      break;
    default:
      echo "Error";
  }
  if (isset($Mass) and $Mass == "0") {
    $Mass = 'برجاء اضافة' . " " . $Label;
  } else {
    $Mass = "";
  }
  $err = GetTheErrMass($StateType, $Label, $Name, $Size, $Mass, $req);
  return $err;
}


#################################################################################################################################
###################################################  NF_PrintRadio_Active
#################################################################################################################################
function FormPrintOneLine($State, $Arr) {
  if ($State == '1') {
    if (isset($Arr['OnLine']) and $Arr['OnLine'] == '1') {
      echo '<div style="clear: both!important;"></div>';
    }
  }
}


#################################################################################################################################
###################################################  NF_PrintRadio_Active
#################################################################################################################################
function NF_PrintRadio_Active($StateType, $Col, $Label, $Name, $ch) {
  global $AdminLangFile;
  $Val = array ('0' => $AdminLangFile['mainform_radio_inactive'], '1' => $AdminLangFile['mainform_radio_active']);
  NF_PrintRadio($StateType, $Col, $Label, $Name, $Val, $ch);
}

function NF_PrintRadio($StateType, $Col, $Label, $Name, $Val, $ch) {
  switch ($StateType) {
    case '1_Line':
      echo '<div class="' . $Col . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo '<div class="radio_new">';
      echo '<label class="control-label OneLine">' . $Label . ' : </label> ';
      for ($i = 0; $i < count($Val); $i++) {
        if ($ch == $i) {
          $ch_state = "checked ";
        } else {
          $ch_state = "";
        }
        echo '<input id="' . $Name . '" type="radio" name="' . $Name . '" class="radiotype" value="' . $i . '" ' . $ch_state . ' >';
        echo '<label class="control-label OneLine" >' . $Val[$i] . '</label>';
      }
      echo '</div></div>';
      break;
    case '2_Line':
      echo '<div class="' . $Col . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo '<label class="control-label OneLine">' . $Label . ' : </label> ';
      echo '<div class="radio_new">';
      for ($i = 0; $i < count($Val); $i++) {
        if ($ch == $i) {
          $ch_state = "checked ";
        } else {
          $ch_state = "";
        }
        echo '<input id="' . $Name . '" type="radio" name="' . $Name . '" class="radiotype" value="' . $i . '" ' . $ch_state . ' >';
        echo '<label class="control-label OneLine" >' . $Val[$i] . '</label>';
      }
      echo '</div></div>';
      break;
    case '3_Line':
      echo '<div class="' . $Col . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo '<label class="control-label OneLine">' . $Label . ' : </label> ';
      for ($i = 0; $i < count($Val); $i++) {
        if ($ch == $i) {
          $ch_state = "checked ";
        } else {
          $ch_state = "";
        }
        echo '<div class="radio_new">';
        echo '<input id="' . $Name . '" type="radio" name="' . $Name . '" class="radiotype" value="' . $i . '" ' . $ch_state . ' >';
        echo '<label class="control-label OneLine" >' . $Val[$i] . '</label>';
        echo '</div>';
      }
      echo '</div>';
      break;
    default:
      echo "Error";
  }
}

#################################################################################################################################
###################################################  New_PrintFilePhoto
#################################################################################################################################
function New_PrintFilePhoto($StateType, $Arr) {
  global $AdminNoPhoto;
  global $AdminLangFile;
  global $ALang;
  if (!empty($Arr['required'])) {
    $req_span = '&nbsp; <span class="requiredText">*</span>';
  } else {
    $req_span = '&nbsp; ';
  }
  if (isset($Arr['Label'])) {
    $Print_Label = '<label class="control-label">' . $Arr['Label'] . $req_span . '</label>';
  } else {
    $Print_Label = "";
  }
  if (isset($Arr['NewStyle'])) {
    $CSS_Style = $Arr['NewStyle'];
  } else {
    $CSS_Style = "";
  }
  if (!isset($Arr['Dell_But'])) {
    $Arr['Dell_But'] = '0';
  }
  if (!isset($Arr['upload_type'])) {
    $Arr['upload_type'] = "0";
  }
  switch ($StateType) {
    case 'Add':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      if (!isset($Arr['StopView'])) {
        $FormArr = array ("Label" => 'on', "Active" => '1');
        $Err[] = NF_PrintSelect_2018("Chosen", $ALang['webconfig_upload_photo_type'], "col-md-12", "upload_type", "config_photo", "req", $Arr['upload_type'], $FormArr);
      }
      echo '<div class="col-md-12">';
      echo $Print_Label . '<br />';
      echo '<input type="file"  name="' . $Arr['name'] . '" ' . $Arr['required'] . '  data-classbutton="btn btn-default" 
    data-classinput="form-control inline" class="filestyle form-control">';
      echo '</div>';
      echo '</div>';
      break;
    case 'Edit':
      if ($Arr['photo']) {
        $photov = $Arr['path'] . $Arr['photo'];
      } else {
        $photov = $AdminNoPhoto;
      }
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight  ">';
      if (!isset($Arr['StopView'])) {
        $FormArr = array ("Label" => 'on', "Active" => '1');
        $Err[] = NF_PrintSelect_2018("Chosen", $ALang['webconfig_upload_photo_type'], "col-md-12", "upload_type", "config_photo", "req", $Arr['upload_type'], $FormArr);
      }
      echo '<div class="col-md-12">';
      echo $Print_Label . '<br />';
      echo '<input type="file"  name="' . $Arr['name'] . '" ' . $Arr['required'] . '  data-classbutton="btn btn-default" data-classinput="form-control inline" class="filestyle form-control">';
      echo '</div>';
      echo '<img src="' . $photov . '" class="thumbUploadPhto ' . $CSS_Style . ' "> ';
      if ($Arr['photo'] and $Arr['Dell_But'] == '1') {
        echo '<button type="submit"  name="DletePhoto" class="mb-sm btn btn-danger">' . $AdminLangFile['mainform_delete'] . '</button> ';
      }
      echo '</div>';
      break;
    case 'Multiple':
      echo '<div class="' . $Arr['Col'] . ' col-sm-12 col-xs-12 form-group DirRight">';
      if (!isset($Arr['StopView'])) {
        $FormArr = array ("Label" => 'on', "Active" => '1');
        $Err[] = NF_PrintSelect_2018("Chosen", $ALang['webconfig_upload_photo_type'], "col-md-12", "upload_type", "config_photo", "req", $Arr['upload_type'], $FormArr);
      }
      echo '<div class="col-md-12">';
      echo $Print_Label . '<br />';
      echo '<input type="file"  name="' . $Arr['name'] . '"  ' . $Arr['required'] . '  multiple="" data-classbutton="btn btn-default" 
    data-classinput="form-control inline" class="filestyle form-control" />';
      echo '</div>';
      echo '</div>';
      break;
    default:
      echo "Error";
  }
}


#################################################################################################################################
###################################################   Autocomplete_Input_2018
#################################################################################################################################
function Autocomplete_Input_2018($StateType, $LabelS, $ColMd, $Name, $IDD, $TabelData, $Arr) {
  global $row;
  if (!empty($Arr['required'])) {
    $req_span = '&nbsp; <span class="requiredText">*</span>';
  } else {
    $req_span = '&nbsp; ';
  }
  if ($LabelS) {
    $Print_Label = '<label class="control-label">' . $LabelS . $req_span . '</label>';
  } else {
    $Print_Label = "";
  }
  if (isset($Arr['SQL_Line_Send'])) {
    $MySql = $Arr['SQL_Line_Send'];
  } else {
    $MySql = "SELECT * FROM $TabelData ";
  }
  switch ($StateType) {
    case 'Add':
      echo '<div class="' . $ColMd . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<input type="text" name="' . $Name . '" id="' . $IDD . '" class="TypeText form-control Autocomplete_Input"  ' . $Arr['required'] . '  > ';
      echo '<script type="text/javascript">';
      echo '$(document).ready(function() {';
      echo '$("#' . $IDD . '").tokenInput(';
      echo '[';
      Autocomplet_List_2018($MySql, $Arr);
      echo ']';
      echo ',{';
      Autocomplet_Setting_2018();
      if (isset($_POST[$Name])) {
        CatWasSel_Add_2018('Add', $MySql, $_POST[$Name], $Arr);
      }
      echo '});';
      echo '});';
      echo '</script>';
      echo '</div>';
      break;
    case 'Edit':
      echo '<div class="' . $ColMd . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo $Print_Label;
      echo '<input type="text" name="' . $Name . '" id="' . $IDD . '" class="TypeText form-control Autocomplete_Input"  ' . $Arr['required'] . '  > ';
      echo '<script type="text/javascript">';
      echo '$(document).ready(function() {';
      echo '$("#' . $IDD . '").tokenInput(';
      echo '[';
      Autocomplet_List_2018($MySql, $Arr);
      echo ']';
      echo ',{';
      Autocomplet_Setting_2018();
      if (isset($_POST[$Name])) {
        CatWasSel_Add_2018('Add', $MySql, $_POST[$Name], $Arr);
      } else {
        CatWasSel_Add_2018('Edit', $MySql, $row[$Name], $Arr);
      }
      echo '});';
      echo '});';
      echo '</script>';
      echo '</div>';
      break;
      break;
    default:
      echo "Errorssssssssssss";
  }
}

function Autocomplet_List_2018($MySql, $Arr) {
  global $db;
  if (!isset($Arr['OtherIdd'])) {
    $ListPrintIDDD = 'id';
  } else {
    $ListPrintIDDD = $Arr['OtherIdd'];
  }
  $Sql_List = $db->SelArr($MySql);
  for ($i = 0; $i < count($Sql_List); $i++) {
    if (isset($Arr['OtherAr'])) {
      $Sql_List[$i]['name'] = $Sql_List[$i][$Arr['OtherAr']];
    }
    if (isset($Arr['OtherEn'])) {
      $Sql_List[$i]['name_en'] = $Sql_List[$i][$Arr['OtherEn']];
    }
    if (ADMIN_WEB_LANG == 'En' and $Sql_List[$i]['name_en']) {
      $Sql_List[$i]['name'] = $Sql_List[$i]['name_en'];
    }
    if (isset($Arr['ActiveFilde'])) {
      if ($Sql_List[$i][$Arr['ActiveFilde']] == '1') {
        echo '{id:' . $Sql_List[$i][$ListPrintIDDD] . ', name: "' . $Sql_List[$i]['name'] . '"},';
      }
    } else {
      echo '{id:' . $Sql_List[$i][$ListPrintIDDD] . ', name: "' . $Sql_List[$i]['name'] . '"},';
    }
  }
}

function CatWasSel_Add_2018($Type, $MySql, $POST_Send, $Arr) {
  global $db;
  if ($Type == 'Add') {
    $NewCatId = explode("-", $POST_Send);
  } elseif ($Type == 'Edit') {
    $cat_id = substr($POST_Send, 1, -1);
    $NewCatId = explode("-", $cat_id);
  }
  if (!isset($Arr['OtherIdd'])) {
    $ListPrintIDDD = 'id';
  } else {
    $ListPrintIDDD = $Arr['OtherIdd'];
  }
  if (isset($Arr['OtherAr'])) {
    $PrintNameT = $Arr['OtherAr'];
  } else {
    $PrintNameT = "name";
  }
  if (isset($Arr['OtherEn'])) {
    $PrintNameT_EN = $Arr['OtherEn'];
  } else {
    $PrintNameT_EN = 'name_en';
  }
  if (ADMIN_WEB_LANG == 'En') {
    $PrintNameT = $PrintNameT_EN;
  }
  $Sql_List = $db->SelArr($MySql);
  echo 'prePopulate: [';
  for ($i = 0; $i < count($NewCatId); $i++) {
    $Print_Name = findValue_FromArr($Sql_List, $ListPrintIDDD, $NewCatId[$i], $PrintNameT);
    echo '{id: ' . $NewCatId[$i] . ', name: "' . $Print_Name . '"},';
  }
  echo ']';
}

function Autocomplet_Setting_2018() {
  global $AdminLangFile;
  echo 'theme: "facebook",';
  echo 'tokenDelimiter: "-",';
  echo 'preventDuplicates: true ,';
  echo 'minChars: 1,';
  echo 'hintText: "' . $AdminLangFile['mainform_start_typing'] . '",';
  echo 'noResultsText: "' . $AdminLangFile['mainform_no_results'] . '",';
  echo 'searchingText: "' . $AdminLangFile['mainform_searching'] . '", ';
}


#################################################################################################################################
###################################################    Checkbox_2019
################################################################################################################################# 
function Checkbox_2019($StateType, $Name, $MySQL, $ch, $ArrData) {
  global $db;
  global $NamePrint;

  if (isset($ArrData['Req']) and $ArrData['Req'] == 'req') {
    $Req_V = ArrIsset($ArrData, "MinReq", "");
    $PrintReq = 'required="" data-parsley-mincheck="' . $Req_V . '"';
  } else {
    $PrintReq = '';
  }
  $Col = ArrIsset($ArrData, "Col", "col-md-12");
  $Col_2 = ArrIsset($ArrData, "Col_2", "col-md-3");
  $Label = ArrIsset($ArrData, "Label", "");
  $SqlPrint_Id = ArrIsset($ArrData, "PrintId", "id");
  $SqlPrint_Name = ArrIsset($ArrData, "PrintName", $NamePrint);
  $ActiveMode = ArrIsset($ArrData, "ActiveMode", "1");
  $PageView = ArrIsset($ArrData, "PageView", "Add");

  if (isset($_POST[$Name])) {
    $Amenities_Arr = $_POST[$Name];
  } else {
    if ($ch != '') {
      $Ch_Arr = explode('-', $ch);
      $Ch_Arr = array_filter($Ch_Arr);
      if (count($Ch_Arr) > '0') {
        $Amenities_Arr = $Ch_Arr;
      } else {
        $Amenities_Arr = array ();
      }
    } else {
      $Amenities_Arr = array ();
    }
  }

  switch ($StateType) {
    case 'SQL':
      echo '<div class="' . $Col . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo '<fieldset_checkbox>';
      echo '<label class="control-label Checkbox_label " >' . $Label . '</label>';

      $Already = $db->H_Total_Count($MySQL);
      if ($Already > '0') {
        $SQL_Arr = $db->SelArr($MySQL);

        for ($x = 0; $x < count($SQL_Arr); $x++) {
          if ($ch != '0' and count($Amenities_Arr) > '0') {
            if (in_array($SQL_Arr[$x][$SqlPrint_Id], $Amenities_Arr)) {
              $checkedState = "checked";
              $SQL_Arr[$x]['state'] = '1';
            } else {
              $checkedState = "";
            }
          } else {
            $checkedState = "";
          }


          if ($SQL_Arr[$x]['state'] == '1') {
            echo '<div class="' . $Col_2 . ' Checkbox_Cont DirRight">';
            echo '<label> ';
            echo '<input class="input_checkbox" type="checkbox" id="' . $Name . $SQL_Arr[$x][$SqlPrint_Id] . '" name="' . $Name . '[]"  ' . $PrintReq . ' value="' . $SQL_Arr[$x][$SqlPrint_Id] . '" ' . $checkedState . '>';
            echo $SQL_Arr[$x][$SqlPrint_Name] . ' </label>';
            echo '</div>';
          }
        }

      }

      echo '<div style="clear: both!important;"></div>';
      echo '<div id="checkbox-errors"></div>';
      echo '</fieldset_checkbox>';
      echo '</div>';
      break;

    case 'SQLWithGroup':
      $SqlPrint_GroupId = ArrIsset($ArrData, "SqlPrint_GroupId", "id");
      $SqlPrint_GroupName = ArrIsset($ArrData, "SqlPrint_GroupName", $NamePrint);
      $GroupTabelName = ArrIsset($ArrData, "GroupTabelName", "");  //"config_data";
      $GroupTabelFilde = ArrIsset($ArrData, "GroupTabelFilde", ""); //"pro_id";

      echo '<div class="' . $Col . ' col-sm-12 col-xs-12 form-group DirRight">';
      echo '<fieldset_checkboxGroup>';
      echo '<label class="control-label Checkbox_label " >' . $Label . '</label>';

      $Already_Cat = $db->H_Total_Count($MySQL);
      if ($Already_Cat > '0') {
        $GroupList = $db->SelArr($MySQL);
        for ($xx = 0; $xx < count($GroupList); $xx++) {
          $ThisGrouPId = $GroupList[$xx][$SqlPrint_GroupId];
          $Query = "SELECT * FROM $GroupTabelName where $GroupTabelFilde = '$ThisGrouPId' ";
          $already = $db->H_Total_Count($Query);
          if ($already) {
            echo '<div class="UserGroupName">' . $GroupList[$xx][$SqlPrint_GroupName] . "</div>";
            $User_Name = $db->SelArr($Query);
            for ($x = 0; $x < count($User_Name); $x++) {
              if ($ch != '0' and count($Amenities_Arr) > '0') {
                if (in_array($User_Name[$x][$SqlPrint_Id], $Amenities_Arr)) {
                  $checkedState = "checked";
                  $User_Name[$x]['state'] = '1';
                } else {
                  $checkedState = "";
                }
              } else {
                $checkedState = "";
              }
              if ($User_Name[$x]['state'] == '1') {
                echo '<div class="' . $Col_2 . ' Checkbox_Cont DirRight">';
                echo '<label> ';
                echo '<input class="input_checkbox" type="checkbox" id="' . $Name . $User_Name[$x][$SqlPrint_Id] . '" 
                    name="' . $Name . '[]"  ' . $PrintReq . ' value="' . $User_Name[$x][$SqlPrint_Id] . '" ' . $checkedState . '>';
                echo $User_Name[$x][$SqlPrint_Name] . ' </label>';
                echo '</div>';
              }
            }
          }
          echo '<div style="clear: both!important;"></div>';
        }
      }
      echo '<div style="clear: both!important;"></div>';
      echo '<div id="checkbox-errorsGroup"></div>';
      echo '</fieldset_checkboxGroup>';
      echo '</div>';
      break;

    default:
      echo "Error";
  }
}

?>