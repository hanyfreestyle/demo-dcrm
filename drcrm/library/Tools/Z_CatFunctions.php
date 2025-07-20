<?php
if(!defined('WEB_ROOT')) {	exit;}
 
################################################################################################################# 
############################################# AddCategory
################################################################################################################# 

 function AddCategory($db,$catTabel,$Path,$ConfigP){
    global $LastAdd_S_Cat ;
    
   if($ConfigP['cat_en_lang'] != '1' and ADMINCPANELLANG == "1" ){
    $_POST['name_en'] = Clean_Mypost($_POST['name']);
    $_POST['des_en'] = Clean_Mypost($_POST['des']); 
    
    if($ConfigP['namecat_m']== '1'){
    $_POST['name_m_en'] = Clean_Mypost($_POST['name_m']);        
    }   
   
   if($ConfigP['googlecat_state']== '1'){
    $_POST['g_name_en'] = Clean_Mypost($_POST['g_name']);
    $_POST['g_des_en'] = Clean_Mypost($_POST['g_des']);
    $_POST['g_key_en'] = Clean_Mypost(Removedash($_POST['g_key']));
   }
   
   }
   
   
    $name = Clean_Mypost($_POST['name']);
    
    if($ConfigP['namecat_m']== '1'){
    $name_m = Clean_Mypost($_POST['name_m']);
    $name_m = MaketheModeLink($name_m);    
    }else{
    $name_m = MaketheModeLink($name);    
    }
    
    if($ConfigP['googlecat_state']== '1'){
    $g_name = Clean_Mypost($_POST['g_name']);
    $g_des = Clean_Mypost($_POST['g_des']);
    $g_key = Clean_Mypost(Removedash($_POST['g_key']));
    $g_name_en = Clean_Mypost($_POST['g_name_en']);
    $g_des_en = Clean_Mypost($_POST['g_des_en']);
    $g_key_en = Clean_Mypost(Removedash($_POST['g_key_en']));
    }else{
    $g_name = Clean_Mypost($_POST['name']);
    $g_des = Clean_Mypost($_POST['des']);
    $g_key = Clean_Mypost($_POST['name']);
    $g_name_en = Clean_Mypost($_POST['name_en']);
    $g_des_en = Clean_Mypost($_POST['des_en']);
    $g_key_en = Clean_Mypost($_POST['name_en']);
    }   
    
  
    
    
    
    if(ADMINCPANELLANG == "1"){
        
    $name_en =  Clean_Mypost($_POST['name_en']);
    $name_en = LatterCase($name_en,$ConfigP['namecatadd_state']);    
    
    if($ConfigP['namecat_m']== '1'){
    $name_m_en =  Clean_Mypost($_POST['name_m_en']);    
    $name_m_en = LatterCase($name_m_en,$ConfigP['namecatadd_state']);   
    $name_m_en = MaketheModeLink($name_m_en); 
       
    }else{
    $name_m_en = MaketheModeLink($name_en);
    }
    $already_en = mysql_num_rows(mysql_query("SELECT name_m_en FROM $catTabel WHERE name_m_en = '$name_m_en'"));
    }
    
    
    $already = mysql_num_rows(mysql_query("SELECT name_m FROM $catTabel WHERE name_m = '$name_m'"));

    if ($already > '0' or $already_en > '0' ){
    SendJavaErrMass("اسم المجموعة مستخدمة من قبل برجاء استخدام اسم جديد");    
    }else{

    $FileC = array ('width'=> $ConfigP['c_width'] ,
    'height'=> $ConfigP['c_height'] ,
    'color'=> $ConfigP['c_color'],
    'size'=> $ConfigP['file_size'],
    'M_width'=> $ConfigP['file_width'] ,
    'M_height'=> $ConfigP['file_height']  ,
    'resize'=> $ConfigP['c_do']
    );

    if ($ConfigP['cat_photo'] == "1"){
    $photoUp = UploadOnePhoto_2("photo",$Path,$FileC);     
 	$photo = CURRENT_PATH .$photoUp['photo'];
    }else{
    if($_FILES['photo']['size'] != '0') {
    $photoUp = UploadOnePhoto_2("photo",$Path,$FileC);     
 	$photo = CURRENT_PATH .$photoUp['photo'];
    }else{
    $photo = ""; 
    }        
    }
    
    $args = array();
    $args += $server_data = array ('id'=> NULL ,
    'cat_id'=> $_POST['cat_id'] ,
    'name'=> $name,
    'name_m'=> $name_m,
    'des'=> Clean_Mypost($_POST['des']),
 
    'g_name'=> $g_name,
    'g_des'=> $g_des,
    'g_key'=> $g_key, 
           
 
 
    'photo'=> $photo ,
    'state'=> $_POST['state'],
    'menu_state'=> $_POST['menu_state'],
    'banner_id'=> $_POST['banner_id'],
    );

    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'name_en'=> $name_en,
    'name_m_en'=> $name_m_en ,    
    'des_en'=> Clean_Mypost($_POST['des_en']),
    'g_name_en'=> $g_name_en,
    'g_des_en'=> $g_des_en,
    'g_key_en'=> $g_key_en,        
     
    );    
    
    };
    
    

        if($photoUp['photoErr'] != '1') {
    
        $add_server = $db->AutoExecute($catTabel,$args,AUTO_INSERT);
        
        if($ConfigP['cat_count_s']== '1'){CountCatFun();}

        UnsetAllSession("name,name_m,des,g_name,g_des,g_key,name_en,name_m_en,des_en,g_name_en,g_des_en,g_key_en");
        LastAddadmin($LastAdd_S_Cat);
       // Redirect_Page_2(LASTREFFPAGE);
        CatAdd_Redirect($ConfigP['catadd_redirect']);
     
        
        }
        
       
    }
}

