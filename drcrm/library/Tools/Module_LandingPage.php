<?php
if(!defined('WEB_ROOT')) {	exit;}
 

#################################################################################################################################
###################################################   UnitTypeFilter_Form
#################################################################################################################################
function UnitTypeFilter_Form($ThisAccountFollow){
    if(count($ThisAccountFollow) >= '1' ){
        $UserPer = " and ( ";
        for ($i = 0; $i < count($ThisAccountFollow); $i++) {
            if($i == '0'){
                $UserPer .= " id = ".$ThisAccountFollow[$i];
            }else{
                $UserPer .= " or id = ".$ThisAccountFollow[$i];
            }
        }
        $UserPer .= " )";
    }else{
        $UserPer = " and id = '0' ";
    }
    return  $UserPer ;
}


#################################################################################################################################
###################################################   ChangLangLoading
#################################################################################################################################
function ChangLangLoading() {
    global $pfw_db ;
    global $WebMeta;

    if($_SESSION['WebLang'.$pfw_db] == "Ar") {
        $CruntLang = '<div class="CahngeLang" ><a href="'.$WebMeta['LangLink'].'" >English</a></div>';
    } elseif($_SESSION['WebLang'.$pfw_db] == "En") {
        $CruntLang = '<div class="CahngeLang" ><a href="'.$WebMeta['LangLink'].'" class="CahngeLang" >عربى</a></div>';
    }
    return $CruntLang;
}
#################################################################################################################################
###################################################   MobileWelcomeMass
#################################################################################################################################
function MobileWelcomeMass($row){
    global $WebSiteLang ;
    if($row['mob_state'] == '1'){
        echo '<section class="MySection mobile_welcome">';

        if($WebSiteLang == 'En'){
            $row['mob_title'] =  $row['mob_title_en'];
            $row['mob_des'] =  $row['mob_des_en'];
            $CallName = "Call Us Now";
        }else{
            $CallName = "اتصل بنا الان ";
        }

        echo '<div class="container">';
        echo '<div class="row">';

        if($row['mob_title']){
            echo '<div class="col-md-12 col-xs-12 col-sm-12">';
            echo '<h1 class="H_Font_1 border_line">'.$row['mob_title'].'</h1>';
            echo '</div> ';
        }

        if($row['mob_title']){
            echo '<div class="col-md-12 col-xs-12 col-sm-12">';
            echo '<p class="p_style P_Font_1 " >'.$row['mob_des'].'</p>';
            echo '</div>';
        }

        echo '<div class="col-md-12 col-xs-12 col-sm-12 D_center">';
        echo '<a href="tel:'.$row['mob_num'].'"><button class="call_button FontEdit" style="vertical-align:middle"><span>'.$CallName.'</span></button></a>';
        echo '</div> ';

        echo '</div></div>';
        echo '</section>';
        echo '<div style="clear: both!important;"></div>';
    }
}
#################################################################################################################################
###################################################   $LandingPageBlock
#################################################################################################################################
$LandingPageBlock = array(
    '1' => $AdminLangFile['lppage_type_banner'],
    '2' => $AdminLangFile['lppage_type_text'],
    '3' => $AdminLangFile['lppage_type_youtube'],
    '4' => $AdminLangFile['lppage_type_google'],
    '5' => $AdminLangFile['lppage_type_photo'],
    '6' => $AdminLangFile['lppage_type_form'],
);

