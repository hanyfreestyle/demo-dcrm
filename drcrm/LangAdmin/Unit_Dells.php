<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
 
if(FREESTYLE4U_EDIT != '1'){
    SendMassgeforuser2();   
}

 
if(isset($_GET['Confirm'])){
if($GroupPermation == '1' and FREESTYLE4U_EDIT == '1') {
  
$row = $db->H_CheckTheGet("id","id",$GroupTabel,"2");
$id = $row['id'];
$db->H_DELETE_FromId($GroupTabel,$id);   
Redirect_Page_2("index.php?view=List");
}else{
 SendMassgeforuser();
}

}else{
$row = $db->H_CheckTheGet("id","id",$GroupTabel,"2");
$id = $row['id'];
New_Print_Alert("4",$AdminLangFile['mainform_confirm_dell_mass']." ".$row[$NamePrint]);  
PrintDeleteButConfirm("List","Dell&id=".$id);
}
?>
</div></div>