<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
$row = $db->H_CheckTheGet("id","id","landpage_block","2");
$id = $row['id'];
$MianIdFoURl = $row['cat_id'];
 
PageEditBut($row['cat_id']);

 
if(isset($_POST['DletePhoto'])){
    $Des_PhotoS = unserialize($row['des']);
    @unlink(F_PATH_D.$Des_PhotoS['photo']);
    unset($Des_PhotoS['photo']);
    $Des_SAve = serialize($Des_PhotoS);
    $server_data = array ('des'=> $Des_SAve);
    $db->AutoExecute("landpage_block",$server_data,AUTO_UPDATE,"id = $id");
    Redirect_Page_2("index.php?view=BlockEdit&id=".$id);

}

 
$BlockTYpe = intval($row['type']);
$LandingPageBlock = LandingPageBlock($BlockTYpe);
if($LandingPageBlock != "Err"){
  

if(!isset($_POST['B1'])){
UnsetAllSession("cat_id,type,var,name,name_en,title,title_en,title_des,title_des_en,g_lat,g_zoom,g_long,block_style");
UnsetAllSession("name,name_en,lead_cat,des,des_en,name_m,name_m_en,g_name,g_name_en,g_des,g_des_en");
UnsetAllSession("cat_id,type,var,name,name_en,title,title_en,title_des,title_des_en,contact_info,address_en,address");
}
 
Form_Open($ArrForm);
//hidden
echo '<input type="hidden" name="cat_id" value="'.$row['cat_id'].'" />';
echo '<input type="hidden" name="type" value="'.$BlockTYpe.'" />';
echo '<div style="clear: both!important;"></div>';
PrintFildInformation("col-md-6",$AdminLangFile['lppage_page_name'],$row[$NamePrint]);
PrintFildInformation("col-md-6",$AdminLangFile['lppage_block_type'],$LandingPageBlock);
echo '<div style="clear: both!important;"></div>'.BR.BR;



$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="alphanum" data-parsley-minlength="4" ' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit","Section ID ","var","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['lppage_bl_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['lppage_bl_name'].ENLANG,"name_en","1","1","req",$MoreS);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => ' data-parsley-type="alphanum" ' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit","Block Style","block_style","0","1","",$MoreS);

NF_PrintRadio_Active ("2_Line","col-md-4","Menu Status","menu_s",$row['menu_s']);

$row = unserialize($row['des']);


echo '<div style="clear: both!important;"></div>'.BR.BR;

switch($BlockTYpe) {
    
     case "1":
       ////اضافة بانر
       Add_BlockType_01($row); 
       break;
     case "2":
       //// اضافة نص
       Add_BlockType_02($row);
       break;
     case "3":
      /// اضافة فيديو
       Add_BlockType_03($row);
       break;
     case "4":
       /// اضافة جوجل
       Add_BlockType_04($row);
       break;
     case "5":
       ////   اضافة البوم صور
       Add_BlockType_05($row);
       break;
     case "6":
       /// اتصل بنا
        Add_BlockType_06($row);
       break;
     default:
     $order = "Err";
      
}




Form_Close_New("2","ViewBlock&id=".$MianIdFoURl);

if(isset($_POST['B1'])){
if($ErrForm != '1'){    
Vall($Err,"EditBlock",$db,"1",$USER_PERMATION_Add);
}  
}            

}
 
?>
</div></div>