#################################################################################################################  
################################################################################################################# 

################################################################################################################# 
############################################# CountCatFun
################################################################################################################# 
function CountCatFun(){
    global $CatTabel ;
    global $db ;    

    $Name = $db->SelArr("SELECT * FROM $CatTabel ");
    for($i = 0; $i < count($Name); $i++) {
    $TheCat_id  = $Name[$i]['id']; 
    $count_cat = mysql_num_rows(mysql_query("SELECT * FROM $CatTabel WHERE cat_id = '$TheCat_id'"));
    $count_cat_a = mysql_num_rows(mysql_query("SELECT * FROM $CatTabel WHERE cat_id = '$TheCat_id' and state = 1"));
    $server_data = array ('count_cat'=> $count_cat,'count_cat_a'=> $count_cat_a); 
    $add_server = $db->AutoExecute($CatTabel,$server_data,AUTO_UPDATE,"id = $TheCat_id");   
    };
}
#################################################################################################################  
################################################################################################################# 



#################################################################################################################  
################################################################################################################# 


################################################################################################################# 
############################################# EditCatMeta
################################################################################################################# 

function EditCatMeta($db,$catTabel,$Path,$PathD,$ConfigP){
    global $ConfigP ;
    
    $id = $_GET['id'];

    $args = array();
    
    $args += $server_data = array (
    'g_name'=> Clean_Mypost($_POST['g_name']),
    'g_des'=> Clean_Mypost($_POST['g_des']),
    'g_key'=> Clean_Mypost(Removedash($_POST['g_key'])),     
    );


    if ( HEADER_BACK == '1') {

    if($_FILES['photo']['size'] != '0') {

    $FileC = array ('width'=> "400",
    'height'=> "400",
    'color'=> "#FFFFFF",
    'size'=> "400",
    'M_width'=> "2500",
    'M_height'=> "2500",
    'resize'=> '1'
    );  
    
    $photoUp = UploadOnePhoto_2("photo",F_PATH ,$FileC);     
 	$photo = CURRENT_PATH . $photoUp['photo'];
     
    if($photoUp['photoErr'] != '1') {
    Image_Dell("1",$id,F_PATH_D,$catTabel,"header_photo","");
    }   
    
    }else{
    $photo = GetNameFromID($catTabel,$id,"header_photo");   
    }
    


    $args += $server_data = array(
    'header_h3'=> Clean_Mypost($_POST['header_h3']) ,
    'header_h6'=> Clean_Mypost($_POST['header_h6']) ,
    'header_photo'=> $photo ,
    );
    };
        
    
    
    
    
    
    if (ADMINCPANELLANG  == '1' ){
    
    $args += $server_data = array (
    'g_name_en'=> Clean_Mypost($_POST['g_name_en']),
    'g_des_en'=> Clean_Mypost($_POST['g_des_en']),
    'g_key_en'=>  Clean_Mypost(Removedash($_POST['g_key_en'])),    
    );  
    
    if ( HEADER_BACK == '1') {
    $args += $server_data = array(
    'header_h3_en'=> Clean_Mypost($_POST['header_h3_en']) ,
    'header_h6_en'=> Clean_Mypost($_POST['header_h6_en']) ,);
    };
        
          
    };
    
    
    if($photoUp['photoErr'] != '1') { 
    $add_server = $db->AutoExecute($catTabel,$args,AUTO_UPDATE,"id = $id");
    UnsetAllSession("name,name_m,des,g_name,g_des,g_key,name_en,name_m_en,des_en,g_name_en,g_des_en,g_key_en");
    CatEdit_Redirect($ConfigP['catedit_redirect']) ;
    }
}

#################################################################################################################  
################################################################################################################# 


################################################################################################################# 
############################################# EditCategory
################################################################################################################# 

