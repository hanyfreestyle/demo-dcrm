<?php
if(!defined('WEB_ROOT')) {	exit;}
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

 
 

$PERpage = $ConfigP['perpage_unit'] ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;

#################################################################################################################################
###################################################    
#################################################################################################################################
if($view == 'Reservation_List'){
    $PageView = 'Reservation_List';
    if(isset($_GET['Pro_Id'])){
        $Pro_Id = intval($_GET['Pro_Id']);
        $THESQL = "SELECT * FROM reservation where type = '$Reservation_type' and state = '$Reservation_S' and pro_id = '$Pro_Id' $orderby ";
        $THELINK = "view=Reservation_List&Pro_Id=".$Pro_Id;
    }else{
        $THESQL = "SELECT * FROM reservation where type = '$Reservation_type' and state = '$Reservation_S' $orderby ";
        $THELINK = "view=Reservation_List";
    }
}elseif($view == 'Canceled'  ){
    $PageView = 'Canceled';
    if(isset($_GET['Pro_Id'])){
        $Pro_Id = intval($_GET['Pro_Id']);
        $THESQL = "SELECT * FROM reservation where type = '$Reservation_type' and state = '$Reservation_S' and pro_id = '$Pro_Id' $orderby ";
        $THELINK = "view=Canceled&Pro_Id=".$Pro_Id;
    }else{
        $THESQL = "SELECT * FROM reservation where type = '$Reservation_type' and state = '$Reservation_S' $orderby ";
        $THELINK = "view=Canceled";
    }
}elseif($view == 'Contract' ){
    $PageView = 'Contract';
    if(isset($_GET['Pro_Id'])){
        $Pro_Id = intval($_GET['Pro_Id']);
        $THESQL = "SELECT * FROM reservation where type = '$Reservation_type' and state = '$Reservation_S' and pro_id = '$Pro_Id' $orderby ";
        $THELINK = "view=Contract&Pro_Id=".$Pro_Id;
    }elseif(isset($_GET['Floor_Id'])){
        $Floor_Id = intval($_GET['Floor_Id']);
        $THESQL = "SELECT * FROM reservation where type = '$Reservation_type' and state = '$Reservation_S' and floor_id = '$Floor_Id' $orderby ";
        $THELINK = "view=Contract&Floor_Id=".$Floor_Id;
    }else{
        $THESQL = "SELECT * FROM reservation where type = '$Reservation_type' and state = '$Reservation_S' $orderby ";
        $THELINK = "view=Contract";
    }
}elseif($view == 'ContractD' ){
    $PageView = 'Contract';
    if(isset($_GET['Pro_Id'])){
        $Pro_Id = intval($_GET['Pro_Id']);
        $THESQL = "SELECT * FROM reservation where type = '$Reservation_type' and state = '$Reservation_S' and pro_id = '$Pro_Id' $orderby ";
        $THELINK = "view=ContractD&Pro_Id=".$Pro_Id;
    }else{
        $THESQL = "SELECT * FROM reservation where type = '$Reservation_type' and state = '$Reservation_S' $orderby ";
        $THELINK = "view=ContractD";
    }
}


#################################################################################################################################
###################################################    Tabel View
#################################################################################################################################
$already = $db->H_Total_Count($THESQL);
if ($already > 0){
    
    
///// Open_Header
TableOpen_Header();
 
echo '<th width="30">ID</th>';
echo '<th width="150">'.$AdminLangFile['project_pro_name'].'</th>';
echo '<th width="80">'.$AdminLangFile['project_floor_name'].'</th>';
echo '<th width="60">'.$AdminLangFile['project_new_unit_code'].'</th>';
echo '<th width="60">'.$AdminLangFile['project_new_unit_num'].'</th>';
echo '<th width="200">'.$AdminLangFile['contract_cust_id'].'</th>';
echo '<th width="100">'.$AdminLangFile['contract_emp_id'].'</th>';

if($view == 'Reservation_List'){
echo '<th width="80">'.$AdminLangFile['contract_rev_date'].'</th>';
echo '<th width="80">'.$AdminLangFile['contract_cont_date'].'</th>';   
}

if($view == 'Canceled'){
echo '<th width="80">'.$AdminLangFile['contract_rev_date'].'</th>';
echo '<th width="80">'.$AdminLangFile['contract_canceled_date'].'</th>';   
}

if($view == 'Contract' ){
echo '<th width="80">'.$AdminLangFile['contract_contract_date'].'</th>'; 
}

if($view == 'ContractD'){
echo '<th width="80">'.$AdminLangFile['contract_dell_date'].'</th>'; 
}

echo '<th width="50"></th>';

if($view == 'Contract' and $AdminConfig['admin'] == '1' ){
echo '<th width="50"></th>';
}

///// TableClose_Header
TableClose_Header(); 
 
 
   
$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
$Name = $db->SelArr($THESQL);
}else{
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
}


for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];
$ProId =  $Name[$i]['pro_id'];
$ProjectCode = GetNameFromID("project",$Name[$i]['pro_id'],"pro_code");

echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td><a href="index.php?view='.$PageView.'&Pro_Id='.$ProId.'">'.$Name[$i]['pro_name'].'</a></td>';

if($view == 'Contract'){
echo '<td><a href="index.php?view=Contract&Floor_Id='.$Name[$i]['floor_id'].'">'.$Name[$i]['floor_name'].'</a></td>';    
}else{
echo '<td>'.$Name[$i]['floor_name'].'</td>';    
}    

echo '<td>'.$ProjectCode.$Name[$i]['unit_name'].'</td>';
echo '<td>'.GetNameFromID("project_unit",$Name[$i]['unit_id'],"u_num").'</td>';
 
echo '<td>';
echo GetNameFromID ("customer",$Name[$i]['cust_id'],"name");
if($Name[$i]['cust2_id'] != '0'){
echo BR. GetNameFromID ("customer",$Name[$i]['cust2_id'],"name");    
}
if($Name[$i]['cust3_id'] != '0'){
echo BR. GetNameFromID ("customer",$Name[$i]['cust3_id'],"name");    
}
echo '</td>';


echo '<td>'.GetNameFromID_User("tbl_user",$Name[$i]['emp_id'],"name").'</td>';

if($view == 'Reservation_List'){
echo '<td>'.ConvertDateToCalender_2($Name[$i]['rev_date']).'</td>';
echo '<td>'.ConvertDateToCalender_2($Name[$i]['cont_date']).'</td>';
}

if($view == 'Canceled'){
echo '<td>'.ConvertDateToCalender_2($Name[$i]['rev_date']).'</td>';
echo '<td>'.ConvertDateToCalender_2($Name[$i]['new_date']).'</td>'; 
}

if($view == 'Contract'){
echo '<td>'.ConvertDateToCalender_2($Name[$i]['new_date']).'</td>'; 
}


if($view == 'ContractD'){
echo '<td>'.ConvertDateToCalender_2($Name[$i]['dell_date']).'</td>';
}


echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['contract_view_form'],"Reservation_View&id=".$id,"btn-info","fa-search").'</td>';

if($view == 'Contract' and $AdminConfig['admin'] == '1' ){

echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['contract_con_dell_but'],"ContractDell&id=".$id,"btn-danger","fa-window-close").'</td>';  
}


echo '</tr>';
} 
}
	
///// CloseTabel   
CloseTabel(); 
 
 
}else{ 
Alert_NO_Content();         
}




######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 