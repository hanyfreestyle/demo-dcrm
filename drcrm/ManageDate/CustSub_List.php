<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
if(isset($_POST['UnActAllUnit'])) {
	if($USER_PERMATION_Edit == '1') {
       UnActAllUnit_New($Main_DataTabel);
	} else {
		SendMassgeforuser();
	}
}
if(isset($_POST['ActAllUnit'])) {
	if($USER_PERMATION_Edit == '1') {
		ActAllUnit_New($Main_DataTabel);
	} else {
		SendMassgeforuser();
	}
}
echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],$Fs_AddBut,"btn-success","fa-plus-circle");
echo '</div></div>';	



$PERpage = $ConfigP['perpage_unit'] ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;

if(isset($_GET['Cat_id'])){
$ThiscatId = intval($_GET['Cat_id']) ;   
    
$THESQL = "SELECT * FROM $Main_DataTabel where cat_id = '$ThiscatId' $orderby ";
$THELINK = 'view='.$view.'&Cat_id='.$ThiscatId; 
   
}else{
$THESQL = "SELECT * FROM $Main_DataTabel $orderby ";
$THELINK = "view=".$view;    
}


$already = $db->H_Total_Count($THESQL);
if ($already > 0){
?>
<form name="myform" action="#" method="post">
<?php FPrint_ADD_Submit("0"); ?>
<div class="panel panel-default">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover ArTabel">
<thead>
<tr>
<?php
echo '<th width="30">ID</th>';
echo '<th width="200">'.$AdminLangFile['managedate_catname'].'</th>';
echo '<th width="200">'.$AdminLangFile['managedate_data_name'].'</th>';
echo '<th width="200">'.$AdminLangFile['managedate_data_name'].ENLANG.'</th>';
echo '<th width="50"></th>';
echo '<th width="50"></th>';
echo '<th width="50"></th>';
//echo '<th width="50"></th>';
echo '<th width="50" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';
?>
</tr>
</thead>
<tbody>

<?php
   
$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  
$CatId =  $Name[$i]['cat_id'];
$CatName = GetNameFromID($Sub_DataTabel,$CatId,$NamePrint) ;

echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td><a href="index.php?view=CustSubList&Cat_id='.$CatId.'">'.$CatName.'</a></td>';
echo '<td>'.$Name[$i]['name'].'</td>';
echo '<td>'.$Name[$i]['name_en'].'</td>';
//echo '<td>'.$Name[$i]['count'].'</td>';

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
	
?>                          
</tbody>
</table>
</div>
</div>
</form>
<div class="col-md-12 col-sm-12 col-xs-12">
<?php echo $db->pager; ?>
</div>
<?php
}else{ 
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';        
}
?>
</div></div>