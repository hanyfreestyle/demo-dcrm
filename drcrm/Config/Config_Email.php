<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 


if(isset($_POST['DelUnit'])) {
	if($GroupPermation == '1') {
       DelUnit_New("config_email");
	} else {
		SendMassgeforuser();
	}
}
if(isset($_POST['UnActAllUnit'])) {
	if($USER_PERMATION_Edit == '1') {
       UnActAllUnit_New("config_email");
	} else {
		SendMassgeforuser();
	}
}
if(isset($_POST['ActAllUnit'])) {
	if($USER_PERMATION_Edit == '1') {
		ActAllUnit_New("config_email");
	} else {
		SendMassgeforuser();
	}
}
 
$PERpage = "10" ;
$orderby = "order by id ";
$ConfigP['datatabel'] = "0";
$THESQL = "SELECT * FROM config_email $orderby ";
$THELINK = "view=".$view;

$already = $db->H_Total_Count($THESQL); 


echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],"AddEmail","btn-success","fa-plus-circle");
echo '</div></div>';	


if ($already > 0){
echo '<form name="myform" action="#" method="post">';    
FPrint_ADD_Submit("1"); 
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
echo '<table id="MyCustmer" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
echo '<thead><tr>';  
}else{
echo '<div class="panel panel-default"><div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead><tr>';
}


echo '<th class="TD_50">ID</th>';
echo '<th class="TD_100">'.$AdminLangFile['webconfig_email_account_name'].'</th>';
echo '<th class="TD_100">'.$AdminLangFile['webconfig_email_email'].'</th>';
echo '<th class="TD_100">'.$AdminLangFile['webconfig_email_server_name'].'</th>';
echo '<th class="TD_50"></th>';
echo '<th class="TD_50"></th>';
echo '<th class="TD_50">';
echo '<input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)">';
echo '</th>'; 
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
echo '<td align="center">'.$Name[$i]['id'].'</td>';
echo '<td align="center">'.$Name[$i]['name'].'</td>';
echo '<td align="center">'.$Name[$i]['sitemail'].'</td>';
echo '<td align="center">'.$Name[$i]['server'].'</td>';
echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['adminlang_cat_list_edit'],"EditEmail&id=".$id,"btn-info","fa-pencil").'</td>';
echo '<td align="center">'.CheckUnitState($Name[$i]['state']).'</td>';
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
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';        
}
 
 

?>
</div></div>