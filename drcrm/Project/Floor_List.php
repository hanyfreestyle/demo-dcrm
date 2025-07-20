<?php
if(!defined('WEB_ROOT')) {	exit;}
 


######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id","project","2");
$id = $row['id'];
 
 

 
echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],"Floor_Add&id=".$id,"btn-success","fa-plus-circle");
echo '</div></div>';
$PERpage = "50" ;
$THESQL = "SELECT * FROM project_floor where pro_id = '$id' order by f_code ";
$THELINK = "view=Floor_List";
$already = $db->H_Total_Count($THESQL);

if ($already > 0){
    
///// Open_Header
$TaBelArr = array('Tabel'=>"","But"=>'0');
TableOpen_Header($TaBelArr);    



Table_TH_Print('1',"ID","50");
Table_TH_Print('1',$ALang['project_pro_name'],"150");
Table_TH_Print('1',$ALang['project_floor_name'],"150");
Table_TH_Print('1',$ALang['project_floor_code'],"100");
Table_TH_Print('1',$ALang['project_unit_count'],"50"); 
Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50"); 

///// TableClose_Header
TableClose_Header();

$ProjectName_Arr = $db->SelArr("SELECT id,name,name_en FROM project");

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


$ProjectName = findValue_FromArr($ProjectName_Arr,'id',$Name[$i]['pro_id'],$NamePrint);
echo '<td>'.$ProjectName.'</td>';

echo '<td>'.$Name[$i][$NamePrint].'</td>';
Table_TD_Print("1",$Name[$i]['f_code'],"C",array('OtherStyle'=>"Td_Count"));
Table_TD_Print("1",$Name[$i]['unit'],"C",array('OtherStyle'=>"Td_Count"));

 
if($Name[$i]['state'] == '0'){
Table_TD_Print('1',NF_PrintBut_TD('1',$ALang['project_active_unit'],"UnitActive&FloorId=".$id,"btn-danger","fa-exclamation-triangle"),"C");    
Table_TD_Print('1',NF_PrintBut_TD('2',$ALang['mainform_delete'],"FloorDell&id=".$id,"btn-danger","fa-window-close"),"C");    
}else{
echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['project_list_unit'],"UnitList&Floor_Id=".$id,"btn-success","fa-list").'</td>';
echo '<td align="center"></td>';  
}
Table_TD_Print('1',NF_PrintBut_TD('2',$ALang['mainform_edit'],"FloorEdit&id=".$id,"btn-info","fa-pencil"),"C"); 

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
 