function EditCategory($db,$catTabel,$Path,$PathD,$ConfigP){

    $id = $_GET['id'];
   	$cat_id = $_POST['cat_id'];


    $sql_cat = "SELECT * FROM $catTabel where id = '$id'";
	$result_cat = mysql_query($sql_cat);
	$row_cat = mysql_fetch_array($result_cat);
    
        
    $name = Clean_Mypost($_POST['name']);
  
    if($ConfigP['namecat_m']== '1'){
    $name_m = Clean_Mypost($_POST['name_m']);
    $name_m = MaketheModeLink($name_m);    
    }else{
    $name_m = MaketheModeLink($name);    
    }
    
    if($ConfigP['googlecat_state']== '1'){
    $g_name = Clean_Mypost($_POST['g_name']);
    $g_des = Clean_Mypost($_POST['g_des']);
    $g_key = Clean_Mypost(Removedash($_POST['g_key']));
    $g_name_en = Clean_Mypost($_POST['g_name_en']);
    $g_des_en = Clean_Mypost($_POST['g_des_en']);
    $g_key_en = Clean_Mypost(Removedash($_POST['g_key_en']));
    }else{
    $g_name = $row_cat['g_name'];
    $g_des = $row_cat['g_des'];
    $g_key = $row_cat['g_key'];
    $g_name_en = $row_cat['g_name_en'];
    $g_des_en = $row_cat['g_des_en'];
    $g_key_en = $row_cat['g_key_en'];
    }   
    
  
   
    
    
    if(ADMINCPANELLANG == "1"){
   
    $name_en =  Clean_Mypost($_POST['name_en']);
    $name_en = LatterCase($name_en,$ConfigP['namecatadd_state']);   
    

    if($ConfigP['namecat_m']== '1'){
    $name_m_en =  Clean_Mypost($_POST['name_m_en']);    
    $name_m_en = LatterCase($name_m_en,$ConfigP['namecatadd_state']);   
    $name_m_en = MaketheModeLink($name_m_en); 
    }else{
    $name_m_en = MaketheModeLink($name_en);
    }
    
    $already_en = mysql_num_rows(mysql_query("SELECT name_m_en FROM $catTabel WHERE name_m_en = '$name_m_en'  and id != '$id'"));
    }

    
    $already = mysql_num_rows(mysql_query("SELECT name_m FROM $catTabel WHERE name_m = '$name_m' and id != '$id'"));
    
    if ($already > '0' or $already_en > '0' ){
    SendJavaErrMass("اسم المجموعة مستخدمة من قبل برجاء استخدام اسم جديد");    
    
    }else{
    
    if($_FILES['photo']['size'] != '0') {
    $FileC = array ('width'=> $ConfigP['c_width'] ,
    'height'=> $ConfigP['c_height'] ,
    'color'=> $ConfigP['c_color'],
    'size'=> $ConfigP['file_size'],
    'M_width'=> $ConfigP['file_width'] ,
    'M_height'=> $ConfigP['file_height']  ,
    'resize'=> $ConfigP['c_do']
    );
        
    $photoUp = UploadOnePhoto_2("photo",$Path,$FileC);     
 	$photo = CURRENT_PATH .$photoUp['photo'];
     
    if($photoUp['photoErr'] != '1') {
    Image_Dell("1",$id,$PathD,$catTabel,"photo","");
    }   
    
    }else{
    $photo = $row_cat['photo'];   
    }
    
 
 	if($cat_id == $id) {
		redirect_to2("index.php?view=Cat_List", "لا يمكن اضافة المجموعة داخل نفسها");
		exit;
	}
    
   	////  if the catgory is main catgory it will be still as it 0
	$cat_id =  CheckIftheCatIsMain($id,$cat_id,$catTabel);  
    
    
    $args = array();
    
    $args += $server_data = array (
    'cat_id'=> $_POST['cat_id'] ,
    'name'=> $name,
    'name_m'=> $name_m,
    'des'=> Clean_Mypost($_POST['des']),
 
    'g_name'=> $g_name,
    'g_des'=> $g_des,
    'g_key'=> $g_key,        

    'photo'=> $photo ,
    'state'=> $_POST['state'],
    'menu_state'=> $_POST['menu_state'],
    'banner_id'=> $_POST['banner_id'],
    );

    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'name_en'=> $name_en,
    'name_m_en'=> $name_m_en ,    
    'des_en'=> Clean_Mypost($_POST['des_en']),
    'g_name_en'=> $g_name_en,
    'g_des_en'=> $g_des_en,
    'g_key_en'=> $g_key_en,        
     
    );    
    };
    
    
   // print_r3($args);
    
    /**/
    if($photoUp['photoErr'] != '1') {
    $add_server = $db->AutoExecute($catTabel,$args,AUTO_UPDATE,"id = $id");
    if($ConfigP['cat_count_s']== '1'){CountCatFun();}
    UnsetAllSession("name,name_m,des,g_name,g_des,g_key,name_en,name_m_en,des_en,g_name_en,g_des_en,g_key_en");
   // Redirect_Page_2("index.php?view=Cat_List");
   
    CatEdit_Redirect($ConfigP['catedit_redirect']) ;
    }
    
    
    }
      
}
  


function CheckIftheCatIsMain($id,$cat_id,$catTabel) {

	$sql = "SELECT cat_id FROM $catTabel WHERE id = '$id' ";

	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	if($row['cat_id'] == '0') {
		$cat_id = '0';
	} else {
		$cat_id = $cat_id;
	}
	return $cat_id;

}
#################################################################################################################  
################################################################################################################# 



