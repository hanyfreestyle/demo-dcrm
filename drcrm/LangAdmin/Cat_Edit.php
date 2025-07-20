<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 

$row = $db->H_CheckTheGet("id","id",$CatTabel,"2");
$id = $row['id'];
extract($row);


Form_Open();

if(FREESTYLE4U_EDIT == '1'){
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'OnLine'=> '1','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['adminlang_cat_var'],"cat_id","1","1","req",$MoreS);    
}else{
echo '<input  type="hidden" name="cat_id" value="'.$row['cat_id'].'"/>';    
}




$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'OnLine'=> '1','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['adminlang_cat_name'],"name","1","1","req",$MoreS);

if(ADMINCPANELLANG){
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','OnLine'=> '1','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['adminlang_cat_name'].ENLANG,"name_en","1","1","req",$MoreS);
}


Form_Close("2");
if(isset($_POST['B1'])){
Vall($Err,"CatEdit",$db,"0",$GroupPermation);
}



	
?>

</div></div>