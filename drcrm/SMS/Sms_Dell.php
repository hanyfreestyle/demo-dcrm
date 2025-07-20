<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">

<?php
 

if($AdminConfig['sendsms_dell'] == '1'){
$row = $db->H_CheckTheGet("id","id","sms_report","2");
$id = $row['id'];
if(isset($_GET['Confirm'])){
   $db->H_DELETE_FromId("sms_report",$id) ;
   Redirect_Page_2("index.php?view=Report");
}else{
echo '<div id="ErrMass" class="ErrMass_Div"></div>';  
PrintDeleteButConfirm("Report","Dell&id=".$id);

SendJavaErrMass($AdminLangFile['mainform_confirm_dell_mass']." ".$row['name']);
}
}

?>
</div></div>