<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



if(isset($_GET['Project_Id'])){
$PERpage = "30";
$orderby ="";

if(isset($_GET['Project_Id'])){
    $row = $db->H_CheckTheGet("Project_Id","id","project","2");
    $Pro_ID = $row['id'];
  $THESQL = "SELECT * FROM project_price where pro_id = '$Pro_ID' $orderby";
  $THELINK = "view=Price_List&Project_Id=".$Pro_ID;
  
 
}else{
  $THESQL = "SELECT * FROM project_price $orderby ";
  $THELINK = "view=List";
    
}


 
$already = $db->H_Total_Count($THESQL);
if ($already > 0){

echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],"Price_Add","btn-success","fa-plus-circle");
echo '</div></div>';



///// Open_Header

TableOpen_Header();


Table_TH_Print('1',"ID","50");
Table_TH_Print('1',$ALang['pro_price_last_update_d'],"100");
Table_TH_Print('1',$ALang['project_pro_name'],"100");
Table_TH_Print('1',$ALang['pro_price_tabel_name'],"100");

Table_TH_Print('1',$ALang['pro_price_total_price'],"100");
Table_TH_Print('1',$ALang['pro_price_contract_price'],"100");
Table_TH_Print('1',$ALang['pro_price_monthly_price'],"100");
Table_TH_Print('1',$ALang['pro_price_primary_receipt'],"100");
Table_TH_Print('1',$ALang['pro_price_final_receipt'],"100");

Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");
 
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
 
$ProjectName = GetNameFromID("project",$Name[$i]['pro_id'],"name") ;

echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.ConvertDateToCalender_2($Name[$i]['last_date']).'</td>';
echo '<td>'.$ProjectName.'</td>';
echo '<td>'.$Name[$i][$NamePrint].'</td>';
Table_TD_Print("1",number_format($Name[$i]['total_price']),"C",array('OtherStyle'=>"Td_Count"));
Table_TD_Print("1",number_format($Name[$i]['contract_price']),"C",array('OtherStyle'=>"Td_Count"));
Table_TD_Print("1",number_format($Name[$i]['monthly_price']),"C",array('OtherStyle'=>"Td_Count"));

echo '<td>'.ConvertDateToCalender_2($Name[$i]['st_date']).'</td>';
echo '<td>'.ConvertDateToCalender_2($Name[$i]['end_date']).'</td>';
echo '<td>'.$Name[$i]['count'].'</td>';
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_edit'],"Price_Edit&id=".$id,"btn-info","fa-pencil").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_delete'],"Price_Dell&id=".$id,"btn-danger","fa-window-close").'</td>';
} 
}
echo '</tr>';

CloseTabel();

}else{
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';        
}


echo '<div style="clear: both!important;"></div>';

}else{
    echo '<div class="AddRoutineCatIDD">';
    $ArrForm = array('FormName'=> 'country_city');
    Form_Open($ArrForm);
    $Arr = array("Label" => 'off' );
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['project_pro_name'],"col-md-4","pro_id","project","req",0,$Arr);
    Form_Close('4');
    if(isset($_POST['B1'])){
        Redirect_Page_2('index.php?view=Price_List&Project_Id='.$_POST['pro_id']);
    }
    echo '</div>';
}


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 