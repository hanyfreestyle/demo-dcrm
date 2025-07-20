<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
 
$LastAdd  = LastAdd($LastAdd_S);
Form_Open($ArrForm);

$Arr = array("Label" => 'on',"Active" => '1');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['mainform_sel_cat'],"col-md-4","cat_id","landpage_photo_cat","req",$LastAdd['cat_id'],$Arr); 
NF_PrintRadio_Active("2_Line","col-md-6",$AdminLangFile['mainform_save_lastcat'],"lastadd_state",$LastAdd['state']);

echo '<div style="clear: both!important;"></div>';
 

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_photo_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_photo_name'].ENLANG,"name_en","1","1","req",$MoreS);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['lppage_details'],"des","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['lppage_details'].ENLANG,"des_en","0","0","option",$MoreS);
 
 
 
echo '<div style="clear: both!important;"></div>';
 

$Arr= array("Col"=> "col-md-6" ,"name"=> "photo" ,'required' => 'required',"upload_type"=>$ConfigP['photo_album']) ;
New_PrintFilePhoto("Add",$Arr);
 


Form_Close_New("1","ListPage");

if(isset($_POST['B1'])){
if($ErrForm != '1'){    
Vall($Err,"AddPhoto",$db,"1",$USER_PERMATION_Add);
}  
}            
 

 
?>
</div></div>