#################################################################################################################################
###################################################   LandingPageBlock
#################################################################################################################################
function LandingPageBlock($state) {
    global $AdminLangFile ;
    switch($state) {
        case "1":
            $order = $AdminLangFile['lppage_type_banner'];
            break;
        case "2":
            $order = $AdminLangFile['lppage_type_text'];
            break;
        case "3":
            $order = $AdminLangFile['lppage_type_youtube'];
            break;
        case "4":
            $order = $AdminLangFile['lppage_type_google'];
            break;
        case "5":
            $order = $AdminLangFile['lppage_type_photo'];
            break;
        case "6":
            $order = $AdminLangFile['lppage_type_form'];
            break;
        default:
            $order = "Err";

    }
    return $order;
}
#################################################################################################################################
###################################################   ClearCss
#################################################################################################################################
function ClearCss($Path){
//$data = file_get_contents("Landing/css/full-slider.css");
    $data = file_get_contents($Path);
    $data = preg_replace('/\/\*.*?(?=\*\/)\*\//imus', '', $data);
    $data = preg_replace('/([^\d])-?(0+)(px|pt|rem|em|vw|vh|vmax|vmin|cm|mm|m\%)/imus', '\1\2', $data);
    $data = preg_replace('/\s*([>~:;,\[\]\{\}])\s*/imus', '\1', $data);
    $data = preg_replace('/\s*([\(\)])\s*([^+-\/\*\^])/imus', '\1\2', $data);
    $data = preg_replace('/([\+])\s*([^\d])/imus', '\1\2', $data);
    $data = preg_replace('/#([\dabcdef])\1([\dabcdef])\2([\dabcdef])\3/imus', '#\1\2\3', $data);
    $data =  preg_replace('/;\}/imus', '}', $data);
    return $data ;
}
#################################################################################################################################
###################################################   ClearCss
#################################################################################################################################
function LandingPageMenu($row,$BlockList){
    global $WebSiteLang ;
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">';
    echo '<div class="container">';
    echo '<a class="navbar-brand">'.$row['name'].'</a>';
    echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">';
    echo '<span class="navbar-toggler-icon"></span></button>';
    echo '<div class="collapse navbar-collapse" id="navbarResponsive"><ul class="navbar-nav ml-auto">';
    for($i = 0; $i < count($BlockList); $i++) {
        if($WebSiteLang == 'En'){
            $BlockList[$i]['name'] = $BlockList[$i]['name_en'];
        }
      if($BlockList[$i]['menu_s'] == '1'){
        echo '<li class="nav-item"><a class="nav-link  js-scroll-trigger " href="#'.$BlockList[$i]['var'].'">'.$BlockList[$i]['name'].'</a></li>';
      }
    }
    echo ChangLangLoading() ;
    echo '</ul></div></div></nav> ';
}
#################################################################################################################################
###################################################   LandingPageMenuForThanks
#################################################################################################################################
function LandingPageMenuForThanks($row,$BlockList){
    global $WebSiteLang ;
    global $SiteLinkS ;
    global $WebMeta ;

    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">';
    echo '<div class="container">';
    echo '<a class="navbar-brand">'.$row['name'].'</a>';
    echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">';
    echo '<span class="navbar-toggler-icon"></span></button>';
    echo '<div class="collapse navbar-collapse" id="navbarResponsive"><ul class="navbar-nav ml-auto">';
    for($i = 0; $i < count($BlockList); $i++) {
        if($WebSiteLang == 'En'){
            $BlockList[$i]['name'] = $BlockList[$i]['name_en'];
        }
        echo '<li class="nav-item"><a class="nav-link  js-scroll-trigger " href="'.$SiteLinkS['LandingView'].$WebMeta['cat_idName'].'#'.$BlockList[$i]['var'].'">'.$BlockList[$i]['name'].'</a></li>';
    }
    echo ChangLangLoading() ;
    echo '</ul></div></div></nav> ';
}
#################################################################################################################################
###################################################  Add_BlockType_05   اضافة بانر
#################################################################################################################################
function Add_BlockType_01($row){
    ////اضافة بانر
    global $AdminLangFile ;
    if(!isset($row['photo_cat'])){$row['photo_cat']="";}
    $Arr = array("Label" => 'on',"Active" => '1');
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['mainform_sel_cat'],"col-md-3","photo_cat","landpage_photo_cat","req",$row['photo_cat'],$Arr);
}



