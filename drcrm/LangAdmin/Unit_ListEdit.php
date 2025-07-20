<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
if(isset($_POST['PriceMange'])) {
	if($GroupPermation == '1') {
		PriceMange();
    
	} else {
		SendMassgeforuser();
	}
}


$PERpage = ReturnPERpage($ConfigP['perpage_unit'])  ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;

$cat_id = CheckTheGet("id","id",$CatTabel,"خطأ","خطأ");
$THESQL = "SELECT * FROM $GroupTabel where cat_id = '$cat_id' $orderby ";
$THELINK = "view=ListEdit&id=".$cat_id ;

$already = $db->H_Total_Count($THESQL);
if ($already > 0){
?>
<div id="ErrMass" class="ErrMass_Div"></div>

<form name="myform" action="#" method="post" id="forms">
<div class="TopButAction">
<input type="submit" value="<?php echo $AdminLangFile['mainform_edit'] ?>" class="mb-sm btn btn-success"  name="PriceMange"/>   
</div>

<?php

echo '<div style="clear: both!important;"></div> ';
$NOPAGE = GETTHEPAGE ( $THESQL ,$PERpage);
if ($NOPAGE != 1){
$koko = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
for ($i=0; $i<count($koko); $i++){
$id = $koko[$i]['id'];
 

$CatName = GetNameFromID($CatTabel,$cat_id,$NamePrint);
PrintFildInformation("col-md-3",$AdminLangFile['adminlang_cat_name'],$CatName);



if(FREESTYLE4U_EDIT == '1'){
echo '<div class="col-md-3 col-sm-12 col-xs-12 form-group DirRight">';
echo '<label class="control-label">'.$AdminLangFile['adminlang_cat_count_var'].'</label>';
echo '<input type="text" name="var[]"  class="TypeText form-control En_Lang" value="'.$koko[$i]['var'].'" required  > ';
echo '</div>';
}else{
PrintFildInformation("col-md-3",$AdminLangFile['adminlang_cat_count_var'],$koko[$i]['var']);
echo '<input type="hidden" value="'.$koko[$i]['var'].'" name="var[]"  class="text_en" style="width: 200px;" />';
}

echo '<div class="col-md-3 col-sm-12 col-xs-12 form-group DirRight">';
echo '<label class="control-label">'.$AdminLangFile['adminlang_var_des'].'</label>';
echo '<input type="text" name="name[]"  class="TypeText form-control " value="'.$koko[$i]['name'].'" required  > ';
echo '</div>';

if(ADMINCPANELLANG){
echo '<div class="col-md-3 col-sm-12 col-xs-12 form-group DirRight">';
echo '<label class="control-label">'.$AdminLangFile['adminlang_var_des'].ENLANG.'</label>';
echo '<input type="text" name="name_en[]"  class="TypeText form-control En_Lang" value="'.$koko[$i]['name_en'].'" required  > ';
echo '</div>';
}

echo '<td><input type="hidden" name="id_id[]" value="'.$koko[$i]['id'].'"  /></td>';

echo '<div style="clear: both!important;"></div>';

}
}	
?>

<div class="TopButAction">
<input type="submit" value="<?php echo $AdminLangFile['mainform_edit'] ?>" class="mb-sm btn btn-success"  name="PriceMange"/>   
</div>

</form>
<div class="pager fr">
<?php echo $db->pager; ?>
</div>


<?php

} 
?>

</div></div>