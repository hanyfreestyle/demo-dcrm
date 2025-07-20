<?php
if(!defined('WEB_ROOT')) {	exit;}
 


######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

 
echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],"PageAdd","btn-success","fa-plus-circle");
echo '</div></div>';	


$ThisTabelName = "landpage";
$PERpage = $ConfigP['perpage_unit'] ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;
$THESQL = "SELECT * FROM $ThisTabelName $orderby ";
$THELINK = "view=".$view;



$already = $db->H_Total_Count($THESQL);
if ($already > 0){


///// Open_Header
$TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'1');
TableOpen_Header($TaBelArr);


 
 

 
echo '<th width="30">ID</th>';
echo '<th width="200">'.$AdminLangFile['lppage_page_name'].'</th>';
echo '<th width="200">'.$AdminLangFile['lppage_page_name'].ENLANG.'</th>';
echo '<th width="200">'.$AdminLangFile['lppage_campaign'].'</th>';
echo '<th width="50"></th>';
echo '<th width="50"></th>';
echo '<th width="50"></th>';
echo '<th width="50"></th>';
echo '<th width="50"></th>';
echo '<th width="50"></th>';
echo '<th width="50" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';
echo '<th width="50"></th>';

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
$LeadCat = GetNameFromID("config_data",$Name[$i]['lead_cat'],$NamePrint);

if ( $Name[$i]['photo_t'] ) {
$photo = F_PATH_V . $Name[$i]['photo_t'];
} else {
$photo = $AdminNoPhoto;
}

echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.$Name[$i]['name'].'</td>';
echo '<td>'.$Name[$i]['name_en'].'</td>';
echo '<td>'.$LeadCat.'</td>';
echo '<td><img src="'.$photo.'" class="thumbCatview"/></td>';
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_edit'],"PageEdit&id=".$id,"btn-info","fa-pencil").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['lppage_view_content'],"ViewBlock&id=".$id,"btn-info","fa-search").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['lppage_order_block'],"OrderBlock&id=".$id,"btn-info","fa-sort-amount-desc").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_delete'],"PageDell&id=".$id,"btn-danger","fa-window-close").'</td>';    

 
echo '<td align="center">'.CheckUnitState($Name[$i]['state']).'</td>';
echo '<td align="center">'.PrintCheckBox_New($id).'</td>'; 
$ViewUrl = WEB_ROOT."lp/".$Name[$i]['name_m'] ;
echo '<td align="center">'.NF_PrintBut_TD('Full_Url',$AdminLangFile['lppage_view_url'],$ViewUrl,"btn-warning","fa-eye-slash","1").'</td>';
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
