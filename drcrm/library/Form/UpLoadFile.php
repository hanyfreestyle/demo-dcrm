<?php
if(!defined('WEB_ROOT')) {	exit;}
 
#################################################################################################################
############################################# Add2Photo
#################################################################################################################
function Add2Photo($UploadState="1",$ArrConfig=""){
    if(isset($ArrConfig['FileName'])){
        $FileName = $ArrConfig['FileName'] ;
    }else{
        $FileName = "photo";
    }
    if(isset($ArrConfig['Path'])){
        $Path = $ArrConfig['Path'];
    }else{
        $Path = F_PATH ;
    }

    if(isset($ArrConfig['UpLoadType'])){
        $FileC = GetUpLoadTypeArr($ArrConfig['UpLoadType']);
    }else{
        $FileC = array('Err'=> "1");
    }

    if( $UploadState == "1"){
        $photoUp =   UploadTwoPhoto_2($FileName,$Path,$FileC);
        $photo = CURRENT_PATH .  $photoUp['photo'] ;
        $photo_t = CURRENT_PATH . $photoUp['photo_t'];
    }else{
        if($_FILES[$FileName]['size'] != '0') {
            $photoUp =   UploadTwoPhoto_2($FileName,$Path,$FileC);
            $photo = CURRENT_PATH .  $photoUp['photo'] ;
            $photo_t = CURRENT_PATH . $photoUp['photo_t'];
        }else{
            $photo = "";
            $photo_t = "";
            $photoUp['photoErr']="";
        }
    }
    $data = array(
        'photoErr' => $photoUp['photoErr'],
        'photo' => $photo ,
        'photo_t' => $photo_t ,
    );
    return $data ;
}
 
 
################################################################################################################# 
#############################################   Edit2Photo
################################################################################################################# 
function Edit2Photo($GroupTabel,$ArrConfig=""){
    global $db ;

    if(isset($ArrConfig['FileName'])){
        $FileName = $ArrConfig['FileName'] ;
    }else{
        $FileName = "photo";
    }

    if(isset($ArrConfig['PhotoID'])){
        $id = $ArrConfig['PhotoID'];
    }else{
        $id = $_GET['id'];
    }

    if(isset($ArrConfig['Path'])){
        $Path = $ArrConfig['Path'];
    }else{
        $Path = F_PATH ;
    }

    if(isset($ArrConfig['PathDelete'])){
        $PathDelete = $ArrConfig['PathDelete'];
    }else{
        $PathDelete = F_PATH_D ;
    }

    if(isset($ArrConfig['Filed_Photo'])){
        $Filed_Photo = $ArrConfig['Filed_Photo'];
    }else{
        $Filed_Photo = "photo";
    }

    if(isset($ArrConfig['Filed_Photo_t'])){
        $Filed_Photo_t = $ArrConfig['Filed_Photo_t'];
    }else{
        $Filed_Photo_t = "photo_t";
    }

    if(isset($ArrConfig['UpLoadType'])){
        $FileC = GetUpLoadTypeArr($ArrConfig['UpLoadType']);
    }else{
        $FileC = array('Err'=> "1");
    }


    $photoUp['photoErr']="";

    $row = $db->H_SelectOneRow("select * from $GroupTabel where id = '$id' ");

    if ($_FILES[$FileName]['size'] != '0' and $FileC['Err']!= '1') {
        $photoUp =   UploadTwoPhoto_2($FileName,$Path,$FileC);
        $photo = CURRENT_PATH .  $photoUp['photo'] ;
        $photo_t = CURRENT_PATH . $photoUp['photo_t'];

        if ($photoUp['photoErr'] != '1'  ) {
            Image_Dell("2",$id,$PathDelete,$GroupTabel,$Filed_Photo,$Filed_Photo_t);
        }
    } else {
        $photo = $row[$Filed_Photo];
        $photo_t = $row[$Filed_Photo_t];
    }
    $data = array(
        'photoErr' => $photoUp['photoErr'],
        'photo' => $photo ,
        'photo_t' => $photo_t ,
    );

    return $data ;

}