#################################################################################################################################
###################################################  Add_BlockType_02     اضافة نص
#################################################################################################################################
function Add_BlockType_02($row){
//// اضافة نص
    global $AdminLangFile ;
    global $Block_Photo_P ;
    global $Block_Photo_S ;
    global $ConfigP ;
    global $view ;
    If($view == 'AddBlock'){
        $FildeType = "TextArea";
    }else{
        $FildeType = "TextAreaEdit";
    }



    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
    $Err[] = NF_PrintInput($FildeType,$AdminLangFile['lppage_content_title'],"title","0","0","option",$MoreS);

    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required'  ,'Dir'=> "En_Lang");
    $Err[] = NF_PrintInput($FildeType,$AdminLangFile['lppage_content_title'].ENLANG,"title_en","0","0","option",$MoreS);

    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required ' ,'Dir'=> "Ar_Lang");
    $Err[] = NF_PrintInput($FildeType,$AdminLangFile['lppage_content'],"title_des","0","0","option",$MoreS);

    $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required'  ,'Dir'=> "En_Lang");
    $Err[] = NF_PrintInput($FildeType,$AdminLangFile['lppage_content'].ENLANG,"title_des_en","0","0","option",$MoreS);


    echo '<div style="clear: both!important;"></div>';
    if(!isset($row['photo_p'])){$row['photo_p']="";}
    if(!isset($row['photo_s'])){$row['photo_s']="";}
    if(!isset($row['photo'])){$row['photo']="";}

    $Arr = array("StartFrom" => '1',"Label" => 'on' );
    $Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['lppage_image_postion'],"col-md-3","photo_p",$Block_Photo_P,"",$row['photo_p'],$Arr);
    $Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['lppage_image_size'],"col-md-3","photo_s",$Block_Photo_S,"",$row['photo_s'],$Arr);


    echo '<div style="clear: both!important;"></div>';
    $Arr= array("Col"=> "col-md-12" ,"name"=> "photo" ,'required' => '',"photo"=> $row['photo'] ,"path"=> F_PATH_V,  "Dell_But"=>'1', 'upload_type'=>$ConfigP['block_photo'] ) ;
    New_PrintFilePhoto("Edit",$Arr);

}

$Block_Photo_P = array(
    "1"=> $AdminLangFile['lppage_postion_top'],
    "2"=> $AdminLangFile['lppage_postion_below'],
    "3"=> $AdminLangFile['lppage_next_to_the_content'],
);

$Block_Photo_S = array(
    "1"=> "Col 4",
    "2"=> "Col 6",
    "3"=> "Col 8",
);



#################################################################################################################################
###################################################  Add_BlockType_03   اضافة فيديو
#################################################################################################################################
function Add_BlockType_03($row){
/// اضافة فيديو
global $AdminLangFile ;
global $view ;
If($view == 'AddBlock'){
    $FildeType = "";
}else{
   $FildeType = "Edit";
}

$MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required data-parsley-type="url"' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['lppage_video_url'],"url","1","1","req",$MoreS);


$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['lppage_content_title'],"title","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['lppage_content_title'].ENLANG,"title_en","1","1","req",$MoreS);



$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => ' ' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextArea".$FildeType,$AdminLangFile['lppage_content'],"title_des","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => ''  ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextArea".$FildeType,$AdminLangFile['lppage_content'].ENLANG,"title_des_en","0","0","option",$MoreS);
  
}





#################################################################################################################################
###################################################  Add_BlockType_04   اضافة جوجل
#################################################################################################################################
function Add_BlockType_04($row){
////  اضافة جوجل
global $AdminLangFile ;
global $view ;
If($view == 'AddBlock'){
    $FildeType = "";
}else{
   $FildeType = "Edit";
}

if($row){
   
$full_width = $row['full_width'] ;   
}else{
$full_width = '1';    
}
$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="number"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text".$FildeType,"Google Latitude","g_lat","400","0","optin-num",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="number"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text".$FildeType,"Google Longitude","g_long","400","0","optin-num",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="number"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text".$FildeType,"Map Zoom","g_zoom","400","0","optin-num",$MoreS);

NF_PrintRadio_Active ("2_Line","col-md-3","Full Width","full_width",$full_width);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['lppage_content_title'],"title","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['lppage_content_title'].ENLANG,"title_en","1","1","req",$MoreS);

 echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => ' ' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextArea".$FildeType,$AdminLangFile['lppage_content'],"title_des","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => ''  ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextArea".$FildeType,$AdminLangFile['lppage_content'].ENLANG,"title_des_en","0","0","option",$MoreS);
  
}


