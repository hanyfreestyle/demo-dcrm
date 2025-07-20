<?php
if(!defined('WEB_ROOT')) {	exit;}
 
/*
$sql = "ALTER TABLE project ADD name_en varchar(50) collate utf8_unicode_ci NULL AFTER name ";
$db->H_DELETE($sql);

$sql = "ALTER TABLE project ADD state int(11) NOT NULL AFTER  con_c ";
$db->H_DELETE($sql);

$Name = $db->SelArr("SELECT * FROM project ");
for($i = 0; $i < count($Name); $i++) {
$ProID = $Name[$i]['id'];
    $server_data = array (
        'name_en'=>  $Name[$i]['name']  ,
    );
   
   $add_server = $db->AutoExecute(project,$server_data,AUTO_UPDATE,"id = $ProID");
    
} 

$sql = "ALTER TABLE project_floor_name ADD name_en varchar(50) collate utf8_unicode_ci NULL AFTER name ";
$db->H_DELETE($sql);

$Name = $db->SelArr("SELECT * FROM project_floor_name ");
for($i = 0; $i < count($Name); $i++) {
$ProID = $Name[$i]['id'];  
    $server_data = array (
        'name_en'=>  $Name[$i]['name']  ,
    );
   
   $add_server = $db->AutoExecute("project_floor_name",$server_data,AUTO_UPDATE,"id = $ProID");
    
} 


$sql = "ALTER TABLE project_floor ADD name_en varchar(50) collate utf8_unicode_ci NULL AFTER name ";
$db->H_DELETE($sql);

$Name = $db->SelArr("SELECT * FROM project_floor ");
for($i = 0; $i < count($Name); $i++) {
$ProID = $Name[$i]['id'];  
    $server_data = array (
        'name_en'=>  $Name[$i]['name']  ,
    );
   
   $add_server = $db->AutoExecute("project_floor",$server_data,AUTO_UPDATE,"id = $ProID");
    
}

*/



#################################################################################################################################
###################################################   AreaAdd 
#################################################################################################################################
function AreaAdd($db){
    $ThIsIsTest = '0';
    $TabelName = 'project_area';
    $Name =  HandleDuplicate($TabelName,"name",'name');
    $Name_En =  HandleDuplicate($TabelName,"name_en",'name_en');
    $server_data = array ('id'=> NULL ,
        'name'=> $Name['Val']  ,
        'name_en'=> $Name_En['Val']  ,
        'state'=> "1"  ,
    );
    $server_data =  AddOnlyAr($server_data);
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Name['Err'] != '1' and $Name_En['Err'] != '1'  ){
            $db->AutoExecute($TabelName,$server_data,AUTO_INSERT);
            Redirect_Page_2("index.php?view=AreaList");
        }
    }
}

#################################################################################################################################
###################################################    AreaEdit
#################################################################################################################################
function AreaEdit($db){
    $id = $_GET['id'];
    $ThIsIsTest = '0';
    $TabelName = 'project_area';
    $Name =  HandleDuplicate($TabelName,"name",'name',$id);
    $Name_En =  HandleDuplicate($TabelName,"name_en",'name_en',$id);
    $server_data = array (
        'name'=> $Name['Val']  ,
        'name_en'=> $Name_En['Val']  ,
    );
    $server_data =  AddOnlyAr($server_data);

    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Name['Err'] != '1' and $Name_En['Err'] != '1'  ){
            $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $id");
            Redirect_Page_2("index.php?view=AreaList");
        }
    }
}


