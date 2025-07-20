<?php
require_once '../library/db-config_crm.php';
require_once './library/CheckLogin.php';
require_once './library/_Inc_Files.php';
$AdminConfig = checkUser();



$content = 'include/Inc_HomePage.php';
$HomePage = 'Home';

require_once 'include/Admin_Template.php';


?>