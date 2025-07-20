<?php
if(!defined('WEB_ROOT')) {	exit;}
 
#################################################################################################################################
###################################################   Form_Open
#################################################################################################################################
function Form_Open_XXXX($Arr=array()){
    if ( !isset($Arr['FormId'])){
        $Arr['FormId'] = 'forms';
    }
    if (!isset($Arr['FormPost'])){
        $Arr['FormPost'] = 'POST';
    }
    if (!isset($Arr['FormClass'])){
        $Arr['FormClass'] = 'form';
    }
    if (!isset($Arr['FormClassConfig'])){
        $Arr['FormClassConfig'] = 'form_config';
    }
    if (!isset($Arr['FormName'])){
        $Arr['FormName'] = 'FormName';
    }
    echo '<div id="'.$Arr['FormId'].'" >';
    echo '<div id="ErrMass" class="ErrMass_Div"></div>';
    echo '<form class="'.$Arr['FormClass']. " ".$Arr['FormClassConfig'].'" method="'.$Arr['FormPost'].'" name="'.$Arr['FormName'].'"  id="validate-form" data-parsley-validate enctype="multipart/form-data">';
}

function Form_Open($SendArr=array()){
    $FormDiveId = ArrIsset($SendArr,"FormDiveId","forms");
    $FormMethod = ArrIsset($SendArr,"FormMethod","POST");
    $FormClass = ArrIsset($SendArr,"FormClass","form");
    $FormClassConfig = ArrIsset($SendArr,"FormClassConfig","form_config");
    $FormName = ArrIsset($SendArr,"FormName","FormName");
    $Enctype  = ArrIsset($SendArr,"Enctype",'enctype="multipart/form-data"');
    $ParsleyState = ArrIsset($SendArr,"ParsleyState",'data-parsley-validate');
    $ParsleyId = ArrIsset($SendArr,"ParsleyId",'validate-form');

    echo '<div id="'.$FormDiveId.'" >';
    echo '<div id="ErrMass" class="ErrMass_Div"></div>';
    echo '<form class="'.$FormClass. " ".$FormClassConfig.'" method="'.$FormMethod.'" name="'.$FormName.'"  id="'.$ParsleyId.'" '.$ParsleyState." ".$Enctype.' >';
}

#################################################################################################################################
###################################################  Form_Close
#################################################################################################################################
function Form_Close($state="1",$Arr=array()){
    global $AdminLangFile;
    if($state == '1'){
        $B_name = $AdminLangFile['mainform_add_but'];
    }elseif($state == '2'){
        $B_name = $AdminLangFile['mainform_edit_but'];
    }elseif($state == '3'){
        $B_name = $AdminLangFile['mainform_search_but'];
    }elseif($state == '4'){
        $B_name = $AdminLangFile['mainconfig_view_but'];
    }
    echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
    echo '<input type="submit" name="B1" class="ArButForm btn btn-default" value="'.$B_name.'" />';
    echo '</div>';
    echo '</form>';
    echo '</div>';
}

#################################################################################################################################
###################################################   Form_Close_New
#################################################################################################################################
function Form_Close_New($state="1",$CanceledUrl= null){
    global $AdminLangFile;
    if($state == '1'){
        $B_name = $AdminLangFile['mainform_add_but'];
    }elseif($state == '2'){
        $B_name = $AdminLangFile['mainform_edit_but'];
    }elseif($state == '3'){
        $B_name = $AdminLangFile['mainform_search_but'];
    }elseif($state == '4'){
        $B_name = $AdminLangFile['mainconfig_view_but'];
    }elseif($state == '5'){
        $B_name = $AdminLangFile['mainform_confirm_but'];
    }elseif($state == '6'){
        $B_name = $AdminLangFile['mainform_close_but'];
    }
    echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
    echo '<a  class="CloseForm_Ar mb-sm btn btn-warning" href="index.php?view='.$CanceledUrl.'">'.$AdminLangFile['mainform_canceled_but'].'</a>';
    echo '<input type="submit" name="B1" class="CloseForm_Ar btn btn-default" value="'.$B_name.'" />';
    echo '</div>';
    echo '</form>';
    echo '</div>';
}