#################################################################################################################################
###################################################   PrjectAdd
#################################################################################################################################
function PrjectAdd($db){
    $ThIsIsTest = '0';
    $TabelName = 'project';
    $Name =  HandleDuplicate($TabelName,"name",'name');
    $Name_En =  HandleDuplicate($TabelName,"name_en",'name_en');
    $ProCode =  HandleDuplicate($TabelName,"pro_code",'pro_code');

    $server_data = array ('id'=> NULL ,
        'name'=> $Name['Val']  ,
        'name_en'=> $Name_En['Val']  ,
        'area_id'=>  Clean_Mypost($_POST['area_id']) ,
        'pro_code'=> $ProCode['Val']  ,
        'crunt'=>  Clean_Mypost($_POST['crunt']) ,
        'state'=> "1"  ,
    );
    $server_data =  AddOnlyAr($server_data);

    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Name['Err'] != '1' and $Name_En['Err'] != '1' and $ProCode['Err'] != '1' ){
            $db->AutoExecute($TabelName,$server_data,AUTO_INSERT);
            CountProjectArea();
            Redirect_Page_2("index.php?view=List");
        }
    }

}

#################################################################################################################################
###################################################    ProjectEdit
#################################################################################################################################
function ProjectEdit($db){
    $ThIsIsTest = '0';
    $id = $_GET['id'];
    $TabelName = 'project';
    $Name =  HandleDuplicate($TabelName,"name",'name',$id);
    $Name_En =  HandleDuplicate($TabelName,"name_en",'name_en',$id);
    $ProCode =  HandleDuplicate($TabelName,"pro_code",'pro_code',$id);
    $server_data = array (
        'name'=> $Name['Val']  ,
        'name_en'=> $Name_En['Val']  ,
        'area_id'=>  Clean_Mypost($_POST['area_id']) ,
        'pro_code'=> $ProCode['Val']  ,
        'crunt'=>  Clean_Mypost($_POST['crunt']) ,
    );
    $server_data =  AddOnlyAr($server_data);
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Name['Err'] != '1' and $Name_En['Err'] != '1' and $ProCode['Err'] != '1' ){
            $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $id");
            CountProjectArea();
            Redirect_Page_2("index.php?view=List");
        }
    }
}

#################################################################################################################################
###################################################   CountProjectArea
#################################################################################################################################
function CountProjectArea(){
    global $db ;
    $Name = $db->SelArr("SELECT * FROM project_area ");
    for($i = 0; $i < count($Name); $i++) {
        $TheCat_id  = $Name[$i]['id'];
        $count = $db->H_Total_Count("SELECT * FROM project WHERE area_id = '$TheCat_id'");
        $server_data = array ('count'=> $count );
        $db->AutoExecute("project_area",$server_data,AUTO_UPDATE,"id = $TheCat_id");
    };
}





#################################################################################################################################
###################################################   GetInfoforFloor
#################################################################################################################################
function GetInfoforFloor($ProjectId){
    global $db ;
    $F_Code = "";
    $Name = $db->SelArr("SELECT f_code FROM project_floor where pro_id = $ProjectId  ORDER BY f_code  ");
    for($i = 0; $i < count($Name); $i++) {
        $F_Code .= $Name[$i]['f_code']."-";
    
    }
    $F_Code =  MoveLastWord($F_Code);
    $F_Code = explode("-",$F_Code);
    
    
    return $F_Code ;
}
#################################################################################################################################
###################################################   GetInfoforFloor_New
#################################################################################################################################
function GetInfoforFloor_New($ProjectId){
    global $db ;
    $F_Code = " and ";
    $Name = $db->SelArr("SELECT f_code FROM project_floor where pro_id = $ProjectId  ORDER BY f_code  ");
    for($i = 0; $i < count($Name); $i++) {
        if($i == '0'){
            $F_Code .= "code != ". $Name[$i]['f_code'];
        }else{
            $F_Code .= " and  code != ". $Name[$i]['f_code'];
        }
    }
    $F_Code .="  ";
    return $F_Code ;
}






