<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
 
 

if(isset($_POST['DelUnit'])) {
	if($GroupPermation == '1') {
       DelUnit_New($GroupTabel);
	} else {
		SendMassgeforuser();
	}
}

if(isset($_POST['UnActAllUnit'])) {
	if($GroupPermation == '1') {
       UnActAllUnit_New($GroupTabel);
	} else {
		SendMassgeforuser();
	}
}
if(isset($_POST['ActAllUnit'])) {
	if($GroupPermation == '1') {
		ActAllUnit_New($GroupTabel);
	} else {
		SendMassgeforuser();
	}
}
 
$PERpage = $ConfigP['perpage_unit'] ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;

if(isset($_GET['Cat_Id'])){
  $cat_id = intval($_GET['Cat_Id']);
  $THESQL = "SELECT * FROM $GroupTabel where cat_id = '$cat_id' $orderby";
  $THELINK = "view=List&Cat_Id".$cat_id;
  }else{
  $THESQL = "SELECT * FROM $GroupTabel $orderby ";
  $THELINK = "view=List";
}


$already = $db->H_Total_Count($THESQL);
if ($already > 0){
  

$VallOf = array('PageCount' => 'perpage_unit', 'PageOrder' => "order_by_unit" , 'OrderList' => $Order_ByList ,
'FilterName' => "mainform_filter_con" , 'FilterPath' => 'ListSearch' );
PrintUpdateConfigElement($VallOf);	
   
?>
<form name="myform" action="#" method="post">
<?php FPrint_ADD_Submit("1"); ?>

<div class="panel panel-default">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover ArTabel">
<thead>
<tr>
<?php
echo '<th>ID</th>';
echo '<th>'.$AdminLangFile['adminlang_cat_name'].'</th>';
echo '<th>'.$AdminLangFile['adminlang_var_des'].'</th>';	
if(ADMINCPANELLANG){echo '<th>'.$AdminLangFile['adminlang_var_des'].ENLANG.'</th>';}
?>
<th>Path</th>
<th>View</th>
<th width="90" ></th>
<th width="90" ></th>
<th width="50" ></th>
<th width="50" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>

</tr>
</thead>
<tbody>

<?php



    
$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  
$UnitState =  $Name[$i]['state']; 
 $catname = GetNameFromID($CatTabel,$Name[$i]['cat_id'],$NamePrint) ;
 
echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td><a href="index.php?view=List&Cat_Id='.$Name[$i]['cat_id'].'">'.$catname.'</a></td>';
echo '<td>'.$Name[$i]['name'].'</td>';
if(ADMINCPANELLANG){echo '<td>'.$Name[$i]['name_en'].'</td>';}

echo '<td>'.$Name[$i]['path'].'</td>';

echo '<td>'.$Name[$i]['views'].'</td>';
echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['adminlang_cat_list_edit'],"Edit&id=".$id,"btn-info","fa-pencil").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['adminlang_cat_list_dell'],"Dell&id=".$id,"btn-danger","fa-window-close").'</td>';  

echo '<td align="center">'.CheckUnitState($UnitState).'</td>';
echo '<td align="center">'.PrintCheckBox_New($id).'</td>';

} 
}
	
?>                          
</tbody>
</table>
</div>
</div>
</form>              

<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
<?php echo $db->pager; ?>
</div></div>

<?php
	}
?>

</div></div>
              