################################################################################################################# 
############################################# Retern 
################################################################################################################# 
function ReternCatName ($id,$name){
    global $koko ;
    global $i ;  
    global $LisCatPage ;
   $already = $koko[$i]['count_cat'] ;
   $already_2 = $koko[$i]['count_cat'] - $koko[$i]['count_cat_a'] ;

   if ($already > 0){
   $CatTitelss = $LisCatPage['Tip_CatCount']." " .$already.BR ;
   $CatTitelss .= $LisCatPage['Tip_Disable_CatCount']." ".$already_2.BR ;
   $PrintCat_Name = '<div class="'.$class.'" >
   <a class="normalTip" href="index.php?view=Cat_List&catsub='.$id.'" title="'.$CatTitelss.'"  >'.$name.'</a> ('.$already.')</div>';
   }else{
   $PrintCat_Name = '<div class="'.$class.'" >'.$name.'</div>';
   }
   return $PrintCat_Name ;
}

function ReternCatValues($id){
    global $koko ;
    global $i ;
    global $LisCatPage ;
  
   
   $already = $koko[$i]['count_unit'] ; 
   $already_2 = $koko[$i]['count_unit'] - $koko[$i]['count_unit_a'] ;  
   $CatTitelss = $LisCatPage['List_UnitCount_CountAll']." " .$already.BR ;
   $CatTitelss .= $LisCatPage['List_UnitCount_CountDisable']." " .$already_2.BR ;


   if ($already > 0){
   $name =  $LisCatPage['List_UnitCount_01']." ".$already." ".$LisCatPage['List_UnitCount_UnitType']; 
   $PrintCat_Name = '<div><a class="normalTip" href="index.php?view=List&cat_id='.$id.'" title="'.$CatTitelss.'"  >'.$name.'</a></div>';	
   }else{
   $PrintCat_Name = $LisCatPage['List_NoContent'];
   }
   
   return $PrintCat_Name ;
     
}



function ReternCatName_Mneu ($id,$name){
    global $koko ;
    global $i ;  
    global $LisCatPage ;
   $already = $koko[$i]['count_cat'] ;
   $already_2 = $koko[$i]['count_cat'] - $koko[$i]['count_cat_a'] ;

   if ($already > 0){
   $CatTitelss = $LisCatPage['Tip_CatCount']." " .$already.BR ;
   $CatTitelss .= $LisCatPage['Tip_Disable_CatCount']." ".$already_2.BR ;
   $PrintCat_Name = '<div class="'.$class.'" >
   <a class="normalTip" href="index.php?view=Menu_List&catsub='.$id.'" title="'.$CatTitelss.'"  >'.$name.'</a> ('.$already.')</div>';
   }else{
   $PrintCat_Name = '<div class="'.$class.'" >'.$name.'</div>';
   }
   return $PrintCat_Name ;
}



/*
function ReternCatName ($c_Cat_id,$catTabel,$id,$name){
   if($c_Cat_id == "0"){
    $class = "RadCatName";
   }else{
    $class = "";
   } 
   
   $already = mysql_num_rows(mysql_query("SELECT * FROM $catTabel WHERE cat_id = '$id'"));
   if ($already > 0){
//	echo '<div class="'.$class.'" ><a href="index.php?view=Cat_List&catsub='.$id.'"  >'.$name.'</a> ('.$already.')</div>';
   echo '<div class="'.$class.'" ><a class="normalTip" href="index.php?view=Menu_List&catsub='.$id.'" title="ddddd"  >'.$name.'</a> ('.$already.')</div>';
   }else{
    echo '<div class="'.$class.'" >'.$name.'</div>';
   }
   
}

function ReternCatValues($GroupTabel,$id,$Mass){
   
   $already = mysql_num_rows(mysql_query("SELECT * FROM $GroupTabel WHERE cat_id = '$id'"));
   if ($already > 0){
   echo 'المجموعة تحتوى على '." ".$already." ".$Mass; 	
   }else{
   echo 'لم يتم اضافة محتوى للمجموعة حتى الان';
   }   
}
*/

function CheckGroupState($id,$tabel,$state="state"){
    
    $sql = "SELECT * FROM $tabel where id = '$id'";
	$result     = mysql_query($sql);
	$row=	mysql_fetch_array($result);
    
    if($row[$state]== '1'){
        echo '<img src="../include/img/ico_active_16.png"  />';
    }else{
       echo '<img src="../include/img/ico_inactive_16.png"  />';
    }
}



#################################################################################################################  
################################################################################################################# 

################################################################################################################# 
############################################# ReternCatNameForList
################################################################################################################# 
function ReternCatNameForList ($catTabel,$id,$name){
   
   $already = mysql_num_rows(mysql_query("SELECT * FROM $catTabel WHERE cat_id = '$id'"));
   if ($already > 0){
	$PrintName =  '<div class="'.$class.'" ><a href="index.php?view=List_Postion&catsub='.$id.'"  >'.$name.'</a> ('.$already.')</div>';
   }else{
    $PrintName =  '<div class="'.$class.'" >'.$name.'</div>';
   }
   
   return $PrintName ;
}


