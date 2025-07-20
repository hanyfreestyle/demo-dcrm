<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$row = $db->H_CheckTheGet("id","id","landpage_photo","2");
$id = $row['id'];
extract($row);

 
Form_Open($ArrForm);

$Arr = array("Label" => 'on',"Active" => '1');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['mainform_sel_cat'],"col-md-4","cat_id","landpage_photo_cat","req",$cat_id,$Arr); 

echo '<div style="clear: both!important;"></div>';
 
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['lppage_photo_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['lppage_photo_name'].ENLANG,"name_en","1","1","req",$MoreS);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['lppage_details'],"des","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextAreaEdit",$AdminLangFile['lppage_details'].ENLANG,"des_en","0","0","option",$MoreS);
 
echo '<div style="clear: both!important;"></div>';
 

$Arr= array("Col"=> "col-md-6" ,"name"=> "photo" ,'required' => '',"photo"=> $photo_t ,"path"=> F_PATH_V ,"upload_type"=>$ConfigP['photo_album'] ) ;
New_PrintFilePhoto("Edit",$Arr);


Form_Close_New("2","PhotoList");

if(isset($_POST['B1'])){
if($ErrForm != '1'){    
Vall($Err,"EditPhoto",$db,"1",$USER_PERMATION_Add);
}  
}            
 



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
 
?>
 