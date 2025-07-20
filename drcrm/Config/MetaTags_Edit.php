<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
 

$TypeLine = "Edit";
$GroupTabel = "config_meta"; 
$row = $db->H_CheckTheGet("id","id",$GroupTabel,"2");
extract($row);


 
if(isset($_POST['DletePhoto'])){
Image_Dell_But_From_Page($id,$GroupTabel,F_PATH_D,"2","photo","photo_t");
}   
 
Form_Open($ArrForm);
$Err = array();
 
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text".$TypeLine,$AdminLangFile['webconfig_meta_catid'],"cat_id","0","0","req",$MoreS);

$Arr = array("Label" => 'on',"Active" => '0');      
$Err[] = NF_PrintSelect_2018("Chosen","Banner Category","col-md-3","banner_id","web_banner_cat","req",$banner_id,$Arr);	

NF_PrintRadio_Active ("2_Line","col-md-3","Banner State","banner_state",$banner_state); 


#################################################################################################################################
###################################################   Google
#################################################################################################################################
$Arr = array("StopUrl"=>'1');
$Err = Add_Google_Seo_Filde("Edit",$Arr);

echo '<div style="clear: both!important;"></div> ';


if($ConfigP['header_h'] == '1'){
New_Print_Alert("5","Header");       
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text".$TypeLine,"Header H3","header_h3","0","0","",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text".$TypeLine,"Header H3".ENLANG,"header_h3_en","0","0","",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text".$TypeLine,"Header H6","header_h6","0","0","",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text".$TypeLine,"Header H6".ENLANG,"header_h6_en","0","0","",$MoreS);
}




if($ConfigP['header_photo'] == '1'){
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("5","Header Photo"); 

$Arr= array("Col"=> "col-md-6" ,"name"=> "photo" ,'required' => '', 'Dell_But'=> '1',
"photo"=> $photo_t ,"path"=> F_PATH_V , 'upload_type'=>$ConfigP['defphoto_meta'] ) ;
New_PrintFilePhoto("Edit",$Arr);
}

 
Form_Close_New("2","MetaTags");

 
if(isset($_POST['B1'])){
Vall($Err,"EditMetaTag",$db,"1",$USER_PERMATION_Edit);
}  
         

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page(); 
?>
 