<?php
if(!defined('WEB_ROOT')) {	exit;}
checkUser();
 

#################################################################################################################################
###################################################    Add MetaTag
#################################################################################################################################
function AddMetaTag($db){
    global $ConfigP ;
    $ThIsIsTest = '0';
    $TabelName = 'config_meta';

    $Cat_Id =  HandleDuplicate($TabelName,"cat_id",'cat_id',"0","id");

    if($ConfigP['header_photo'] == '1'){
        $ArrConfig =array("UpLoadType"=> $_POST['upload_type']);
        $photoUp =  Add2Photo("0",$ArrConfig);
    }else{
        $photoUp['photoErr'] = "0"; $photoUp['photo_t'] = ""; $photoUp['photo'] = "";
    }

    $server_data = array (
        'cat_id'=> $Cat_Id['Val'],
        'banner_id'=> PostIsset('banner_id'),
        'banner_state'=> PostIsset('banner_state'),
        'g_name'=> PostIsset('g_name')  ,
        'g_des'=> PostIsset('g_des')  ,
        'g_key'=> PostIsset('g_key',"1",array('KeyWors'=>'1'))  ,
        'g_name_en'=> PostIsset('g_name_en')  ,
        'g_des_en'=> PostIsset('g_des_en')  ,
        'g_key_en'=> PostIsset('g_key_en',"1",array('KeyWors'=>'1'))  ,
        'header_h3'=> PostIsset('header_h3')  ,
        'header_h3_en'=> PostIsset('header_h3_en')  ,
        'header_h6'=> PostIsset('header_h6')  ,
        'header_h6_en'=> PostIsset('header_h6_en')  ,
        'photo'=> $photoUp['photo'] ,
        'photo_t'=> $photoUp['photo_t'] ,
    );

    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Cat_Id['Err'] != '1' and  $photoUp['photoErr'] != '1'  ){
            $db->AutoExecute($TabelName,$server_data,AUTO_INSERT);
            Redirect_Page_2("index.php?view=MetaTags");
        }
    }
}

#################################################################################################################################
###################################################      Edit MetaTag
#################################################################################################################################
function EditMetaTag($db){
    global $ConfigP ;
    $ThIsIsTest = '0';
    $TabelName = 'config_meta';
    $id = $_GET['id'];
    $Cat_Id =  HandleDuplicate($TabelName,"cat_id",'cat_id',$id,"id");

    if($ConfigP['header_photo'] == '1'){
        $ArrConfig =array("UpLoadType"=> $_POST['upload_type']);
        $photoUp = Edit2Photo($TabelName,$ArrConfig);
    }else{
        $photoUp['photoErr'] = "0"; $photoUp['photo_t'] = ""; $photoUp['photo'] = "";
    }

    $server_data = array (
        'cat_id'=> $Cat_Id['Val'],
        'banner_id'=> PostIsset('banner_id'),
        'banner_state'=> PostIsset('banner_state'),        
        'g_name'=> PostIsset('g_name')  ,
        'g_des'=> PostIsset('g_des')  ,
        'g_key'=> PostIsset('g_key',"1",array('KeyWors'=>'1'))  ,
        'g_name_en'=> PostIsset('g_name_en')  ,
        'g_des_en'=> PostIsset('g_des_en')  ,
        'g_key_en'=> PostIsset('g_key_en',"1",array('KeyWors'=>'1'))  ,
        'header_h3'=> PostIsset('header_h3')  ,
        'header_h3_en'=> PostIsset('header_h3_en')  ,
        'header_h6'=> PostIsset('header_h6')  ,
        'header_h6_en'=> PostIsset('header_h6_en')  ,
        'photo'=> $photoUp['photo'] ,
        'photo_t'=> $photoUp['photo_t'] ,
    );

    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Cat_Id['Err'] != '1' and  $photoUp['photoErr'] != '1'  ){
            $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $id");
            Redirect_Page_2(LASTREFFPAGE);
        }
    }
}
################################################################################################################################
################################ WebConfig 
################################################################################################################################