#################################################################################################################################
###################################################    AddFloor
#################################################################################################################################
function AddFloor($db){
    $ThIsIsTest = '0';
    $Name = $_POST['name'];
    $Project_Id = $_POST['pro_id'] ;
    $UnitCount = $_POST['unit'] ;

    $sql = "SELECT * FROM project_floor_name where id = '$Name'";
    $row = $db->H_SelectOneRow($sql);


    $server_data = array ('id'=> NULL ,
        'pro_id'=> $Project_Id ,
        'name'=> $row['name']  ,
        'name_en'=> $row['name_en']  ,
        'f_code'=> $row['code'] ,
        'unit'=>  $UnitCount ,
    );
    $server_data =  AddOnlyAr($server_data);
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        $db->AutoExecute("project_floor",$server_data,AUTO_INSERT);
        CountProjectInfo();
        Redirect_Page_2("index.php?view=Floor_List&id=".$Project_Id);
    }
}

#################################################################################################################################
###################################################    FloorEdit
#################################################################################################################################
function FloorEdit($db){
    $ThIsIsTest = '0';
    global $AdminLangFile ; 
    $id = $_GET['id'];
    $TabelName = "project_floor";
    $row = $db->H_SelectOneRow("SELECT * FROM project_floor  where id = '$id'");
    $Project_Id = $row['pro_id'] ;
    $Arr_filter = array('SubFilde'=> 'pro_id','SubFildeVal'=> $Project_Id);
    $Name =  HandleDuplicate($TabelName,"name",'name',$id,"id",$Arr_filter);
    $Name_En =  HandleDuplicate($TabelName,"name_en",'name_en',$id,"id",$Arr_filter);
    $server_data = array (
        'name'=> $Name['Val']  ,
        'name_en'=> $Name_En['Val']  ,
    );
    $server_data =  AddOnlyAr($server_data);
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
       if($Name['Err'] != '1' and $Name_En['Err'] != '1'){
       $add_server = $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $id");
       Redirect_Page_2("index.php?view=Floor_List&id=".$Project_Id);
       }    
    }
}

#################################################################################################################################
###################################################    CountProjectInfo
#################################################################################################################################
function CountProjectInfo(){
    global $db ;
    $Name = $db->SelArr("SELECT * FROM project ");
    for($i = 0; $i < count($Name); $i++) {
        $TheCat_id  = $Name[$i]['id'];
        $floor_count = $db->H_Total_Count("SELECT * FROM project_floor WHERE pro_id = '$TheCat_id'");
        $unit_count  = $db->H_Total_Count("SELECT * FROM project_unit WHERE pro_id = '$TheCat_id'")  ;
        $server_data = array ('floor_count'=> $floor_count , 'unit_count'=> $unit_count  );
        $db->AutoExecute("project",$server_data,AUTO_UPDATE,"id = $TheCat_id");
    };
}

#################################################################################################################################
###################################################    Edit_Unit
#################################################################################################################################
function Edit_Unit($db){
    $ThIsIsTest = '0';
    $Err = "";
    $id = $_GET['id'];
    $thispro_id = Clean_Mypost($_POST['thispro_id']) ;
    $U_num = Clean_Mypost($_POST['u_num']) ;
    $already = $db->H_Total_Count("SELECT * FROM project_unit where u_num = '$U_num' and pro_id = '$thispro_id' and  id != $id ");
    if($already > 0) {
        SendJavaErrMass("رقم الوحدة مستخدم من قبل");
        $Err = '1';
    }
    $server_data = array (
        'price_id'=> Clean_Mypost($_POST['price_id']) ,
        'u_area'=> Clean_Mypost($_POST['u_area']) ,
        'u_num'=> Clean_Mypost($_POST['u_num']) ,
        'g_area'=> Clean_Mypost($_POST['g_area']) ,
        'notes'=> Clean_Mypost($_POST['notes']) ,
        'state'=> Clean_Mypost($_POST['state']) ,
        'avtive'=>"1",
    );
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Err != '1'){
            $db->AutoExecute("project_unit",$server_data,AUTO_UPDATE,"id = $id");
            CountPriceTabel();
            Redirect_Page_2('index.php?view=UnitList&Floor_Id='.$_POST['flo_id']);
        }
    }
}


