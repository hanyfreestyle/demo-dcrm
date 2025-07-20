<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}


$PERpage = ReturnPERpage($ConfigP['perpage_cat']) ;
$orderby = RterunOrder($ConfigP['order_by_cat']) ;
$THESQL = "SELECT * FROM $GroupTabel ";

$THELINK = "view=Cat_List";
$already = $db->H_Total_Count($THESQL);

if ($already > 0){
?>
<div class="row"><div class="col-lg-12"><div class="panel panel-default">

<div class="panel-body">
<table id="MyCustmer" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">

<thead>
<tr>
<?php
echo '<th >ID</th>';

echo '<th>'.$AdminLangFile['adminlang_cat_name'] .'</th>';
echo '<th>'.$AdminLangFile['adminlang_cat_name'].ENLANG .'</th>';
echo '<th width="150">'.$AdminLangFile['adminlang_cat_count_var'].'</th>';
?>
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
 
 if(ADMIN_WEB_LANG == 'En'){
$CatNamePrint = 'name_en' ;   
}else{
$CatNamePrint = 'name' ;      
}    
$catname = GetNameFromID($CatTabel,$Name[$i]['cat_id'],$CatNamePrint) ;

$catvar = GetNameFromID($CatTabel,$Name[$i]['cat_id'],"cat_id") ;
 
 
echo '<tr>';

echo '<td>'.$Name[$i]['id'].'</td>';


echo '<td>'.$Name[$i]['name'].'</td>';
echo '<td>'.$Name[$i]['name_en'].'</td>';
echo '<td>'. $catvar."_".$Name[$i]['var'].'</td>'; 
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['adminlang_cat_list_edit'],"Edit&id=".$id,"btn-info","fa-pencil").'</td>';

if(FREESTYLE4U_EDIT == '1'){
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['adminlang_cat_list_dell'],"Dell&id=".$id,"btn-danger","fa-window-close").'</td>';
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