function WebConfig($db){
    global $AdminLangFile;
     $Data = serialize($_POST);
     $server_data = array('web_config' => $Data,);
     $add_server = $db->AutoExecute("config",$server_data,AUTO_UPDATE,"");
     Redirect_Page_2(LASTREFFPAGE);
}

 
#################################################################################################################################
###################################################    AddEmailConfig
#################################################################################################################################
 function AddEmailConfig($db){
    $ThIsIsTest = '0';
    $Pass = Letter_Encrypt(Clean_Mypost($_POST['pass']));
    $server_data = array ( 'id'=> NULL ,
    'name'=> Clean_Mypost($_POST['name']),
    'sitemail'=> Clean_Mypost($_POST['sitemail']) ,
    'sitename'=> Clean_Mypost($_POST['sitename']) ,
    'server'=> Clean_Mypost($_POST['server']) ,
    'port'=> Clean_Mypost($_POST['port']) ,
    'user'=> Clean_Mypost($_POST['user']) ,
    'pass'=>  $Pass ,
    'state'=>  "1" ,
    'charest'=> Clean_Mypost($_POST['charest']) ,
    );

    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
       $add_server = $db->AutoExecute("config_email",$server_data,AUTO_INSERT);
       Redirect_Page_2("index.php?view=ConfigEmail");
    }
} 
 
#################################################################################################################################
###################################################    EditEmailConfig
#################################################################################################################################

function EditEmailConfig($db){
    $ThIsIsTest = '0';
    $id = $_GET['id'];

    if(isset($_POST['pass']) and trim($_POST['pass'] != "")){
       
    $Pass = Letter_Encrypt(Clean_Mypost($_POST['pass']));    
    }else{
    $Pass = GetNameFromID("config_email",$id,"pass");   
    }

    $server_data = array (
    'name'=> Clean_Mypost($_POST['name']),
    'sitemail'=> Clean_Mypost($_POST['sitemail']) ,
    'sitename'=> Clean_Mypost($_POST['sitename']) ,
    'server'=> Clean_Mypost($_POST['server']) ,
    'port'=> Clean_Mypost($_POST['port']) ,
    'user'=> Clean_Mypost($_POST['user']) ,
    'pass'=> $Pass ,
    'charest'=> Clean_Mypost($_POST['charest']) ,
    );

    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
       $add_server = $db->AutoExecute("config_email",$server_data,AUTO_UPDATE,"id = $id"); 
       Redirect_Page_2("index.php?view=ConfigEmail");
    }
}

#################################################################################################################################
###################################################    AddPhotoSize
#################################################################################################################################
function AddPhotoSize($db){
    $ThIsIsTest = '0';
    $TabelName = 'config_photo';
    $Name =  HandleDuplicate($TabelName,"name",'name');
   
   if(isset($_FILES['photo'])){
        if($_FILES['photo']['size'] != '0' and $Name['Err'] != "1" ) {
            $photoUp['photoErr'] = "0";
            $FileC = array (
                'size'=> "1024",
                'M_width'=> "1024" ,
                'M_height'=> "1024"  ,
            );

            $photoUp =  UploadOnePhoto_NoConfig("photo",WATERMARK_IMAGE_DIR,$FileC);
            $PNG_Photo  = $photoUp['photo'] ;
        }else{
            $PNG_Photo = $_POST['old_photo'];
        }
    }
   
    $server_data = array (
        'name'=> $Name['Val']  ,
        'file_rename'=> PostIsset("file_rename")  ,
        'resize_p'=> PostIsset("resize_p")  ,
        'width'=> PostIsset("width")  ,
        'height'=> PostIsset("height")  ,
        'resize_t'=> PostIsset("resize_t")  ,
        'width_t'=> PostIsset("width_t")  ,
        'height_t'=> PostIsset("height_t")  ,
        'mark'=> PostIsset("mark")  ,
        'mark_text'=> PostIsset("mark_text")  ,
        'mark_color'=> PostIsset("mark_color")  ,
        'mark_back'=> PostIsset("mark_back")  ,
        'png_state'=> PostIsset("png_state")  ,
        'photo'=> $PNG_Photo  ,
        'mark_position'=> PostIsset("mark_position")  ,
        'color'=> PostIsset("color")  ,
        'm_size'=> PostIsset("m_size")  ,
        'm_width'=> PostIsset("m_width")  ,
        'm_height'=> PostIsset("m_height")  ,
        'quality'=> PostIsset("quality")  ,
        'state'=> "1" ,
    );
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
         if($Name['Err'] != "1" and $photoUp['photoErr']  != '1'  ){
            $db->AutoExecute($TabelName,$server_data,AUTO_INSERT);
            Redirect_Page_2("index.php?view=PhotoSize");
        }
    }
}

