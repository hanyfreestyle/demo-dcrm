<?php

$ConfigP['datatabel'] = '0';


$already = $db->H_Total_Count($THESQL);
if ($already > 0){

$SalesUserArr = $db->SelArr("SELECT user_id,name FROM tbl_user where sales = '1' and state = '1' ");

$VallOf_Arr = array('PageCount' => 'perpage_'.$SectionName, 'PageOrder' => "order_".$SectionName , 'OrderList' => $Order_ByList);
ConfigElement_UpdateAjex($VallOf_Arr);



echo '<div id="ErrMass" class="ErrMass_Div"></div> ';
echo '<form name="myform" action="#" id="validate-form" data-parsley-validate method="post">';


#################################################################################################################################
###################################################   List 
#################################################################################################################################
if($view == 'List'){
echo BR.'<div class="row PanelMin TopButAction"><div class="">';

$Arr = array("Label" => "off","Active" => '1','Order'=> "order by name desc" ,'OtherIdd' => 'user_id', "Filter_Filde"=> "sales" , "Filter_Vall"=> "1" );
$Err[] = NF_PrintSelect_2018("Chosen",$ALang['leads_emp'],"col-md-3","user_id","tbl_user","req","0",$Arr);
    
echo '<button type="submit"  name="AddCustFromLeads" class="mb-sm btn btn-success MMR_10">'.$AdminLangFile['leads_add_to_sales'].'</button>';
echo '</div> </div><div style="clear: both;"></div>';      
}


echo '<div style="clear: both!important;"></div>';
echo '<div class="panel panel-default">';
echo '<div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead>';
echo '<tr>';

Table_TH_Print('1',"ID","40");
Table_TH_Print("1",$ALang['leads_date_add'],"100");
Table_TH_Print(F_LEAD_TYPE,$ALang['customer_lead_type'],"100");
Table_TH_Print(F_LEAD_SOURS,$ALang['customer_lead_sours'],"100");
Table_TH_Print(F_LEAD_CAT,$ALang['hotline_ad_campaign'],"100"); 
Table_TH_Print("1",$ALang['leads_c_data'],"150");
Table_TH_Print("1",$ALang['leads_add_user'],"70");
Table_TH_Print('1',"","40");
 

if($view == 'List'){
echo '<th class="TD_20">';
echo '<input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)">';
echo '</th>';
}else{
echo '<th class="TD_20"></th>';
echo '<th class="TD_20"></th>';    
}

echo '</tr></thead><tbody>';


$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
for($i = 0; $i < count($Name); $i++) {
  
$id = $Name[$i]['id'];  
 

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
 
//echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_delete'],"DellLead&id=".$id,"btn-danger","fa-window-close").'</td>'; 

 
echo '<td align="center">'.Print_Button_Delete($id,$ConfigP['ajex_delete'],"DellLead").'</td>'; 

if($view == 'List'){
PrintTD_List($Name[$i],$SalesUserArr);

}elseif($view == 'ListCust'){
PrintTD_ListCust($Name[$i]);
} 


echo '</tr>';
} 
}
	
echo '</tbody>';
echo '</table>';
echo '</div>';
echo '</div>';
echo '</form>';

echo '<div class="col-md-12 col-sm-12 col-xs-12">';
echo $db->pager; 
echo '</div>';

}else{ 
  Alert_NO_Content();    
}	
?>