#################################################################################################################################
###################################################    GetUpLoadTypeArr
#################################################################################################################################
function GetUpLoadTypeArr($ID){
    global $db ;
    $ID = intval($ID);
    $SQL = "select * from config_photo where id =  '$ID'";
    $already = $db->H_Total_Count($SQL);
    if($already == '1'){
        $row = $db->H_SelectOneRow($SQL);
        $PhotoPath = "";
        if($row['photo'] != ""){
            $PhotoPath = WATERMARK_IMAGE_DIR_D.$row['photo'];
        }
        $FileC = array (
            'resize_P'=> $row['resize_p'] ,
            'file_rename'=> $row['file_rename'] ,
            'width'=> $row['width'] ,
            'height'=>$row['height'],
            'resize_T'=> $row['resize_t']  ,
            'width_t'=> $row['width_t'] ,
            'height_t'=> $row['height_t']   ,
            'mark'=> $row['mark'],
            'mark_text'=> $row['mark_text']  ,
            'mark_color'=> $row['mark_color'],
            'mark_back'=> $row['mark_back'],
            'png_state'=> $row['png_state']  ,
            'png'=> $PhotoPath ,
            'watermark_position'=> $row['mark_position'] ,
            'color'=> $row['color'],
            'size'=> $row['m_size'],
            'M_width'=>$row['m_width'],
            'M_height'=> $row['m_height'],
            'quality'=> $row['quality'],
            
            'Err'=> "0",
        );
    }else{
        $FileC = array (
            'Err'=> "1",
        );
    }
    return $FileC ;
}
#################################################################################################################################
###################################################   UploadFileName 
#################################################################################################################################
function UploadFile_Name($handle,$FileC,$PostName="name_en"){
    $NameType_AR = preg_match("/\p{Arabic}/u", $handle->file_src_name_body);
    if($NameType_AR == "1" ){
        $handle->file_src_name_body = Rand_Name("10");
    }else{
        if($FileC['file_rename'] == '1' and isset($_POST[$PostName])){
            $SendName = preg_match("/\p{Arabic}/u", $_POST[$PostName]);
            if($SendName == '1'){
                $handle->file_src_name_body = Rand_Name("10");
            }else{
                $handle->file_src_name_body = PostIsset("$PostName");
            }
        }
    }
    return  $handle->file_src_name_body ;
}
#################################################################################################################################
###################################################   UploadFile_Watermark 
#################################################################################################################################
function UploadFile_Watermark($handle,$FileC){
        
        if($FileC['mark'] == '1') {
            $handle->image_unsharp         = true;
            $handle->image_border          = '0 0 20 0';
            $handle->image_border_color    = $FileC['mark_back'];
            $handle->image_text            = $FileC['mark_text'];
            $handle->image_text_color      = $FileC['mark_color'];
            $handle->image_text_font       = 10;
            $handle->image_text_position   = 'B';
            $handle->image_text_padding_y  = 2;
        }
        
        if($FileC['png_state'] == '1' and $FileC['png'] != "") {
            $handle->image_watermark = $FileC['png'];
            Watermark_Position($FileC['watermark_position'],$FileC,$handle);
        }   
}

function UploadFile_Quality($handle,$FileC){
       if(isset($FileC['quality']) and intval($FileC['quality']) > "49"){
       $handle->jpeg_quality = $FileC['quality'] ;
       }
}
 
#################################################################################################################################
###################################################    UploadTwoPhoto_2
#################################################################################################################################
function UploadTwoPhoto_2($photoFile,$DIR,$FileC) {
    $FileC['size'] = $FileC['size'] * 1024;
    $photoErr = ""; $photo = ''; $photo_t ="";
    $dir_dest = ($DIR);
    $handle = new Upload($_FILES[$photoFile]);
    if($handle->uploaded) {
        WhatWillWeDo($FileC['resize_P'],$FileC,$handle);
        
        /// File Watermark
        UploadFile_Watermark($handle,$FileC);
        /// File Rename
        UploadFile_Name($handle,$FileC,"name_en");
        
        
        $handle->file_new_name_body   = strtolower($handle->file_src_name_body);
        $handle->mime_magic_check = true;
        UploadFile_Quality($handle,$FileC);
        $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
        $handle->file_max_size = $FileC['size'];
        $handle->image_max_width = $FileC['M_width'];
        $handle->image_max_height = $FileC['M_height'];
        $handle->Process($dir_dest);
        if($handle->processed) {
            $photo = $handle->file_dst_name;
        } else {
            PrintErrPhoto($handle->error,$FileC);
            $photoErr = 1;
        }
        WhatWillWeDoT($FileC['resize_T'],$FileC,$handle);
        $handle->mime_magic_check = true;
        UploadFile_Quality($handle,$FileC);
        $handle->file_new_name_body   = strtolower($handle->file_src_name_body);
        $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
        $handle->file_max_size = $FileC['size'];
        $handle->image_max_width = $FileC['M_width'];
        $handle->image_max_height = $FileC['M_height'];
        $handle->Process($dir_dest);
        if($handle->processed) {
            $photo_t = $handle->file_dst_name;
        } else {
            $photoErr = 1;
        }
        $handle->Clean();
    } else {
        PrintErrPhoto($handle->error,$FileC);
        $photoErr = 1;
        $photo ="";
        $photo_t ="";
    }
    return array('photo' => $photo,'photo_t' => $photo_t,'photoErr' => $photoErr);
}



