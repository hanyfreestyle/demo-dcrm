<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>

<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
echo '<div id="ErrMass" class="ErrMass_Div"></div>';
/*************************************************************************************************************/

/*************************************************************************************************************/
SendJavaErrMass($AdminLangFile['mainform_category_has_been_set']);

//$ArFilePath = SRV_ROOT."library/".$AR_File_Name ;
$ArFilePath = SRV_ROOT.ADMIN_LANG_FILEPATH.AR_FILE_NAME ;

if(file_exists($ArFilePath) ){ 
    SendJavaErrMass($AdminLangFile['mainform_confirmed_existence_language_file']);
    $ErrAr = "0";
}else{ 
   SendJavaErrMass($AdminLangFile['mainform_language_file_path_is_incorrect']);
   $ErrAr = "1";
} 

/*************************************************************************************************************/
 $_br = ' ;'."\r\n";
 $_br_nn = "\r\n";
 $open_tag = '$AdminLangFile[';
 $close_tag = "]= ";   
/*************************************************************************************************************/
 

/*************************************************************************************************************/
if($ErrAr != '1' ){
 $handle = fopen($ArFilePath , "w+");
 $data = '<?php'.$_br_nn;


    
 $Cat_Name = $db->SelArr("SELECT * FROM $CatTabel ");
 for($i = 0; $i < count($Cat_Name); $i++) {

$data .= $_br_nn.'/*********************************************************************************************/
/****************                   '.$Cat_Name[$i]['name'].'               
/*********************************************************************************************/'.$_br_nn ;  
    
    $cat_id = $Cat_Name[$i]['id'];  

    $Var_Name = $db->SelArr("SELECT * FROM $GroupTabel where cat_id = '$cat_id' ");
    for($x = 0; $x < count($Var_Name); $x++) {
    $data .= $open_tag."'".$Cat_Name[$i]['cat_id']."_".$Var_Name[$x]['var']."'".$close_tag.'"'.nl2br(Clean_Mypost($Var_Name[$x]['name'])).'"'.$_br ;  
    }     
    
 }
	 
 
 $data .= $_br_nn.'?>'.$_br_nn;
 fwrite($handle, $data);
 
 SendJavaErrMass($AdminLangFile['mainform_language_file_has_been_updated']); 
 }
/*************************************************************************************************************/ 
 
 
if(ADMINCPANELLANG == '1'){

//$EnFilePath = SRV_ROOT."library/".$EN_File_Name ;
$EnFilePath = SRV_ROOT.ADMIN_LANG_FILEPATH.EN_FILE_NAME ;
if(file_exists($ArFilePath) ){ 
    SendJavaErrMass($AdminLangFile['mainform_confirmed_existence_language_file']." ".ENLANG);
    $ErrEn = "0";
}else{ 
    SendJavaErrMass($AdminLangFile['mainform_language_file_path_is_incorrect']." ".ENLANG);
   $ErrEn = "1";
}

/*************************************************************************************************************/
if($ErrEn != '1' ){
 $handle = fopen($EnFilePath , "w+");
 $data = '<?php'.$_br_nn;


 $Cat_Name = $db->SelArr("SELECT * FROM $CatTabel ");
 for($i = 0; $i < count($Cat_Name); $i++) {

$data .= $_br_nn.'/*********************************************************************************************/
/****************                   '.$Cat_Name[$i]['name'].'               
/*********************************************************************************************/'.$_br_nn ;  
    
    $cat_id = $Cat_Name[$i]['id'];  

    $Var_Name = $db->SelArr("SELECT * FROM $GroupTabel where cat_id = '$cat_id' ");
    for($x = 0; $x < count($Var_Name); $x++) {        
    $data .= $open_tag."'".$Cat_Name[$i]['cat_id']."_".$Var_Name[$x]['var']."'".$close_tag.'"'.nl2br(Clean_Mypost($Var_Name[$x]['name_en'])).'"'.$_br ;
    }

	 
 }
	 
 
 $data .= $_br_nn.'?>'.$_br_nn;
 fwrite($handle, $data);
 
 SendJavaErrMass($AdminLangFile['mainform_language_file_has_been_updated']." ".ENLANG); 
 }
/*************************************************************************************************************/      
} 
 Redirect_Page_2("index.php?view=List"); 
?>
</div></div>