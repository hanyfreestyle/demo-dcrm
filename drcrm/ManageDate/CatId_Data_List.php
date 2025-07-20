<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">

<?php


if(isset($_POST['UnActAllUnit'])) {
	if($USER_PERMATION_Edit == '1') {
       UnActAllUnit_New("config_data");
	} else {
		SendMassgeforuser();
	}
}
if(isset($_POST['ActAllUnit'])) {
	if($USER_PERMATION_Edit == '1') {
		ActAllUnit_New("config_data");
	} else {
		SendMassgeforuser();
	}
}



echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],$Fs_AddBut,"btn-success","fa-plus-circle");
echo '</div></div>';	


$PERpage = $ConfigP['perpage_unit'] ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;
$orderby = ' Order by count desc';  

$THESQL = "SELECT * FROM config_data where cat_id = '$Fs_DataTabel' $orderby ";

$THELINK = "view=".$Fs_ListUrl;

$already = $db->H_Total_Count($THESQL);
if ($already > 0){
?>


<form name="myform" action="#" method="post">
<?php  
FPrint_ADD_Submit("0"); 

if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
echo '<table id="MyCustmer" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
echo '<thead><tr>';  
}else{
echo '<div class="panel panel-default"><div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead><tr>';
}

 
echo '<th width="30">ID</th>';
echo '<th width="200">'.$AdminLangFile['managedate_data_name'].'</th>';
echo '<th width="200">'.$AdminLangFile['managedate_data_name'].ENLANG.'</th>';
echo '<th width="50"></th>';
echo '<th width="50"></th>';
echo '<th width="50"></th>';
echo '<th width="50"></th>';
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
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.$Name[$i]['name'].'</td>';
echo '<td>'.$Name[$i]['name_en'].'</td>';

echo '<td align="center" class="CodeNumber" >'.$Name[$i]['count'].'</td>';

echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_edit'],$Fs_EditBut."&id=".$id,"btn-info","fa-pencil").'</td>';

if($Name[$i]['count'] == '0'){
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_delete'],$Fs_DellBut."&id=".$id,"btn-danger","fa-window-close").'</td>';    
}else{
echo '<td align="center"></td>';    
}

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


}else{ 
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';        
}
?>
</div></div>