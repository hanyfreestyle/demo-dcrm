<?php
if(!defined('WEB_ROOT')) {	exit;}
 
#################################################################################################################################
###################################################   PageEditBut
#################################################################################################################################
function PageEditBut($id){
    global $ALang ;
    global $db ;
    global $NamePrint ;
    global $view ;
    echo '<div class="row"><div class="col-md-12 Row_Top TopButAction PageEditBut">';
    echo  NF_PrintBut_TD('1',$ALang['lppage_pageedit'],"PageEdit&id=".$id,"btn-info","fa-pencil-square-o");
    echo  NF_PrintBut_TD('1',$ALang['lppage_edit_tracking_code'],"EditTracking&id=".$id,"btn-info","fa-google-plus");
    echo  NF_PrintBut_TD('1',$ALang['lppage_edit_mobile_welcome'],"EditMobile&id=".$id,"btn-info","fa-mobile");
    echo  NF_PrintBut_TD('1',$ALang['lppage_edit_contact_form'],"EditForm&id=".$id,"btn-info","fa-ellipsis-v");
    echo  NF_PrintBut_TD('1',$ALang['lppage_view_content'],"ViewBlock&id=".$id,"btn-info","fa-search");
    echo  NF_PrintBut_TD('1',$ALang['lppage_order_block'],"OrderBlock&id=".$id,"btn-info","fa-sort-amount-desc");
    echo '<div style="clear: both!important;"></div>';
    $SQL = "select * from landpage_block where cat_id = '$id' ";
    $already = $db->H_Total_Count($SQL);
    if($already > '0'){
        $Name = $db->SelArr($SQL);
        for($i = 0; $i < count($Name); $i++) {
            if($view == 'BlockEdit' and $Name[$i]['id'] == $_GET['id'] ){
                $cc = "btn-danger";
            }else{
                $cc = "btn-primary";
            }
            echo NF_PrintBut_TD('1',$Name[$i][$NamePrint],"BlockEdit&id=".$Name[$i]['id'],$cc,"fa-pencil") ;
        }
    }
    echo '</div></div>';
}
#################################################################################################################################
###################################################   AddLpPAge
#################################################################################################################################
function AddLpPAge($db){
    global $AdminLangFile ;
    global $ConfigP ;
    $Err = "" ; $Err_2 = "";
    $ThisIsTest = '0' ;
    $ArrConfig =array("UpLoadType"=> $_POST['upload_type']);
    $photoUp =  Add2Photo($ConfigP['group_photo'],$ArrConfig);
    
    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;
    $Name_M = Clean_Mypost($_POST['name_m']) ;
    $Name_M_En = Clean_Mypost($_POST['name_m_en']) ;
    $Name_M = Url_Slug($Name_M);
    $Name_M_En = Url_Slug($Name_M_En);

    $server_data = array ('id'=> NULL ,
        'lead_sours'=>  PostIsset("lead_sours"),
        'lead_cat'=> PostIsset("lead_cat")  ,
        'lead_type'=> PostIsset("lead_type")  ,
        'name'=> $Name  ,
        'name_en'=> $Name_En  ,
        'name_m'=> $Name_M  ,
        'name_m_en'=> $Name_M_En  ,
        'des'=> Clean_Mypost($_POST['des'])  ,
        'des_en'=> Clean_Mypost($_POST['des_en'])  ,
        'g_des'=> Clean_Mypost($_POST['g_des'])  ,
        'g_des_en'=> Clean_Mypost($_POST['g_des_en'])  ,
        'g_name'=> Clean_Mypost($_POST['g_name'])  ,
        'g_name_en'=> Clean_Mypost($_POST['g_name_en'])  ,
        'state'=> "1"  ,
        'photo'=> $photoUp['photo'] ,
        'photo_t'=> $photoUp['photo_t'] ,
        'website_url'=> stripslashes($_POST['website_url'])  ,
        'thanks_title'=> stripslashes($_POST['thanks_title'])  ,
        'thanks_title_en'=> stripslashes($_POST['thanks_title_en'])  ,
        'thanks_des'=> stripslashes($_POST['thanks_des'])  ,
        'thanks_des_en'=> stripslashes($_POST['thanks_des_en'])  ,
        'thanks_mob'=> stripslashes($_POST['thanks_mob'])  ,   
    );
    $server_data =  RemoveFildeFromArrWhenAdd($server_data);

    $already = $db->H_Total_Count("SELECT * FROM landpage where name = '$Name' ");
    $already_en = $db->H_Total_Count("SELECT * FROM landpage where name_en = '$Name_En' ");

    if($already > 0 or $already_en > 0) {
        SendJavaErrMass($AdminLangFile['lppage_name_err']);
        $Err = '1';
    }
    $already = $db->H_Total_Count("SELECT * FROM landpage where name_m = '$Name_M' ");
    $already_en = $db->H_Total_Count("SELECT * FROM landpage where name_m_en = '$Name_M_En' ");
    if($already > 0 or $already_en > 0) {
        SendJavaErrMass($AdminLangFile['lppage_url_err']);
        $Err_2 = '1';
    }
    if($Err != '1' and  $Err_2 != "1" and $photoUp['photoErr'] != '1' ){
        if($ThisIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("landpage",$server_data,AUTO_INSERT);
            Redirect_Page_2("index.php?view=ListPage");
        }
    }
}

