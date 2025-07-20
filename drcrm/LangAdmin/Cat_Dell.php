<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
if(isset($_GET['Confirm'])){
if ($GroupPermation == '1' and FREESTYLE4U_EDIT == '1'  ){  

$row = $db->H_CheckTheGet("id","id",$CatTabel,"2");
$id = $row['id'];

$db->H_DELETE_FromId($CatTabel,$id);   
$db->H_DELETE("DELETE FROM $GroupTabel WHERE cat_id = '$id'");
Redirect_Page_2('index.php?view=Cat_List');
}else{
 SendMassgeforuser();
}

}else{
$row = $db->H_CheckTheGet("id","id",$CatTabel,"2");
$id = $row['id'];

extract($row);
$already = $db->H_Total_Count("SELECT * FROM $GroupTabel WHERE cat_id = '$id'");
$CatMass = "";
$CatMass .= $AdminLangFile['mainform_confirm_dell_mass']." ".$row[$NamePrint].BR  ;
$CatMass .= $AdminLangFile['adminlang_cat_dell_mass']." : ".$already ; 
New_Print_Alert("4",$CatMass);  
PrintDeleteButConfirm("Cat_List","Cat_Dell&id=".$id);

}
?>

</div></div>