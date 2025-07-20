<?php
if(!defined('WEB_ROOT')) {	exit;}
 	
?>
<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">

<?php
 
$row = $db->H_CheckTheGet("id","id",$Main_DataTabel ,"2");
$id = $row['id'];

if($row['count'] == '0'){
$already = $db->H_Total_Count("SELECT id FROM $Fs_Count_tabel WHERE $Fs_Count_Filde = '$id'");
if($already > 0 ){
UpdateFildeForDell($Main_DataTabel,"count",$already,$id) ;     
$row = $db->H_CheckTheGet("id","id",$Main_DataTabel,"2");
extract($row);
}
}

if($row['count'] == '0'){
if(isset($_GET['Confirm'])){
$db->H_DELETE_FromId($Main_DataTabel,$id);
Redirect_Page_2("index.php?view=".$Fs_ListUrl);
   
}else{
echo '<div id="ErrMass" class="ErrMass_Div"></div>';  
PrintDeleteButConfirm($Fs_ListUrl,$Fs_DellBut."&id=".$id);
SendJavaErrMass($AdminLangFile['mainform_confirm_dell_mass']." ".$row[$NamePrint]);
}
}else{
echo '<div id="ErrMass" class="ErrMass_Div"></div>'; 
PrintDeleteButConfirm($Fs_ListUrl,"");
SendJavaErrMass($AdminLangFile['mainform_err_dell_mass'].BR." ".$row[$NamePrint]);
}
 

?>
</div></div>