<?php
if(!defined('WEB_ROOT')) {	exit;}
 
#################################################################################################################################
###################################################    RemoveFildeFromArrWhenAdd
#################################################################################################################################
function RemoveFildeFromArrWhenAdd($Arr){
    $server_data =   $Arr ;
    if(F_SOCIAL_ID != 1){ unset($server_data['social_id']);}
    if(F_ID_NO != 1){ unset($server_data['id_no']);}
    if(F_BIRTH_DATE != 1){ unset($server_data['birth_date'],$server_data['birth_day'],$server_data['birth_month']);}
    if(F_FULL_COUNTRY != 1){ unset($server_data['countrylive_id'],$server_data['live_id']);}
    if(F_CITY_ID != 1){ unset($server_data['city_id']);}
    if(F_COUNTRY_ID != 1){ unset($server_data['country_id']);}
    if(F_JOP_ID != 1){ unset($server_data['jop_id']);}
    if(F_KIND_ID != 1){ unset($server_data['kind_id']);}
    if(F_LEAD_CAT != 1){ unset($server_data['lead_cat']);}
    if(F_LEAD_TYPE != 1){ unset($server_data['lead_type']);}
    if(F_LEAD_SOURS != 1){ unset($server_data['lead_sours']);}
    if(F_UNIT_TYPE_ID != 1){ unset($server_data['unit_id']);}
    if(F_PROJECT_AREA != 1){ unset($server_data['pro_area']);}
    if( F_CASH_ID != 1){ unset($server_data['cash_id']);}
    if( F_DATE_RECEIPT_ID != 1){ unset($server_data['date_id']);}
    if( F_AREA_ID != 1){ unset($server_data['area_id']);}
    if( F_CALL_TIME_ID != 1){ unset($server_data['time_id']);}
    if( F_BEST_CALL_ID != 1){ unset($server_data['bestcall_id']);}
    if( F_COURS != 1){ unset($server_data['cours_id']);}
    if( F_RELIGION != 1){ unset($server_data['religion']);}
    if( F_ADDRESS != 1){ unset($server_data['address']);}
    return $server_data ;
}


#################################################################################################################################
###################################################    Filter_Post_ListBox
#################################################################################################################################
function Filter_Post_ListBox($Post_Name,$Filde_Name){
    $LineSend = "";
    if(isset($_POST[$Post_Name])){
        $SendVal = intval($_POST[$Post_Name]) ;
        if($SendVal  == '0'){
            $LineSend = "" ;
        }else{
            $LineSend = " and ".$Filde_Name." = " .$SendVal ;
        }
    }
    return $LineSend ;
}
#################################################################################################################
############################################# Unset_Alert_User
#################################################################################################################
/*
function Unset_Alert_User(){
    global $AdminLangFile;
    if(isset($_SESSION['UserPermission_ID']) and  intval($_SESSION['UserPermission_ID'])!= '0'){
        $EmPName = GetNameFromID_User("tbl_user",$_SESSION['UserPermission_ID'],"name");
        echo '<form action="#" method="post">';
        echo '<div class="alert alert-success alert-dismissable">';
        echo '<button type="submit" name="clear_user" class="close">×</button>';
        echo "You are now viewing the results for the employee "." ".$EmPName;
        echo '</div>';
        echo '</form>';
    }
}
*/

#################################################################################################################################
###################################################    SendArrToSql
#################################################################################################################################
function SendArrToSql($Name){
    $SendLine = "-";
    $Line = "" ;
    if(isset($_POST[$Name])){
        $MyArry = $_POST[$Name] ;
        for ($i = 0; $i < count($MyArry); $i++) {
            $SendLine .= $MyArry[$i].$Line."-";
        }
    }else{
        $SendLine = "";
    }
    return  $SendLine;
}

#################################################################################################################################
###################################################    PostIsset_Config
#################################################################################################################################
function PostIsset_Config($Name){
    global $ConfigP ;
    if(isset($ConfigP[$Name])){
        $SentPost = $ConfigP[$Name];
    }else{
        $SentPost = "" ;
    }
    return $SentPost ;
}

