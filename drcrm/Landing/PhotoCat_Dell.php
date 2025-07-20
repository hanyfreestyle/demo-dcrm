<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 

$Tabel_Sub_Name = "landpage_photo";
$Tabel_Name = "landpage_photo_cat";
$row = $db->H_CheckTheGet("id","id",$Tabel_Name,"2");
$id = $row['id'];
extract($row);
 

if(isset($_GET['Confirm'])){

$SQL_Line = "select * from $Tabel_Sub_Name where cat_id = '$id' ";
$already = $db->H_Total_Count($SQL_Line);
if($already > '0'){
    $Name = $db->SelArr($SQL_Line);
    for($i = 0; $i < count($Name); $i++) {
    $PhotoIDD = $Name[$i]['id'];
    Image_Dell("2",$PhotoIDD,F_PATH_D,$Tabel_Sub_Name,"photo","photo_t"); 
    $db->H_DELETE_FromId($Tabel_Sub_Name,$PhotoIDD);  
    } 
}

$db->H_DELETE_FromId($Tabel_Name,$id); 
Redirect_Page_2("index.php?view=PhotoCat");
 
}else{
New_Print_Alert("4",$AdminLangFile['mainform_confirm_dell_mass']." ".$row[$NamePrint]); 
PrintDeleteButConfirm("PhotoCat","PhotoCatDell&id=".$id);
}


?>
</div></div>