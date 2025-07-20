<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],"PhotoCatAdd","btn-success","fa-plus-circle");
echo '</div></div>';	




$PERpage = $ConfigP['perpage_unit'] ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;
$ThisTabelName = 'landpage_photo_cat';
$THESQL = "SELECT * FROM $ThisTabelName $orderby ";
$THELINK = "view=".$view;

$already = $db->H_Total_Count($THESQL);
 
if ($already > 0){

if($ConfigP['datatabel'] != '1'){
$VallOf = array('PageCount' => 'perpage_unit', 'PageOrder' => "order_by_unit" , 'OrderList' => $Order_ByList);
UpdateConfigElement($VallOf);	
}


///// Open_Header
$TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'1');
TableOpen_Header($TaBelArr);


Table_TH_Print('1',"ID","50");
Table_TH_Print('1',$AdminLangFile['lppage_cat_name'],"150");
Table_TH_Print(ADMINCPANELLANG,$AdminLangFile['lppage_cat_name'].ENLANG,"150"); 
Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");
echo '<th width="50"><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';

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

echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.$Name[$i]['name'].'</td>';
echo '<td>'.$Name[$i]['name_en'].'</td>';

echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_edit'],"PhotoCatEdit&id=".$id,"btn-info","fa-pencil").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['lppage_view_content'],"PhotoList&Cat_id=".$id,"btn-info","fa-search").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['lppage_order_block'],"OrderPhoto&id=".$id,"btn-info","fa-sort-amount-desc").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_delete'],"PhotoCatDell&id=".$id,"btn-danger","fa-window-close").'</td>';    

echo '<td align="center">'.CheckUnitState($Name[$i]['state']).'</td>';
echo '<td align="center">'.PrintCheckBox_New($id).'</td>'; 
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
