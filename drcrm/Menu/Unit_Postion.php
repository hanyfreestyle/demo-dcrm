<?php
if(isset($_POST["submit"])) {
$id_ary = explode(",",$_POST["row_order"]);
for($i=0;$i<count($id_ary);$i++) {
    $id = $id_ary[$i]; 
    $server_data = array (
    'postion'=>  $i 
    );    
    $db->AutoExecute($GroupTabel,$server_data,AUTO_UPDATE,"id = $id");
}
Redirect_Page_2(LASTREFFPAGE);
}

ListPostion_File();


?>

<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">

<form name="frmQA" method="POST" />
<input type = "hidden" name="row_order" id="row_order" /> 
<ul id="sortable-row">
<?php
$Cat_id = $_GET['id'];

$query  = "SELECT * FROM $GroupTabel where cat_id = '$Cat_id' ORDER BY postion";

$Name = $db->SelArr($query);
for($i = 0; $i < count($Name); $i++) {
    
    
?>
<li id="<?php echo $Name[$i]["id"]; ?>"> <?php echo $Name[$i][$NamePrint]; ?></li>
<?php 
}

?>  
</ul>
<input type="submit" class="btnSave" name="submit" value="<?php echo $AdminLangFile['adminlang_save_order']?>" onClick="saveOrder();" />
</form>



</div></div>