#################################################################################################################################
###################################################   PageLpEdit
#################################################################################################################################
function PageLpEdit($db){
    global $AdminLangFile ;
    $id = $_GET['id'];
    $Err = "" ; $Err_2 = "";
    $ThisIsTest = '0' ;
    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;
    $Name_M = Clean_Mypost($_POST['name_m']) ;
    $Name_M_En = Clean_Mypost($_POST['name_m_en']) ;
    $Name_M = Url_Slug($Name_M);
    $Name_M_En = Url_Slug($Name_M_En);
    
    $ArrConfig =array("UpLoadType"=> $_POST['upload_type']);
    $photoUp = Edit2Photo("landpage",$ArrConfig);
    
    $server_data = array (
        'lead_sours'=>  PostIsset("lead_sours"),
        'lead_cat'=> PostIsset("lead_cat")  ,
        'lead_type'=> PostIsset("lead_type")  ,
        'name'=> $Name  ,
        'name_en'=> $Name_En  ,
        'name_m'=> $Name_M  ,
        'name_m_en'=> $Name_M_En  ,
        'des'=> Clean_Mypost($_POST['des'])  ,
        'des_en'=> Clean_Mypost($_POST['des_en'])  ,
        'g_des'=> Clean_Mypost($_POST['g_des'])  ,
        'g_des_en'=> Clean_Mypost($_POST['g_des_en'])  ,
        'g_name'=> Clean_Mypost($_POST['g_name'])  ,
        'g_name_en'=> Clean_Mypost($_POST['g_name_en'])  ,
        'photo'=> $photoUp['photo'] ,
        'photo_t'=> $photoUp['photo_t'] ,
        'website_url'=> stripslashes($_POST['website_url'])  ,
        'thanks_title'=> stripslashes($_POST['thanks_title'])  ,
        'thanks_title_en'=> stripslashes($_POST['thanks_title_en'])  ,
        'thanks_des'=> stripslashes($_POST['thanks_des'])  ,
        'thanks_des_en'=> stripslashes($_POST['thanks_des_en'])  ,
        'thanks_mob'=> stripslashes($_POST['thanks_mob'])  ,
      
    );

    $server_data =  RemoveFildeFromArrWhenAdd($server_data);
    $already = $db->H_Total_Count("SELECT * FROM landpage where name = '$Name' and id != $id ");
    $already_en = $db->H_Total_Count("SELECT * FROM landpage where name_en = '$Name_En' and id != $id ");
    if($already > 0 or $already_en > 0) {
        SendJavaErrMass($AdminLangFile['lppage_name_err']);
        $Err = '1';
    }
    $already = $db->H_Total_Count("SELECT * FROM landpage where name_m = '$Name_M' and id != $id ");
    $already_en = $db->H_Total_Count("SELECT * FROM landpage where name_m_en = '$Name_M_En' and id != $id  ");
    if($already > 0 or $already_en > 0) {
        SendJavaErrMass($AdminLangFile['lppage_url_err']);
        $Err_2 = '1';
    }
    if($Err != '1' and  $Err_2 != "1" and $photoUp['photoErr'] != '1' ){
        if($ThisIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("landpage",$server_data,AUTO_UPDATE,"id = $id");
            UnsetAllSession("name,name_en,lead_cat,des,des_en,name_m,name_m_en,g_name,g_name_en,g_des,g_des_en");
            Redirect_Page_2(LASTREFFPAGE);
        }
    }
}

