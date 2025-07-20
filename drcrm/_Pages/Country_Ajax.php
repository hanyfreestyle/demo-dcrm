<?php
require_once '../include/inc_reqfile.php';


if(isset($_POST["live_id"]) && !empty($_POST["live_id"])){

if($_POST["live_id"] == '1'){
$Name = $db->SelArr("SELECT * FROM fi_country where id = '204'  ");    
}elseif($_POST["live_id"] == '2'){
$Name = $db->SelArr("SELECT * FROM fi_country where id = '204'  ");       
}elseif($_POST["live_id"] == '3'){
$Name = $db->SelArr("SELECT * FROM fi_country where id != '204' and state = '1' order by count desc ");  
echo '<option value="">'.$AdminLangFile['customer_specify_nationality'].'</option>';   
}elseif($_POST["live_id"] == '4'){
$Name = $db->SelArr("SELECT * FROM fi_country where id != '204' and state = '1' order by count desc ");  
echo '<option value="">'.$AdminLangFile['customer_specify_nationality'].'</option>';   
}


for($i = 0; $i < count($Name); $i++) {
    if(ADMIN_WEB_LANG == "En"){$Name[$i]['name'] = $Name[$i]['name_en'];}        
    echo '<option value="'.$Name[$i]['id'].'">'.$Name[$i]['name'].'</option>';
}
    
}


if(isset($_POST["live_id2"]) && !empty($_POST["live_id2"])){

if($_POST["live_id2"] == '1'){
$Name = $db->SelArr("SELECT * FROM fi_country where id = '204'  ");    
}elseif($_POST["live_id2"] == '2'){
$Name = $db->SelArr("SELECT * FROM fi_country where id != '204' and state = '1' order by count desc ");  
echo '<option value="">'.$AdminLangFile['customer_please_specify_your_country'].'</option>';     
}elseif($_POST["live_id2"] == '3'){
$Name = $db->SelArr("SELECT * FROM fi_country where id = '204'  ");  
}elseif($_POST["live_id2"] == '4'){
$Name = $db->SelArr("SELECT * FROM fi_country where id != '204' and state = '1' order by count desc ");  
echo '<option value="">'.$AdminLangFile['customer_please_specify_your_country'].'</option>';   
}


for($i = 0; $i < count($Name); $i++) {
    if(ADMIN_WEB_LANG == "En"){$Name[$i]['name'] = $Name[$i]['name_en'];}        
    echo '<option value="'.$Name[$i]['id'].'">'.$Name[$i]['name'].'</option>';
}
}



?>