#################################################################################################################################
###################################################    UploadOnePhoto
#################################################################################################################################
function UploadOnePhoto($photoFile,$DIR,$FileC) {
    $FileC['size'] = $FileC['size'] * 1024;
    $photoErr = 0;
    $photo = '';
    $dir_dest = ($DIR);
    
     
    $handle = new Upload($_FILES[$photoFile]);
    if($handle->uploaded) {

        WhatWillWeDo($FileC['resize_P'],$FileC,$handle);


        /// File Watermark
        UploadFile_Watermark($handle,$FileC);
        /// File Rename
        UploadFile_Name($handle,$FileC,"name_en");


        $handle->mime_magic_check = true;
        UploadFile_Quality($handle,$FileC);
        $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
        $handle->file_max_size = $FileC['size'];
        $handle->image_max_width = $FileC['M_width'];
        $handle->image_max_height = $FileC['M_height'];
        $handle->Process($dir_dest);
        if($handle->processed) {
            $photo = $handle->file_dst_name;
        } else {
            PrintErrPhoto($handle->error,$FileC);
            $photoErr = 1;
        }
        $handle->Clean();
    } else {
        PrintErrPhoto($handle->error,$FileC);
        $photoErr = 1;
    }
    return array('photo' => $photo,'photoErr' => $photoErr);
}


#################################################################################################################################
###################################################  UploadTwoPhoto_Multiple
#################################################################################################################################
function UploadTwoPhoto_Multiple($photoFile,$DIR,$FileC) {
    $FileC['size'] = $FileC['size'] * 1024;
    $photoErr = 0;
    $photo = ''; $photo_t = "" ; $ErrMass="";
    $dir_dest = ($DIR);
    $handle = new Upload($photoFile);
    if($handle->uploaded) {
        
        UploadFile_Photo_01($handle,$FileC,$dir_dest);
  
        if($handle->processed) {
            $photo = $handle->file_dst_name;
        } else {
            $ErrMass = $handle->error;
            $photoErr = 1;
        }

        UploadFile_Photo_02($handle,$FileC,$dir_dest);
        if($handle->processed) {
            $photo_t = $handle->file_dst_name;
        } else {
            $photoErr = 1;
        }
        $handle->Clean();
    } else {
        $ErrMass = $handle->error;
        $photoErr = 1;
    }
    return array('photo' => $photo,'photo_t' => $photo_t,'photoErr' => $photoErr,'ErrMass' => $ErrMass);
}



function UploadFile_Photo_01($handle,$FileC,$dir_dest){
        WhatWillWeDo($FileC['resize_P'],$FileC,$handle);
        /// File Watermark
        UploadFile_Watermark($handle,$FileC);
        /// File Rename
        UploadFile_Name($handle,$FileC,"name_en");
        $handle->file_new_name_body   = strtolower($handle->file_src_name_body);
        $handle->mime_magic_check = true;
        UploadFile_Quality($handle,$FileC);
        $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
        $handle->file_max_size = $FileC['size'];
        $handle->image_max_width = $FileC['M_width'];
        $handle->image_max_height = $FileC['M_height'];
        $handle->Process($dir_dest);
}

function UploadFile_Photo_02($handle,$FileC,$dir_dest){
        WhatWillWeDoT($FileC['resize_T'],$FileC,$handle);
        $handle->mime_magic_check = true;
        UploadFile_Quality($handle,$FileC);
        $handle->file_new_name_body   = strtolower($handle->file_src_name_body);
        $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
        $handle->file_max_size = $FileC['size'];
        $handle->image_max_width = $FileC['M_width'];
        $handle->image_max_height = $FileC['M_height'];
        $handle->Process($dir_dest);
}

#################################################################################################################################
###################################################    UploadOnePhoto_NoConfig
#################################################################################################################################
function UploadOnePhoto_NoConfig($photoFile,$DIR,$FileC) {
    $photoErr = 0;
    $photo = '';
    $FileC['size'] = $FileC['size'] * 1024;
    $dir_dest = ($DIR);
    $handle = new Upload($_FILES[$photoFile]);
    if($handle->uploaded) {
        $handle->mime_magic_check = true;

        $NameType_AR = preg_match("/\p{Arabic}/u", $handle->file_src_name_body);
        if($NameType_AR == "1" ){
            $handle->file_src_name_body = Rand_Name("10");
        }
        $handle->file_new_name_body   = strtolower($handle->file_src_name_body);

        $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
        $handle->file_max_size = $FileC['size'];
        $handle->Process($dir_dest);
        if($handle->processed) {
            $photo = $handle->file_dst_name;
        } else {
            PrintErrPhoto($handle->error,$FileC);
            $photoErr = 1;
        }
        $handle->Clean();
    } else {
        // one error occured
        PrintErrPhoto($handle->error,$FileC);
        $photoErr = 1;
    }
    return array('photo' => $photo,'photoErr' => $photoErr);
}

