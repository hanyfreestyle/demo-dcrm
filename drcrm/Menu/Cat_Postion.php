<?php
if(isset($_POST["submit"])) {
$id_ary = explode(",",$_POST["row_order"]);
for($i=0;$i<count($id_ary);$i++) {
    $id = $id_ary[$i]; 
    $server_data = array (
    'postion'=>  $i 
    );    
    $db->AutoExecute($CatTabel,$server_data,AUTO_UPDATE,"id = $id");
}
Redirect_Page_2(LASTREFFPAGE);
}	

?>


<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<script src="<?php echo $AdminPath ?>inc/ListPostion/jquery-ui.js"></script>
<link href="<?php echo $AdminPath ?>inc/ListPostion/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $AdminPath ?>inc/ListPostion/Config.js"></script>
<style>
.faZizeea{
    font-size:20px;
}
</style>

<form name="frmQA" method="POST" />
<input type = "hidden" name="row_order" id="row_order" /> 
<ul id="sortable-row">
<?php
$query  = "SELECT * FROM $CatTabel ORDER BY postion";
$Name = $db->SelArr($query);
for($i = 0; $i < count($Name); $i++) {
    $CatView = $Name[$i]['cat_id'];
    if(isset($AdminGroup[$CatView])){
    echo '<li id="'.$Name[$i]["id"].'"><em class="fa faZizeea '.$Name[$i]['icon'].' "></em>'. $Name[$i][$NamePrint].'</li>';        
    }
    
}

?>  
</ul>
<input type="submit" class="btnSave" name="submit" value="<?php echo $AdminLangFile['adminlang_save_order']?>" onClick="saveOrder();" />
</form>



</div></div>