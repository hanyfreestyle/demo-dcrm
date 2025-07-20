<?php
if(!defined('WEB_ROOT')) {	exit;}
 
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],"PhotoSizeAdd","btn-success","fa-plus-circle");
echo '</div></div>';	



$PERpage = "20" ;
$orderby = "" ;
$ThisTabelName = 'config_photo';


 
$THESQL = "SELECT * FROM $ThisTabelName $orderby ";
$THELINK = "view=".$view;



if(isset($_POST['DellPhotoSize'])) {
    if($USER_PERMATION_Edit == '1') {
        DellPhotoSizeF($ThisTabelName);
    } else {
        SendMassgeforuser();
    }
}


$already = $db->H_Total_Count($THESQL);
if ($already > 0){

 
   
///// Open_Header

$AddBut = '<button type="submit"  name="DellPhotoSize" class="mb-sm btn btn-danger">'.$AdminLangFile['mainform_delete'].'</button> ';
$TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'1','AddBut'=> $AddBut);
TableOpen_Header($TaBelArr);


Table_TH_Print('1',"ID","50");
Table_TH_Print('1',$AdminLangFile['webconfig_photo_size_name'],"150");
Table_TH_Print('1',$ALang['webconfig_t_photo'],"200");
Table_TH_Print('1',$ALang['webconfig_t_thumbnail'],"200");
Table_TH_Print('1',"","100");
Table_TH_Print('1',"","30");
 
Table_TH_Print('1',"","30");
echo '<th width="30" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';

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
$PhotoD = WhatWillWeDoText($Name[$i]['resize_p']).BR ;
$PhotoD .= $Name[$i]['width']." X ".$Name[$i]['height'] ;

$PhotoDT = WhatWillWeDoText($Name[$i]['resize_t']).BR ;
$PhotoDT .= $Name[$i]['width_t']." X ".$Name[$i]['height_t'] ;

echo '<tr>';

Table_TD_Print('1',$Name[$i]['id'],"C");
Table_TD_Print('1',$Name[$i]['name'],"C");
Table_TD_Print('1',$PhotoD,"C");
Table_TD_Print('1',$PhotoDT,"C");

$ArrPhoto = array("Path"=> WATERMARK_IMAGE_DIR_V,"NewStyle"=>"PngPhotoTh");
Table_TD_Print_Photo("1",$Name[$i]['photo'],"C",$ArrPhoto);

Table_TD_Print_Option('1',NF_PrintBut_TD('2',$ALang['mainform_edit'],"PhotoSizeEdit&id=".$id,"btn-info","fa-pencil"),"C");
 

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