#################################################################################################################################
###################################################    PostIsset
#################################################################################################################################
function PostIsset($Name,$Clean='1'){
    if(isset($_POST[$Name])){
        if($Clean == '1'){
            $SentPost = Clean_Mypost($_POST[$Name]);
        }else{
            $SentPost = $_POST[$Name];
        }
    }else{
        $SentPost = "" ;
    }
    return $SentPost ;
}
#################################################################################################################################
###################################################    PostIsset_Intval
#################################################################################################################################
function PostIsset_Intval($Name,$Clean='1',$Def="0"){
    if(isset($_POST[$Name])){
        if($Clean == '1'){
            $SentPost = Clean_Mypost(intval($_POST[$Name]));
        }else{
            $SentPost = intval($_POST[$Name]);
        }
    }else{
        $SentPost = intval($Def) ;
    }
    return $SentPost ;
}
#################################################################################################################################
###################################################    ArrIsset
#################################################################################################################################
function ArrIsset($Arr,$Name,$DefVall=""){
    if(isset($Arr[$Name])){
        $SendVal = $Arr[$Name] ;
    }else{
        $SendVal  = $DefVall;
    }
    return  $SendVal ;
}
#################################################################################################################################
###################################################    ConfigIsset
#################################################################################################################################
function ConfigIsset($Name){
    global $ConfigP;
    if(isset($ConfigP[$Name]) and $ConfigP[$Name] == '1'){
        $SentPermtion = '1';
    }else{
        $SentPermtion = '0';
    }
    return $SentPermtion ;
}
#################################################################################################################################
###################################################    HandleDuplicate
#################################################################################################################################
function HandleDuplicate($Tabel,$Filde,$Post,$id="0",$IdFilde="id",$Arr=""){
    global $db ;
    global $AdminLangFile ;
    $Err = ""; $FilterIdd = "";$SubFildeFilter="";
    if($id != '0' ){
     $FilterIdd = " and $IdFilde != '$id' ";   
    }
    if(isset($Arr['SubFilde'])){
    $SubFildeFilter = " and ".$Arr['SubFilde']." = ".$Arr['SubFildeVal'];    
    }
    $Name = PostIsset($Post);
    $already = $db->H_Total_Count("select * from $Tabel where $Filde = '$Name' $SubFildeFilter $FilterIdd ");
    if($already > '0'){
        SendJavaErrMass($Name." ".$AdminLangFile['mainform_name_add_err']);
        $Err = '1';
    }
    return  array('Val'=> $Name , 'Err'=> $Err );
}
#################################################################################################################################
###################################################  AddOnlyAr
#################################################################################################################################
function AddOnlyAr($Arr){
    $server_data =   $Arr ;
    if(ADMINCPANELLANG != '1'){
        unset($server_data['name_en']);
    }
    return $server_data ;
}
#################################################################################################################################
###################################################    DashboardBlock
#################################################################################################################################
function DashboardBlock($Col,$Color,$MyStyle,$Number,$Titel,$Icons){
    echo '<div class="'.$Col.' DirRight "><div class="panel widget">';
    echo '<div class="panel-body '.$Color.' text-center '.$MyStyle.'">';
    echo '<div class="text-lg m0">'.$Number.'</div>';
    echo '<p>'.$Titel.'</p>';
    echo '<div class="mb-lg"></div>';
    echo '<em class="fa '.$Icons.' text-alpha"></em>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
#################################################################################################################################
###################################################   New_Print_Alert
#################################################################################################################################
function New_Print_Alert($State,$Mass,$Close="0"){
    switch($State) {
        case "1":
            $Style = "alert-success";
            break;
        case "2":
            $Style = "alert-info";
            break;
        case "3":
            $Style = "alert-warning";
            break;
        case "4":
            $Style = "alert-danger";
            break;
        case "5":
            $Style = "alert-inverse";
            break;
        case "6":
            $Style = "alert-default";
            break;
        default:
            $Style = "";
    }
    echo '<div style="clear: both!important;"></div>';
    echo '<div class="alert '.$Style.' alert-dismissable Arr_Mass">';
    if($Close == '1'){
        echo '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>';
    }
    echo $Mass ;
    echo '</div>';
    echo '<div style="clear: both!important;"></div>';
}
#################################################################################################################################
###################################################    New_But_Alert
#################################################################################################################################
function New_But_Alert($State,$Mass,$Close="0"){
    switch($State) {
        case "1":
            $Style = "alert-success";
            break;
        case "2":
            $Style = "alert-info";
            break;
        case "3":
            $Style = "alert-warning";
            break;
        case "4":
            $Style = "alert-danger";
            break;
        case "5":
            $Style = "alert-inverse";
            break;
        case "6":
            $Style = "alert-default";
            break;
        default:
            $Style = "";
    }
    $But =  '<div style="clear: both!important;"></div>';
    $But .=  '<div class="alert '.$Style.' alert-dismissable Arr_Mass tb_style">';
    if($Close == '1'){
        $But .= '<button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>';
    }
    $But .=  $Mass ;
    $But .= '</div>';
    $But .= '<div style="clear: both!important;"></div>';
    return $But ;
}
#################################################################################################################################
###################################################  ErrMassPer
#################################################################################################################################
function ErrMassPer($State=""){
    global $AdminLangFile ;

    switch($State){
        case "1":
            $Mass = ' ';
            break;
        case "2":
            $Mass = '';
            break;
        default:
            $Mass = $AdminLangFile['mainform_no_user_per'] ;
    }

    echo '<div class="alert alert-danger alert-dismissable Arr_Mass">';
    echo $Mass ;
    echo '</div>';
}
#################################################################################################################################
###################################################   RowCountForLight_New
#################################################################################################################################
function RowCountForLight_New($RowCount,$ClearAfter="4"){
    $RowCount = intval($RowCount);
    $RowCount = $RowCount+1;
    if($RowCount == $ClearAfter){
        echo '<div style="clear: both!important;"></div>';
        $RowCount = '0' ;
    }
    return $RowCount ;
}
#################################################################################################################################
###################################################    ActiveAllContent
#################################################################################################################################
function ActiveAllContent($TabelName,$Field="state"){
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
    $id =  $_POST['id_id'][$i]  ;
    $sql = "UPDATE $TabelName SET 
	$Field = '1'
	WHERE id = '$id'";
    $result = mysql_query($sql) or die('Cannot add category' . mysql_error()); 
    }
}
#################################################################################################################################
###################################################    DisableAllContent
#################################################################################################################################
function DisableAllContent($TabelName,$Field="state"){
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
    $id =  $_POST['id_id'][$i]  ;
    $sql = "UPDATE $TabelName SET 
	$Field = '0'
	WHERE id = '$id'";
    $result = mysql_query($sql) or die('Cannot add category' . mysql_error()); 
    }
}
#################################################################################################################################
###################################################   OredrCodeRef
#################################################################################################################################
function OredrCodeRef($Table,$FildeName,$String=10,$RefS=""){
 global $db ;
 $ordercode = $RefS.Rand_String_H($String);
 $already = $db->H_Total_Count("SELECT * FROM $Table WHERE $FildeName = '$ordercode'");
 if($already > 0) {
  OredrCodeRef($Table,$FildeName,$String,$RefS);     
 }else{
 return $ordercode ; 
 }  
}
#################################################################################################################################
###################################################    Rand_String_H
#################################################################################################################################
function Rand_String_H($num_chars) {
   $ret = "";
   $chars = array("1","2","3","4","5","6","7","8","9","0","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
   $string = array_rand($chars,$num_chars);
   foreach($string as $s) {
     $ret .= $chars[$s];
   }
   return $ret;
}
#################################################################################################################################
###################################################  Print_Open_Panel 
#################################################################################################################################
function Print_Open_Panel($Titel,$Open='1',$Arr=""){
    if($Open == '1'){
    $DivClass = '';
    $EmIcon = 'fa-minus';     
    }else{
    $DivClass = 'panel-wrapper collapse'; 
    $EmIcon = 'fa-plus';   
    }
    echo '<div class="panel panel-default">';
    echo '<div class="panel-heading">'.$Titel ;
    echo '<a href="#" data-perform="panel-collapse" data-toggle="tooltip"  class="pull-left">';
    echo '<em class="fa '.$EmIcon.'"></em></a>';
    echo '</div>';
    echo '<div class="'.$DivClass.'">';
    echo '<div class="panel-body">';    
} 
function Print_Close_Panel($Footer='',$Arr=''){
    echo '</div></div>';
    if($Footer){
    echo '<div class="panel-footer">'.$Footer.'</div>';    
    }
    echo '</div>'; 
} 
function PrintFildInformation($Size,$Titel,$Info){
    echo '<div class="'.$Size.' col-sm-12 col-xs-12 DirRight CustInfo">';
    echo '<div class="Name">'.$Titel.'</div>';
    echo '<div class="Info">'.nl2br($Info).'</div>';
    echo '</div>';    
} 
function RowCountClear($RowCount,$Count='4'){
   $RowCount = $RowCount+1;
   if($RowCount == $Count ){
     echo '<div style="clear: both!important;"></div>';
    $RowCount = '0' ; 
   } 
   return $RowCount ;
}
################################################################################################################################
###################################################   GetNameFromID_Usrname
#################################################################################################################################
function Ret_RowInfo($tabel,$id){
    $sql = "SELECT * FROM $tabel where id = '$id'";
	$result     = mysql_query($sql);
	$row=	mysql_fetch_array($result);
    return $row ;   
}
function GetNameFromID_Usrname($id) {
   global $db ;
   $sql = "SELECT * FROM tbl_user  where user_id = '$id'";
   $row = $db->H_SelectOneRow($sql);
   return $row['name'];
}
function GetNameFromID($Tabel,$id,$Print) {
   global $db ;
   if(intval($id) != '0'){
   $row = $db->H_SelectOneRow("SELECT * FROM $Tabel where id = '$id'");
   return $row[$Print];  
   } 
}
function GetNameFromID_ForLoaction($Tabel,$id,$Print) {
   global $db ;
   if($Print == 'name'){
    $Print = 's_name';
   }elseif($Print == 'name_en'){
    $Print = 's_name_en';
   }
   if(intval($id) != '0'){
   $row = $db->H_SelectOneRow("SELECT * FROM $Tabel where id = '$id'");
   return $row[$Print];  
   } 
}
function GetNameFromID_User($Tabel,$id,$Print) {
   global $db ;
   $sql = "SELECT * FROM $Tabel where user_id = '$id'";
   $row = $db->H_SelectOneRow($sql);
   return $row[$Print];
}
function CheckCatName($id,$tabel) {
   $sql = "SELECT * FROM $tabel where id = '$id'";
   $result = mysql_query($sql);
   $row = mysql_fetch_array($result);
   echo $row['name'];
}
function CheckCatName_New($id,$tabel) {
   $sql = "SELECT * FROM $tabel where id = '$id'";
   $result = mysql_query($sql);
   $row = mysql_fetch_array($result);
   return $row['name'];
}
function GetSoursBannerId($cat_id) {
   $sql = "SELECT * FROM config_meta where cat_id = '$cat_id'";
   $result = mysql_query($sql);
   $row = mysql_fetch_array($result);
   return $row['banner_catid'];
}
#################################################################################################################################
###################################################   CountFildFromTabel
#################################################################################################################################
function CountFildFromTabel($Tabel_Date,$Tabel_Update,$FildeCount,$FildeUpdate){
    global $db ;
    $Name = $db->SelArr("SELECT id FROM $Tabel_Date ");
    for($i = 0; $i < count($Name); $i++) {
    $Filde_Id = $Name[$i]['id']; 
    $already = $db->H_Total_Count("SELECT $FildeCount FROM $Tabel_Update WHERE $FildeCount = '$Filde_Id'");
    $server_data = array ($FildeUpdate => $already );  
    $add_server = $db->AutoExecute($Tabel_Date,$server_data,AUTO_UPDATE,"id = '$Filde_Id' "); 
    } 
}
#################################################################################################################################
###################################################    CountUnitFun_Many
#################################################################################################################################
function CountUnitFun_Many($Tabel_Date,$Tabel_Update,$FildeCount,$FildeUpdate){
    global $db ;    
    $Name = $db->SelArr("SELECT * FROM $Tabel_Date ");
    for($i = 0; $i < count($Name); $i++) {
    $TheCat_id_Sours  = $Name[$i]['id'];         
    $TheCat_id  = "-".$Name[$i]['id']."-"; 
    $already = mysql_num_rows(mysql_query("SELECT $FildeCount FROM $Tabel_Update WHERE $FildeCount LIKE '%$TheCat_id%' "));
    $server_data = array ($FildeUpdate => $already); 
    $add_server = $db->AutoExecute($Tabel_Date,$server_data,AUTO_UPDATE,"id = $TheCat_id_Sours"); 
    };
}
#################################################################################################################################
###################################################  CountFildFromTabel_CatID  
#################################################################################################################################
function CountFildFromTabel_CatID($Tabel_Date,$Tabel_Update,$FildeCount,$FildeUpdate){
    global $db ;
    $Name = $db->SelArr("SELECT id FROM config_data where cat_id = '$Tabel_Date' ");
    for($i = 0; $i < count($Name); $i++) {
    $Filde_Id = $Name[$i]['id']; 
    $already = $db->H_Total_Count("SELECT $FildeCount FROM $Tabel_Update WHERE $FildeCount = '$Filde_Id'");
    $server_data = array ($FildeUpdate => $already );  
    $db->AutoExecute("config_data",$server_data,AUTO_UPDATE,"id = '$Filde_Id' ");
    } 
}
#################################################################################################################################
###################################################   
#################################################################################################################################
function validate_url($input) {
   if(!stristr($input,'http://')) {
     return false;
   }
   return true;
}
#################################################################################################################################
###################################################   
#################################################################################################################################
function UserPerMatianCont($Page,$Permation){
    if($Permation == '1'){
        $Page = $Page ;
    }else{
         $Page = "../include/Page_UserErr.php" ;
    }
    return $Page ;
}
#################################################################################################################################
###################################################   
#################################################################################################################################
function UserPerMatianCont_2($Page,$Permation,$DefineVar){
    if($Permation == '1' and $DefineVar == '1'){
        $Page = $Page ;
    }else{
         $Page = "../include/Page_Feature_Not_Available.php" ;
    }
    return $Page ;
}
#################################################################################################################################
###################################################   
#################################################################################################################################
function RemovePhoto($Type,$Tabel,$IDD,$PhotoPath,$Photo_Name,$Photo_Name_t,$Redirect_Page=LASTREFFPAGE){
    global $db ;
    if($Type == "1"){
    Image_Dell("1",$IDD,$PhotoPath,$Tabel,$Photo_Name,"");
    $server_data = array ($Photo_Name => "");
    $add_server = $db->AutoExecute($Tabel,$server_data,AUTO_UPDATE,"id = $IDD");
    }
    if($Type == "2"){
    Image_Dell("2",$IDD,$PhotoPath,$Tabel,$Photo_Name,$Photo_Name_t);
    $server_data = array ($Photo_Name => "",$Photo_Name_t => "");
    $add_server = $db->AutoExecute($Tabel,$server_data,AUTO_UPDATE,"id = $IDD");
    }
    Redirect_Page_2($Redirect_Page);
} 
#################################################################################################################################
###################################################   PrintUpdateConfigElement
#################################################################################################################################
function PrintUpdateConfigElement($VallOf){
global $AdminLangFile ;
global $db ;
global $ConfigP ;
global $ConfigTabel ;
if(isset($_POST['UpdatePageCount'])){
   if(intval($_POST['page_count']) > '0'){
    $Update = intval($_POST['page_count']);
    $sql = "SELECT * FROM  config_cat  where cat_id = '$ConfigTabel' ";
    $row = $db->H_SelectOneRow($sql);
    $des = $row['des'];
    $des =  unserialize($des);
    $des = replace_key($VallOf['PageCount'],$Update, $des);
    $Data = serialize($des);
    $server_data = array ('des'=> $Data , );
    $add_server = $db->AutoExecute("config_cat",$server_data,AUTO_UPDATE,"cat_id = '$ConfigTabel'");
    Redirect_Page_2(LASTREFFPAGE);
   }
}
echo '<div class="row">';
echo '<form method="post" action="" id="validate-form" data-parsley-validate>';
echo '<div class="col-md-3 col-sm-12 col-xs-12 UpDatePageCount"> ';
echo '<div class="col-md-12 col-sm-12 col-xs-12 "> ';
echo '<input type="text" name="page_count"  value="'.$ConfigP[$VallOf['PageCount']].'" class="unit_count form-control" > ';
echo '<input type="submit" class="btn btn-default " name="UpdatePageCount" value="'.$AdminLangFile['mainform_update'].'" />';
echo '</div>';
echo '</div>';
echo '</form>';
?>
<div class="col-md-4 col-sm-12 col-xs-12 form-group DirRightx">            
<div class="btn-group mb-sm">
<button type="button" class="btn btn-default"><?php echo RterunOrderName($ConfigP[$VallOf['PageOrder']])?></button>
<button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span class="caret"></span></button>
<ul role="menu" class="dropdown-menu">
<?php
for ($i = 1; $i <= count($VallOf['OrderList']); $i++) {
echo '<li><a class="UpdateConfig" id="'.$i.'" type="'.$VallOf['PageOrder'].'" >'.$VallOf['OrderList'][$i].'</a></li><li class="divider"></li> ' ;  
}
if(isset($VallOf['FilterPath'])){
echo '<li><a href="index.php?view='.$VallOf['FilterPath'].'">'.$AdminLangFile[$VallOf['FilterName']].'</a> </li>';    
}
echo '</ul>';
echo '</div>';
echo '</div> ';
echo '</div>';
}
#################################################################################################################################
###################################################   PrintUpdateConfigElement
#################################################################################################################################
function PrintUpdatePageCount($VallOf){
global $AdminLangFile ;
global $db ;
global $ConfigP ;
global $ConfigTabel ;
if(isset($_POST['UpdatePageCount'])){
   if(intval($_POST['page_count']) > '0'){
    $Update = intval($_POST['page_count']);
    $sql = "SELECT * FROM  config_cat  where cat_id = '$ConfigTabel' ";
    $row = $db->H_SelectOneRow($sql);
    $des = $row['des'];
    $des =  unserialize($des);
    $des = replace_key($VallOf['PageCount'],$Update, $des);
    $Data = serialize($des);
    $server_data = array ('des'=> $Data , );
    $add_server = $db->AutoExecute("config_cat",$server_data,AUTO_UPDATE,"cat_id = '$ConfigTabel'");
    Redirect_Page_2(LASTREFFPAGE);
   }
}
echo '<div class="row">';
echo '<form method="post" action="" id="validate-form" data-parsley-validate>';
echo '<div class="col-md-3 col-sm-12 col-xs-12 UpDatePageCount"> ';
echo '<div class="col-md-12 col-sm-12 col-xs-12 "> ';
echo '<input type="text" name="page_count"  value="'.$ConfigP[$VallOf['PageCount']].'" class="unit_count form-control" > ';
echo '<input type="submit" class="btn btn-default " name="UpdatePageCount" value="'.$AdminLangFile['mainform_update'].'" />';
echo '</div>';
echo '</div>';
echo '</form>';
}
#################################################################################################################################
###################################################   CheckAdminMenu
#################################################################################################################################
 function CheckAdminMenu($State) {
   global $ThisMenuIs;
   if($ThisMenuIs == $State) {
     $ct =  "active";
   }else{
    $ct =  "";
   }
   return $ct;
 }
 function CheckAdminMenu2($State) {
   global $ThisMenuIs;
   if($ThisMenuIs == $State) {
     $ct =  "in";
   }else{
    $ct =  "";
   }
   return $ct;
 }
 function CheckAdminMenuLi($State) {
   global $ThisMenuIs_li;
   if($ThisMenuIs_li == $State) {
     $ct =  "active";
   }else{
    $ct =  "";
   }
   return $ct;
 }
 function CheckSelBut($State) {
   global $Short_Menu_Sel;
   if($Short_Menu_Sel == $State) {
     $ct =  "btn_3d-Sell";
   }else{
    $ct =  "";
   }
   return $ct;
 }
 
function CheckSelBut_Sub($State) {
    global $Short_Menu_Sel_Sub;
    if($Short_Menu_Sel_Sub == $State) {
        $ct =  "btn_3d-Sell";
    }else{
        $ct =  "";
    }
    return $ct;
}
 
#################################################################################################################################
###################################################   
#################################################################################################################################
function IffExistingVal($Val){
    if($Val){
        $Val = $Val." ".BR;
    }else{
        $Val = "";
    }
    return $Val ;
}
#################################################################################################################################
###################################################   
#################################################################################################################################
function Update_Left_Menu($CatId){
    global $db ;
$Name = $db->H_SelectOneRow("SELECT * FROM x_admin_menu where cat_id = '$CatId'");
$TheCatIdForMenu = $Name['id'];
$Menu_TabelName = 'x_admin_menu_sub';
$SubMenu = $db->SelArr("SELECT * FROM $Menu_TabelName where cat_id = '$TheCatIdForMenu' ");
for($i = 0; $i < count($SubMenu); $i++) {
$Id = $SubMenu[$i]['id'] ;
$M_Views = $SubMenu[$i]['views'] ;
##########################################   التقارير
Update_Left_Menu_Filde($M_Views,$Id,"LeadSours",F_LEAD_SOURS);
Update_Left_Menu_Filde($M_Views,$Id,"LeadType",F_LEAD_TYPE);
##########################################  ادارة البيانات 
Update_Left_Menu_Filde($M_Views,$Id,"ListLeadSours",F_LEAD_SOURS); 
Update_Left_Menu_Filde($M_Views,$Id,"ListLeadType",F_LEAD_TYPE); 
Update_Left_Menu_Filde($M_Views,$Id,"City",F_CITY_ID); 
Update_Left_Menu_Filde($M_Views,$Id,"Country",F_COUNTRY_ID); 
Update_Left_Menu_Filde($M_Views,$Id,"LeadCat",F_LEAD_CAT); 
Update_Left_Menu_Filde($M_Views,$Id,"ListJop",F_JOP_ID); 
Update_Left_Menu_Filde($M_Views,$Id,"ListSocial",F_SOCIAL_ID); 
Update_Left_Menu_Filde($M_Views,$Id,"ListDate",F_DATE_RECEIPT_ID); 
Update_Left_Menu_Filde($M_Views,$Id,"ListCash",F_CASH_ID); 
Update_Left_Menu_Filde($M_Views,$Id,"ListArea",F_AREA_ID); 
Update_Left_Menu_Filde($M_Views,$Id,"ListTime",F_CALL_TIME_ID); 
Update_Left_Menu_Filde($M_Views,$Id,"ListBestcall",F_BEST_CALL_ID); 
Update_Left_Menu_Filde($M_Views,$Id,"ListUnit",F_UNIT_TYPE_ID); 
Update_Left_Menu_Filde($M_Views,$Id,"ListOpenReason",F_REASON_T_ID); 
} 
}
function Update_Left_Menu_Filde($Menu_Views,$SubMenuId,$ThisView,$State){
    global $db ;    
    $Menu_TabelName = 'x_admin_menu_sub';
    if($Menu_Views  == $ThisView ){
    $server_data = array ('state'=> intval($State) );
    $add_server = $db->AutoExecute($Menu_TabelName, $server_data, AUTO_UPDATE, "id = $SubMenuId");    
    }
}
#################################################################################################################################
###################################################   
#################################################################################################################################
function MakeDirToCopy($DirPath){
   $FolderExist = is_dir($DirPath);
   if($FolderExist == '1'){
   $Gotonext = '1';
   }else{
   $rs = @mkdir($DirPath,0777,true);
   if(!$rs){
   echo 'حدث خطاء اثناء انشاء المجلد';
   $Gotonext = '0';
   }else{
    $Gotonext = '1';
   }
   }
 return $Gotonext ;  
}
function CopyFileFromFolderToFolder($FilePath,$CopyTo) {
   $save_path = $saveto;
   $file = fopen($FilePath,"rb");
   if(!$file) {
     echo "<font color=red>غير قادر على تحميل الملف $url</font><br>";
     $Err = "1";
   } else {
     $filename = basename($FilePath);
     $fc = fopen($CopyTo.$filename,"wb");
     while(!feof($file)) {
       $line = fread($file,1028);
       fwrite($fc,$line);
     }
     fclose($fc);
     $Err = "0";
     return array('Name' => $prefix.$filename,'Err' => $Err);
   }
}
function QtypePrint($TabelData,$Cat_ID,$Style='f_qtypeLi'){
   $Cat_ID = substr($Cat_ID,1, -1);
   $NewCatId =  explode("-",$Cat_ID);
for ($i = 0; $i < count($NewCatId); $i++) {
  if(ADMIN_WEB_LANG == 'En'){$NamePrint = 'name_en' ;  }else{ $NamePrint = 'name' ;}    
  $Print_Name = GetNameFromID($TabelData,$NewCatId[$i],$NamePrint);
  $LinePrin = $LinePrin. '<li class="'.$Style.'">'.$Print_Name.'</li>' ; 
}
   return $LinePrin ; 
}
function GetNameOfLoaction($TableName,$IDD){
    $sql = "SELECT * FROM $TableName where id = '$IDD'";
	$result     = mysql_query($sql);
	$row=	mysql_fetch_array($result);
	$MyResult = array('name'=> $row['name'] ,'name_en'=> $row['name_en']);
    return $MyResult ; 
}
function GetLocationID($ref_id) {
   $sql = "SELECT * FROM f_location where ref_id = '$ref_id'";
   $result = mysql_query($sql);
   $row = mysql_fetch_array($result);
   return $row['id'];
}
#################################################################################################################################
###################################################    UpdateTabelFilde
#################################################################################################################################
function UpdateTabelFilde($Tabel,$Filde,$Val,$IDD){
     global $db ;
     $server_data = array ($Filde => $Val );
     $db->AutoExecute($Tabel,$server_data,AUTO_UPDATE,"id = $IDD");
}
#################################################################################################################################
###################################################    UpdateFildeForDell
#################################################################################################################################
function UpdateFildeForDell($Tabel,$Filde,$Val,$IDD){
    global $db ;
    $server_data = array ($Filde => $Val );
    $db->AutoExecute($Tabel,$server_data,AUTO_UPDATE,"id = $IDD");
}

function ListPostion_File(){
    global  $AdminPath ;
    echo '<script src="'.$AdminPath.'inc/ListPostion/jquery-ui.js"></script>';
    echo '<link href="'.$AdminPath.'inc/ListPostion/style.css" rel="stylesheet" type="text/css" />';
    echo '<script src="'.$AdminPath.'inc/ListPostion/Config.js"></script>  ';
}

#################################################################################################################################
###################################################   GetFileSize
#################################################################################################################################
function GetFileSize ($Path){
    $Size = filesize($Path) ;
    $Val =  FileSizeConvert($Size);
    return $Val;
}
#################################################################################################################################
###################################################   FileSizeConvert 
#################################################################################################################################
function FileSizeConvert($bytes){
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
#################################################################################################################################
###################################################  LoadingDiv
#################################################################################################################################
function LoadingDiv($Arr=""){
echo ' <div class="col-md-12">';  
echo '<div class="wrapxx">';
echo '<div class="loader"></div>';
echo '<div class="loaderbefore"></div>';
echo '<div class="circular"></div>';
echo '<div class="circular another"></div>';
echo '<div class="text">Loading</div>';
echo '</div>';
echo '</div> <div style="clear: both;"></div>';    
}


#################################################################################################################################
###################################################    MainConfigSection
#################################################################################################################################
function MainConfigSection($SectionName,$PhotoS='1',$FunArr=array()){
    global $ALang;
    global $Order_ByList ;
    global $row ;

    $MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" ', 'Dir'=> "En"  ,'OnLine'=> '0');
    $Err[] = NF_PrintInput("TextEdit",$ALang['mainconfig_count_unit_per_page'],"perpage_".$SectionName,"1","1","req",$MoreS);

    $Arr = array("StartFrom" => '1',"Label" => 'on');
    $Err[] = NF_PrintSelect_2018("ArrFrom",$ALang['mainconfig_view_content_by'],"col-md-3","order_".$SectionName,$Order_ByList,"req",$row['order_'.$SectionName],$Arr);

    if($PhotoS == '1'){
        $Arr = array("Label" => 'on',"Active" => '1' );
        $Err[] = NF_PrintSelect_2018("Chosen",$ALang['webconfig_upload_photo_type'],"col-md-3","defphoto_".$SectionName,"config_photo","req",$row["defphoto_".$SectionName],$Arr);
    }
    
    
    NF_PrintRadio_Active ("2_Line","col-md-3",$ALang['mainform_data_tabel'],"datatabel_".$SectionName,$row['datatabel_'.$SectionName]);
    
    $MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" ', 'Dir'=> "En"  ,'OnLine'=> '0');
    $Err[] = NF_PrintInput("TextEdit",$ALang['mainform_data_tabel_max'],"datamax_".$SectionName,"1","1","req",$MoreS);
    
    if(isset($FunArr['ActiveMode'])){
     NF_PrintRadio_Active ("2_Line","col-md-3",$ALang['mainform_active_mode'],"activemode_".$SectionName,$row['activemode_'.$SectionName]); 
    }
    
    
        
}

#################################################################################################################################
###################################################    Add_Google_Seo_Filde
#################################################################################################################################
function Add_Google_Seo_Filde($Type,$Arr=""){
    global $AdminLangFile ;
    global $Err ;

    if($Type == "Edit"){
        $TypeLine = "Edit";
    }else{
        $TypeLine = "" ;
    }
 
    if(isset($Arr['AlertDes'])){
    $AlerDes = $Arr['AlertDes'] ;    
    }else{
    $AlerDes = $AdminLangFile['mainform_seo_h1'];    
    }
    
    echo '<div style="clear: both!important;"></div>'.BR;
    New_Print_Alert("5",$AlerDes);
    echo '<div style="clear: both!important;"></div>'.BR;
    
    if(!isset($Arr['StopUrl'])){
    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
    $Err[] = NF_PrintInput("Text".$TypeLine,$AdminLangFile['mainform_seo_page_url'].ENLANG,"name_m_en","0","0","req",$MoreS);
    
    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
    $Err[] = NF_PrintInput("Text".$TypeLine,$AdminLangFile['mainform_seo_page_url'],"name_m","0","0","req",$MoreS);

    echo '<div style="clear: both!important;"></div> ';
    }

    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-maxlength="'.MAX_GOOGLE_COUNT_PAGE.'"'  ,'Dir'=> "En_Lang");
    $Err[] = NF_PrintInput("Text".$TypeLine,$AdminLangFile['mainform_seo_page_title'].ENLANG,"g_name_en","0","0","req",$MoreS);


    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-maxlength="'.MAX_GOOGLE_COUNT_PAGE.'"' ,'Dir'=> "Ar_Lang");
    $Err[] = NF_PrintInput("Text".$TypeLine,$AdminLangFile['mainform_seo_page_title'],"g_name","0","0","req",$MoreS);

    echo '<div style="clear: both!important;"></div> ';

    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-maxlength="'.MAX_GOOGLE_COUNT_DES.'"'  ,'Dir'=> "En_Lang");
    $Err[] = NF_PrintInput("TextArea".$TypeLine,$AdminLangFile['mainform_seo_description'].ENLANG,"g_des_en","0","0","req",$MoreS);
    
    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-maxlength="'.MAX_GOOGLE_COUNT_DES.'"' ,'Dir'=> "Ar_Lang");
    $Err[] = NF_PrintInput("TextArea".$TypeLine,$AdminLangFile['mainform_seo_description'],"g_des","0","0","req",$MoreS);

    echo '<div style="clear: both!important;"></div> ';

    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-maxlength="'.MAX_GOOGLE_COUNT_META.'"'  ,'Dir'=> "En_Lang");
    $Err[] = NF_PrintInput("TextArea".$TypeLine,$AdminLangFile['mainform_seo_page_keyword'].ENLANG,"g_key_en","0","0","req",$MoreS);
    
    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-maxlength="'.MAX_GOOGLE_COUNT_META.'"' ,'Dir'=> "Ar_Lang");
    $Err[] = NF_PrintInput("TextArea".$TypeLine,$AdminLangFile['mainform_seo_page_keyword'],"g_key","0","0","req",$MoreS);

    return  $Err  ;
}

#################################################################################################################################
###################################################    UpdateLangTableFromOther
#################################################################################################################################
function UpdateLangTableFromOther($SoursT,$SoursCatID,$SubT,$SubCatID,$ThIsIsTest){
    global $pfw_host ; global $pfw_user ; global $pfw_pw ;
    $db_1 = new DB($pfw_host,$pfw_user,$pfw_pw,$SoursT);
    $db_2 = new DB($pfw_host,$pfw_user,$pfw_pw,$SubT);
    $SoursName = $db_1->SelArr("SELECT * FROM x_admin_lang_var  where cat_id = '$SoursCatID' ");
    for($i = 0; $i < count($SoursName); $i++) {
        $CheckVar =  $SoursName[$i]['var'];
        $already = $db_2->H_Total_Count("SELECT * FROM x_admin_lang_var where var = '$CheckVar' and  cat_id = '$SubCatID' ");
        if($already == '0'){
            $server_data = array ('id'=> NULL ,
                'cat_id'=> $SubCatID ,
                'var'=> $SoursName[$i]['var']  ,
                'name'=> $SoursName[$i]['name']  ,
                'name_en'=> $SoursName[$i]['name_en']  ,
                'state'=> "1"  ,
            );
            if($ThIsIsTest == '1'){
                print_r3($server_data);
            }else{
                $db_2->AutoExecute("x_admin_lang_var",$server_data,AUTO_INSERT);
            }
        }
    }
}
#################################################################################################################################
###################################################    AddFildeToTabel
#################################################################################################################################
function AddFildeToTabel($TabelName,$FildName,$FildName_2,$Type,$Count,$Null='1'){
    global $db ;
    if($Null == '1'){
        $PrintNull =  'NOT NULL ';
    }else{
        $PrintNull =  ' NULL ';
    }
    if($Type == 'int'){
        $PrintType = ' int(11) NOT NULL ' ;
    }elseif($Type == 'var'){
        $PrintType = " varchar($Count) collate utf8_unicode_ci $PrintNull ";
    }elseif($Type == 'text'){
        $PrintType = " text collate utf8_unicode_ci $PrintNull ";
    }
    $sql = "ALTER TABLE $TabelName ADD $FildName $PrintType AFTER $FildName_2 " ;
    $db->H_DELETE($sql);
}
#################################################################################################################
############################################# GetCatConfig
#################################################################################################################
function GetCatConfig($ConfigTabel){
    global $db;
    $sql = "SELECT * FROM  config_cat where cat_id = '$ConfigTabel' ";
    $row = $db->H_SelectOneRow($sql);
    $ConfigP  =  unserialize( $row['des']);
    return $ConfigP;
}
#################################################################################################################
############################################# Config_Cat_only
#################################################################################################################
function Config_Cat_only($db){
    global $ConfigTabel;
    $Data = serialize($_POST);
    $server_data = array ('des'=> $Data , );
    $db->AutoExecute("config_cat",$server_data,AUTO_UPDATE,"cat_id = '$ConfigTabel'");
    Redirect_Page_2(LASTREFFPAGE);
}


#################################################################################################################
############################################# CountUnitFun
#################################################################################################################
function CHANGE_Filde($TabelName,$FildName,$Type,$Count="200"){
    global $db ;

    if($Type == 'int'){
        $PrintType = ' int(11) NULL DEFAULT '.$Count ;
    }elseif($Type == 'var'){
        $PrintType = " varchar($Count) collate utf8_unicode_ci NULL DEFAULT NULL ";
    }elseif($Type == 'text'){
        $PrintType = " text collate utf8_unicode_ci NULL DEFAULT NULL";
    }

    $sql = "ALTER TABLE $TabelName MODIFY $FildName $PrintType  ";
    $db->H_DELETE($sql);
}
#################################################################################################################################
###################################################   EmptyFildes
#################################################################################################################################
function EmptyFildes($TabelName,$FildeName,$NewVall="",$Arr=array()){
    global $db ;
    $Name = $db->SelArr("SELECT * FROM $TabelName ");
    for($i = 0; $i < count($Name); $i++) {
        $ThisID = $Name[$i]['id'];
        $server_data = array ($FildeName => $NewVall );
        $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $ThisID");
    }
}
#################################################################################################################################
###################################################   EmptyFildes
#################################################################################################################################
function ClearCol($RowCount,$Def="4"){
    $RowCount = $RowCount+1;
    if($RowCount >=  $Def  ){
        echo '<div style="clear: both!important;"></div>';
        $RowCount = '0' ;
    }
    return $RowCount ;
}




#################################################################################################################
############################################# CountUnitFun
#################################################################################################################
function CountUnitFun(){
    global $CatTabel ;
    global $GroupTabel ;
    global $db ;
    $Name = $db->SelArr("SELECT * FROM $CatTabel ");

    for($i = 0; $i < count($Name); $i++) {
        $TheCat_id  = $Name[$i]['id'];
        $count_unit = $db->H_Total_Count("SELECT * FROM $GroupTabel WHERE cat_id = '$TheCat_id'");
        $count_unit_a = $db->H_Total_Count("SELECT * FROM $GroupTabel WHERE cat_id = '$TheCat_id' and state = 1");
        $server_data = array ('count_unit'=> $count_unit,'count_unit_a'=> $count_unit_a);
        $db->AutoExecute($CatTabel,$server_data,AUTO_UPDATE,"id = $TheCat_id");

    };
}
    
    


 
#################################################################################################################################
###################################################    Module_InCFile
#################################################################################################################################
function Module_InCFile($MyArr=array()){
echo '<script type="text/javascript" src="inc/Jsfile.js"></script>';
echo '<link rel="stylesheet" href="inc/CssFile.css">';
}    








?>