function ReternCatNameForManagePhotoName ($catTabel,$id,$name){
   
   $already = mysql_num_rows(mysql_query("SELECT * FROM $catTabel WHERE cat_id = '$id'"));
   if ($already > 0){
	$PrintName =  '<div class="'.$class.'" ><a href="index.php?view=ManagePhotoName&catsub='.$id.'"  >'.$name.'</a> ('.$already.')</div>';
   }else{
    $PrintName =  '<div class="'.$class.'" >'.$name.'</div>';
   }
   
   return $PrintName ;
} 

 
#################################################################################################################  
################################################################################################################# 


/*



   
    

    
function CheckGroupState2($id,$tabel,$filde='id'){
    
    $sql = "SELECT * FROM $tabel where $filde = '$id'";
	$result     = mysql_query($sql);
	$row=	mysql_fetch_array($result);
    
    if($row['state']== '1'){
        echo '<img src="../include/img/ico_active_16.png"  />';
    }else{
       echo '<img src="../include/img/ico_inactive_16.png"  />';
    }
}
*/

#################################################################################################################  
################################################################################################################# 
    

################################################################################################################# 
############################################# Config_Cat
################################################################################################################# 
function Config_Cat($db){
    global $ConfigTabel;
    global $db;

    $sql = "SELECT * FROM  config_cat where cat_id = '$ConfigTabel' ";
    $row = $db->H_SelectOneRow($sql);
    $ConfigP  =  unserialize( $row['des']);


    if($_FILES['photo']['size'] != '0') {
    $photoUp['photoErr'] = "0";
    $FileC = array (
    'size'=> "100",
    'Mimtype'=> array('image/gif', 'image/png'),
    'ViewErr' => 'لابد ان يكون امتداد الصورة PNG' 
    );

    $photoUp =  UploadOneFile_New("photo",F_PATH,$FileC); 
    $_POST['png']  = CURRENT_PATH . $photoUp['photo'] ;
    if($photoUp['photoErr'] != '1'){
    $deleted = @unlink( F_PATH_D.$ConfigP['png']);    
    }
    }else{
     $_POST['png'] = $ConfigP['png']; 
    }
     
      
    $Cat_Count = count($_POST['metacat_id']);
    $cat_id = '-' ;
    for ($i = 0; $i < $Cat_Count; $i++){
    $id =  $_POST['metacat_id'][$i]  ;
    $cat_id = $cat_id . $id . '-';
    }  
    
    $_POST['metacat_id'] =  $cat_id ;
    
    
    if(isset($_POST['metacat_id_meta'])){
    $Cat_Count = count($_POST['metacat_id_meta']);
    $cat_id = '-' ;
    for ($i = 0; $i < $Cat_Count; $i++){
    $id =  $_POST['metacat_id_meta'][$i]  ;
    $cat_id = $cat_id . $id . '-';
    }  
    
    $_POST['metacat_id_meta'] =  $cat_id ;        
    }
   
   
   
   
   if($photoUp['photoErr'] != '1'){
    $Data = serialize($_POST);
    $server_data = array ('des'=> $Data , );
    $add_server = $db->AutoExecute("config_cat",$server_data,AUTO_UPDATE,"cat_id = '$ConfigTabel'");
    Redirect_Page_2(LASTREFFPAGE);
 }
}


function metacatcheckstate($id,$CatiDD){
   $CatiDD = (str_replace("-", " ", $CatiDD));
   $CatiDD = explode(" ",trim($CatiDD));
   $CheckState = "";
   if (in_array($id, $CatiDD)) {
     $CheckState =  ' checked="" ';
   }
    return $CheckState ;
}





#################################################################################################################  
################################################################################################################# 


################################################################################################################# 
############################################# Cat_Activecat
################################################################################################################# 
function Cat_Activecat(){
    global $CatTabel ;
    global $ConfigP ;
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
    $id =  $_POST['id_id'][$i]  ;
    $sql = "UPDATE $CatTabel SET 
	state = '1'
	WHERE id = '$id'";
    $result = mysql_query($sql) or die('Cannot add category' . mysql_error()); 
    }
    if($ConfigP['cat_count_s']== '1'){CountCatFun();}
} 

function Cat_UnActivecat(){
    global $CatTabel ;
    global $ConfigP ;    
    
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
    $id =  $_POST['id_id'][$i]  ;
    $sql = "UPDATE $CatTabel SET 
	state = '0'
	WHERE id = '$id'";
    $result = mysql_query($sql) or die('Cannot add category' . mysql_error()); 
    }
   if($ConfigP['cat_count_s']== '1'){CountCatFun();}
}
#################################################################################################################  
################################################################################################################# 


################################################################################################################# 
############################################# GetAllTreeSubCat
################################################################################################################# 
 function GetAllTreeSubCat($id = 0,$name_t) {
   $id_f = "id";
   $name_f = 'name';
   $parent_f = "cat_id";
   static $cates = array();
   static $tnum = 0;
   $tnum++;
   $result = mysql_query("SELECT $id_f,$name_f FROM $name_t WHERE $parent_f=$id ORDER BY $name_f");
   while($row = mysql_fetch_assoc($result)) {
     $cates[] = $row[$id_f];
     GetAllTreeSubCat($row[$id_f],$name_t);
   }
   $tnum = $tnum - 1;
   return $cates;
 }