#################################################################################################################################
###################################################    Edit PhotoSize
#################################################################################################################################
function EditPhotoSize($db){
    $ThIsIsTest = '0';
    $photoUp['photoErr'] = "0";
    $TabelName = 'config_photo';
    $id = $_GET['id'];
    $Name =  HandleDuplicate($TabelName,"name",'name',$id);
 

    if(isset($_FILES['photo'])){
        if($_FILES['photo']['size'] != '0' and $Name['Err'] != "1" ) {
           
            $FileC = array (
                'size'=> "1024",
                'M_width'=> "1024" ,
                'M_height'=> "1024"  ,
            );

            $photoUp =  UploadOnePhoto_NoConfig("photo",WATERMARK_IMAGE_DIR,$FileC);
            $PNG_Photo  = $photoUp['photo'] ;
            if($photoUp['photoErr'] != '1'){
                $deleted = @unlink( WATERMARK_IMAGE_DIR.$_POST['old_photo']);
            }
        }else{
            $PNG_Photo = $_POST['old_photo'];
        }
    }


    $server_data = array (
        'name'=> $Name['Val']  ,
        'file_rename'=> PostIsset("file_rename")  ,
        'resize_p'=> PostIsset("resize_p")  ,
        'width'=> PostIsset("width")  ,
        'height'=> PostIsset("height")  ,
        'resize_t'=> PostIsset("resize_t")  ,
        'width_t'=> PostIsset("width_t")  ,
        'height_t'=> PostIsset("height_t")  ,
        'mark'=> PostIsset("mark")  ,
        'mark_text'=> PostIsset("mark_text")  ,
        'mark_color'=> PostIsset("mark_color")  ,
        'mark_back'=> PostIsset("mark_back")  ,
        'png_state'=> PostIsset("png_state")  ,
        'photo'=> $PNG_Photo  ,
        'mark_position'=> PostIsset("mark_position")  ,
        'color'=> PostIsset("color")  ,
        'm_size'=> PostIsset("m_size")  ,
        'm_width'=> PostIsset("m_width")  ,
        'm_height'=> PostIsset("m_height")  ,
        'quality'=> PostIsset("quality")  ,
    );


    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Name['Err'] != "1" and $photoUp['photoErr']  != '1'  ){
            $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $id");
            Redirect_Page_2(LASTREFFPAGE);
        }
    }
}

#################################################################################################################################
###################################################   DellPhotoSizeF 
#################################################################################################################################
function DellPhotoSizeF($Tabel){
    global $db;
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
        $id =  $_POST['id_id'][$i]  ;
        Image_Dell("1",$id,WATERMARK_IMAGE_DIR_D,$Tabel,"photo","");  
        $db->H_DELETE_FromId($Tabel,$id);
    }
}

#################################################################################################################################
###################################################    Logos Edit
#################################################################################################################################
function LogosEdit($db){
    global $db ;
    $sql = "SELECT * FROM config ";
    $row = $db->H_SelectOneRow($sql);
    $FileC = array ('width'=> "400",
        'height'=> "400",
        'color'=> "#FFFFFF",
        'size'=> "400",
        'M_width'=> "2500",
        'M_height'=> "2500",
        'resize'=> '1'
    );
    EditThePhoto("photo_logo",$row,$FileC);
    EditThePhoto("photo_logo_en",$row,$FileC);
    EditThePhoto("photo_developer",$row,$FileC);
    EditThePhoto("photo_developer_en",$row,$FileC);
    EditThePhoto("photo_project",$row,$FileC);
    EditThePhoto("photo_project_en",$row,$FileC);
    EditThePhoto("photo_unit",$row,$FileC);
    EditThePhoto("photo_unit_en",$row,$FileC);
    Redirect_Page_2(LASTREFFPAGE);
}

function EditThePhoto($photofilename,$row,$FileC){
    global $db ;
    $photoUp['photoErr'] = "";
    if($_FILES[$photofilename]['size'] != '0') {
        $photoUp =  UploadOnePhoto_NoConfig($photofilename,LOGOS_IMAGE_DIR,$FileC);
        $photo = $photoUp['photo'];
        if($photoUp['photoErr'] != '1') {
            @unlink(LOGOS_IMAGE_DIR_D.$row[$photofilename]);
        }
    } else {
        $photo = $row[$photofilename];
    }
    if($photoUp['photoErr'] != '1') {
        $server_data = array($photofilename => $photo);
        $db->AutoExecute("config",$server_data,AUTO_UPDATE,"");
    }
}



?>