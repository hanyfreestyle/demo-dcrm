<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


if($view == 'PhotoSizeAdd'){
    $FildeType = "" ; $resize_p ="";$resize_t = ""; $mark=""; $png_state="";$mark_position=""; $row['photo']="";$row['color']="" ;
    $PhotoFile = "Add";
    $But = "1";
    $file_rename = "0";
}elseif($view == 'PhotoSizeEdit'){
    $FildeType = "Edit" ;
    $PhotoFile = "Edit";
    $But = "2";
    $row = $db->H_CheckTheGet("id","id","config_photo","2");
    $id = $row['id'];
    extract($row);
}


if(isset($_POST['DletePhoto'])){
Image_Dell_But_From_Page($id,"config_photo",WATERMARK_IMAGE_DIR_D,"1","photo","");
}


Form_Open();

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['webconfig_photo_size_name'],"name","","","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-min="50" data-parsley-max="100" ', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['webconfig_photo_quality'],"quality","","","req",$MoreS);


NF_PrintRadio_Active ("2_Line","col-md-3",$ALang['webconfig_photo_file_rename'],"file_rename",$file_rename);


echo '<div style="clear: both!important;"></div> ';


#################################################################################################################################
###################################################   صور القسم
#################################################################################################################################
New_Print_Alert("5",$AdminLangFile['webconfig_image_dimensions']); 
 
$Arr = array("StartFrom" => '1',"Label" => 'on' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['mainconfig_u_image_upload_type'],"col-md-4","resize_p",$WhatWillWeDoText,"req",$resize_p,$Arr);

$Arr = array("StartFrom" => '1',"Label" => 'on' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['mainconfig_u_thumbnail_image_upload_type'],"col-md-4","resize_t",$WhatWillWeDoText,"req",$resize_t,$Arr);

 
$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required ', 'Dir'=> "En"  ,'OnLine'=> '0');
$Err[] = NF_PrintInput("Color",$AdminLangFile['mainconfig_u_image_background_color'],"color","","","req",$MoreS);

echo '<div style="clear: both!important;"></div>';


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits"', 'Dir'=> "En_Lang" ); 
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['mainconfig_u_image_width'],"width","1","1","req-num",$MoreS);
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['mainconfig_u_image_height'],"height","1","1","req-num",$MoreS);
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['mainconfig_u_thumbnail_image_width'],"width_t","1","1","req-num",$MoreS);
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['mainconfig_u_thumbnail_image_height'],"height_t","1","1","req-num",$MoreS);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['mainconfig_maximum_image_width'],"m_width","1","1","req-num",$MoreS);
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['mainconfig_maximum_image_height'],"m_height","1","1","req-num",$MoreS);
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['mainconfig_maximum_file_size'],"m_size","1","1","req-num",$MoreS);



#################################################################################################################################
###################################################    webconfig_watermark_h1
#################################################################################################################################
//hidden
echo '<input type="hidden" value="#000000" name="mark_back" />';
echo '<input type="hidden" value="#ffffff" name="mark_color" />';
echo '<input type="hidden" value="'.$row['photo'].'" name="old_photo" />';

New_Print_Alert("5",$AdminLangFile['webconfig_watermark_h1']); 
$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text".$FildeType,$ALang['webconfig_watermark_text'],"mark_text","","","req",$MoreS);
NF_PrintRadio_Active ("2_Line","col-md-3",$ALang['webconfig_watermark_text_state'],"mark",$mark);


$Arr = array("StartFrom" => '1',"Label" => 'on' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$ALang['webconfig_watermark_position'],"col-md-3","mark_position",$Watermark_Position,"req",$mark_position,$Arr);

NF_PrintRadio_Active ("2_Line","col-md-3",$ALang['webconfig_watermark_photo_state'],"png_state",$png_state); 

echo '<div style="clear: both!important;"></div>';
$Arr= array("StopView"=>'1', "Col"=> "col-md-12" ,"name"=> "photo" ,'required' => '', "Dell_But"=> '1',
"photo"=> $row['photo'] ,"path"=> WATERMARK_IMAGE_DIR_V ,"NewStyle"=>"PngPhotoTh") ;
New_PrintFilePhoto($PhotoFile,$Arr);


Form_Close_New($But,"PhotoSize");


if(isset($_POST['B1'])){
    if($view == 'PhotoSizeAdd'){
        Vall($Err,"AddPhotoSize",$db,"1",$GroupPermation);
    }elseif($view == 'PhotoSizeEdit'){
        Vall($Err,"EditPhotoSize",$db,"1",$GroupPermation);
    }
}


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page(); 
?>