#################################################################################################################################
###################################################    Image_Dell
#################################################################################################################################
function Image_Dell($state,$id,$Path,$Tabel,$photo,$photo2 = "") {
    global $db ;
    if($state == '1') {
        $sql = "SELECT * FROM $Tabel WHERE id = '$id'";
        $row = $db->H_SelectOneRow($sql);
        $deleted = @unlink($Path.$row[$photo]);
        return $deleted;
    }
    if($state == '2') {
        $sql = "SELECT * FROM $Tabel WHERE id = '$id'";
        $row = $db->H_SelectOneRow($sql);
        $deleted = @unlink($Path.$row[$photo]);
        $deleted = @unlink($Path.$row[$photo2]);
        return $deleted;
    }
}

#################################################################################################################################
###################################################    Image_Dell_But_From_Page
#################################################################################################################################
function Image_Dell_But_From_Page($id,$Tabel,$Path,$PhotoCount,$Filde_1,$Filde_2,$FilterID="id"){
    global $db;
    Image_Dell($PhotoCount,$id,$Path,$Tabel,$Filde_1,$Filde_2);
    $server_data = array ($Filde_1 => "");
    if($PhotoCount == '2'){
        $server_data = array ($Filde_1 => "" ,$Filde_2=>"");
    }
    $db->AutoExecute($Tabel,$server_data,AUTO_UPDATE,"$FilterID = $id");
    Redirect_Page_2(LASTREFFPAGE);
}
#################################################################################################################################
###################################################    GetNameWithNoExt
#################################################################################################################################
function GetNameWithNoExt($FileName){
    $FileName = explode('/',$FileName);
    $NewName = substr($FileName['1'], 0, strrpos($FileName['1'], '.'));
    return $NewName;
}
#################################################################################################################################
###################################################    GetNameWithNoExt_2
#################################################################################################################################
function GetNameWithNoExt_2($FileName){
    $NewName = substr($FileName, 0, strrpos($FileName, '.'));
    return $NewName;
}

#################################################################################################################################
###################################################    GetExOfFile
#################################################################################################################################
function GetExOfFile($FileName){
    global $AdminPath ;
    $Exten =  substr($FileName, strrpos($FileName, '.') + 1);
    switch ($Exten){
        case 'xls':
            $ExtenIcon = '<img src="'.$AdminPath.'img/xls.png" />';
            break;

        case 'doc':
            $ExtenIcon = '<img src="'.$AdminPath.'img/Doc.png" />';
            break;

        case 'pdf':
            $ExtenIcon = '<img src="'.$AdminPath.'img/Pdf.png" />';
            break;

        case 'zip':
            $ExtenIcon = '<img src="'.$AdminPath.'img/zip.png " />';
            break;

        case 'txt':
            $ExtenIcon = '<img src="'.$AdminPath.'img/txt.png " />';
            break;

        case 'jpg':
            $ExtenIcon = '<img src="'.$AdminPath.'img/jpg.png " />';
            break;


        default :
            $ExtenIcon = '<img src="'.$AdminPath.'img/File.png" />';

    }
    return array('Exten'=> $Exten , 'Icon'=> $ExtenIcon);
}