#################################################################################################################################
###################################################   PrintDeleteButConfirm
#################################################################################################################################
function PrintDeleteButConfirm($CanceledUrl,$DellUrl){
    global $AdminLangFile;
    echo '<a  class="ArButForm_Dell mb-sm btn btn-warning" href="index.php?view='.$CanceledUrl.'">'.$AdminLangFile['mainform_canceled_but'].'</a>';
    if($DellUrl){
        echo '<a  class="ArButForm_Dell mb-sm btn btn-danger" href="index.php?view='.$DellUrl.'&Confirm=1">'.$AdminLangFile['mainform_delete'].'</a>';
    }
}
#################################################################################################################################
###################################################   PrintCheckBox
#################################################################################################################################
function PrintCheckBox($id){
    echo '<input type="checkbox" name="id_id[]" value="'.$id.'" class="FormcheckboxL" >';
}
function PrintCheckBox_New($id){
    $CheckBox = '<input type="checkbox" name="id_id[]" value="'.$id.'" class="FormcheckboxL" >';
    return $CheckBox ;
}

#################################################################################################################################
###################################################   Print
#################################################################################################################################
function print_r3($val) {
    echo '<div style="float: left; width: 500px;">';
    echo '<pre>';
    print_r($val);
    echo '</pre>';
    echo '</div>';
    echo '<div style="clear: both!important;"></div>';

}
function print_r2($val) {
    echo '<pre>';
    print_r($val);
    echo '</pre>';
}
function PrintArryKeys($SiteConfig,$Name,$MainName='Config'){
    echo '<div class="dhtmlgoodies_question">'.$Name.'</div>';
    echo '<div class="dhtmlgoodies_answer"><div>';
    for ($i = 0; $i <= count($SiteConfig)-1; $i++) {
        echo '<input class="text-input" type="text" id="'.$Name.$i.'" onClick="SelectAll('."&#039;".$Name.$i."&#039;".');" 
    value = "'.'$'.$MainName.'[&#039;'.$Name.'&#039;]'.'[&#039;'.key($SiteConfig).'&#039;]'.'" /><br/>';
        next($SiteConfig);
    }
    echo '</div></div>';
}
#####################################################################################################################################
##########################################  NF_PrintBut_TD
#####################################################################################################################################
function NF_PrintBut_TD($StateType,$Name,$Link,$Class,$Icon,$blank="0") {
    global $AdminLangFile ;
    if($blank == '1'){
        $Target =  'target="_blank" ';
    }else{
        $Target  = "";
    }
    switch ($StateType) {
        case '1':
            $But = '<a '.$Target.' href="index.php?view='.$Link.'" class="btn btn-xs TdBut '.$Class.'"><i class="fa '.$Icon.'"></i> '.$Name.' </a>';
            break;
        case '2':
            $But = '<a '.$Target.' href="index.php?view='.$Link.'" class="btn btn-xs TdBut '.$Class.'" 
data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$Name.'" ><i class="fa '.$Icon.'"></i></a>';
            break;
        case 'Full_Url':
            $But = '<a '.$Target.' href="'.$Link.'" class="btn btn-xs TdBut '.$Class.'" 
data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$Name.'" ><i class="fa '.$Icon.'"></i></a>';
            break;
        case '3':
            $But = '<a href="index.php?view='.$Link.'" class="btn btn-xs TdBut '.$Class.'" target="_blank" ><i class="fa '.$Icon.'"></i> '.$Name.' </a>';
            break;
        case '4':
            $But = '<a class="btn btn-xs TdBut '.$Class.'" ><i class="fa '.$Icon.'"></i> '.$Name.' </a>';
            break;
        case 'Full_blank':
            $But = '<a target="_blank" href="'.$Link.'" class="btn btn-xs TdBut '.$Class.'" 
data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$Name.'" ><i class="fa '.$Icon.'"></i></a>';
            break;
        case 'Full_blank_2':
            $But = '<a href="'.$Link.'"  target="_blank" class="btn btn-xs TdBut '.$Class.'"><i class="fa '.$Icon.'"></i> '.$Name.' </a>';
            break;
        case 'autodelete_1':
            $But ='<a id="'.$Link.'" class="Delete_Unit TdBut btn btn-danger btn-xs" href="#"
data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$AdminLangFile['mainform_auto_delete_mass'].'">
<i class="fa fa-window-close"></i> '.$Name.' </a>';
            break;
        case 'autodelete_2':
            $But ='<a id="'.$Link.'" class="Delete_Unit TdBut btn btn-danger btn-xs" href="#"
data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$AdminLangFile['mainform_auto_delete_mass'].'">
<i class="fa fa-window-close"></i></a>';
            break;
        default:
            $But = '';
    }
    return $But;
}

