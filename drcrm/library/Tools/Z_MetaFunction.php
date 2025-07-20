<?php
if(!defined('WEB_ROOT')) {	exit;}
 
function MetaIsSetRow($Row,$RowName){
    if(isset($Row[$RowName])){
        $Val =  $Row[$RowName] ;
    }else{
        $Val = "";        
    }
    return $Val;
}
#################################################################################################################################
###################################################   GetMetaDesForUnit
#################################################################################################################################
function GetMetaDesForUnit($Table,$Cat_Table,$Cat_State,$SendTo,$LangLink){
    global $SiteConfig ;
    global $WebSiteLang ;
    if (!isset ($_GET['id'])){
        Redirect_Home($SendTo);
        exit;
    }
    if ($SiteConfig['rightmode']  == "1") {
        $cat_id =  Url_Slug($_GET['id']);
        $cat_id =  Removword_To_Clean($cat_id);
        $cat_id = Clean_Mypost($cat_id);


        if($WebSiteLang == 'En'){
            $Meta = F_CatList_En_Unit($Table,$cat_id,$LangLink,$SendTo,$Cat_Table,$Cat_State);
        }else{
            $Meta = F_CatList_Ar_Unit($Table,$cat_id,$LangLink,$SendTo,$Cat_Table,$Cat_State);
        }
    }else{
        $Meta = NotRightModeForUnit($Table,$Cat_Table,$Cat_State,$SendTo,$LangLink) ;
    }
    return $Meta;
}


#################################################################################################################################
###################################################   F_CatList_Ar_Unit
#################################################################################################################################
function F_CatList_Ar_Unit($Table,$cat_id,$LangLink,$SendTo,$Cat_Table,$Cat_State){
    global $pfw_db ;
    global $db ;
    $already = $db->H_Total_Count("SELECT * FROM $Table WHERE name_m = '$cat_id' and state = '1' ");
    if ($already > 0){
        $sql = "SELECT * FROM $Table where name_m = '$cat_id' and state = '1' ";
        $row = $db->H_SelectOneRow($sql);
        if($Cat_State == '1'){
            $the_CatName = GetNameFromID($Cat_Table,$row['cat_id'],"name");
        }else{
            $the_CatName ="";
        }
        $Meta = array (
            'PageName'=> Check_PageTitle($row['g_name']) ,
            'Des'=>  Check_Description($row['g_des']),
            'cat_id' => $row['id'] ,
            'cat_idName' => $row['name_m'],
            'Thecatname' => $the_CatName,
            //  'Thecatid' => $row['cat_id'],
            'Print_id' => $row['id'],
            'CatName' => $row['name'],
            'LangLink' => $LangLink.Removword_To_Clean($row['name_m_en']),
            'Header_H3' =>  MetaIsSetRow($row,"header_h3"),
            'Header_H6' => MetaIsSetRow($row,"header_h6") ,
            'Header_Photo' => MetaIsSetRow($row,"header_photo")  ,
            'banner_catid' => MetaIsSetRow($row,"banner_id") ,
        );
        return $Meta ;
    }else{
        $already = $db->H_Total_Count("SELECT * FROM $Table WHERE name_m_en = '$cat_id' and state = '1' ");
        if ($already > 0){
            $_SESSION['WebLang'.$pfw_db] = "En";
            Redirect_Home($_SERVER['REDIRECT_URL']);
        }else{
            F_CatList_ID($SendTo,$Table,$LangLink);
        }
        Redirect_Home($SendTo);
        exit;
    }
}


#################################################################################################################################
###################################################   F_CatList_En_Unit
#################################################################################################################################
function F_CatList_En_Unit($Table,$cat_id,$LangLink,$SendTo,$Cat_Table,$Cat_State){
    global $pfw_db ;
    global $db ;
    $already = $db->H_Total_Count("SELECT * FROM $Table WHERE name_m_en = '$cat_id' and state = '1' ");
    if ($already > 0){
        $sql = "SELECT * FROM $Table where name_m_en = '$cat_id'";
        $row = $db->H_SelectOneRow($sql);
        if($Cat_State == '1'){
            $the_CatName = GetNameFromID($Cat_Table,$row['cat_id'],"name_en");
        }else{
            $the_CatName = "";
        }
        $Meta = array (
            'PageName'=> Check_PageTitle($row['g_name_en']) ,
            'Des'=>  Check_Description($row['g_des_en']),
            'cat_id' => $row['id'] ,
            'cat_idName' => $row['name_m_en'],
            'Thecatname' => $the_CatName,
            //  'Thecatid' => $row['cat_id'],
            'Print_id' => $row['id'],
            'CatName' => $row['name_en'],
            'LangLink' => $LangLink.Removword_To_Clean($row['name_m']),
            'Header_H3' =>  MetaIsSetRow($row,"header_h3"),
            'Header_H6' => MetaIsSetRow($row,"header_h6") ,
            'Header_Photo' => MetaIsSetRow($row,"header_photo")  ,
            'banner_catid' => MetaIsSetRow($row,"banner_id") ,
        );

        return $Meta ;
    }else{
        $already = $db->H_Total_Count("SELECT * FROM $Table WHERE name_m = '$cat_id' and state = '1' ");
        if ($already > 0){
            $_SESSION['WebLang'.$pfw_db] = "Ar";
            Redirect_Home($_SERVER['REDIRECT_URL']);
        }else{
            F_CatList_ID($SendTo,$Table,$LangLink);
        }
        exit;
    }
}
#################################################################################################################################
###################################################   F_CatList_ID
#################################################################################################################################
function F_CatList_ID($SendTo,$Table,$LangLink){
    global  $SiteLinkS ;
    global $db ;
    global $pfw_db ;
    if (!is_numeric($_GET['id'])){
    Redirect_Home($SendTo);
    exit;
    } 
    $cat_id = intval($_GET['id']); 
    $already = $db->H_Total_Count("SELECT * FROM $Table WHERE id = '$cat_id' and state = '1' ");
    if ($already > 0){
    $sql = "SELECT * FROM $Table where id = '$cat_id'";
    $row = $db->H_SelectOneRow($sql);
    if($_SESSION['WebLang'.$pfw_db] == "En"){
    $row['name_m'] = $row['name_m_en'];    
    }
	Redirect_Home($LangLink.$row['name_m'].$SiteLinkS['html']);   
    }else{
    Redirect_Home($SendTo);        
    }        
}
#################################################################################################################################
###################################################   PageIdprint
#################################################################################################################################
function PageIdprint($id){
    global $SiteConfig ;
    global $WebSiteLang ;
     global $db ;
    if ( $SiteConfig['rightmode']  == "1") {
        $sql = "SELECT * FROM pages where id = '$id'";
        $row = $db->H_SelectOneRow($sql);
        if($WebSiteLang == 'En'){
            $id = $row['name_m_en'];
        }else{
            $id = $row['name_m'];
        }
    }else{
        $id = $id ;
    }
    return $id ;
}
?>