#################################################################################################################################
###################################################   PageLpEditTracking
#################################################################################################################################
function PageLpEditMobile($db){
    $id = $_GET['id'];
    $ThisIsTest = '0' ;
     
      $server_data = array (
        'mob_state'=> Clean_Mypost($_POST['mob_state'])  ,
        'mob_num'=> Clean_Mypost($_POST['mob_num'])  ,
        'mob_title'=> Clean_Mypost($_POST['mob_title'])  ,
        'mob_title_en'=> Clean_Mypost($_POST['mob_title_en'])  ,
        'mob_des'=> Clean_Mypost($_POST['mob_des'])  ,
        'mob_des_en'=> Clean_Mypost($_POST['mob_des_en'])  ,

    ); 
    
        if($ThisIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("landpage",$server_data,AUTO_UPDATE,"id = $id");
            Redirect_Page_2("index.php?view=PageEdit&id=".$id);
        }
  
}
#################################################################################################################################
###################################################   PageLpEditTracking
#################################################################################################################################
function PageLpEditTracking($db){
    $id = $_GET['id'];
    $ThisIsTest = '0' ;
     
      $server_data = array (
        'face_code'=> stripslashes($_POST['face_code'])  ,
        'google_code'=> stripslashes($_POST['google_code'])  ,
        'face_code_thanks'=> stripslashes($_POST['face_code_thanks'])  ,
        'google_code_thanks'=> stripslashes($_POST['google_code_thanks'])  ,
    ); 
    
        if($ThisIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("landpage",$server_data,AUTO_UPDATE,"id = $id");
            Redirect_Page_2("index.php?view=PageEdit&id=".$id);
        }
  
}
#################################################################################################################################
###################################################   AddPhotoCat
#################################################################################################################################
function AddPhotoCat($db){
    global $AdminLangFile ;
    $Err ="";
    $Tabel_Name = "landpage_photo_cat";
    $ThisIsTest = '0' ;
    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;

   $server_data = array ('id'=> NULL ,
        'name'=> $Name  ,
        'name_en'=> $Name_En  ,
        'des'=> Clean_Mypost($_POST['des']),
        'des_en'=> Clean_Mypost($_POST['des_en']),
        'state'=> "1"  ,
    );

    $already = $db->H_Total_Count("SELECT * FROM $Tabel_Name where name = '$Name' ");
    $already_en = $db->H_Total_Count("SELECT * FROM $Tabel_Name where name_en = '$Name_En' ");
    if($already > 0 or $already_en > 0) {
        SendJavaErrMass($AdminLangFile['mainform_name_add_err']);
        $Err = '1';
    }

    if($Err != '1' ){
        if($ThisIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute($Tabel_Name,$server_data,AUTO_INSERT);
            Redirect_Page_2("index.php?view=PhotoCat");
        }
    }
}


#################################################################################################################################
###################################################  EditPhotoCat
#################################################################################################################################
function EditPhotoCat($db){
    global $AdminLangFile ;
    $Err ="";
    $ThisIsTest = '0' ;
    $id = $_GET['id'];
    $Tabel_Name = "landpage_photo_cat";
    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;
    $server_data = array (
        'name'=> $Name  ,
        'name_en'=> $Name_En  ,
        'des'=> Clean_Mypost($_POST['des']),
        'des_en'=> Clean_Mypost($_POST['des_en']),
    );
    $already = $db->H_Total_Count("SELECT * FROM $Tabel_Name where name = '$Name' and id != $id ");
    $already_en = $db->H_Total_Count("SELECT * FROM $Tabel_Name where name_en = '$Name_En' and id != $id ");


    if($already > 0 or $already_en > 0) {
        SendJavaErrMass($AdminLangFile['mainform_name_add_err']);
        $Err = '1';
    }
    if($Err != '1'){
        if($ThisIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute($Tabel_Name,$server_data,AUTO_UPDATE,"id = $id");
            Redirect_Page_2("index.php?view=PhotoCat");
        }
    }
}

#################################################################################################################################
###################################################    AddPhoto
#################################################################################################################################
function AddPhoto($db){
    $ThIsIsTest = '0';
    global $LastAdd_S ;
    global $ConfigP;
    $photoUp['photoErr'] = '0';
    
    $ArrConfig =array("UpLoadType"=> $_POST['upload_type']);
    $photoUp =  Add2Photo("1",$ArrConfig);
    
    $server_data = array (
        'cat_id'=> $_POST['cat_id']  ,
        'name'=> PostIsset('name')  ,
        'name_en'=> PostIsset('name_en')  ,
        'des'=> PostIsset('des'),
        'des_en'=>PostIsset('des_en'),
        'state'=> "1"  ,
        'photo'=> $photoUp['photo'] ,
        'photo_t'=> $photoUp['photo_t'] ,
    );
    if($photoUp['photoErr'] != '1' ){
        if($ThIsIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("landpage_photo",$server_data,AUTO_INSERT);
            LastAddadmin($LastAdd_S);
            Redirect_Page_2("index.php?view=AddPhoto");
        }
    }

}

