<?php
if(!defined('WEB_ROOT')) {	exit;}


######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$SectionName = "meta";
$SectionLink = "MetaTag";
$ThisTabelName = "config_meta";


$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$UpdateConfig = '1'; 
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$THESQL = "SELECT * FROM $ThisTabelName $orderby ";
$THELINK = "view=".$view;

$already = $db->H_Total_Count($THESQL);

echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],$SectionLink."Add","btn-success","fa-plus-circle");
echo '</div></div>';


if ($already > 0){

if($ConfigP['datatabel'] != '1' and $UpdateConfig == '1'){
$VallOf = array('PageCount' => 'perpage_'.$SectionName, 'PageOrder' => "order_".$SectionName , 'OrderList' => $Order_ByList);
UpdateConfigElement($VallOf);	
}


///// Open_Header
$TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'0');
TableOpen_Header($TaBelArr);


Table_TH_Print('1',"ID","30");
Table_TH_Print('1',$AdminLangFile['webconfig_meta_catid'],"50");
Table_TH_Print('1',$AdminLangFile['webconfig_meta_page_title'],"150");
Table_TH_Print('1',$AdminLangFile['webconfig_meta_page_description'],"200");
Table_TH_Print('1',"","30");
Table_TH_Print('1',"","30");


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

 

$GName = $Name[$i]['g_name_en'].BR.$Name[$i]['g_name'] ;
$GDes = $Name[$i]['g_des_en'].BR.$Name[$i]['g_des'] ;

echo '<tr>';
Table_TD_Print('1',$Name[$i]['id'],"C");

Table_TD_Print('1',$Name[$i]['cat_id'],"C");
Table_TD_Print('1',$GName,"C");
Table_TD_Print('1',$GDes,"L");
 
Table_TD_Print_Option('1',NF_PrintBut_TD('2',$ALang['mainform_edit'],$SectionLink."Edit&id=".$id,"btn-info","fa-pencil"),"C");

Table_TD_Print_Option('1',NF_PrintBut_TD('2',$ALang['mainform_delete'],$SectionLink."Dell&id=".$id,"btn-danger","fa-window-close"),"C");

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