#################################################################################################################  
#################################################################################################################





################################################################################################################# 
############################################# EditMetaU
################################################################################################################# 
/*
function  EditMetaU($db){
    global $GroupTabel ;
    global $ConfigP ;
    $id = $_GET['id'];

    $args = array();
    
    $args += $server_data = array (
    'g_name'=> Clean_Mypost($_POST['g_name']),
    'g_des'=> Clean_Mypost($_POST['g_des']),
    'g_key'=> Clean_Mypost(Removedash($_POST['g_key'])),     
    );

    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'g_name_en'=> Clean_Mypost($_POST['g_name_en']),
    'g_des_en'=> Clean_Mypost($_POST['g_des_en']),
    'g_key_en'=>  Clean_Mypost(Removedash($_POST['g_key_en'])),    
    );    
    };
    $add_server = $db->AutoExecute($GroupTabel,$args,AUTO_UPDATE,"id = $id");
    UnsetAllSession("name,name_m,des,g_name,g_des,g_key,name_en,name_m_en,des_en,g_name_en,g_des_en,g_key_en");
    UnitEdit_Redirect($ConfigP['unitedit_redirect']);
}
*/

function  EditMetaU($db){
    global $GroupTabel ;
    global $ConfigP ;
    $id = $_GET['id'];

    $args = array();
    
    $args += $server_data = array (
    'g_name'=> htmlspecialchars(($_POST['g_name']), ENT_QUOTES, "UTF-8"),
    'g_des'=>  htmlspecialchars(($_POST['g_des']), ENT_QUOTES, "UTF-8"), 
    'g_key'=>  htmlspecialchars(Removedash($_POST['g_key']), ENT_QUOTES, "UTF-8"),
   
    /*
    'g_name'=> htmlspecialchars(($_POST['g_name']), ENT_QUOTES, "UTF-8"),
    'g_des'=>  htmlspecialchars(($_POST['g_des']), ENT_QUOTES, "UTF-8"), 
    'g_key'=>  htmlspecialchars(Removedash($_POST['g_key']), ENT_QUOTES, "UTF-8"),
    
    
    'g_name'=> mb_strtolower($_POST['g_name'],'UTF-8'),
    'g_des'=>  mb_strtolower($_POST['g_des'],'UTF-8'), 
    'g_key'=> mb_strtolower($_POST['g_key'],'UTF-8'),   
     */
    );
    
    if ( HEADER_BACK == '1') {

    if($_FILES['photo']['size'] != '0') {

    $FileC = array ('width'=> "400",
    'height'=> "400",
    'color'=> "#FFFFFF",
    'size'=> "400",
    'M_width'=> "2500",
    'M_height'=> "2500",
    'resize'=> '1'
    );  
    
    $photoUp = UploadOnePhoto_2("photo",F_PATH ,$FileC);     
 	$photo = CURRENT_PATH . $photoUp['photo'];
     
    if($photoUp['photoErr'] != '1') {
    Image_Dell("1",$id,F_PATH_D,$GroupTabel,"header_photo","");
    }   
    
    }else{
    $photo = GetNameFromID($GroupTabel,$id,"header_photo");   
    }
    


    $args += $server_data = array(
    'header_h3'=> Clean_Mypost($_POST['header_h3']) ,
    'header_h6'=> Clean_Mypost($_POST['header_h6']) ,
    'header_photo'=> $photo ,
    );
    };
    
    
    

    if (ADMINCPANELLANG  == '1' ){
    
    $args += $server_data = array (
    /*
    'g_name_en'=> Clean_Mypost($_POST['g_name_en']),
    'g_des_en'=> Clean_Mypost($_POST['g_des_en']),
    'g_key_en'=>  Clean_Mypost(Removedash($_POST['g_key_en'])),  
      */
    'g_name_en'=> htmlentities(Clean_Mypost($_POST['g_name_en']), ENT_QUOTES, "UTF-8"),
    'g_des_en'=>  htmlentities(Clean_Mypost($_POST['g_des_en']), ENT_QUOTES, "UTF-8"), 
    'g_key_en'=>  htmlentities(Clean_Mypost($_POST['g_key_en']), ENT_QUOTES, "UTF-8"),   
    );    
    
    if ( HEADER_BACK == '1') {
    $args += $server_data = array(
    'header_h3_en'=> Clean_Mypost($_POST['header_h3_en']) ,
    'header_h6_en'=> Clean_Mypost($_POST['header_h6_en']) ,);
    };
        
    
    };
    
    
    if($photoUp['photoErr'] != '1') { 
    $add_server = $db->AutoExecute($GroupTabel,$args,AUTO_UPDATE,"id = $id");
    UnsetAllSession("name,name_m,des,g_name,g_des,g_key,name_en,name_m_en,des_en,g_name_en,g_des_en,g_key_en");
    UnitEdit_Redirect($ConfigP['unitedit_redirect']);
    }
}
#################################################################################################################  
################################################################################################################# 

