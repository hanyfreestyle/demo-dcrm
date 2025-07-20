<?php
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


if($PageType == 'Add'){
$FideType = "";
$FideType_But = "1";  
$EditFilde = "Add";  
$grouplist = ""; 
}elseif($PageType == 'Edit'){
$EditFilde = "Edit";
$FideType = "Edit"; 
$FideType_But = "2";   
$row = $db->H_CheckTheGet("id","id","user_regulations","2");
$id = $row['id'];
$grouplist = $row['grouplist'];
extract($row);  
}

Form_Open($ArrForm);

#hidden
echo '<input type="hidden" name="cat_id" value="'.$CatId_Type.'" />';


        $MySQL = "SELECT * FROM user_group where state = '1' ";
        $ArrData = array('Req'=> 'req','MinReq'=> '1',"PageView"=> $EditFilde );
        Checkbox_2019("SQL","grouplist",$MySQL,$grouplist,$ArrData);
        
        
$MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required ','Dir'=> "");
$Err[] = NF_PrintInput("Text".$FideType,"العنوان","name","1","0","req",$MoreS);


$MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "");
$Err[] = NF_PrintInput("TextArea".$FideType,"الوصف","des","0","0","req",$MoreS);



Form_Close_New($FideType_But,$ListPage);

if(isset($_POST['B1'])){
    if($PageType == 'Add'){
    Vall($Err,"RegulationsAdd",$db,"1",$USER_PERMATION_Add);
    }elseif($PageType == 'Edit'){
    Vall($Err,"RegulationsEdit",$db,"1",$USER_PERMATION_Edit);  
    }
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();



 

#################################################################################################################################
###################################################    RegulationsAdd
#################################################################################################################################
function RegulationsAdd($db){
    $ThIsIsTest = '0';
    global $ListPage ;
    $TabelName = 'user_regulations';
 
    $server_data = array ('id'=> NULL ,
        'cat_id'=> PostIsset('cat_id')  ,
        'name'=> PostIsset('name')  ,
        'des'=> PostIsset('des')  ,
        'grouplist'=> SendArrToSql("grouplist"),
        'postion'=> "0"  ,
        'state'=> "1"  ,
    );
    
    if($ThIsIsTest == '1'){
        print_r3($server_data);
        echo $ListPage ;
    }else{
        $add_server = $db->AutoExecute($TabelName,$server_data,AUTO_INSERT);
        Redirect_Page_2("index.php?view=".$ListPage);
    }
}

#################################################################################################################################
###################################################    
#################################################################################################################################
function RegulationsEdit($db){
    global $ListPage ;
    $id = $_GET['id'];
    $ThIsIsTest = '0';
    $TabelName = 'user_regulations';
 
    $server_data = array (
        'name'=> PostIsset('name')  ,
        'des'=> PostIsset('des')  ,
        'grouplist'=> SendArrToSql("grouplist"),
    );
     

    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        $add_server = $db->AutoExecute($TabelName,$server_data,AUTO_UPDATE,"id = $id");
        Redirect_Page_2("index.php?view=".$ListPage);
        
    }
}


?>