#####################################################################################################################################
##########################################  Print_PagePanel_OPen
#####################################################################################################################################
function Print_PagePanel_OPen($Col,$Title,$OPenState="1",$RemoveState="0",$NewCalss=""){
    echo '<div class="'.$Col.' '.$NewCalss.' ">';
    echo '<div class="panel panel-default">';
    echo '<div class="panel-heading">'.$Title;
    if($RemoveState == '1'){
        echo '<a href="#" data-perform="panel-dismiss" data-toggle="tooltip" title="Close Panel" class="pull-right"><em class="fa fa-times"></em></a>';
    }
    if($OPenState == '1'){
        echo '<a href="#" data-perform="panel-collapse" data-toggle="tooltip" title="Collapse Panel" class="pull-right"><em class="fa fa-minus"></em></a>';
    }else{
        echo '<a href="#" data-perform="panel-collapse" data-toggle="tooltip" title="Collapse Panel" class="pull-right"><em class="fa fa-plus"></em></a>';
    }

    echo '</div>';
    if($OPenState == '1'){
        echo '<div>';
    }else{
        echo '<div class="panel-wrapper collapse">';
    }
    echo '<div class="panel-body">';
}

function Print_PagePanel_Close($Footer=""){
    echo '</div>';
    if($Footer){
        echo '<div class="panel-footer">'.$Footer.'</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

#####################################################################################################################################
########################################## FPrint_ADD_Submit
#####################################################################################################################################
function FPrint_ADD_Submit($Dell='0'){
    global $AdminLangFile ;
    if($Dell == '1'){
        echo '<div class="row PanelMin TopButAction"><div class="col-md-12">
<button type="submit"  name="ActAllUnit" class="mb-sm btn btn-success">'.$AdminLangFile['mainform_activation'].'</button>
<button type="submit"  name="UnActAllUnit" class="mb-sm btn btn-warning">'.$AdminLangFile['mainform_disable'].'</button>
<button type="submit"  name="DelUnit" class="mb-sm btn btn-danger">'.$AdminLangFile['mainform_delete'].'</button>
</div> </div><div style="clear: both;"></div>';
    }else{
        echo '<div class="row PanelMin TopButAction"><div class="col-md-12">
<button type="submit"  name="ActAllUnit" class="mb-sm btn btn-success">'.$AdminLangFile['mainform_activation'].'</button>
<button type="submit"  name="UnActAllUnit" class="mb-sm btn btn-warning">'.$AdminLangFile['mainform_disable'].'</button>
</div> </div><div style="clear: both;"></div>';
    }
}
#####################################################################################################################################
########################################## CheckUnitState
#####################################################################################################################################
function CheckUnitState($State){
    if($State== '1'){
        $Photo =  '<img src="../include/img/ico_active_16.png"  />';
    }else{
        $Photo =  '<img src="../include/img/ico_inactive_16.png"  />';
    }
    return $Photo ;
}

#####################################################################################################################################
##########################################   ActAllUnit_New
#####################################################################################################################################
function ActAllUnit_New($Tabel){
    global $db;
    if(isset($_POST['id_id'])) {
        $EmailCount = count($_POST['id_id']);
        for ($i = 0; $i < $EmailCount; $i++) {
            $id = $_POST['id_id'][$i];
            $server_data = array('state' => "1");
            $db->AutoExecute($Tabel, $server_data, AUTO_UPDATE, "id = $id");
        }
    }
}
function UnActAllUnit_New($Tabel){
    global $db;
    if(isset($_POST['id_id'])){
        $EmailCount = count($_POST['id_id']);
        for ($i = 0; $i < $EmailCount; $i++){
            $id =  $_POST['id_id'][$i]  ;
            $server_data = array ('state'=> "0");
            $db->AutoExecute($Tabel,$server_data,AUTO_UPDATE,"id = $id");
        }
    }
}
function DelUnit_New($Tabel){
    global $db;
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
        $id =  $_POST['id_id'][$i]  ;
        $db->H_DELETE_FromId("$Tabel",$id);
    }
}



#################################################################################################################################
###################################################   hetsee_2
#################################################################################################################################
function hetsee_2($filedname) {
    if(isset($_POST[$filedname])) {
        $v = $_POST[$filedname];
    } else {
        $v = "";
    }
    return $v;
}

function hetseeEdit_2($filedname,$Name) {
    global $row;
    if(isset($_POST[$filedname])) {
        $v = $_POST[$filedname];
    } else {
//        $v = $row[$Name];
        $v = ArrIsset($row,$Name,null);
    }
    return $v;
}

function hetseeEdit_3($filedname,$Name) {
    global $row;
    $v = $row[$Name];
    return $v;
}
function hetsee($filedname) {
    if(isset($filedname)) {
        echo $filedname;
    } else {
        echo "";
    }
}
function hetseeEdit($filedname,$Name) {
    global $row;
    if(isset($filedname)) {
        echo $filedname;
    } else {
        echo $row[$Name];
    }
}




function hetseeEdit_2019($filedname,$Name) {
    global $row;
    if(isset($_POST[$filedname])) {
        $v = $_POST[$filedname];
    } else {
        $v = $row[$Name];
    }
    return $v;
}


#################################################################################################################################
###################################################   Form_Close_3
#################################################################################################################################
function Form_Close_3($state="1",$But_Name=null){
    global $AdminLangFile;
    if($state == '1'){
        $B_name = $AdminLangFile['mainform_add_but'];
    }elseif($state == '2'){
        $B_name = $AdminLangFile['mainform_edit_but'];
    }elseif($state == '3'){
        $B_name = $AdminLangFile['mainform_search_but'];
    }elseif($state == '4'){
        $B_name = $AdminLangFile['mainconfig_view_but'];
    }
    echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
    echo '<input type="submit" name="'.$But_Name.'" class="ArButForm btn btn-default" value="'.$B_name.'" />';
    echo '</div>';
    echo '</form>';
    echo '</div>';
}
function Form_Close_2($B_name){
    echo '<div class="form-field clear">';
    echo '<input type="submit" class="submit" value="'.$B_name.'" name="B1" />';
    echo '</div>';
    echo '</form>';
    echo '<div class="form_space"></div>';
    echo '</div>';
}
function Form_Close_4($But_Name){
    global $AdminLangFile;
    echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
    echo '<input type="submit" name="B1" class="ArButForm btn btn-default" value="'.$B_name.'" />';
    echo '</div>';
    echo '</form>';
    echo '</div>';
}

#################################################################################################################################
###################################################   PrintFiled
#################################################################################################################################
function PrintFiled($Label,$filed){
echo '<div class="form-field clear">';
echo '<label class="form-label fl-space2">'.$Label . ' : </label>';
echo '<div class="PrintFiled">'.$filed.'</div>';
echo '</div>';
}
function PrintFiled_Home($Label,$filed){
echo '<div class="form-field">';
echo '<div class="form-label">'.$Label.' : </div>';
echo '<div class="form-Filed">'.$filed.'</div>';
echo '</div>';
}
#################################################################################################################################
###################################################   LastAdd
#################################################################################################################################
 function LastAdd($SESSION) {
   if(isset($_SESSION[$SESSION])) {
     $state = "1";
     $cat_id = $_SESSION[$SESSION];
   } else {
     $state = "0";
     $cat_id = "0";
   }
   $LastAdd = array('state' => $state,'cat_id' => $cat_id);
   return $LastAdd;
 }
#################################################################################################################################
################################################### LastAddadmin  
#################################################################################################################################
 function LastAddadmin($SESSION) {
   if($_POST['lastadd_state'] == "1") {
     $_SESSION[$SESSION] = $_POST['cat_id'];
   } else {
     UnsetAllSession($SESSION);
   }
 }
 function LastAddadmin_22($SESSION) {
   if($_POST['lastadd_state'] == "1") {
     $_SESSION[$SESSION] = $_POST['amara_id'];
   } else {
     UnsetAllSession($SESSION);
   }
 }
#################################################################################################################################
###################################################   UnsetAllSession
#################################################################################################################################
function UnsetAllSession($arr) {
   $getArr = explode(",",$arr);
   for($i = 0; $i < count($getArr); $i++) {
     $sessionName = $getArr[$i];
     unset($_SESSION[$sessionName]);
   }
}
function UnsetAllSession_index($arr,$But='B1') {
   if(!isset($_POST[$But])){ 
   $getArr = explode(",",$arr);
   for($i = 0; $i < count($getArr); $i++) {
     $sessionName = $getArr[$i];
     unset($_SESSION[$sessionName]);
   }
   }
}
function unsetsss($arr) {
   $getArr = explode(",",$arr);
   for($i = 0; $i < count($getArr); $i++) {
     $sessionName = $getArr[$i];
     unset($_SESSION[$sessionName]);
   }
}

function UnseetByKey($arry){
   $key = "";     
   forEach($arry as $key => $value) {
   $key_2 = $key_2.",".$key ;
   }
  unsetsss($key_2);
}

function UnsetAllSession_Dell(){
  $Text = "";
  foreach ($_POST as $key => $value)  { 
  //echo '<p>'.$key.' - '.$value.'</p>';
  $Text = $Text.",".$key ;         
  }   
  return $Text ;
}
#################################################################################################################################
###################################################   
#################################################################################################################################
 function Redirect_Page($location = null) {
   if($location != null) {
     echo '<meta HTTP-EQUIV="REFRESH" content="2; url='.$location.'">';
     exit;
   }
 }
 function Redirect_to2($location = NULL,$mass= NULL) {
   if($location != NULL) {
     echo '<script type="text/javascript">';
     echo 'alert("'.$mass.'")';
     echo '</script>';
     echo '<meta HTTP-EQUIV="REFRESH" content="0; url='.$location.'">';
     exit;
   }
 }
 function Redirect_Header($location = NULL,$mass = "") {
   if($location != NULL) {
     echo '<meta HTTP-EQUIV="REFRESH" content="2; url='.$location.'">';
     exit;
   }
 }
  function Redirect_Page_2($location = null) {
   if($location != null) {
     echo '<meta HTTP-EQUIV="REFRESH" content="0; url='.$location.'">';
     exit;
   }
 }
 function Redirect_Home($location = null) {
   if($location != null) {
     echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
     echo '<meta HTTP-EQUIV="REFRESH" content="0; url='.$location.'">';
     exit;
   }
 } 
#################################################################################################################################
###################################################   CheckTheGetAndState
#################################################################################################################################
 function CheckTheGetAndState($GetValue,$FiledName,$TabelName,$to,$state = "") {
   global $LANG;
   if(!isset($_GET[$GetValue])) {
     redirect_Header($to);
   } else {
     $GOODGetValue = $_GET[$GetValue];
   }
   if(!is_numeric($_GET[$GetValue])) {
     redirect_Header($to);
     exit;
   }
   if($state == '1') {
     $already = mysql_num_rows(mysql_query("SELECT '$FiledName' FROM $TabelName WHERE $FiledName = $GOODGetValue and state = '1'"));
     if($already > 0) {
       $GOODGetValue = $_GET[$GetValue];
     } else {
       redirect_Header($to);
     }
   } else {
     $already = mysql_num_rows(mysql_query("SELECT '$FiledName' FROM $TabelName WHERE $FiledName = $GOODGetValue"));
     if($already > 0) {
       $GOODGetValue = $_GET[$GetValue];
     } else {
       redirect_Header($to);
     }
   }
   return $GOODGetValue;
}
#################################################################################################################################
###################################################  CheckTheGet 
#################################################################################################################################
function CheckTheGet($GetValue,$FiledName,$TabelName,$Mass1 = "Error",$Mass2 = "Error") {
   //////// Check The GET OF the CAT ID
   global $LANG;
   global $db ;
   if(!isset($_GET[$GetValue])) {
     redirect_to2("index.php",$Mass1);
   } else {
     $GOODGetValue = $_GET[$GetValue];
   }
   if(!is_numeric($_GET[$GetValue])) {
     redirect_to2("index.php",$Mass1);
     exit;
   }
   $already = $db->H_Total_Count("SELECT '$FiledName' FROM $TabelName WHERE $FiledName = $GOODGetValue");
   if($already > 0) {
     $GOODGetValue = $_GET[$GetValue];
   } else {
     redirect_to2("index.php",$Mass2);
   }
   return $GOODGetValue;
}
#################################################################################################################################
###################################################
#################################################################################################################################
function GETTHEPAGE($TheSQL,$PERpage) {
    global $AdminLangFile ;
    global $db;
   $NOPAGE = "0";

   $already = $db->H_Total_Count($TheSQL);
   if(($already / $PERpage) == 1) {
     $countpage = 1;
   } else {
     $countpage = ceil($already / $PERpage);
   }
   if( isset($_GET['page']) and $_GET['page'] > $countpage) {
    echo '<div style="clear: both!important;"></div>';
    New_Print_Alert("4",$AdminLangFile['mainform_alert_no_content']);
    echo '<div style="clear: both!important;"></div>';
     $NOPAGE = 1;
   }
   return $NOPAGE;
}

#################################################################################################################################
###################################################   SendJavaErrMass
#################################################################################################################################
function SendJavaErrMass($Mass) {
    echo '<script type="text/javascript">';
    echo '$(document).ready(function(){';
    echo '$("#ErrMass").addClass("ErrMass_Div_S");';
    echo '$("#ErrMass").append("';
    echo $Mass."<br/>";
    echo '");';
    echo '});';
    echo '</script>';
}
function SendJavaErrMass_22($Mass) {
    echo '<script type="text/javascript">';
    echo '$(document).ready(function(){';
    echo '$("#ErrMass").addClass("ErrMass_Div_S");';
    echo '$("#ErrMass").append("';
    echo $Mass.BR;
    echo '");';
    echo '});';
    echo '</script>';
}
#################################################################################################################################
###################################################  Vall 
#################################################################################################################################
function Vall($Err,$DoFunction,$db,$state,$GroupPermation = "") {

   $validator = new FormValidator();

   for($i = 0; $i < count($Err); $i++) {
     for($x = 0; $x < count($Err[$i]); $x++) {
       $validator->addValidation($Err[$i][$x]['Name'],$Err[$i][$x]['Req'],$Err[$i][$x]['Mass']);
     }
   }
   if($validator->ValidateForm()) {
     if($DoFunction == "test") {
       echo "Test Done";
       exit;
     }
     if($state == "1") {
       if($GroupPermation == '1') {
         $DoFunction($db);
       } else {
         SendMassgeforuser();
       }
     } else {
       $DoFunction($db);
     }
   } else {
     $error_hash = $validator->GetErrors();
     echo '';
     foreach($error_hash as $inpname => $inp_err) {
       SendJavaErrMass($inp_err);
     }
   }
}

#################################################################################################################################
###################################################   VallCat
#################################################################################################################################
function VallCat($Err,$DoFunction,$db,$state,$GroupPermation = "",$catTabel= NULL,$Path= NULL,$ConfigP = NULL,$PathD = "") {
   $validator = new FormValidator();
   for($i = 0; $i < count($Err); $i++) {
     for($x = 0; $x < count($Err[$i]); $x++) {
       $validator->addValidation($Err[$i][$x]['Name'],$Err[$i][$x]['Req'],$Err[$i][$x]['Mass']);
     }
   }
   if($validator->ValidateForm()) {
     if($DoFunction == "test") {
       echo "Test Done";
       exit;
     }
     if($state == "1") {
       if($GroupPermation == '1') {
         $DoFunction($db,$catTabel,$Path,$PathD,$ConfigP);
       } else {
         SendMassgeforuser();
       }
     } else {
       $DoFunction($db,$catTabel,$Path,$ConfigP);
     }
   } else {
     $error_hash = $validator->GetErrors();
     echo '';
     foreach($error_hash as $inpname => $inp_err) {
       SendJavaErrMass($inp_err);
     }
   }
}

#################################################################################################################################
###################################################   VallFormFunction
#################################################################################################################################
function VallFormFunction($Err,$DoFunction,$FunctionArr,$captcha = "") {
   $validator = new FormValidator();
   for($i = 0; $i < count($Err); $i++) {
     for($x = 0; $x < count($Err[$i]); $x++) {
       $validator->addValidation($Err[$i][$x]['Name'],$Err[$i][$x]['Req'],$Err[$i][$x]['Mass']);
     }
   }
   if($validator->ValidateForm()) {
     if($captcha == '1') {
       if(trim($_POST['captcha']) == "") {
         SendJavaErrMass('برجاء التاكد من كتابة الكود العشوائى');
       } else {
         if(!empty($_REQUEST['captcha'])) {
           if(empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
             SendJavaErrMass('برجاء التاكد من كتابة الكود العشوائى');
           } else {
             if($DoFunction == "test") {
               echo "Test Done";
               exit;
             }
             $DoFunction($FunctionArr = "");
           }
           unset($_SESSION['captcha']);
         }
       }
     } else {
       if($DoFunction == "test") {
         echo "Test Done";
         exit;
       }
       $DoFunction($FunctionArr = "");
     }
   } else {
     $error_hash = $validator->GetErrors();
     echo '';
     foreach($error_hash as $inpname => $inp_err) {
       SendJavaErrMass($inp_err);
     }
   }
}
#################################################################################################################################
###################################################   
#################################################################################################################################
function GetTheErrMass($StateType,$Label,$Name,$Size,$Mass,$req) {
    global $AdminWebLang ;
    if($AdminWebLang == 'En'){
    $Url_Err_Mass = "Please be sure to write correctly URL";
    }else{
    $Url_Err_Mass = "برجاء التاكد من كتابة الرابط بصورة صحيحة";
    }
    
   if($req != "0") {
     $req2 = explode("-",$req);
     if(count($req2) > '0') {
       for($i = 0; $i < count($req2); $i++) {
         $vr = explode('=',$req2[$i]);
         if($req2[$i] == "email") {
           $Mass22 = "برجاء كتابة البريد الالكترنى بصورة صحيحة";
         } elseif($req2[$i] == "url") {
           $Mass22 = $Url_Err_Mass ;
         } elseif($req2[$i] == "num") {
           $Mass22 = "برجاء التاكد من ان تكون قيمة"." ".$Label." "."ارقام فقط !!";
         } elseif($vr[0] == "maxlen") {
           $Mass22 = "برجاء التاكد من اقصى عدد حروف للحقل"." ".$Label." ".$vr['1'];
         } elseif($vr[0] == "minlen") {
           $Mass22 = "برجاء التاكد من اقل عدد حروف للحقل"." ".$Label." ".$vr['1'];
         } elseif($vr[0] == "lessthan") {
           $Mass22 = "برجا التاكد من ان قيمة "." ".$Label." "." اقل من ".$vr['1'];
         } elseif($vr[0] == "greaterthan") {
           $Mass22 = "برجا التاكد من ان قيمة "." ".$Label." "." اكبر من ".$vr['1'];
         } elseif($vr[0] == "dontselect") {
           $Mass22 = "برجاء التاكد من اختيار"." ".$Label;
         } else {
           $Mass22 = $Mass;
         }
         $err[] = array('Name' => $Name,'Mass' => $Mass22,'Req' => $req2[$i]);
         $Mass22 = "";
       }
     } else {
       $err[] = array('Name' => $Name,'Mass' => $Mass,'Req' => $req);
     }
     return $err;
   }
} 
#################################################################################################################################
###################################################   
#################################################################################################################################
#################################################################################################################################
###################################################   
#################################################################################################################################
function IdUrl($row) {
   global $SiteConfig;
   global $WebSiteLang;
   if($SiteConfig['rightmode'] == "1") {
     if($WebSiteLang == 'En') {
       $idYY = Removword_To_Clean($row['name_m_en']);
     } else {
       $idYY = Removword_To_Clean($row['name_m']);
     }
   } else {
     $idYY = $row['id'];
   }
   return $idYY;
}
#################################################################################################################################
###################################################   
#################################################################################################################################
function Removword($value) {
   $value = trim($value);
   $rep1 = array('"','<','>',"'");
   $rep2 = array("&#34;",'&#60;','&#62;','&#039;');
   $value = str_replace($rep1,$rep2,$value);
   return $value;
}

#################################################################################################################################
###################################################   
#################################################################################################################################
function Removword_L($value) {
   $value = trim($value);
   $rep1 = array("&#34;",'&#60;','&#62;','&#039;');
   $rep2 = array('"','<','>',"'");
   $value = str_replace($rep1,$rep2,$value);
   return $value;
}

#################################################################################################################################
###################################################   
#################################################################################################################################
function Removword_L2($value) {
   $value = trim($value);
   $rep1 = array("&#63;");
   $rep2 = array('?');
   $value = str_replace($rep1,$rep2,$value);
   return $value;
 }

#################################################################################################################################
###################################################  Removword_To_Clean 
#################################################################################################################################
function Removword_To_Clean($value) {
   $value = trim($value);
    $rep1 = array("&#8217;","&#63;","&#35;",'&#37;','&amp;',"+");
	$rep2 = array("'","&#191;","|number|sign|",'&permil;',"|--AND--|","|-AND-|");
   $value = str_replace($rep1,$rep2,$value);
   return $value;
 }

#################################################################################################################################
###################################################   HTML_Print
#################################################################################################################################
function HTML_Print($value,$type="1",$trim="300"){
    if($type == '1'){
     $value = Removword_L($value);   
    }elseif($type == "2"){
     $value = Removword_L($value);
     $value = Remove_HTML($value);        
     $value = nl2br($value);
    }elseif($type == "3"){
     $value = Removword_L($value);
     $value = Remove_HTML($value);
     $value = NiceTrimNew($value,$trim);             
    }
    return $value ;    
}


#################################################################################################################################
###################################################   Check_Keyword
#################################################################################################################################
function Check_Keyword($value,$trim="180"){
    $value = trim($value);
    /*
    $value = Removword_L($value);
    $value = Remove_HTML($value);
    $value = NiceTrimNew($value,$trim);
    */
    return $value ;
}

#################################################################################################################################
###################################################   Check_Description
################################################################################################################################# 
function Check_Description($value,$trim="180"){
    $value = trim($value);
   /*
    $value = Removword_L($value);
    $value = Remove_HTML($value);
    $value = NiceTrimNew($value,$trim);
    */
    return $value ;
} 

#################################################################################################################################
###################################################   Check_PageTitle
#################################################################################################################################
function Check_PageTitle($value,$trim="180"){
    $value = trim($value);
  /*
    $value = Removword_L($value);
    $value = Remove_HTML($value);
    $value = NiceTrimNew($value,$trim);
    */
    return $value ;
} 


#################################################################################################################################
###################################################   Clean_Mypost
#################################################################################################################################
function Clean_Mypost($value) {
    global $con ;
    $rep1 = array("|--AND--|","|-AND-|");
	$rep2 = array("&","+");
    $value = str_replace($rep1,$rep2,$value);
    
    $value = XSS_Remove($value);
	$value = trim($value);
	$value = htmlspecialchars($value);
//	if (!get_magic_Quotes_gpc()) {
//	$value = addslashes(strip_tags($value));
//	} else {
//	$value = strip_tags($value);
//	}

 
    $rep1 = array("'",'"','<','>','«','»',"?","¿",'%','‰');
	$rep2 = array("&#8217;","&#34",'&#60;','&#62;',"&#171;","&#187;","&#63;","&#63;","&#37;","&#37;");

    $value = str_replace($rep1,$rep2,$value);

//    if (get_magic_Quotes_gpc()) {
//	$value = stripslashes($value);
//	}
    
    $value = mysqli_real_escape_string($con,$value);
	return $value;
}

#################################################################################################################################
###################################################   XSS_Remove
#################################################################################################################################
function XSS_Remove($x_content){
    $x_content = preg_replace('#(<[^>]+[\s\r\n\"\'])(on|xmlns)[^>]*>#iU',"$1>",$x_content);
    $x_content = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([\`\'\"]*)[\\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iU','$1=$2nojavascript...',$x_content);
    $x_content = preg_replace('#([a-z]*)[\x00-\x20]*=([\'\"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iU','$1=$2novbscript...',$x_content);
    $x_content = preg_replace('#</*\w+:\w[^>]*>#i','',$x_content);
    do {
        $oldstring = $x_content;
        $x_content = preg_replace('#</*(\?xml|applet|meta|xml|blink|link|style|script|object|iframe|frame|frameset|ilayer|layer|bgsound|title|base)[^>]*>#i',"",$x_content);
    } while ($oldstring != $x_content);
    
   return $x_content; 
}



#################################################################################################################################
###################################################  url_slug 
#################################################################################################################################
function Url_Slug($str, $options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => false,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
		'ß' => 'ss', 
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
		'ÿ' => 'y',

		// Latin symbols
		'©' => '(c)',

		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',

		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
		'Ž' => 'Z', 
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z', 

		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
		'Ż' => 'Z', 
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',

		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}


#################################################################################################################################
###################################################   
#################################################################################################################################
function Print_Button_Delete($Id,$Ajex,$Link,$ViewType="1",$MyArr=array()){
  global $ALang ;

  $Icon = ArrIsset($MyArr,"Icon","fa-window-close");
  $Class = ArrIsset($MyArr,"Icon","btn-danger");
  $Name = ArrIsset($MyArr,"Name",$ALang['mainform_delete']);
  
  $Blank = ArrIsset($MyArr,"Blank","0");
  if($Blank == '1'){$Target =  'target="_blank" ';}else{$Target  = "";}
  
  if($ViewType == '1'){
  $But_tooltip = 'data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$Name.'"' ; 
  $Name = ""; 
  }elseif($ViewType == '2'){
  $But_tooltip = "";
  }
  
  
  $Ajex_tooltip = 'data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$ALang['mainform_auto_delete_mass'].'"' ;
  
 
 
   
  if($Ajex == '1'){
  $But ='<a id="'.$Id.'" class="'.$Link.' TdBut btn '.$Class.'" href="#" '.$Ajex_tooltip.'><i class="fa '.$Icon.'"></i> '.$Name.' </a>';       
  }else{
  $But = '<a '.$Target.' href="index.php?view='.$Link.'&id='.$Id.'" class="btn btn-xs TdBut '.$Class.'" '.$But_tooltip.'><i class="fa '.$Icon.'"></i> '.$Name.' </a>';  
  }
        
  
  return $But ;
}


#################################################################################################################################
###################################################   
#################################################################################################################################



#################################################################################################################################
###################################################   
#################################################################################################################################



#################################################################################################################################
###################################################   
#################################################################################################################################


?>

