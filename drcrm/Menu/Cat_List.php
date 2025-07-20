<?php
if(!defined('WEB_ROOT')) {	exit;}
checkUser();
 
if(isset($_POST['UnActAllUnit'])) {
	if($GroupPermation == '1') {
       UnActAllUnit_New($CatTabel);
	} else {
		SendMassgeforuser();
	}
}
if(isset($_POST['ActAllUnit'])) {
	if($GroupPermation == '1') {
		ActAllUnit_New($CatTabel);
	} else {
		SendMassgeforuser();
	}
}

?>
<style>
.faIconss{
    font-size: 30px;
}
</style>
<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">

<?php
$VallOf = array('PageCount' => 'perpage_cat', 'PageOrder' => "order_by_cat" , 'OrderList' => 
$Order_ByList ,'FilterName' => "mainform_filter_cat" , 'FilterPath' => 'Cat_Search' );
PrintUpdateConfigElement($VallOf);		
?>

</div></div>


<form name="myform" action="#" method="post">
<?php FPrint_ADD_Submit(); ?>

<div class="panel panel-default">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover ArTabel">
<thead>
<tr>
<?php
echo '<th>ID</th>';
echo '<th>'.$AdminLangFile['adminlang_cat_name'].'</th>';	
if(ADMINCPANELLANG){echo '<th>'.$AdminLangFile['adminlang_cat_name'].ENLANG.'</th>';}
echo '<th>Cat ID </th>';
echo '<th align="center" >Icon </th>';

?>
<th width="90" ></th>
<th width="90" ></th>
<th width="90" ></th>
<th width="90" ></th>
<th width="50" ></th>
<th width="50" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>

</tr>
</thead>
<tbody>

<?php




$PERpage = ReturnPERpage($ConfigP['perpage_cat']) ;
$orderby = RterunOrder($ConfigP['order_by_cat']) ;
$THESQL = "SELECT * FROM $CatTabel $orderby ";
$THELINK = "view=Cat_List";




$NOPAGE = GETTHEPAGE ( $THESQL ,$PERpage);
if ($NOPAGE != 1){
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  
$UnitState =  $Name[$i]['state']; 
 
echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.$Name[$i]['name'].'</td>';
if(ADMINCPANELLANG){echo '<td>'.$Name[$i]['name_en'].'</td>';}
echo '<td>'.$Name[$i]['cat_id'].'</td>';
echo '<td align="center"  ><em class="fa  faIconss '.$Name[$i]['icon'].'"></em></td>';




echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['adminlang_cat_content_list'],"List&Cat_Id=".$id,"btn-info","fa-search").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['adminlang_cat_list_edit'],"Cat_Edit&id=".$id,"btn-info","fa-pencil").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['adminlang_menu_sort'],"U_Postion&id=".$id,"btn-success","fa-sort-amount-desc").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['adminlang_cat_list_dell'],"Cat_Dell&id=".$id,"btn-danger","fa-window-close").'</td>';    
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







              