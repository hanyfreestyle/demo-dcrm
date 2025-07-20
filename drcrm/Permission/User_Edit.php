<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

 
 
$row = $db->H_CheckTheGet("id","user_id","tbl_user","2");
$id = $row['user_id'];
$sql = "SELECT * FROM tbl_user where user_id = '$id' ";
$row = $db->H_SelectOneRow($sql);
extract($row);





if(isset($_POST['user_follow'])){
$user_follow = $_POST['user_follow'];
$user_follow = serialize($user_follow);

} 

 

if($AdminConfig['admin'] == '1'){


if(isset($_POST['DletePhoto'])){
Image_Dell_User_But($id);
}    
    
 
Form_Open($ArrForm);

//hidden
echo '<input type="hidden" value="'.$row['photo'].'" name="old_photo" />';


if($row['user_id'] == '1'){
echo '<input type="hidden"  name="group_id" value="'.$row['group_id'].'"/>';  
}else{
$SQLForCat = "SELECT * FROM  user_group where id != '1' ";
$Arr = array("Label" => 'on',"Active" => '0', "SQL_Line_Send"=> $SQLForCat);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['users_cat_name'],"col-md-4","group_id","user_group","req",$group_id,$Arr);
}    

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="alphanum" data-parsley-minlength="5"','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['users_user_name'],"user_name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => '','Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['users_new_pass'],"new_user_pass","0","1","optin",$MoreS);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required', 'Dir'=> "Ar_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['users_name'],"name","1","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="email"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['users_email'],"email","1","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-minlength="11"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['users_mobile'],"mobile","1","0","req",$MoreS);


echo '<div style="clear: both!important;"></div>'.BR;

if(USER_PROFILE_UPDATE_IMG == '1'){
$Arr= array("Col"=> "col-md-6" ,"name"=> "photo" ,'required' => '',"photo"=> $row['photo'] ,"path"=> F_PATH_V, "NewStyle"=>"DefUserImg" ,"Dell_But"=>'1',"StopView"=>1) ;
New_PrintFilePhoto("Edit",$Arr);
}



echo '<div style="clear: both!important;"></div>'.BR;
New_Print_Alert("5","User API"); 
PrintFildInformation("col-md-3","Authentication Code",$row['google_code']);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'data-parsley-type="digits" ', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("TextEdit","Telegram Code","telegram_code","1","0","optin-num",$MoreS);
 


if($row['user_id'] == '1'){
echo '<input type="hidden"  name="state" value="1"/>';
echo '<input type="hidden"  name="sales" value="0"/>';
echo '<input type="hidden"  name="custserv" value="0"/>';            
}else{
echo '<div style="clear: both!important;"></div>'.BR;
New_Print_Alert("5","User Status"); 
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['users_user_state'],"state",$state);    
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['users_sales_group'],"sales",$sales);  
if($AdminGroup['custserv'] == '1'){
NF_PrintRadio_Active ("2_Line","col-md-3",$AdminLangFile['users_custserv_group'],"custserv",$custserv);
}
}   


echo '<div style="clear: both!important;"></div>'.BR;
New_Print_Alert("5",$AdminLangFile['users_user_follow']); 
$MySQL = "SELECT * FROM tbl_user where user_id != '1'  and state = '1' ";
UserFollowSel("UserWithGroup","col-md-12","col-md-3","","user_follow",$MySQL,"reqx","3",$user_follow);

echo '<div style="clear: both!important;"></div>';

 

Form_Close_New("2","List");


if(isset($_POST['B1'])){
Vall($Err,"UserEdit",$db,"1",$AdminConfig['admin']);
} 
    
}
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
	
?>




 