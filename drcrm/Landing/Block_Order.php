<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$Po_CatTabel = $GroupTabel ;
$Po_Tabel = "landpage_block";
$Cat_id = CheckTheGet("id","id",$Po_CatTabel,"خطأ","خطأ");
$SQL_Line = "SELECT * FROM  $Po_Tabel  where cat_id = '$Cat_id' and state = '1' ORDER BY postion" ; 


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
        $db->AutoExecute("landpage_block",$server_data,AUTO_UPDATE,"id = $id");

    }
    Redirect_Page_2(LASTREFFPAGE);
}
 

PageEditBut($Cat_id);	

echo '<form name="frmQA" method="POST" />';
echo '<input type = "hidden" name="row_order" id="row_order" /> ';
echo '<ul id="sortable-row">';

 
$Name = $db->SelArr($SQL_Line);
for($i = 0; $i < count($Name); $i++) {
echo '<li id="'.$Name[$i]["id"].'">'.$Name[$i]["var"].'</li>'; 
}

echo '</ul>';
echo '<input type="submit" class="btnSave" name="submit" value="Save Order" onClick="saveOrder();" />';
echo '</form>';

}else{
Alert_NO_Content();      
}
 
######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 