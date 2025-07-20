<?php

//// Photo Paths
$Month = date("m",time());
$Year =  date("Y",time());
//define('CURRENT_PATH',""); 

define('CURRENT_PATH_NEW',$Year."/".$Year.$Month); 
define('CURRENT_PATH',$Year."/".$Year.$Month."/"); 
//define('CURRENT_PATH',"2018/201804/"); 
define('IMAGE_DIR_V', WEB_ROOT .'images/');
define('IMAGE_DIR_D', SRV_ROOT .'images/');

define('LOGOS_IMAGE_DIR', SRV_ROOT.'images/Logos/');
define('LOGOS_IMAGE_DIR_V', WEB_ROOT .'images/Logos/');
define('LOGOS_IMAGE_DIR_D', SRV_ROOT .'images/Logos/');


define('LANDINGPAGE_IMAGE_DIR' , SRV_ROOT."images/".CURRENT_PATH);
define('LANDINGPAGE_IMAGE_DIR_V', WEB_ROOT ."images/");
define('LANDINGPAGE_IMAGE_DIR_D', SRV_ROOT ."images/");

define('WEBSITE_IMAGE_DIR' , SRV_ROOT."images/".CURRENT_PATH);
define('WEBSITE_IMAGE_DIR_V', WEB_ROOT ."images/");
define('WEBSITE_IMAGE_DIR_D', SRV_ROOT ."images/");


define('ADMIN_IMG_FOLDER','images/');
define('D_USER_ADMIN_IMG',WEB_ROOT. $AdminFolder.ADMIN_IMG_FOLDER."avertar.png");
define('USERPROFILE_IMAGE_DIR' ,  SRV_ROOT. $AdminFolder.ADMIN_IMG_FOLDER.CURRENT_PATH);
define('USERPROFILE_IMAGE_DIR_V', WEB_ROOT .$AdminFolder.ADMIN_IMG_FOLDER);
define('USERPROFILE_IMAGE_DIR_D', SRV_ROOT .$AdminFolder.ADMIN_IMG_FOLDER);

define('WATERMARK_IMAGE_DIR' , SRV_ROOT."images/Watermark/");
define('WATERMARK_IMAGE_DIR_V', WEB_ROOT ."images/Watermark/");
define('WATERMARK_IMAGE_DIR_D', SRV_ROOT ."images/Watermark/");



?>