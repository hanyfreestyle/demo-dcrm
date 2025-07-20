<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$Po_CatTabel ="landpage_photo_cat";
$Po_Tabel = "landpage_photo";
$Cat_id = CheckTheGet("id","id",$Po_CatTabel,"خطأ","خطأ");
$SQL_Line = "SELECT * FROM $Po_Tabel where cat_id = '$Cat_id' and state = '1' ORDER BY postion " ;

$already = $db->H_Total_Count($SQL_Line);
if($already > '0'){
    

ListPostion_File();
 
if(isset($_POST["submit"])) {
    $id_ary = explode(",",$_POST["row_order"]);
    for($i=0;$i<count($id_ary);$i++) {
        $id = $id_ary[$i] ;
        $server_data = array (
            'postion'=> $i
        );
        $db->AutoExecute($Po_Tabel,$server_data,AUTO_UPDATE,"id = $id");

    }
    Redirect_Page_2(LASTREFFPAGE);
}


echo '<form name="frmQA" method="POST" />';
echo '<input type = "hidden" name="row_order" id="row_order" /> ';
echo '<ul id="sortable-row">';

 
$Name = $db->SelArr($SQL_Line);
for($i = 0; $i < count($Name); $i++) {
echo '<li id="'.$Name[$i]["id"].'"><img src="'.F_PATH_V.$Name[$i]["photo_t"].'" class="thumbCatview" /> '. $Name[$i][$NamePrint].' </li>';   
}


echo '</ul>';
echo '<input type="submit" class="btnSave" name="submit" value="'.$ALang['lppage_save_order'].'" onClick="saveOrder();" />';
echo '</form>';
 
}else{
Alert_NO_Content();     
}


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page(); 	
?>

 