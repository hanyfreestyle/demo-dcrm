<?php
if(!defined('WEB_ROOT')) {	exit;}
 

//// 
OPen_Page($PageTitle);


echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],"AreaAdd","btn-success","fa-plus-circle");
echo '</div></div>';	



$PERpage = $ConfigP['perpage_unit'] ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;
$ThisTabelName = 'project_area';


 
$THESQL = "SELECT * FROM $ThisTabelName $orderby ";
$THELINK = "view=".$view;

 

$already = $db->H_Total_Count($THESQL);
if ($already > 0){



if(ArrIsset($ConfigP,"datatabel",0) != '1'){
$VallOf = array('PageCount' => 'perpage_unit', 'PageOrder' => "order_by_unit" , 'OrderList' => $Order_ByList);
UpdateConfigElement($VallOf);	
}



    
///// Open_Header
$TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'1');
TableOpen_Header($TaBelArr);


Table_TH_Print('1',"ID","50");
Table_TH_Print('1',$AdminLangFile['project_area_name'],"150");
Table_TH_Print(ADMINCPANELLANG,$AdminLangFile['project_area_name'].ENLANG,"150"); 
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
 
echo '<tr>';

Table_TD_Print('1',$Name[$i]['id'],"C");
Table_TD_Print('1',$Name[$i]['name'],"C");
Table_TD_Print(ADMINCPANELLANG,$Name[$i]['name_en'],"C");
Table_TD_Print("1",$Name[$i]['count'],"C",array('OtherStyle'=>"Td_Count"));

Table_TD_Print_Option('1',NF_PrintBut_TD('2',$ALang['mainform_edit'],"EditArea&id=".$id,"btn-info","fa-pencil"),"C");

if($Name[$i]['count'] == '0'){
Table_TD_Print_Option('1',NF_PrintBut_TD('2',$ALang['mainform_delete'],"DellArea&id=".$id,"btn-danger","fa-window-close"),"C");    
}else{
echo '<td align="center"></td>';    
}


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



Close_Page();
?>
