<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<div class="row ShortMenu"><div class="col-md-12">
<?php
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListUnit").'"  href="index.php?view=ListUnit">
<i class="fa fa-plus-circle"></i>عرض جدول الوحدات</a>';



echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("List").'"  href="index.php?view=List">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['contract_list_but'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Reservation_List").'"  href="index.php?view=Reservation_List">
<i class="fa fa-list"></i>'.$AdminLangFile['contract_menu_rev'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Canceled").'"  href="index.php?view=Canceled">
<i class="fa fa-list"></i>'.$AdminLangFile['contract_menu_rev_c'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Contract").'"  href="index.php?view=Contract">
<i class="fa fa-list"></i>'.$AdminLangFile['contract_menu_con'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ContractD").'"  href="index.php?view=ContractD">
<i class="fa fa-list"></i>'.$AdminLangFile['contract_menu_con_c'].'</a>';



  



?>
</div></div>
<div style="clear: both!important;"></div>