################################################################################################################# 
############################################# AddMultiplePhoto
################################################################################################################# 

function AddMultiplePhoto($db){
    global $ConfigP;
    global $GroupTabel ;
    global $GroupTabel_Files ;
    global $AdminLangFile ;
 
     if (isset($_POST['resize_t'])){
      $ConfigP['resize_morephoto_t'] = $_POST['resize_t'];  
      $ConfigP['resize_morephoto'] = $_POST['resize_p'];
     }  

     if (isset($_POST['png_state'])){
      $ConfigP['png_state'] = $_POST['png_state'];  
     }  

     
     
    global $LastAdd_S ;

    $photoUp['photoErr'] = '0';
     
    $FileC = array (
    'resize_P'=> $ConfigP['resize_morephoto'],    
    'width'=> $ConfigP['morephoto_width'] ,
    'height'=> $ConfigP['morephoto_height'] ,
    'color'=> $ConfigP['morephoto_color'],
    
    'size'=> $ConfigP['file_size'],
    'M_width'=> $ConfigP['file_width'] ,
    'M_height'=> $ConfigP['file_height']  ,
    

    'mark'=> $ConfigP['mark'],
    'marktext'=> $ConfigP['marktext'],
    'markcolor'=> $ConfigP['markcolor'],
    
    'resize_T'=>$ConfigP['resize_morephoto_t'],
    'width_t'=> $ConfigP['morephoto_width_t'] ,
    'height_t'=> $ConfigP['morephoto_height_t'] ,
 
    'png_state'=> $ConfigP['png_state'] ,
    'png'=> F_PATH_D.$ConfigP['png'] ,
    'watermark_position'=> $ConfigP['watermark_position'] ,
     );
     
     

   
    $files = array();
    foreach ($_FILES['filesToUpload'] as $k => $l) {
        foreach ($l as $i => $v) {
            if (!array_key_exists($i, $files))
                $files[$i] = array();
            $files[$i][$k] = $v;
        }
    }
    

    
    
    $P_Up = "0";
    $P_Down = "0";
    
     for($i = 0; $i < count($files); $i++) {
     $photoUp = UploadTwoPhoto_Multiple($files[$i],F_PATH,$FileC);
    
     if($photoUp['photoErr'] != '1') {
      PrintErrPhoto_Multiple($photoUp['photoErr'],$photoUp['ErrMass'],$FileC,$files[$i]['name']);
   
                //echo "OK File ". $photoUp['photo']." was Uploade </br>";
                $photoUp['photo'] = CURRENT_PATH . $photoUp['photo'];
                $photoUp['photo_t'] = CURRENT_PATH . $photoUp['photo_t'];
                
                
                
                $server_data = array ('id'=> NULL ,
                'cat_id'=> $_POST['cat_id'],
                'photo'=> $photoUp['photo'] ,
                'photo_t'=> $photoUp['photo_t'] ,
                'type'=> 'photo' ,
                );
                
                
                if ($photoUp['photoErr'] != '1') {
                $add_server = $db->AutoExecute($GroupTabel_Files,$server_data,AUTO_INSERT);
                }

     $P_Up = $P_Up + 1;
     } else {
      PrintErrPhoto_Multiple($photoUp['photoErr'],$photoUp['ErrMass'],$FileC,$files[$i]['name']);
      $P_Down = $P_Down + 1;
     }
    }
    
    CountMorePhotos();
    echo '<div class="notification note-attention"><span class="icon"></span>';
    echo '<p><strong>'.$AdminLangFile['content_morephoto_countfile'].'</strong>'.count($files).'&nbsp;&nbsp;
    <strong>'.$AdminLangFile['content_morephoto_countdone'].'</strong>'.$P_Up.
    '&nbsp;&nbsp;<strong>'.$AdminLangFile['content_morephoto_counterr'].'</strong>'.$P_Down.'&nbsp;&nbsp;</p></div>';
    
}


function EditMorePhotoDes($db){
    $UnitIDD = $_POST['UnitIdd'];
    $id = $_GET['id'];
    global $GroupTabel_Files ;
 
    $args = array();
    $args += $server_data = array (
    'des'=> Clean_Mypost($_POST['des']),
    ); 
    
    
    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'des_en'=> Clean_Mypost($_POST['des_en']),
    );    
    };
    
    $add_server = $db->AutoExecute($GroupTabel_Files,$args,AUTO_UPDATE,"id = $id");
    Redirect_Page_2("index.php?view=AddMorePhoto&id=".$UnitIDD);
}


function CountMorePhotos(){
    global $db;
    global $GroupTabel ;
    global $GroupTabel_Files ;
    $UnitID = $_GET['id'];
    $photo_count = mysql_num_rows(mysql_query("SELECT * FROM $GroupTabel_Files WHERE cat_id = '$UnitID' and type = 'photo' "));
 /*
    echo $GroupTabel .BR;
    echo $GroupTabel_Files .BR;
    echo $UnitID .BR;
    echo $photo_count .BR;
    */

    $server_data = array ('photo_count'=> $photo_count); 
    $add_server = $db->AutoExecute($GroupTabel,$server_data,AUTO_UPDATE,"id = $UnitID");
          
}