#################################################################################################################################
###################################################  Add_BlockType_05   اضافة البوم صور
#################################################################################################################################
function Add_BlockType_05($row){
////   اضافة البوم صور
global $AdminLangFile ;
global $view ;
If($view == 'AddBlock'){
    $FildeType = "";
}else{
   $FildeType = "Edit";
}
if(!isset($row['photo_cat'])){$row['photo_cat']="";}
$Arr = array("Label" => 'on',"Active" => '1');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['mainform_sel_cat'],"col-md-3","photo_cat","landpage_photo_cat","req",$row['photo_cat'],$Arr); 

if(!isset($row['photo_zoom'])){$row['photo_zoom']="";}
if(!isset($row['photo_name'])){$row['photo_name']="";}
if(!isset($row['photo_des'])){$row['photo_des']="";}
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['lppage_photo_zoom'],"photo_zoom",$row['photo_zoom']);
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['lppage_view_photo_name'],"photo_name",$row['photo_name']);
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['lppage_view_photo_details'],"photo_des",$row['photo_des']);






echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['lppage_content_title'],"title","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['lppage_content_title'].ENLANG,"title_en","1","1","req",$MoreS);



$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => ' ' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextArea".$FildeType,$AdminLangFile['lppage_content'],"title_des","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => ''  ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextArea".$FildeType,$AdminLangFile['lppage_content'].ENLANG,"title_des_en","0","0","option",$MoreS);

}



#################################################################################################################################
###################################################  Add_BlockType_06  اتصل بنا 
#################################################################################################################################
function Add_BlockType_06($row){
////    اتصل بنا 
global $AdminLangFile ;
global $view ;
If($view == 'AddBlock'){
    $FildeType = "";
}else{
   $FildeType = "Edit";
}
echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['lppage_content_title'],"title","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text".$FildeType,$AdminLangFile['lppage_content_title'].ENLANG,"title_en","1","1","req",$MoreS);



$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => ' ' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextArea".$FildeType,$AdminLangFile['lppage_content'],"title_des","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => ''  ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextArea".$FildeType,$AdminLangFile['lppage_content'].ENLANG,"title_des_en","0","0","option",$MoreS);
echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextArea".$FildeType,$AdminLangFile['lppage_address'],"address","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required'  ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextArea".$FildeType,$AdminLangFile['lppage_address'].ENLANG,"address_en","0","0","option",$MoreS);
echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required'  ,'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextArea".$FildeType,$AdminLangFile['lppage_phone'],"contact_info","0","0","option",$MoreS);

}





#################################################################################################################################
################################################### طباعة المحتوى 
#################################################################################################################################

