<h3 class="H3_FontAr"><?php echo $AdminLangFile['dashboard_h1'] ?></h3>
<div class="row"><div class="col-lg-12">
<?php 
if(isset($_GET['logintrue']) and $AdminConfig['admin'] == '1'){
if($_SERVER['SERVER_NAME'] != 'localhost'){
$e = new export_mysql($pfw_host, $pfw_user, $pfw_pw , $pfw_db );//instance class
$FileName = "dB".date("Y-m-d H:i:s");
$e->exportAll($FileName,true);//export all (structure and value) and zipped
}    
}

//print_r3($RowUsreInfo);

if($RowUsreInfo['group_id'] == '1'){
    require_once 'Dashboard_Admin.php';
}elseif($RowUsreInfo['group_id'] == '2'){
    require_once 'Dashboard_Sales.php';
}







?>

</div></div>