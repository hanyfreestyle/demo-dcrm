<?php
if(!defined('WEB_ROOT')) {	exit;}
#################################################################################################################################
###################################################    
################################################################################################################################# 
       
       /*
        $PageTitle = $Module_H1.$PageVarList['H1']." | ".$AdminLangFile['mainform_h1_order'] ;
        $ThisTabelName  = $PageVarList['TabelName'] ;
        $Tabel_Type     =  $PageVarList['Tabel_Type']  ;
        $Fs_CatId       = $PageVarList['Fs_CatId'];
        */

$ThisTabelName = "user_regulations";
        
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

 

$SQL_Line = "SELECT * FROM $ThisTabelName where state = '1' and cat_id = '$CatId_Type'  ORDER BY postion " ;


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
        $db->AutoExecute($ThisTabelName,$server_data,AUTO_UPDATE,"id = $id");
    }
    Redirect_Page_2(LASTREFFPAGE);
}


echo '<form name="frmQA" method="POST" />';
echo '<input type = "hidden" name="row_order" id="row_order" />';
echo '<ul id="sortable-row">';

 

$Name = $db->SelArr($SQL_Line);
for($i = 0; $i < count($Name); $i++) {
echo '<li id="'.$Name[$i]["id"].'">'. $Name[$i]['name'].'</li>';
}
 
echo '</ul>';
echo '<input type="submit" class="btnSave" name="submit" value="حفظ الترتيب" onClick="saveOrder();" />';
echo '</form>';
 
}else{
 Alert_NO_Content();      
}    


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page(); 	
?>    