function LandingPageViewPrint($Type,$row) {
    global $db ;
    global $WebSiteLang ;
    global $PageInfo ;
    global $IP_INFO ;
    
    switch($Type) {
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  طباعة البانر
        case "1":
            $Des = unserialize($row['des']);
            $CatId = $Des['photo_cat'];
            $SQL = "SELECT * FROM landpage_photo where cat_id = $CatId and state = '1' ORDER BY postion";
            $already = $db->H_Total_Count($SQL);
            $Name = $db->SelArr($SQL);


            echo '<section id="'.$row['var'].'">';
            if($already > "1") {
                $StyleName = strtolower($row['var']).$row['id'] ;
                echo '<div  class="owl-carousel my_owl-theme '.$StyleName.'">';
            }else{
                echo '<div class="HomeBanner">';
            }

            for($i = 0; $i < count($Name); $i++) {
                if($WebSiteLang == 'En'){
                    $Name[$i]['name']  = $Name[$i]['name_en']  ;
                }
                echo '<img src="'.LANDINGPAGE_IMAGE_DIR_V.$Name[$i]["photo"].'" alt="'.$Name[$i]['name'].'">';
            }

            echo '</div>';
            echo '</section>';

            break;
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   طباعة نص
        case "2":
            $Des = unserialize($row['des']);
            if($WebSiteLang == 'En'){
                $Des['title']  = $Des['title_en']  ;
                $Des['title_des']  = $Des['title_des_en']  ;
            }
            echo '<section class="MySection Section_Text '.$row['block_style'].' " id="'.$row['var'].'">';
            echo '<div class="container">';
            echo '<div class="row">';

            echo '<div class="col-md-12 col-xs-12 col-sm-12">';
            echo '<h1 class="H_Font_1 border_line">'.nl2br($Des['title']).'</h1>';
            echo '</div> ';

            $Photo = CheckPhotoPrintBlock($Des);


            echo  $Photo['Top'];

            echo '<div class="'.$Photo['Col'].' col-xs-12 col-sm-12">';
            echo '<p class="p_style P_Font_1 " >'.nl2br($Des['title_des']).'</p>';
            echo '</div>';

            echo  $Photo['Bottom'];

            echo '</div>';
            echo '</div>';
            echo '</section>';
            break;
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   طباعة فيديو
        case "3":
            $Des = unserialize($row['des']);
            if($WebSiteLang == 'En'){
                $Des['title']  = $Des['title_en']  ;
                $Des['title_des']  = $Des['title_des_en']  ;
            }

            echo '<section id="'.$row['var'].'" class="MySection Section_Video" >';
            echo '<div class="container">';
            echo '<div class="row">';

            if($Des['title']){
                echo '<div class="col-md-12 col-xs-12 col-sm-12">';
                echo '<h1 class="H_Font_1 border_line">'.$Des['title'].'</h1>';
                echo '</div> ';
            }

            if($Des['title_des']){
                echo '<div class="col-md-12 col-xs-12 col-sm-12">';
                echo '<p class="p_style P_Font_1 " >'.nl2br($Des['title_des']).'</p>';
                echo '</div>';
            }


            echo '<div class="col-md-12 col-xs-12 col-sm-12">';
            echo '<div class="Embed_Video"><iframe src="'.$Des['url'].'" allowfullscreen></iframe></div>';
            echo '</div>';


            echo '</div>';
            echo '</div>';
            echo '</section>';
            break;
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   طباعة جوجل
        case "4":
            $Des = unserialize($row['des']);
            if($WebSiteLang == 'En'){
                $Des['title']  = $Des['title_en']  ;
                $Des['title_des']  = $Des['title_des_en']  ;
            }
            echo '<section class="MySection Section_Google" id="'.$row['var'].'" > ';

            if($Des['title'] or $Des['title_des'] ){
                echo '<div class="container">';
                echo '<div class="row">';
                if($Des['title']){
                    echo '<div class="col-md-12 col-xs-12 col-sm-12">';
                    echo '<h1 class="H_Font_1 border_line">'.$Des['title'].'</h1>';
                    echo '</div> ';
                }
                if($Des['title_des']){
                    echo '<div class="col-md-12 col-xs-12 col-sm-12">';
                    echo '<p class="p_style P_Font_1 " >'.nl2br($Des['title_des']).'</p>';
                    echo '</div>';
                }

                echo '</div>';
                echo '</div>';
            }

            if($Des['full_width'] == "1"){
                echo '<div class="GoogleMap" id="'.$row['var'].$row['id'].'"></div>';
            }else{
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="GoogleMap" id="'.$row['var'].$row['id'].'"></div>';
                echo '</div>';
                echo '</div>';
            }

            echo '</section>';
            break;

#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   طباعة البوم الصور
        case "5":
            $Des = unserialize($row['des']);
            $CatId =$Des['photo_cat'];
            if($WebSiteLang == 'En'){
                $Des['title']  = $Des['title_en']  ;
                $Des['title_des']  = $Des['title_des_en']  ;
            }
            echo '<section class="MySection Section_Photo" id="'.$row['var'].'">';
            echo '<div class="container">';
            echo '<div class="row">';


            if($Des['title']){
                echo '<div class="col-md-12 col-xs-12 col-sm-12">';
                echo '<h1 class="H_Font_1 border_line">'.$Des['title'].'</h1>';
                echo '</div> ';
            }

            if($Des['title_des']){
                echo '<div class="col-md-12 col-xs-12 col-sm-12">';
                echo '<p class="p_style P_Font_1 " >'.$Des['title_des'].'</p>';
                echo '</div>';
            }




            $StyleName = strtolower($row['var']).$row['id'] ;
            echo '<div class="col-md-12 gallery_'.$StyleName.'">';

            echo '<div  class="owl-carousel photo_owl-theme '.$StyleName.'">';

            $Name = $db->SelArr("SELECT * FROM landpage_photo where cat_id = $CatId ORDER BY postion");
            for($i = 0; $i < count($Name); $i++) {
                if($WebSiteLang == 'En'){
                    $Name[$i]["name"] = $Name[$i]["name_en"] ;
                    $Name[$i]["des"] = $Name[$i]["des_en"] ;
                }

                echo '<div class="item">';
                if($Des['photo_zoom'] == '1'){
                    echo '<a href="'.LANDINGPAGE_IMAGE_DIR_V.$Name[$i]["photo"].'" title="'.$Name[$i]["name"].'">
<img src="'.LANDINGPAGE_IMAGE_DIR_V.$Name[$i]["photo_t"].'" alt="'.$Name[$i]["name"].'" /></a>';
                }else{
                    echo '<img src="'.LANDINGPAGE_IMAGE_DIR_V.$Name[$i]["photo_t"].'" alt="'.$Name[$i]["name"].'" />';
                }
                if($Des['photo_name'] == '1'){
                    echo '<div class="photo_name">'.$Name[$i]["name"].'</div>';
                }

                if($Des['photo_des'] == '1'){
                    if($Name[$i]["des"]) {
                        echo '<div class="photo_des">'.$Name[$i]["des"].'</div>';
                    }
                }

                echo '</div>';
            }

            echo '</div>';
            echo '</div>';



            echo '</div>';
            echo '</div>';
            echo '</section>';

            break;
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   طباعة اتصل بنا
        case "6":
            $Des = unserialize($row['des']);
            if($WebSiteLang == 'En'){
                $Des['title']  = $Des['title_en']  ;
                $Des['title_des']  = $Des['title_des_en']  ;
                $Des['address']  = $Des['address_en']  ;

            }
            echo '<section class="MySection Section_ContactUs" id="'.$row['var'].'">';
            echo '<div class="container">';
            echo '<div class="row">';

            echo '<div class="col-md-12 col-xs-12 col-sm-12">';
            echo '<h1 class="H_Font_1 border_line">'.nl2br($Des['title']).'</h1>';
            echo '</div> ';


            echo '<div class="col-md-6 col-xs-12 col-sm-12">';
            echo '<p class="p_style P_Font_1 contact_info">'.nl2br($Des['contact_info']).'</p>';
            echo '</div>';

            echo '<div class="col-md-6 col-xs-12 col-sm-12">';
            echo '<p class="p_style P_Font_1 address_info">'.nl2br($Des['address']).'</p>';
            echo '</div>';

            if($Des['title_des']){
                echo '<div class="col-md-12 col-xs-12 col-sm-12">';
                echo '<p class="p_style P_Font_1 contact_mass " >'.nl2br($Des['title_des']).'</p>';
                echo '</div>';
            }


            echo '<div class="MyCrd"></div>';

            echo '<div class="col-md-12 col-xs-12 col-sm-12">';
            require_once 'Landing_View_Form.php' ;
            echo '</div>';


            echo '</div>';
            echo '</div>';
            echo '</section>';

            break;
        default:
            $order = "Err";
    }
}


