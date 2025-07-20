<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 

$row = $db->H_CheckTheGet("id","id",$GroupTabel,"2");
$id = $row['id'];
extract($row);


Form_Open($ArrForm);


if(FREESTYLE4U_EDIT == '1'){
$Arr = array("Label" => 'on',"Active" => '0');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['mainform_sel_cat'],"col-md-3","cat_id",$CatTabel,"req",$cat_id,$Arr);	
}else{
$CatName = GetNameFromID($CatTabel,$cat_id,$NamePrint);
PrintFildInformation("col-md-3",$AdminLangFile['adminlang_cat_name'],$CatName);
echo '<input type="hidden" name="cat_id" value="'.$cat_id.'" />';    
}


 
echo '<div style="clear: both!important;"></div>';


if(FREESTYLE4U_EDIT == '1'){
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'OnLine'=> '1','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['adminlang_var_name'],"var","1","1","req",$MoreS);
}else{
echo '<input type="hidden" name="var" value="'.$row['var'].'"/>';    
}

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['adminlang_var_des'],"name","1","1","req",$MoreS);


if(ADMINCPANELLANG){
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['adminlang_var_des'].ENLANG,"name_en","1","1","req",$MoreS);
}

Form_Close("2");
if(isset($_POST['B1'])){
if($Err != '1'){    
Vall($Err,"Edit",$db,"0",$GroupPermation);
}  
}            

?>
</div></div>