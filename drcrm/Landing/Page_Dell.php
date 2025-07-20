<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$row = $db->H_CheckTheGet("id","id",$GroupTabel,"2");
$id = $row['id'];



if(isset($_GET['Confirm'])){

$already = $db->H_Total_Count("SELECT * FROM landpage_block where cat_id = '$id'");

    if($already > '0'){
        $Name = $db->SelArr("SELECT * FROM landpage_block where cat_id = '$id'");
        for($i = 0; $i < count($Name); $i++) {
            $ThisBlockId = $Name[$i]['id'] ; 
            $Des =  unserialize( $Name[$i]['des']);
            if(isset($Des["photo"])){
             $deleted = @unlink(F_PATH_D.$Des["photo"]);
            }
           $db->H_DELETE_FromId("landpage_block",$ThisBlockId);
        }
    }
    
Image_Dell("2",$id,F_PATH_D,$GroupTabel,"photo","photo_t");  
$db->H_DELETE_FromId($GroupTabel,$id);
Redirect_Page_2("index.php?view=ListPage");

}else{
New_Print_Alert("4",$AdminLangFile['mainform_confirm_dell_mass']." ".$row[$NamePrint]);     
PrintDeleteButConfirm("ListPage","PageDell&id=".$id);
}

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page(); 
?>
 