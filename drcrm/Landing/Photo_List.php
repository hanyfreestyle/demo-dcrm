<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
 

echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],"AddPhoto","btn-success","fa-plus-circle");
echo '</div></div>';	


 

$PERpage = $ConfigP['perpage_photo'] ;
$orderby = RterunOrder($ConfigP['order_by_photo']) ;
$ThisTabelName = 'landpage_photo';



if(isset($_GET['Cat_id'])){
    $CatId = intval($_GET['Cat_id']);
    $THESQL = "SELECT * FROM $ThisTabelName where cat_id = $CatId  $orderby ";
    $THELINK = "view=".$view."&Cat_id=".$CatId;
}else{
    $THESQL = "SELECT * FROM $ThisTabelName  $orderby ";
    $THELINK = "view=".$view;
}


$already = $db->H_Total_Count($THESQL);
if ($already > 0){

if($ConfigP['datatabel'] != '1'){
$VallOf = array('PageCount' => 'perpage_photo', 'PageOrder' => "order_by_photo" , 'OrderList' => $Order_ByList);
UpdateConfigElement($VallOf);	
}



///// Open_Header
$TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'1');
TableOpen_Header($TaBelArr);

Table_TH_Print('1',"ID","50");
Table_TH_Print('1',$AdminLangFile['lppage_photo_name'],"150");
Table_TH_Print(ADMINCPANELLANG,$AdminLangFile['lppage_photo_name'].ENLANG,"150"); 
Table_TH_Print('1',$AdminLangFile['lppage_cat_name'],"100");  

Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50"); 
 
echo '<th width="50" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';

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

$ThECatId = $Name[$i]['cat_id'] ;

if ( $Name[$i]['photo_t'] ) {
$photo = F_PATH_V . $Name[$i]['photo_t'];
} else {
$photo = $AdminNoPhoto;
}

echo '<tr>';

Table_TD_Print('1',$Name[$i]['id'],"C");
Table_TD_Print('1',$Name[$i]['name'],"C");
Table_TD_Print(ADMINCPANELLANG,$Name[$i]['name_en'],"C");

$LeadCat = GetNameFromID("landpage_photo_cat",$Name[$i]['cat_id'],$NamePrint);
Table_TD_Print('1','<a href="index.php?view=PhotoList&Cat_id='.$ThECatId.'">'.$LeadCat.'</a>',"C");

Table_TD_Print_Photo("1",$Name[$i]['photo_t'],"C");  

echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_edit'],"PhotoEdit&id=".$id,"btn-info","fa-pencil").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['lppage_order_block'],"OrderPhoto&id=".$ThECatId,"btn-info","fa-sort-amount-desc").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('autodelete_2',$AdminLangFile['mainform_delete'],$id,"","").'</td>';   
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
 