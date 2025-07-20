<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
 
$row = $db->H_CheckTheGet("id","id",$GroupTabel,"2");
$id = $row['id'];
extract($row);


if(!isset($_POST['B1'])){
UnsetAllSession('name,name_en,views,cat_id,path');
}


Form_Open($ArrForm);

$Arr = array("Label" => 'on',"Active" => '0');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['mainform_sel_cat'],"col-md-3","cat_id",$CatTabel,"req",$cat_id,$Arr);	

echo '<div style="clear: both!important;"></div>';



$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'OnLine'=> '1','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['adminlang_var_des'],"name","1","1","req",$MoreS);

if(ADMINCPANELLANG){
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','OnLine'=> '1','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['adminlang_var_des'].ENLANG,"name_en","1","1","req",$MoreS);
}

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required','OnLine'=> '1','Dir'=> "En" );
$Err[] = NF_PrintInput("TextEdit","Path","path","1","1","req",$MoreS);


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required','OnLine'=> '1','Dir'=> "En" );
$Err[] = NF_PrintInput("TextEdit","Views","views","1","1","req",$MoreS);



$Err[] = NF_PrintRadio_Active ("2_Line","col-md-6",$AdminLangFile['adminlang_menu_for_site_manager'],"admin_view",$admin_view);


Form_Close("2");
if(isset($_POST['B1'])){
Vall($Err,"Edit",$db,"0",$GroupPermation);
}            

?>
</div></div>