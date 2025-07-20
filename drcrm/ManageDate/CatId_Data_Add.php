<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!isset($_POST['B1'])){
UnsetAllSession('name,name_en');
}

Form_Open($ArrForm);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['managedate_data_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['managedate_data_name'].ENLANG,"name_en","1","1","req",$MoreS);
 
Form_Close_New("1",$Fs_ListUrl);


if(isset($_POST['B1'])){
if($Err != '1'){    
Vall($Err,"CatIdAddData",$db,"1",$USER_PERMATION_Add);
}  
}            

?>
</div></div>