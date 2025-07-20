<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$ConfigP['datatabel'] = "0";



$SectionName = "leads";
$ThisTabelName = "c_leads";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;





$ThisTabel = "landpage_data";
$THESQL = "SELECT * FROM  $ThisTabel where state = '$DataState' " ;
$THELINK = "view=".$view;



$already = $db->H_Total_Count($THESQL);
if($already > 0) {
if(isset($_POST['DelUnit'])) {
	if($USER_PERMATION_Dell == '1') {
	   if(isset($_POST['id_id'])){
	    DelUnit_New($ThisTabel);   
	   }
	} else {
		SendMassgeforuser();
	}
}
 
if(isset($_POST['Transfer'])) {
    if($USER_PERMATION_Edit == '1') {
        if( !isset($_POST['id_id'])  ){
        SendJavaErrMass($AdminLangFile['leads_err_sel_content']);
        }else{
        Transfer_Leads_Google();
        }
    }else{
    SendMassgeforuser();
    }
}




if($view == "ExportLanding"){
echo '<div id="ErrMass" class="ErrMass_Div"></div>';    
echo '<form name="myform" action="LandingPage_ExportPage.php" method="post">';    
}else{
echo '<div id="ErrMass" class="ErrMass_Div"></div>';    
echo '<form name="myform" action="#" method="post">';    
}

echo '<input type="hidden" name="user_id" value="'.$RowUsreInfo['user_id'].'" />';

echo '<div class="row PanelMin TopButAction"><div class="col-md-12">';
echo '<button type="submit"  name="DelUnit" class="mb-sm btn btn-danger">'.$AdminLangFile['mainform_delete'].'</button> ';
echo '<button type="submit"  name="Transfer" class="mb-sm btn btn-primary">'.$AdminLangFile['lppage_transfer_data'].'</button> ';
echo '</div> </div><div style="clear: both;"></div>';   

  
    
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
echo '<table id="MyCustmer" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
echo '<thead><tr>';  
}else{
echo '<div class="panel panel-default"><div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead><tr>';
}
echo '<th width="50">'.$AdminLangFile['lppage_date_add'].'</th>';
echo '<th width="100">'.$AdminLangFile['lppage_campaign'].'</th>';    
echo '<th width="200">'.$AdminLangFile['lppage_customer_data'].'</th>';
echo '<th width="200">'.$AdminLangFile['lppage_lead_info'].'</th>';
echo '<th width="50" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';

echo '</tr></thead><tbody>'; 
   
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
echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>';

if( F_LEAD_CAT  == 1){
$LeadCat = findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$Name[$i]['lead_cat'],$NamePrint);
echo '<td>'.$LeadCat.'</td>';   
}

echo '<td>';
echo $Name[$i]['name'].BR;
echo $Name[$i]['mobile'].BR;
echo $Name[$i]['email'].BR;
echo PrintFildIf($Name[$i]['notes']);
echo '</td>';

echo '<td>';
 

$LeadSours = findValue_FromArr($T_ARRAY_LEAD_SOURS,"id",$Name[$i]['lead_sours'],$NamePrint);
$location_idN = findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$Name[$i]['district_id'],$NamePrint);
$Project_Name = GetNameFromID_ForLoaction("f_location",$Name[$i]['project_id'],$NamePrint);
$service_typeN = findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$Name[$i]['service_type_id'],$NamePrint);
$unit_typeN = findValue_FromArr($T_ARRAY_CONFIG_DATA,"id",$Name[$i]['unit_type'],$NamePrint);

echo PrintFildIf($LeadSours);
echo PrintFildIf($location_idN);
echo PrintFildIf($Project_Name);
echo PrintFildIf($service_typeN);
echo PrintFildIf($unit_typeN);

echo PrintFildIf($Name[$i]['f_type']);
echo PrintFildIf($Name[$i]['f_ip']);
echo PrintFildIf($Name[$i]['f_country']);
echo PrintFildIf($Name[$i]['f_city']);
echo PrintFildIf($Name[$i]['f_url']);

echo '</td>';

echo '<td align="center">'.PrintCheckBox_New($id).'</td>'; 
echo '</tr>';

} 
}

///// Close    
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
echo '</tbody></table>';  
}else{
echo '</tbody></table></div></div>';
echo '<div class="col-md-12 col-sm-12 col-xs-12">';
echo $db->pager;
echo '</div>';
}
echo '</form>';


}else{ 
Alert_NO_Content();         
}



###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
 