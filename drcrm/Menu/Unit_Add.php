<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
 
if(!isset($_POST['B1'])){
UnsetAllSession('name,name_en,views,cat_id,path');
}

$LastAdd  = LastAdd($LastAdd_S);



Form_Open($ArrForm);

$Arr = array("Label" => 'on',"Active" => '0');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['mainform_sel_cat'],"col-md-3","cat_id",$CatTabel,"req",$LastAdd['cat_id'],$Arr);	


NF_PrintRadio_Active("2_Line","col-md-4",$AdminLangFile['mainform_save_lastcat'],"lastadd_state",$LastAdd['state']);
 
echo '<div style="clear: both!important;"></div>';

 

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'OnLine'=> '1','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['adminlang_var_des'],"name","1","1","req",$MoreS);

if(ADMINCPANELLANG){
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','OnLine'=> '1','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['adminlang_var_des'].ENLANG,"name_en","1","1","req",$MoreS);
}


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required','OnLine'=> '1','Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text","Path","path","1","1","req",$MoreS);


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required','OnLine'=> '1','Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text","Views","views","1","1","req",$MoreS);

$Err[] = NF_PrintRadio_Active ("2_Line","col-md-6",$AdminLangFile['adminlang_menu_for_site_manager'],"admin_view","0");


Form_Close("1");

if(isset($_POST['B1'])){
Vall($Err,"Add",$db,"0",$GroupPermation);
}            

?>
</div></div>