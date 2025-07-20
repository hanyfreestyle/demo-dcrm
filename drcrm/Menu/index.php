<?php
 
 require_once '../include/inc_reqfile.php';
 require_once '_index_config.php';
 require_once 'Process.php';

  $ThisMenuIs = strtoupper('admin_menu');
 $ConfigP = GetCatConfig($ConfigTabel);
 $CatListOrder =  RterunOrder($ConfigP['order_by_cat']) ;
 
 $AdminConfig = checkUser();
 $GroupPermation = $AdminConfig[USERPERMATION_EDIT];

if($AdminConfig[USERPERMATION] == '1') {
$view = (isset($_GET['view']) && $_GET['view'] != '')?$_GET['view']:'';
switch($view) {

case 'Config':
$content =  'Config.php';
$ThisMenuIs_li = $ThisMenuIs.'Config';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_menu_config'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'Config';
break; 

case 'Cat_Add':
$content =  'Cat_Add.php';
$ThisMenuIs_li = $ThisMenuIs.'Cat_Add';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_menu_cat_add'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'Cat_Add';
break; 


case 'Cat_List':
$content =  'Cat_List.php';
$ThisMenuIs_li = $ThisMenuIs.'Cat_List';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_menu_cat_list'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'Cat_List';
break;


case 'Cat_Edit':
$content =  'Cat_Edit.php';
$ThisMenuIs_li = $ThisMenuIs.'Cat_Edit';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_cat_list_edit'];
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'Cat_List';
break; 

case 'Cat_Search':
$content =  'Cat_Search.php';
$ThisMenuIs_li = $ThisMenuIs.'Cat_List';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_menu_cat_list'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'Cat_List';
break;

case 'Cat_Dell':
$Short_Menu = '_Short_Menu.php';
$content =  'Cat_Dell.php';
$ThisMenuIs_li = $ThisMenuIs.'Cat_Dell';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_cat_list_dell'];
break; 


case 'Add':
$content =  'Unit_Add.php';
$ThisMenuIs_li = $ThisMenuIs.'Add';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_cat_list_dell'];
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'Add';
break;

case 'Edit':
$content =  'Unit_Edit.php';
$ThisMenuIs_li = $ThisMenuIs.'Edit';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_h1_edit']; 
$Short_Menu = '_Short_Menu.php';
break;

case 'List':
$content =  'Unit_List.php';
$ThisMenuIs_li = $ThisMenuIs.'List';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_menu_unit_list'];
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'List';
break;

case 'ListSearch':
$Short_Menu = '_Short_Menu.php';
$content =  'Unit_Search.php';
$ThisMenuIs_li = $ThisMenuIs.'ListSearch';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_menu_unit_list'];
break;

case 'ListEdit':
$Short_Menu = '_Short_Menu.php';
$content =  'Unit_ListEdit.php';
$ThisMenuIs_li = $ThisMenuIs.'ListEdit';
$PageTitle =  $Module_H1.$AdminLangFile['adminlang_cat_content_edit'];
break;


case 'Dell':
$content =  'Unit_Dell.php';
$ThisMenuIs_li = $ThisMenuIs.'Dell';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_h1_del'];
$Short_Menu = '_Short_Menu.php';
break;


case 'Cat_Postion':
$content =  'Cat_Postion.php';
$ThisMenuIs_li = $ThisMenuIs.'Cat_Postion';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_menu_sort'];
$Short_Menu = '_Short_Menu.php';
break;       


case 'U_Postion':
$content =  'Unit_Postion.php';
$ThisMenuIs_li = 'U_Postion';
$PageTitle = $Module_H1.$AdminLangFile['adminlang_menu_sort'];
$Short_Menu = '_Short_Menu.php';
break;





default:
       $content =  '../include/Page_Empty.php';
       $PageTitle = $Module_H1.$AdminLangFile['mainform_emptypage'];
       $Short_Menu = '_Short_Menu.php';
   }
} else {
   SendMassgeforuser2();
}
require_once $TemplatePhth;

?>