#################################################################################################################################
###################################################    Rand_Name
#################################################################################################################################
function Rand_Name($num_chars) {
    $ret = "";
    $chars = array("1","2","3","4","5","6","7","8","9","0","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
    $string = array_rand($chars,$num_chars);
    foreach($string as $s) {
        $ret .= $chars[$s];
    }
    return $ret;
}

#################################################################################################################################
###################################################    PrintErrPhoto
#################################################################################################################################
function PrintErrPhoto($Errr,$Mass) {
    echo '<script type="text/javascript">';
    echo '$(document).ready(function(){';
    echo '$("#ErrMass").addClass("ErrMass_Div_S");';
    echo '$("#ErrMass").append("';
    echo CheckCatimgErr_2($Errr,$Mass);
    echo '");';
    echo '});';
    echo '</script>';
}

#################################################################################################################################
###################################################   PrintErrPhoto_Multiple
#################################################################################################################################
function PrintErrPhoto_Multiple($photoUp,$Errr,$Mass,$file_name) {
    global $AdminLangFile ;
    if($photoUp == '1') {
        $Mass = '<strong>'.$AdminLangFile['mainform_morephoto_err_mass'].'</strong>'.'&nbsp;&nbsp;'.$file_name.'&nbsp;&nbsp;'.CheckCatimgErr_2($Errr,$Mass) ;
        echo  New_Print_Alert("4",$Mass);    
    } else {
        $Mass = '<strong>'.$AdminLangFile['mainform_morephoto_done_mass'].'</strong>'.'&nbsp;&nbsp;'.$file_name ;
        echo  New_Print_Alert("1",$Mass);
    }
}
#################################################################################################################################
###################################################  CheckCatimgErr_2
#################################################################################################################################
function CheckCatimgErr_2($ErrType,$FileC) {
    global $AdminLangFile ;
    $ErrMass = "";
    switch($ErrType) {
        case 'Incorrect type of file.':
            if( isset($FileC['ViewErr']) and  $FileC['ViewErr'] != "") {
                $ErrMass = $FileC['ViewErr'];
            } else {
                $ErrMass = $AdminLangFile['mainform_incorrect_type_of_file'];
            }
            break;
         case 'File upload error (the uploaded file exceeds the upload_max_filesize directive in php.ini).':
            $ErrMass = $AdminLangFile['mainform_file_too_big']." ".$FileC['size']."KB";
            break;
        case 'File too big.':
            $ErrMass = $AdminLangFile['mainform_file_too_big']." ".$FileC['size']." KB ";
            break;
        case 'uploaded_missing':
            $ErrMass = $AdminLangFile['mainform_uploaded_missing'];
            break;

        case 'File upload error (no file was uploaded).':
            $ErrMass = $AdminLangFile['mainform_uploaded_missing'];
            break;
        case 'Image too wide.':
            $ErrMass = $AdminLangFile['mainform_image_too_wide']." ".$FileC['M_width']." "."PX";
            break;
        case 'Image too tall.':
            $ErrMass = $AdminLangFile['mainform_image_too_tall']." ".$FileC['M_height']." "."PX";
            break;
        default:
            $ErrMass = $ErrType;
    }
    return $ErrMass;
}

#################################################################################################################################
###################################################   WhatWillWeDo
#################################################################################################################################
function WhatWillWeDo($DoState,$FileC,$handle) {
    switch($DoState) {
        case "1":
            break;
        case "2":
            $handle->image_resize = true;
            $handle->image_ratio_fill = "C";
            $handle->image_y = $FileC['height'];
            $handle->image_x = $FileC['width'];
            $handle->image_background_color = $FileC['color'];
            break;
        case "3":
            if($handle->image_src_x > $FileC['width']) {
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_x = $FileC['width'];
            }else{
                $FileC['width'] = $handle->image_src_x - 1 ;
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_x = $FileC['width'];  
            }
            break;
        case "4":
            if($handle->image_src_y > $FileC['height']) {
                $handle->image_resize = true;
                $handle->image_ratio_x = true;
                $handle->image_y = $FileC['height'];
            }else{
                $FileC['height'] = $handle->image_y  -1 ;
                $handle->image_resize = true;
                $handle->image_ratio_x = true;
                $handle->image_y = $FileC['height'];   
            }
            break;
        case "5":
            $handle->image_resize = true;
            $handle->image_y = $FileC['height'];
            $handle->image_x = $FileC['width'];
            break;

        case "6":
            $handle->image_resize = true;
            $handle->image_ratio_crop = true;
            $handle->image_y = $FileC['height'];
            $handle->image_x = $FileC['width'];
            break;

        default:
            $handle->image_resize = true;
            $handle->image_ratio_fill = "C";
            $handle->image_y = $FileC['height'];
            $handle->image_x = $FileC['width'];
            $handle->image_background_color = $FileC['color'];
    }
}

#################################################################################################################################
###################################################    WhatWillWeDoT
#################################################################################################################################
function WhatWillWeDoT($DoState,$FileC,$handle) {
    switch($DoState) {
        case "1":
            break;
        case "2":
            $handle->image_resize = true;
            $handle->image_ratio_fill = "C";
            $handle->image_y = $FileC['height_t'];
            $handle->image_x = $FileC['width_t'];
            $handle->image_background_color = $FileC['color'];
            break;
        case "3":
            if($handle->image_src_x > $FileC['width_t']) {
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_x = $FileC['width_t'];
            }else{
                $FileC['width_t'] = $handle->image_src_x - 1 ;
                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_x = $FileC['width_t'];  
            }
            break;            
        case "4":
            if($handle->image_src_y > $FileC['height_t']) {
                $handle->image_resize = true;
                $handle->image_ratio_x = true;
                $handle->image_y = $FileC['height_t'];
            }else{
                $FileC['height_t'] = $handle->image_y  -1 ;
                $handle->image_resize = true;
                $handle->image_ratio_x = true;
                $handle->image_y = $FileC['height_t'];   
            }
            break;
        case "5":
            $handle->image_resize = true;
            $handle->image_y = $FileC['height_t'];
            $handle->image_x = $FileC['width_t'];
            break;
        case "6":
            $handle->image_resize = true;
            $handle->image_ratio_crop = true;
            $handle->image_y = $FileC['height_t'];
            $handle->image_x = $FileC['width_t'];
            break;
        default:
            $handle->image_resize = true;
            $handle->image_ratio_fill = "C";
            $handle->image_y = $FileC['height_t'];
            $handle->image_x = $FileC['width_t'];
            $handle->image_background_color = $FileC['color'];
    }
}
#################################################################################################################################
###################################################    $WhatWillWeDoText
#################################################################################################################################
$WhatWillWeDoText = array (
    '1'=> $AdminLangFile['mainform_no_change_image_dimensions'],
    '2'=> $AdminLangFile['mainform_image_dimensions_background'],
    '3'=> $AdminLangFile['mainform_image_dimensions_to_width'],
    '4'=> $AdminLangFile['mainform_image_dimensions_to_height'],
    '5'=> $AdminLangFile['mainform_image_dimensions_to_width_height'] ,
    '6'=> $AdminLangFile['mainform_image_crop_to_width_height'],
);


function  WhatWillWeDoText($DoState) {
    global$AdminLangFile ;
    switch($DoState) {
        case "1":
            $Name = $AdminLangFile['mainform_no_change_image_dimensions'];
            break;
        case "2":
            $Name = $AdminLangFile['mainform_image_dimensions_background'];
            break;
        case "3":
            $Name = $AdminLangFile['mainform_image_dimensions_to_width'];
            break;
        case "4":
            $Name = $AdminLangFile['mainform_image_dimensions_to_height'];
            break;
        case "5":
            $Name = $AdminLangFile['mainform_image_dimensions_to_width_height'];
            break;
        case "6":
            $Name = $AdminLangFile['mainform_image_crop_to_width_height'];
            break;
        default:
            $Name ="";
    }

    return $Name ;
}
#################################################################################################################################
###################################################       $Watermark_Position
#################################################################################################################################
$Watermark_Position = array (
    '1'=> $AdminLangFile['mainform_watermark_top_right'],
    '2'=> $AdminLangFile['mainform_watermark_top_left'],
    '3'=> $AdminLangFile['mainform_watermark_center'],
    '4'=> $AdminLangFile['mainform_watermark_bottom_right'],
    '5'=> $AdminLangFile['mainform_watermark_bottom_left'],
);

function Watermark_Position($DoState,$FileC,$handle) {
    switch($DoState) {
        case "1":
            $handle->image_watermark_position = 'TR';
            break;
        case "2":
            $handle->image_watermark_position = 'TL';
            break;
        case "3":
            $handle->image_watermark_position = 'C';
            break;
        case "4":
            $handle->image_watermark_position = 'BR';
            break;
        case "5":
            $handle->image_watermark_position = 'BL';
            break;
        default:
            $handle->image_watermark_position = 'C';
    }
}


#################################################################################################################################
###################################################
#################################################################################################################################
/*
        $NameType_AR = preg_match("/\p{Arabic}/u", $handle->file_src_name_body);
        if($NameType_AR == "1" ){
            $handle->file_src_name_body = Rand_Name("10");
        }else{
           if($FileC['file_rename'] == '1' and isset($_POST['name_en'])){
            $SendName = preg_match("/\p{Arabic}/u", $_POST['name_en']);
            if($SendName == '1'){
            $handle->file_src_name_body = Rand_Name("10");
            }else{
            $handle->file_src_name_body = PostIsset("name_en");
            }
           }
        }
        */



#################################################################################################################################
###################################################
#################################################################################################################################


#################################################################################################################################
###################################################
#################################################################################################################################













/*

 
 
 
##############################################################################################################################################################
################################ UploadOnePhoto_2
##############################################################################################################################################################


##############################################################################################################################################################
################################ UploadTwoPhoto_Name
##############################################################################################################################################################
function UploadTwoPhoto_Name($photoFile,$DIR,$FileC) {
   $FileC['size'] = $FileC['size'] * 1024;
   $photoErr = 0;
   $photo = '';
   $dir_dest = ($DIR);
   $handle = new Upload($_FILES[$photoFile]);
   if($handle->uploaded) {
    
    $handle->file_auto_rename = false;
    $handle->file_new_name_body   = $FileC['OldName'];
    $handle->file_overwrite = true;
    
     WhatWillWeDo($FileC['resize_P'],$FileC,$handle);
     if($FileC['mark'] == '1') {
       $handle->image_background_color =  $FileC['color'];
       $handle->image_text = $FileC['marktext'];
       $handle->image_crop = '0 0 -16 0';
       $handle->image_text_color = $FileC['markcolor'];
       $handle->image_text_font = 10;
       $handle->image_text_position = 'B';
       $handle->image_text_padding_y = 2;
     }
     if($FileC['png_state'] == '1') {
       $handle->image_watermark = $FileC['png'];
       Watermark_Position($FileC['watermark_position'],$FileC,$handle);
     }
     $handle->mime_magic_check = true;
     $handle->jpeg_quality = '100';
     $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
     $handle->file_max_size = $FileC['size'];
     $handle->image_max_width = $FileC['M_width'];
     $handle->image_max_height = $FileC['M_height'];
     $handle->Process($dir_dest);
    
     if($handle->processed) {
       $photo = $handle->file_dst_name;
     } else {
       PrintErrPhoto($handle->error,$FileC);
       $photoErr = 1;
     }
    $handle->file_auto_rename = false;
    $handle->file_new_name_body   = $FileC['OldName_t'];
    $handle->file_overwrite = true;
    
     WhatWillWeDoT($FileC['resize_T'],$FileC,$handle);
     $handle->mime_magic_check = true;
     $handle->jpeg_quality = '100';
     $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
     $handle->file_max_size = $FileC['size'];
     $handle->image_max_width = $FileC['M_width'];
     $handle->image_max_height = $FileC['M_height'];
     $handle->Process($dir_dest);
     if($handle->processed) {
       $photo_t = $handle->file_dst_name;
     } else {
       $photoErr = 1;
     }
     $handle->Clean();
   } else {
     PrintErrPhoto($handle->error,$FileC);
     $photoErr = 1;
   }
   return array('photo' => $photo,'photo_t' => $photo_t,'photoErr' => $photoErr);
 }



##############################################################################################################################################################
################################ UploadthreePhoto_2
##############################################################################################################################################################
 function UploadthreePhoto_2($photoFile,$DIR,$FileC) {
   $FileC['size'] = $FileC['size'] * 1024;
   $photoErr = 0;
   $photo = '';
   $dir_dest = ($DIR);
   $handle = new Upload($_FILES[$photoFile]);
   if($handle->uploaded) {
     WhatWillWeDo($FileC['resize_P'],$FileC,$handle);
     if($FileC['mark'] == '1') {
       $handle->image_background_color = "#000000";
       $handle->image_text = $FileC['marktext'];
       $handle->image_crop = '0 0 -16 0';
       $handle->image_text_color = $FileC['markcolor'];
       $handle->image_text_font = 10;
       $handle->image_text_position = 'B';
       $handle->image_text_padding_y = 2;
     }
     if($FileC['png_state'] == '1') {
       $handle->image_watermark = $FileC['png'];
     }

     $NameType_AR = preg_match("/\p{Arabic}/u", $handle->file_src_name_body);
     if($NameType_AR == "1" ){
     $handle->file_src_name_body = Rand_Name("10");   
     }
     $handle->file_new_name_body   = strtolower($handle->file_src_name_body);     
     
     $handle->mime_magic_check = true;
     $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
     $handle->file_max_size = $FileC['size'];
     $handle->image_max_width = $FileC['M_width'];
     $handle->image_max_height = $FileC['M_height'];
     $handle->Process($dir_dest);
     if($handle->processed) {
       $photo = $handle->file_dst_name;
     } else {
       PrintErrPhoto($handle->error,$FileC);
       $photoErr = 1;
     }
     WhatWillWeDoT($FileC['resize_T'],$FileC,$handle);
     $handle->mime_magic_check = true;
     $handle->file_new_name_body   = strtolower($handle->file_src_name_body);
     $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
     $handle->file_max_size = $FileC['size'];
     $handle->image_max_width = $FileC['M_width'];
     $handle->image_max_height = $FileC['M_height'];
     $handle->Process($dir_dest);
     if($handle->processed) {
       $photo_t = $handle->file_dst_name;
     } else {
       $photoErr = 1;
     }
     
     $FileC['height_t'] = $FileC['height_t3'];
     $FileC['width_t'] = $FileC['width_t3'];
     
     WhatWillWeDoT($FileC['resize_T3'],$FileC,$handle);
     $handle->mime_magic_check = true;
     $handle->file_new_name_body   = strtolower($handle->file_src_name_body);
     $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
     $handle->file_max_size = $FileC['size'];
     $handle->image_max_width = $FileC['M_width'];
     $handle->image_max_height = $FileC['M_height'];
     $handle->Process($dir_dest);
     if($handle->processed) {
       $photo_t3 = $handle->file_dst_name;
     } else {
       $photoErr = 1;
     }
     
     $handle->Clean();
   } else {
     PrintErrPhoto($handle->error,$FileC);
     $photoErr = 1;
   }
   return array('photo' => $photo,'photo_t' => $photo_t,'photo_t3' => $photo_t3,'photoErr' => $photoErr);
 }



##############################################################################################################################################################
################################ UploadOneFile_Name
##############################################################################################################################################################
 function UploadOneFile_Name($photoFile,$DIR,$FileC) {
   $photoErr = 0;
   $photo = '';
   $FileC['size'] = $FileC['size'] * 1024;
   $dir_dest = ($DIR);
   $handle = new Upload($_FILES[$photoFile]);
   if($handle->uploaded) {
    $handle->file_auto_rename = false;
    $handle->file_new_name_body   = $FileC['OldName'];
    $handle->file_overwrite = true;
    
     $handle->mime_magic_check = true;
     $handle->allowed = $FileC['Mimtype'];
     $handle->file_max_size = $FileC['size'];
     $handle->Process($dir_dest);
     if($handle->processed) {
       $photo = $handle->file_dst_name;
     } else {
       PrintErrPhoto($handle->error,$FileC);
       $photoErr = 1;
     }
     $handle->Clean();
   } else {
     // one error occured
     PrintErrPhoto($handle->error,$FileC);
     $photoErr = 1;
   }
   return array('photo' => $photo,'photoErr' => $photoErr);
 }



##############################################################################################################################################################
################################ UploadOneFile_Name
##############################################################################################################################################################



##############################################################################################################################################################
################################ UploadOnePhoto_Multiple
##############################################################################################################################################################
 function UploadOnePhoto_Multiple($photoFile,$DIR,$FileC) {
   $FileC['size'] = $FileC['size'] * 1024;
   $photoErr = 0;
   $photo = '';
   $dir_dest = ($DIR);
   $handle = new Upload($photoFile);
   if($handle->uploaded) {
     WhatWillWeDo($FileC['resize'],$FileC,$handle);
     if($FileC['mark'] == '1') {
       $handle->image_background_color = "#000000";
       $handle->image_text = $FileC['marktext'];
       $handle->image_crop = '0 0 -16 0';
       $handle->image_text_color = $FileC['markcolor'];
       $handle->image_text_font = 10;
       $handle->image_text_position = 'B';
       $handle->image_text_padding_y = 2;
     }
     if($FileC['png_state'] == '1') {
       $handle->image_watermark = $FileC['png'];
     }

     
     $NameType_AR = preg_match("/\p{Arabic}/u", $handle->file_src_name_body);
     if($NameType_AR == "1" ){
     $handle->file_src_name_body = Rand_Name("10");   
     }
     $handle->file_new_name_body   = strtolower($handle->file_src_name_body);  

     $handle->mime_magic_check = true;
     $handle->allowed = array('image/gif','image/jpg','image/jpeg','image/png');
     $handle->file_max_size = $FileC['size'];
     $handle->image_max_width = $FileC['M_width'];
     $handle->image_max_height = $FileC['M_height'];
     $handle->Process($dir_dest);
     if($handle->processed) {
       $photo = $handle->file_dst_name;
     } else {
       $ErrMass = $handle->error;
       $photoErr = 1;
     }
     $handle->Clean();
   } else {
     $ErrMass = $handle->error;
     $photoErr = 1;
   }
   return array('photo' => $photo,'photoErr' => $photoErr,'ErrMass' => $ErrMass);
 }
 

##############################################################################################################################################################
################################ UploadOneFile_New
##############################################################################################################################################################
 function UploadOneFile_New($photoFile,$DIR,$FileC) {
   $photoErr = 0;
   $photo = '';
   $FileC['size'] = $FileC['size'] * 1024;
   $dir_dest = ($DIR);
   $handle = new Upload($_FILES[$photoFile]);
   if($handle->uploaded) {
     $handle->mime_magic_check = true;

     $NameType_AR = preg_match("/\p{Arabic}/u", $handle->file_src_name_body);
     if($NameType_AR == "1" ){
     $handle->file_src_name_body = Rand_Name("10");   
     }
     $handle->file_new_name_body   = strtolower($handle->file_src_name_body);  
          
     $handle->allowed = $FileC['Mimtype'];
     $handle->file_max_size = $FileC['size'];
     $handle->Process($dir_dest);
     if($handle->processed) {
       $photo = $handle->file_dst_name;
     } else {
       PrintErrPhoto($handle->error,$FileC);
       $photoErr = 1;
     }
     $handle->Clean();
   } else {
     // one error occured
     PrintErrPhoto($handle->error,$FileC);
     $photoErr = 1;
   }
   return array('photo' => $photo,'photoErr' => $photoErr);
 }


*/
?>