#################################################################################################################################
###################################################    CountPriceTabel
#################################################################################################################################
function CountPriceTabel(){
    global $db ;
    $Name = $db->SelArr("SELECT * FROM  project_price ");
    for($i = 0; $i < count($Name); $i++) {
        $TheCat_id  = $Name[$i]['id'];
        $count = $db->H_Total_Count("SELECT * FROM project_unit  WHERE price_id = '$TheCat_id'");
        $server_data = array ('count'=> $count , );
        $db->AutoExecute("project_price",$server_data,AUTO_UPDATE,"id = $TheCat_id");
    };

}

#################################################################################################################################
###################################################    CheckF_FileReq
#################################################################################################################################
function CheckF_FileReq($Po_01,$Po_02,$Mass){
    global $AdminLangFile ;
    $Err =""; $SendMass="";
    if(intval($_POST[$Po_01]) == '0' ){
        if(intval($_POST[$Po_02]) == '0'){
            $Err = '0';
            $SendMass = "";
        }else{
            $Err = '1';
            $SendMass = $AdminLangFile['pro_price_errsendpost']." ".$Mass;
        }
    }else{
        if(intval($_POST[$Po_02]) == '0'){
            $Err = '1';
            $SendMass = $AdminLangFile['pro_price_errsendpost']." ".$Mass;
        }else{
            $Err = '0';
            $SendMass = "";
        }
    }
    return array('Err' => $Err ,'Mass'=> $SendMass);
}
#################################################################################################################################
###################################################    CheckF_FileReq_2
#################################################################################################################################
function CheckF_FileReq_2($Po_01,$Po_02,$Po_03,$Mass){
    global $AdminLangFile ;
    $Err =""; $SendMass="";
    if($_POST[$Po_01] == '' ){
        if($_POST[$Po_02] == '' and $_POST[$Po_03] == '' ){
            $Err = '0';
            $SendMass = "";
        }else{
            $Err = '1';
            $SendMass = $AdminLangFile['pro_price_errsendpost']." ".$Mass;
        }
    }elseif($_POST[$Po_02] == ''){
        if($_POST[$Po_01] == '' and $_POST[$Po_03] == '' ){
            $Err = '0';
            $SendMass = "";
        }else{
            $Err = '1';
            $SendMass = $AdminLangFile['pro_price_errsendpost']." ".$Mass;
        }
    }else{
        if($_POST[$Po_03] == ''){
            if($_POST[$Po_01] == '' and $_POST[$Po_02] == '' ){
                $Err = '0';
                $SendMass = "";
            }else{
                $Err = '1';
                $SendMass = $AdminLangFile['pro_price_errsendpost']." ".$Mass;
            }
        }
    }
    return array('Err' => $Err ,'Mass'=> $SendMass);
}

#################################################################################################################################
###################################################    GetGdVall
#################################################################################################################################
function GetGdVall($Post1,$Post2){
    if(intval($_POST[$Post1]) == '0'){
     $GD = "";   
    }else{
     $GD = strtotime( $_POST[$Post2]) ;    
    }
    return $GD ;
}


