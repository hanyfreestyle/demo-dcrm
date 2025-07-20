<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
checkUser();
 
$row = $db->H_CheckTheGet("id","id",$CatTabel,"2");
$id = $row['id'];
extract($row);
 
if(!isset($_POST['B1'])){
UnsetAllSession('name,name_en,icon,cat_id');
}

Form_Open($ArrForm);


$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'OnLine'=> '1');
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['adminlang_cat_name'],"name","1","1","req",$MoreS);

if(ADMINCPANELLANG){
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','OnLine'=> '1','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['adminlang_cat_name'].ENLANG,"name_en","1","1","req",$MoreS);
}

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required','OnLine'=> '1','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit","Cat ID ","cat_id","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required','OnLine'=> '1','Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit","Icon Name","icon","1","1","req",$MoreS);
 
NF_PrintRadio_Active ("2_Line","col-md-4",$AdminLangFile['adminlang_control_panel'],"web_admin",$web_admin);


Form_Close("2");
if(isset($_POST['B1'])){
Vall($Err,"Cat_Edit",$db,"0",$GroupPermation);
}            

?>
</div></div>