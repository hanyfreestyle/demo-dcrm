<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$SectionName = "leads";
$ThisTabelName = "c_leads";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;



if($view == "DeleteRepeatLeads"){
$THESQL = "SELECT * FROM c_leads where ch_2 = '0' $orderby ";
$THELINK = "view=".$view;
}else{
$THESQL = "SELECT * FROM c_leads where cust = '$CustType' $orderby ";
$THELINK = "view=".$view;
}

$already = $db->H_Total_Count($THESQL);
if ($already > 0){


$VallOf_Arr = array('PageCount' => 'perpage_'.$SectionName, 'PageOrder' => "order_".$SectionName , 'OrderList' => $Order_ByList);
ConfigElement_UpdateAjex($VallOf_Arr);


ReportBlockPrint("col-md-3",$AdminLangFile['report_totalcount'],$already,"fa-hdd-o","alert-inverse");
echo '<div style="clear: both!important;"></div> ';          
        
if(isset($_POST['DelUnit'])) {
	if($USER_PERMATION_Dell == '1') {
    if(isset($_POST['id_id']) and count($_POST['id_id']) > '0'){
         DelUnit_New("c_leads");
         Redirect_Page_2(LASTREFFPAGE);
    }
	} else {
		SendMassgeforuser();
	}
}

 
echo '<div id="ErrMass" class="ErrMass_Div"></div> ';
echo '<form name="myform" action="#" id="validate-form" data-parsley-validate method="post">';


echo '<div class="row PanelMin TopButAction"><div class="col-md-12">';
echo '<button type="submit"  name="DelUnit" class="mb-sm btn btn-danger">'.$AdminLangFile['mainform_delete'].'</button> ';
echo '</div> </div><div style="clear: both;"></div>';




echo '<div style="clear: both!important;"></div>';
echo '<div class="panel panel-default"><div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel"><thead><tr>';


Table_TH_Print('1',"ID","40");
Table_TH_Print("1",$ALang['leads_date_add'],"100");
Table_TH_Print(F_LEAD_TYPE,$ALang['customer_lead_type'],"100");
Table_TH_Print(F_LEAD_SOURS,$ALang['customer_lead_sours'],"100");
Table_TH_Print(F_LEAD_CAT,$ALang['hotline_ad_campaign'],"100"); 
Table_TH_Print("1",$ALang['leads_c_data'],"150");
Table_TH_Print("1",$ALang['leads_add_user'],"70");
Table_TH_Print('1','<input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)">',"20");

echo '</tr></thead><tbody>';

$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5);
for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];



$LeadSours = GetNameFromID("fs_lead_sours",$Name[$i]['lead_sours'],$NamePrint);
$LeadCat = GetNameFromID("config_data",$Name[$i]['lead_cat'],$NamePrint);
echo '<tr>';
echo '<td align="center">'.$Name[$i]['id'].'</td>';
echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>';

if( F_LEAD_TYPE  == 1){
$LeadType = GetNameFromID("fs_lead_type",$Name[$i]['lead_type'],$NamePrint);    
echo '<td>'.$LeadType.'</td>';     
}

if( F_LEAD_SOURS  == 1){
$LeadSours = GetNameFromID("fs_lead_sours",$Name[$i]['lead_sours'],$NamePrint);    
echo '<td>'.$LeadSours.'</td>';     
}

if( F_LEAD_CAT  == 1){
$LeadCat = GetNameFromID("config_data",$Name[$i]['lead_cat'],$NamePrint);    
echo '<td>'.$LeadCat.'</td>';     
}


echo '<td>';
echo $Name[$i]['name'].BR ;
echo $Name[$i]['mobile'].BR ;
echo  IffExistingVal($Name[$i]['mobile_2']);
echo  IffExistingVal($Name[$i]['phone']);
echo  IffExistingVal($Name[$i]['email']);

if($Name[$i]['notes']){
echo '<div class="td_line"></div>';
echo $Name[$i]['notes'];    
}
echo '</td>';

 

 
if($Name[$i]['user_id'] == "0"){
echo '<td></td>';     
}else{
$EmpnName =  GetNameFromID_User("tbl_user",$Name[$i]['user_id'],"name") ; 
echo '<td>'.$EmpnName.'</td>'; 
}

Table_TD_Print('1',PrintCheckBox_New($Name[$i]['id']),"C");




echo '</tr>';
}
}

echo '</tbody></table></div></div></form>';
echo '<div class="col-md-12 col-sm-12 col-xs-12">';
echo $db->pager;
echo '</div>';

}else{
Alert_NO_Content();
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>