#################################################################################################################################
###################################################    AddPrice_Tabel
#################################################################################################################################
function AddPrice_Tabel($db){
    global $AdminLangFile ;
    $Err = "";
    $ThIsIsTest = '0';
    $gd_data = array (
        'g1'=>  NumberClean($_POST['g1']) ,
        'gd1'=> GetGdVall("g1","gd1")  ,
        'g2'=>  NumberClean($_POST['g2']) ,
        'gd2'=> GetGdVall("g2","gd2")  ,
        'g3'=>  NumberClean($_POST['g3']) ,
        'gd3'=>  GetGdVall("g3","gd3")  ,
        'g4'=>  NumberClean($_POST['g4']) ,
        'gd4'=> GetGdVall("g4","gd4")  ,
        'g5'=>  NumberClean($_POST['g5']) ,
        'gd5'=>  GetGdVall("g5","gd5")  ,
        'g6'=>  NumberClean($_POST['g6']) ,
        'gd6'=> GetGdVall("g6","gd6")  ,
    );
    if($ThIsIsTest == '1'){
        print_r3($gd_data);
    }    
    $GD_DataSave = serialize($gd_data);
    $td_data = array (
        't1'=>  NumberClean($_POST['t1']) ,
        'tdes1'=>  Clean_Mypost($_POST['tdes1']) ,
        'td1'=>  GetGdVall("t1","td1")  ,
        't2'=>  NumberClean($_POST['t2']) ,
        'tdes2'=>  Clean_Mypost($_POST['tdes2']) ,
        'td2'=>  GetGdVall("t2","td2")  ,
        't3'=>  NumberClean($_POST['t3']) ,
        'tdes3'=>  Clean_Mypost($_POST['tdes3']) ,
        'td3'=> GetGdVall("t3","td3")  ,
        't4'=>  NumberClean($_POST['t4']) ,
        'tdes4'=>  Clean_Mypost($_POST['tdes4']) ,
        'td4'=> GetGdVall("t4","td4")  ,
        't5'=>  NumberClean($_POST['t5']) ,
        'tdes5'=>  Clean_Mypost($_POST['tdes5']) ,
        'td5'=> GetGdVall("t5","td5")  ,
        't6'=>  NumberClean($_POST['t6']) ,
        'tdes6'=>  Clean_Mypost($_POST['tdes6']) ,
        'td6'=> GetGdVall("t6","td6")   ,
        't7'=>  NumberClean($_POST['t7']) ,
        'tdes7'=>  Clean_Mypost($_POST['tdes7']) ,
        'td7'=> GetGdVall("t7","td7")  ,
    );
    if($ThIsIsTest == '1'){
        print_r3($td_data);
    }    
    $TD_DataSave = serialize($td_data);
    $ProIDDD = Clean_Mypost($_POST['pro_id']);
    $Name = Clean_Mypost($_POST['name']);
    $already = $db->H_Total_Count("SELECT * FROM project_price where name = '$Name' and pro_id = '$ProIDDD' ");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['pro_price_add_err']);
        $Err = '1';
    }
    $server_data = array ('id'=> NULL ,
        'pro_id'=>  Clean_Mypost($_POST['pro_id']) ,
        'last_date'=> time() ,
        'name'=> Clean_Mypost($_POST['name']) ,
        'total_price'=>   NumberClean($_POST['total_price']) ,
        'reser_price'=>   NumberClean($_POST['reser_price']) ,
        'unit_m_price'=>   NumberClean($_POST['unit_m_price']) ,
        'contract_price'=>   NumberClean($_POST['contract_price']) ,
        'monthly_price'=>   NumberClean($_POST['monthly_price']) ,
        'monthly_des'=>   NumberClean($_POST['monthly_des']) ,
        'st_date'=>   strtotime( $_POST['st_date']) ,
        'end_date'=>  strtotime( $_POST['end_date']) ,
        'g_data'=> $GD_DataSave  ,
        't_data'=> $TD_DataSave  ,
    );
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Err != '1') {
            $add_server = $db->AutoExecute("project_price",$server_data,AUTO_INSERT);
            Redirect_Page_2("index.php?view=Price_List&Project_Id=".$_POST['pro_id']);
        }
    }
}

