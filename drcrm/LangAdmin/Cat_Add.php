<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 

if(FREESTYLE4U_EDIT != '1'){
    SendMassgeforuser2();   
}


Form_Open();

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'OnLine'=> '1','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['adminlang_cat_var'],"cat_id","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'OnLine'=> '1','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['adminlang_cat_name'],"name","1","1","req",$MoreS);

if(ADMINCPANELLANG){
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required','OnLine'=> '1','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['adminlang_cat_name'].ENLANG,"name_en","1","1","req",$MoreS);
}


Form_Close("1");
if(isset($_POST['B1'])){
Vall($Err,"CatAdd",$db,"0",$GroupPermation);
}


?>
</div></div>