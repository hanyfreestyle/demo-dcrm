<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$row = $db->H_CheckTheGet("id","id",$GroupTabel,"2");
$id = $row['id'];
 

 

$BlockTYpe = intval($_GET['type']);
$LandingPageBlock = LandingPageBlock($BlockTYpe);
if($LandingPageBlock != "Err"){
 
 
 
Form_Open($ArrForm);
//hidden
echo '<input type="hidden" name="cat_id" value="'.$id.'" />';
echo '<input type="hidden" name="type" value="'.$BlockTYpe.'" />';
echo '<div style="clear: both!important;"></div>';
PrintFildInformation("col-md-6",$AdminLangFile['lppage_page_name'],$row[$NamePrint]);
PrintFildInformation("col-md-6",$AdminLangFile['lppage_block_type'],$LandingPageBlock);
echo '<div style="clear: both!important;"></div>'.BR.BR;



$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="alphanum" data-parsley-minlength="4" ' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text","Section ID ","var","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_bl_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['lppage_bl_name'].ENLANG,"name_en","1","1","req",$MoreS);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text","Block Style","block_style","0","1","",$MoreS);

NF_PrintRadio_Active ("2_Line","col-md-4","Menu Status","menu_s","1");

echo '<div style="clear: both!important;"></div>'.BR.BR;

switch($BlockTYpe) {
    
     case "1":
        ////اضافة بانر
       Add_BlockType_01(""); 
       break;
     case "2":
       //// اضافة نص
       Add_BlockType_02("");
       break;
     case "3":
      /// اضافة فيديو
       Add_BlockType_03("");
       break;
     case "4":
      /// اضافة جوجل
       Add_BlockType_04("");
       break;
     case "5":
        ///اضافة البوم صور
        Add_BlockType_05("");
       break;
     case "6":
     /// اتصل بنا 
        Add_BlockType_06("");
       break;
     default:
     $order = "Err";
      
}



Form_Close_New("1","ListPage");

if(isset($_POST['B1'])){
if($ErrForm != '1'){    
Vall($Err,"AddBlock",$db,"1",$USER_PERMATION_Add);
}  
}            

}

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page(); 
 
?>
 