#################################################################################################################################
###################################################   CheckPhotoPrintBlock
#################################################################################################################################

function CheckPhotoPrintBlock($row){

 if(isset($row['photo']) and $row['photo'] != ""){
  
 if($row['photo_p'] == '1'){

    $Photo = '<div class="col-md-12 col-xs-12 col-sm-12">';
    $Photo .= '<img src="'.LANDINGPAGE_IMAGE_DIR_V.$row['photo'].'" alt="'.$row['name'].'"  class="respinv_photo" />'; 
    $Photo .= '</div> ';    
    $SendArr = array("Top" => $Photo ,"Bottom"=> "","Col"=>"12")  ;
 
 }elseif($row['photo_p'] == '2'){
    
    $Photo = '<div class="col-md-12 col-xs-12 col-sm-12">';
    $Photo .= '<img src="'.LANDINGPAGE_IMAGE_DIR_V.$row['photo'].'" alt="'.$row['name'].'"  class="respinv_photo"/>'; 
    $Photo .= '</div> ';    
    $SendArr = array("Top" => "" ,"Bottom"=> $Photo,"Col"=>"12")  ;
        
 }elseif($row['photo_p'] == '3'){
 if($row['photo_s'] == "1" ){
 $Col_Photo = "col-md-4";
 $Col = "col-md-8";   
 }elseif($row['photo_s'] == "2"){
 $Col_Photo = "col-md-6";
 $Col = "col-md-6";       
 }elseif($row['photo_s'] == "3"){
 $Col_Photo = "col-md-8";
 $Col = "col-md-4";    
 }else{
 $Col_Photo = "col-md-12";
 $Col = "col-md-12"; 
 }
 
    $Photo = '<div class="'.$Col_Photo.' col-xs-12 col-sm-12">';
    $Photo .= '<img src="'.LANDINGPAGE_IMAGE_DIR_V.$row['photo'].'" alt="'.$row['name'].'" class="respinv_photo" />'; 
    $Photo .= '</div> ';    
    $SendArr = array("Top" => $Photo ,"Bottom"=> "","Col"=>$Col)  ;
        
 }   

 }else{
  $SendArr = array("Top" => "","Bottom"=> "","Col"=>"12")  ;
 }
  return $SendArr ;
}


