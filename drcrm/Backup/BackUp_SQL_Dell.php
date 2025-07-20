<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">

<?php
 

if($AdminConfig['admin'] == '1'){

    $row = $db->H_CheckTheGet("id","id","x_back_up","2");
    $id = $row['id'];
if(isset($_GET['Confirm'])){
Image_Dell("1",$id,BACKUP_FOLDER_DIR,"x_back_up","path","");
$db->H_DELETE_FromId("x_back_up",$id);
Redirect_Page_2("index.php?view=List");
}else{
echo '<div id="ErrMass" class="ErrMass_Div"></div>';  
PrintDeleteButConfirm("List","Dell&id=".$id);

SendJavaErrMass($AdminLangFile['mainform_confirm_dell_mass']." ".$row['name']);
}
 

}

?>
</div></div>