#################################################################################################################################
###################################################    EditPhoto
#################################################################################################################################
function EditPhoto($db){
    $ThIsIsTest = '0';
    $photoUp['photoErr'] = '0';
    $id = $_GET['id'];


    $ArrConfig =array("UpLoadType"=> $_POST['upload_type']);
    $photoUp = Edit2Photo("landpage_photo",$ArrConfig);

    $server_data = array (
        'cat_id'=> $_POST['cat_id']  ,
        'name'=> PostIsset('name')  ,
        'name_en'=> PostIsset('name_en')  ,
        'des'=> PostIsset('des'),
        'des_en'=>PostIsset('des_en'),
        'photo'=> $photoUp['photo'] ,
        'photo_t'=> $photoUp['photo_t'] ,
    );
    if($photoUp['photoErr'] != '1' ){
        if($ThIsIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("landpage_photo",$server_data,AUTO_UPDATE,"id = $id");
            Redirect_Page_2("index.php?view=PhotoList");
        }
    }
}

#################################################################################################################################
###################################################   AddBlock
#################################################################################################################################
function AddBlock($db){
    global $AdminLangFile ;
    $Err = ""; $photoUp['photoErr']="";
    $ThisIsTest = '0' ;

    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;
    $Var = Clean_Mypost(strtoupper($_POST['var'])) ;
    $cat_id = $_POST['cat_id'] ;

    $already = $db->H_Total_Count("SELECT * FROM landpage_block where cat_id = '$cat_id' and  name = '$Name' ");
    $already_2 = $db->H_Total_Count("SELECT * FROM landpage_block where cat_id = '$cat_id' and  name_en = '$Name_En' ");
    $already_3 = $db->H_Total_Count("SELECT * FROM landpage_block where cat_id = '$cat_id' and  var = '$Var' ");

    if($already > 0 ) {
        SendJavaErrMass($Name." : ".$AdminLangFile['lppage_contract_err']);
        $Err = '1';
    }
    if(  $already_2 > 0  ) {
        SendJavaErrMass($Name_En ." : ".$AdminLangFile['lppage_contract_err']);
        $Err = '1';
    }
    
    if( $already_3 > 0 ) {
        SendJavaErrMass($Var." : ".$AdminLangFile['lppage_contract_err']);
        $Err = '1';
    }
    

    if(isset($_FILES['photo'])){
        if($_FILES['photo']['size'] != '0' and $Err != "1" ) {
            $photoUp['photoErr'] = "0";
            $FileC = GetUpLoadTypeArr($_POST['upload_type']);
            $photoUp = UploadOnePhoto("photo",F_PATH,$FileC);
            $_POST['photo']  = CURRENT_PATH . $photoUp['photo'] ;
        }else{
            $_POST['photo'] = "";
        }
    }

    $Des = serialize($_POST);
    $server_data = array ('id'=> NULL ,
        'cat_id'=> $_POST['cat_id']  ,
        'block_style'=> Clean_Mypost($_POST['block_style'] ) ,
        'type'=> $_POST['type']  ,
        'name'=> $Name  ,
        'name_en'=> $Name_En  ,
        'var'=> $Var  ,
        'des'=> $Des  ,
        'state'=> "1"  ,
        'menu_s'=> $_POST['menu_s']  ,
        
    );
    if($Err != '1'  and $photoUp['photoErr'] != '1'){
        if($ThisIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("landpage_block",$server_data,AUTO_INSERT);
            Redirect_Page_2("index.php?view=ViewBlock&id=".$cat_id);
        }
    }
}
#################################################################################################################################
###################################################   EditBlock
#################################################################################################################################
function EditBlock($db){
    $ThisIsTest = '0' ;
    global $AdminLangFile ;
    $id = $_GET['id'];
    $Err = ""; $photoUp['photoErr']="";

    $Name = Clean_Mypost($_POST['name']) ;
    $Name_En = Clean_Mypost($_POST['name_en']) ;
    $Var = Clean_Mypost(strtoupper($_POST['var'])) ;
    $cat_id = $_POST['cat_id'] ;

    //// old data
    $row_old = $db->H_SelectOneRow("SELECT * FROM landpage_block where id = '$id'");
    $OldData  =  unserialize($row_old['des']);

    $already = $db->H_Total_Count("SELECT * FROM landpage_block where cat_id = '$cat_id' and id != '$id' and  name = '$Name' ");
    $already_2 = $db->H_Total_Count("SELECT * FROM landpage_block where cat_id = '$cat_id' and id != '$id' and  name_en = '$Name_En' ");
    $already_3 = $db->H_Total_Count("SELECT * FROM landpage_block where cat_id = '$cat_id' and id != '$id' and  var = '$Var' ");

    if($already > 0 ) {
        SendJavaErrMass($Name." : ".$AdminLangFile['lppage_contract_err']);
        $Err = '1';
    }
    if(  $already_2 > 0  ) {
        SendJavaErrMass($Name_En ." : ".$AdminLangFile['lppage_contract_err']);
        $Err = '1';
    }
    
    if( $already_3 > 0 ) {
        SendJavaErrMass($Var." : ".$AdminLangFile['lppage_contract_err']);
        $Err = '1';
    }
    

    if(isset($_FILES['photo'])){
        
        if($_FILES['photo']['size'] != '0' and $Err != "1" ) {
            $photoUp['photoErr'] = "0";
            $FileC = GetUpLoadTypeArr($_POST['upload_type']);
            $photoUp = UploadOnePhoto("photo",F_PATH,$FileC);
            
            $_POST['photo']  = CURRENT_PATH . $photoUp['photo'] ;
            if($photoUp['photoErr'] != '1'){
                $deleted = @unlink( F_PATH_D.$OldData['photo']);
            }
        }else{
            $_POST['photo'] = $OldData['photo'];
        }
    }

    $Des = serialize($_POST);
    $server_data = array (
        'block_style'=> Clean_Mypost($_POST['block_style'] ) ,
        'name'=> $Name  ,
        'name_en'=> $Name_En  ,
        'var'=> $Var  ,
        'des'=> $Des  ,
        'menu_s'=> $_POST['menu_s']  ,
    );


    if($Err != '1' and $photoUp['photoErr'] != '1' ){
        if($ThisIsTest == '1'){
            print_r3($server_data);
        }else{
            $db->AutoExecute("landpage_block",$server_data,AUTO_UPDATE,"id = $id");
            UnsetAllSession("name,name_en,lead_cat,des,des_en,name_m,name_m_en,g_name,g_name_en,g_des,g_des_en");
            Redirect_Page_2(LASTREFFPAGE);
        }
    }
}