#################################################################################################################################
###################################################   
#################################################################################################################################
function IP_Info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "ip"           =>   @$ip,
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}


function validate_email_New($email) {
    return preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email);
}

function test_datatype_New($input_value,$reg_exp){
    if(preg_match($reg_exp,$input_value))
    {
        return false;
    }
    return true;
}

#################################################################################################################################
###################################################   SaveDate_From_Landing_Page
#################################################################################################################################
function SaveDate_From_Landing_Page($Arr=""){
    $ThisIsTest = '0';
    global $db ;
    global $WebMeta ;
    if($_POST['f_url'] != ""){
        $modifyUrl = parse_url($_POST['f_url']);
    }else{
        $modifyUrl = "";
    }
   $mobile = Clean_Mypost(UpdateArNum($_POST['mobile']));
   $Test_Phone =  test_datatype_New($mobile,"/[^0-9]/");
    
   if($Test_Phone != '1'){
   echo New_Print_Alert("5","Invalid Phone Number"); 
   } 
  
   if($Test_Phone == '1'){
    $This_f_ip = $_POST['f_ip'] ;
    $server_data = array ('id'=> NULL ,
        'date_add'=> TimeForToday() ,
        'date_time'=> time() ,
        'lead_sours'=>  PostIsset("lead_sours"),
        'lead_cat'=> PostIsset("lead_cat")  ,
        'lead_type'=> PostIsset("lead_type")  ,
        'unit_type'=>  PostIsset("unit_type"),
        'name'=> Clean_Mypost($_POST['name']),
        'mobile'=> $mobile ,
        'email'=> Clean_Mypost($_POST['email']),
        'notes'=> Clean_Mypost($_POST['notes']),
        'state'=> "1",
        'f_url'=>$modifyUrl['host'] ,
        'f_type'=> Clean_Mypost($_POST['f_type']),
        'f_ip'=> Clean_Mypost($_POST['f_ip']),
        'f_city'=> Clean_Mypost($_POST['f_city']),
        'f_country'=> Clean_Mypost($_POST['f_country']),
    );
    
    if($ThisIsTest == '1'){
        print_r3($server_data);
        // Redirect_Page_2(WEB_ROOT."lpthanks/".$WebMeta['cat_idName']);
    }else{
        $already = $db->H_Total_Count("SELECT id FROM landpage_data WHERE f_ip = '$This_f_ip'");
        if($already > "1") {
            Redirect_Page_2(WEB_ROOT."lpthanks/".$WebMeta['cat_idName']);
        }else{
            $add_server = $db->AutoExecute("landpage_data",$server_data,AUTO_INSERT);
            Redirect_Page_2(WEB_ROOT."lpthanks/".$WebMeta['cat_idName']);
        }
    }   
   }
}


#################################################################################################################################
###################################################   PrintFildIf
#################################################################################################################################
function PrintFildIf($Val){
    if($Val){
        $Val = nl2br($Val).BR ;
    }else{
        $Val = "";
    }

    return $Val;
}

?>