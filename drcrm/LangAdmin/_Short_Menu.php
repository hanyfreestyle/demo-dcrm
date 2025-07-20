<div class="row ShortMenu"><div class="col-md-12">
<?php

if(FREESTYLE4U_EDIT == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Cat_Add").'"  href="index.php?view=Cat_Add">
<i class="fa fa-plus-circle"></i>'.$AdminLangFile['adminlang_menu_cat_add'].'</a>';	
}

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Cat_List").'"  href="index.php?view=Cat_List">
<i class="fa fa-sitemap"></i>'.$AdminLangFile['adminlang_menu_cat_list'].'</a>';

if(FREESTYLE4U_EDIT == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Add").'"  href="index.php?view=Add">
<i class="fa fa-upload "></i>'.$AdminLangFile['adminlang_menu_unit_add'].'</a>';
}

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("List").'"  href="index.php?view=List">
<i class="fa fa-files-o"></i>'.$AdminLangFile['adminlang_menu_unit_list'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$AdminLangFile['adminlang_menu_config'].'</a>';

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("UpdateLang").'"  href="index.php?view=UpdateLang">
<i class="fa fa-text-height "></i>'.$AdminLangFile['adminlang_menu_update_lang'].'</a>';


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListSearch").'"  href="index.php?view=ListSearch">
<i class="fa fa-search "></i>'.$AdminLangFile['adminlang_menu_search'].'</a>';


///UpdateLangTableFromOther("diar_crm_2018","3","diar_crm_2020","3","0"); 
//UpdateLangTableFromOther("diar_crm_2018","15","diar_crm_2020","15","0");
//UpdateLangTableFromOther("diar_crm_2018","17","diar_crm_2020","17","0");



?>
</div></div>
<div style="clear: both!important;"></div>