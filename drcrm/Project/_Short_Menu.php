<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<div class="row ShortMenu"><div class="col-md-12">
<?php

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("AreaList").'"  href="index.php?view=AreaList">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['project_listarea'].'</a>';

if($USER_PERMATION_Add == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Add").'"  href="index.php?view=Add">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['project_add_pro'].'</a>';   
}

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("List").'"  href="index.php?view=List">
<i class="fa fa-home"></i>'.$AdminLangFile['project_list_pro'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("UnitList").'"  href="index.php?view=UnitList">
<i class="fa fa-filter"></i>'.$AdminLangFile['project_list_unit'].'</a>';

if($USER_PERMATION_Add == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Price_Add").'"  href="index.php?view=Price_Add">
<i class="fa fa-usd"></i>'.$AdminLangFile['project_price_add'].'</a>';
}


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Price_List").'"  href="index.php?view=Price_List">
<i class="fa  fa-list"></i>'.$AdminLangFile['pro_price_list'].'</a>';
  
  /*
if($USER_PERMATION_Edit == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$AdminLangFile['manage_meta_menu_config'].'</a>';
}
*/
 

$FloorName_Arr = $db->SelArr("SELECT * FROM project_floor ") ;
$PriceName_Arr = $db->SelArr("SELECT * FROM project_price ") ;


?>
</div></div>
<div style="clear: both!important;"></div>