#################################################################################################################################
###################################################  DeleteBlock_New
#################################################################################################################################
function DeleteBlock_New(){
    global $db;
    if(isset($_POST['id_id'])){
        $EmailCount = count($_POST['id_id']);
        for ($i = 0; $i < $EmailCount; $i++){
            $id =  $_POST['id_id'][$i]  ;
            $row = $db->H_SelectOneRow("SELECT * FROM landpage_block where id = '$id'");
            $Des =  unserialize($row['des']);
            if(isset($Des["photo"])){
                $deleted = @unlink( F_PATH_D.$Des["photo"]);
            }
            $db->H_DELETE_FromId("landpage_block",$id);
        }
    }
}




#################################################################################################################################
###################################################   UploadBlock_Photo
#################################################################################################################################
function UploadBlock_Photo($photoFile,$DIR,$FileC) {
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
###################################################   UserFollowSel
#################################################################################################################################
function UserFollowSel($StateType,$Col,$Col_2,$Label,$Name,$Val,$Req,$Req_V,$ch){
    global $db ;
    if($Req == 'req'){
        $PrintReq =   'required="" data-parsley-mincheck="'.$Req_V.'"';
    }else{
        $PrintReq =   '';
    }
    switch ($StateType) {
        case 'SQL':
            echo '<div class="'.$Col.' col-sm-12 col-xs-12 form-group DirRight">';
            echo '<label class="control-label Checkbox_label " >'.$Label.'</label>';
            if($ch != '0' and  $ch != '' ){
                $Amenities_Arr = $ch ;
            }else{
                $Amenities_Arr = array();
            }

            $query  = $Val ;
            $User_Name = $db->SelArr($query);
            for($x = 0; $x < count($User_Name); $x++) {
                if($ch != '0' and count($Amenities_Arr) > '0'){
                    if (in_array($User_Name[$x]['id'], $Amenities_Arr)) {
                        $checkedState = "checked";
                    }else{
                        $checkedState = "";
                    }
                }else{
                    $checkedState = "";
                }

                if(ADMIN_WEB_LANG == 'En' and isset($User_Name[$x]['name_en']) ){
                    $User_Name[$x]['name'] = $User_Name[$x]['name_en'];
                }
                echo '<div class="'.$Col_2.' Checkbox_Cont DirRight">';
                echo '<label> ';
                echo '<input class="input_checkbox" type="checkbox" id="'.$Name.$User_Name[$x]['id'].'" name="'.$Name.'[]"  '.$PrintReq.' value="'.$User_Name[$x]['id'].'" '.$checkedState.'>';
                echo  $User_Name[$x]['name'].' </label>';
                echo '</div>';
            }
            echo '</div>';
            break;
        default:
            echo "Error";
    }
}

#################################################################################################################################
###################################################   AddPhotoMultiple
#################################################################################################################################
function AddPhotoMultiple($Tabel_Name){
    global $LastAdd_S ;
    global $AdminLangFile ;
    global $db ;
    $ThIsIsTest = '0';
    $P_Up = "0";
    $P_Down = "0";

    $files = array();
    foreach ($_FILES['filesToUpload'] as $k => $l) {
        foreach ($l as $i => $v) {
            if (!array_key_exists($i, $files))
                $files[$i] = array();
            $files[$i][$k] = $v;
        }
    }

    for($i = 0; $i < count($files); $i++) {
        $FileC = GetUpLoadTypeArr($_POST['upload_type']);
        $photoUp =  UploadTwoPhoto_Multiple($files[$i],F_PATH,$FileC);

        if($photoUp['photoErr'] != '1') {
            PrintErrPhoto_Multiple($photoUp['photoErr'],$photoUp['ErrMass'],$FileC,$files[$i]['name']);
            $server_data = array (
                'cat_id'=> $_POST['cat_id']  ,
                'name'=> PostIsset('name')  ,
                'name_en'=> PostIsset('name_en')  ,
                'des'=> PostIsset('des'),
                'des_en'=>PostIsset('des_en'),
                'state'=> "1"  ,
                'photo'=> CURRENT_PATH. $photoUp['photo'] ,
                'photo_t'=> CURRENT_PATH. $photoUp['photo_t'] ,
            );

            if($ThIsIsTest == '1'){
                  print_r3($server_data);
            }else{
                if ($photoUp['photoErr'] != '1') {
                    $db->AutoExecute($Tabel_Name,$server_data,AUTO_INSERT);
                }
            }

            $P_Up = $P_Up + 1;
        } else {
            PrintErrPhoto_Multiple($photoUp['photoErr'],$photoUp['ErrMass'],$FileC,$files[$i]['name']);
            $P_Down = $P_Down + 1;
        }
    }
  
    LastAddadmin($LastAdd_S);
    
    $MassSend = "";
    $MassSend .= '</strong>'.$AdminLangFile['mainform_morephoto_count_file'].'</strong>'.count($files).'&nbsp;&nbsp';
    $MassSend .= '</strong>'.$AdminLangFile['mainform_morephoto_count_done'].'</strong>'.$P_Up.'&nbsp;&nbsp';
    $MassSend .= '</strong>'.$AdminLangFile['mainform_morephoto_count_err'].'</strong>'.$P_Down.'&nbsp;&nbsp';
    echo New_Print_Alert("2",$MassSend); 

}






#################################################################################################################################
###################################################   DeleteBlockPhoto
#################################################################################################################################
/*
function DeleteBlockPhoto($id){
    global $db ;
    $sql = "SELECT * FROM landpage_block where id = '$id'";
	$result     = mysql_query($sql);
	$row=	mysql_fetch_array($result);
	$Des =  unserialize($row['des']);
    echo $Des["photo"] ;
    $deleted = @unlink( F_PATH_D.$Des["photo"]);
    unset($Des["photo"]);
    $Des = serialize($Des);
    $server_data = array (
    'des'=> $Des  ,
    );
    $add_server = $db->AutoExecute("landpage_block",$server_data,AUTO_UPDATE,"id = $id");
    Redirect_Page_2("index.php?view=BlockEdit&id=".$id);

}
*/

?>