#################################################################################################################################
###################################################    EditPrice_Tabel
#################################################################################################################################
function EditPrice_Tabel($db){
    global $AdminLangFile ;
    global $ConfigP;
    $id = $_GET['id'];
    $Err = '';
    $ThIsIsTest = '0';
    $gd_data = array (
        'g1'=>  NumberClean($_POST['g1']) ,
        'gd1'=> GetGdVall("g1","gd1")  ,
        'g2'=>  NumberClean($_POST['g2']) ,
        'gd2'=> GetGdVall("g2","gd2")  ,
        'g3'=>  NumberClean($_POST['g3']) ,
        'gd3'=>  GetGdVall("g3","gd3")  ,
        'g4'=>  NumberClean($_POST['g4']) ,
        'gd4'=> GetGdVall("g4","gd4")  ,
        'g5'=>  NumberClean($_POST['g5']) ,
        'gd5'=>  GetGdVall("g5","gd5")  ,
        'g6'=>  NumberClean($_POST['g6']) ,
        'gd6'=> GetGdVall("g6","gd6")  ,
    );
    if($ThIsIsTest == '1'){
        print_r3($gd_data);
    }
    $GD_DataSave = serialize($gd_data);
    $td_data = array (
        't1'=>  NumberClean($_POST['t1']) ,
        'tdes1'=>  Clean_Mypost($_POST['tdes1']) ,
        'td1'=>  GetGdVall("t1","td1")  ,
        't2'=>  NumberClean($_POST['t2']) ,
        'tdes2'=>  Clean_Mypost($_POST['tdes2']) ,
        'td2'=>  GetGdVall("t2","td2")  ,
        't3'=>  NumberClean($_POST['t3']) ,
        'tdes3'=>  Clean_Mypost($_POST['tdes3']) ,
        'td3'=> GetGdVall("t3","td3")  ,
        't4'=>  NumberClean($_POST['t4']) ,
        'tdes4'=>  Clean_Mypost($_POST['tdes4']) ,
        'td4'=> GetGdVall("t4","td4")  ,
        't5'=>  NumberClean($_POST['t5']) ,
        'tdes5'=>  Clean_Mypost($_POST['tdes5']) ,
        'td5'=> GetGdVall("t5","td5")  ,
        't6'=>  NumberClean($_POST['t6']) ,
        'tdes6'=>  Clean_Mypost($_POST['tdes6']) ,
        'td6'=> GetGdVall("t6","td6")   ,
        't7'=>  NumberClean($_POST['t7']) ,
        'tdes7'=>  Clean_Mypost($_POST['tdes7']) ,
        'td7'=> GetGdVall("t7","td7")  ,
    );
    if($ThIsIsTest == '1'){
        print_r3($td_data);
    }
    $TD_DataSave = serialize($td_data);
    $ProIDDD = Clean_Mypost($_POST['pro_id']);
    $Name = Clean_Mypost($_POST['name']);
    $already = $db->H_Total_Count("SELECT * FROM project_price where name = '$Name' and pro_id = '$ProIDDD' and id != '$id'");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['pro_price_add_err']);
        $Err = '1';
    }
    $server_data = array (
        'last_date'=> time() ,
        'name'=> Clean_Mypost($_POST['name']) ,
        'total_price'=>   NumberClean($_POST['total_price']) ,
        'reser_price'=>   NumberClean($_POST['reser_price']) ,
        'unit_m_price'=>   NumberClean($_POST['unit_m_price']) ,
        'contract_price'=>   NumberClean($_POST['contract_price']) ,
        'monthly_price'=>   NumberClean($_POST['monthly_price']) ,
        'monthly_des'=>   Clean_Mypost($_POST['monthly_des']) ,
        'st_date'=>   strtotime( $_POST['st_date']) ,
        'end_date'=>  strtotime( $_POST['end_date']) ,
        'g_data'=> $GD_DataSave  ,
        't_data'=> $TD_DataSave  ,
    );
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Err != '1') {
            $add_server = $db->AutoExecute("project_price",$server_data,AUTO_UPDATE,"id = $id");
            Redirect_Page_2("index.php?view=Price_List&Project_Id=".$_POST['pro_id']);
        }
    }
}




?>