function CountMoreFiles(){
    global $db;
    global $GroupTabel ;
    global $GroupTabel_Files ;
    $UnitID = $_GET['id'];
    $photo_count = mysql_num_rows(mysql_query("SELECT * FROM $GroupTabel_Files WHERE cat_id = '$UnitID' and type = 'file' "));
 /*
    echo $GroupTabel .BR;
    echo $GroupTabel_Files .BR;
    echo $UnitID .BR;
    echo $photo_count .BR;
    */

    $server_data = array ('file_count'=> $photo_count); 
    $add_server = $db->AutoExecute($GroupTabel,$server_data,AUTO_UPDATE,"id = $UnitID");
          
}

#################################################################################################################  
################################################################################################################# 

################################################################################################################# 
############################################# Dell_More_Photo
################################################################################################################# 
function Dell_More_Photo(){
    global $GroupTabel_Files ;  
    global $db;
    global $GroupTabel ;
    $UnitID = $_GET['id'];
      
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
   $id =  $_POST['id_id'][$i]  ;
   Image_Dell("2",$id,F_PATH_D,$GroupTabel_Files,"photo","photo_t");
   mysql_query("DELETE FROM $GroupTabel_Files WHERE id ='$id'");
     }
  
  CountMorePhotos();        
}
#################################################################################################################  
################################################################################################################# 

################################################################################################################# 
############################################# AddMoreFiles
################################################################################################################# 

function AddMoreFiles($db){   
    global $ConfigP;
    global $GroupTabel ;
    global $GroupTabel_Files ;  
    
    $photoUp['photoErr'] = '0';
    
    $FileC = array (
    'size'=> $ConfigP['file_size'],
    'Mimtype'=> array('application/pdf', 'application/zip', 'application/msword','application/vnd.ms-excel','text/plain') ,
    'ViewErr' => 'لابد ان يكون امتداد الملف DOC ZIP PDF XLS TXT' 
    );
   
    $photoUp =  UploadOneFile_New("photo",F_PATH,$FileC); 
    $File = CURRENT_PATH .  $photoUp['photo'] ;

   
    $args = array();
   
    $args += $server_data = array (
    'id'=> NULL ,
    'cat_id'=> $_POST['cat_id'],
    'type'=> 'file',
    'name'=>Clean_Mypost($_POST['name']),
    'file'=> $File ,
   ); 
   

    if (ADMINCPANELLANG  == '1' ){
    $args += $server_data = array (
    'name_en'=>Clean_Mypost($_POST['name_en']),
    );    
    };
       

    if ($photoUp['photoErr'] != '1') {
    $add_server = $db->AutoExecute($GroupTabel_Files,$args,AUTO_INSERT);
    CountMoreFiles();
    Redirect_Page_2(LASTREFFPAGE);
    }
} 
#################################################################################################################  
################################################################################################################# 

################################################################################################################# 
############################################# Dell_More_Photo
################################################################################################################# 
function Dell_More_File(){
    global $GroupTabel_Files ;    
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
   $id =  $_POST['id_id'][$i]  ;
   Image_Dell("1",$id,F_PATH_D,$GroupTabel_Files,"file","");
   mysql_query("DELETE FROM $GroupTabel_Files WHERE id ='$id'");
     }
    CountMoreFiles();     
}
#################################################################################################################  
################################################################################################################# 






################################################################################################################# 
#############################################  Cat_Activecat_Menu
################################################################################################################# 
function Cat_Activecat_Menu(){
    global $CatTabel ;
    $EmailCount = count($_POST['id_id']);

    for ($i = 0; $i < $EmailCount; $i++){
    $id =  $_POST['id_id'][$i]  ;
    $sql = "UPDATE $CatTabel SET 
	menu_state = '1'
	WHERE id = '$id'";
    $result = mysql_query($sql) or die('Cannot add category' . mysql_error()); 
    
    }
} 
function Cat_UnActivecat_Menu(){
    global $CatTabel ;
    $EmailCount = count($_POST['id_id']);

    for ($i = 0; $i < $EmailCount; $i++){
    $id =  $_POST['id_id'][$i]  ;
    $sql = "UPDATE $CatTabel SET 
	menu_state = '0'
	WHERE id = '$id'";
    $result = mysql_query($sql) or die('Cannot add category' . mysql_error()); 
    
    }
}
#################################################################################################################  
################################################################################################################# 



function CategoryChange($NewSoursIdd){
 global $GroupTabel;
 global $SoursTabel;

 global $db;
 $EmailCount = count($_POST['id_id']);
 for ($i = 0; $i < $EmailCount; $i++) {
  $id = $_POST['id_id'][$i];

  if($NewSoursIdd != '0'){
  $args = array( "cat_id" => $NewSoursIdd );
  $add_server = $db->AutoExecute($GroupTabel, $args, AUTO_UPDATE, "id = '$id' ");
  }  

 }

}

  
?>