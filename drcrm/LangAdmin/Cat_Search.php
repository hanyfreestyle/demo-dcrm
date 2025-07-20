<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
$PERpage = ReturnPERpage($ConfigP['perpage_cat']) ;
$orderby = RterunOrder($ConfigP['order_by_cat']) ;
$THESQL = "SELECT * FROM $CatTabel $orderby ";
$THELINK = "view=Cat_List";


$already = $db->H_Total_Count($THESQL);
if ($already > 0){
?>
<div class="row"><div class="col-lg-12"><div class="panel panel-default">

<div class="panel-body">
<table id="datatable2" class="table table-striped table-hover">

<thead>
<tr>
<?php
echo '<th width="50">ID</th>';
echo '<th>'.$AdminLangFile['adminlang_cat_var'] .'</th>';
echo '<th>'.$AdminLangFile['adminlang_cat_name'] .'</th>';
echo '<th>'.$AdminLangFile['adminlang_cat_name'].ENLANG .'</th>';

?>
<th width="50" ></th>
<th width="50" ></th>
<th width="50" ></th>
<?php if(FREESTYLE4U_EDIT == '1'){ echo '<th width="50" ></th>';} ?>
</tr>
</thead>

<tbody>
<?php
$NOPAGE = GETTHEPAGE ( $THESQL ,$PERpage);
$Name = $db->SelArr($THESQL); 
for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  
 
echo '<tr>';

echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.$Name[$i]['cat_id'].'</td>';

echo '<td>'.$Name[$i]['name'].'</td>';
echo '<td>'.$Name[$i]['name_en'].'</td>';

 
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['adminlang_cat_list_edit'],"Cat_Edit&id=".$id,"btn-info","fa-pencil").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['adminlang_cat_content_list'],"List&Cat_Id=".$id,"btn-info","fa-search").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('2', $AdminLangFile['adminlang_cat_content_edit'],"ListEdit&id=".$id,"btn-info","fa-sort-amount-desc").'</td>';

if(FREESTYLE4U_EDIT == '1'){
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['adminlang_cat_list_dell'],"Cat_Dell&id=".$id,"btn-danger","fa-window-close").'</td>';
}
} 
?> 
</tbody>




</table>
</div></div></div></div>
            

<?php
}
?>
</div></div>