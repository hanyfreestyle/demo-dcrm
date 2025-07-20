<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie ie6 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="ie ie7 lt-ie9 lt-ie8"        lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="ie ie8 lt-ie9"               lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="ie ie9"                      lang="en"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-ie">
<!--<![endif]-->

<head>
<!-- Meta-->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<title>Admin</title>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->

<!-- Main vendor Scripts-->
<script src="<?php echo $AdminPath ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Bootstrap CSS-->
<link rel="stylesheet" href="<?php echo $AdminPath ?>app/css/bootstrap.css">
<!-- Vendor CSS-->
<link rel="stylesheet" href="<?php echo $AdminPath ?>vendor/fontawesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo $AdminPath ?>vendor/animo/animate+animo.css">
<link rel="stylesheet" href="<?php echo $AdminPath ?>vendor/csspinner/csspinner.min.css">

<!-- START Page Custom CSS ------------------------------------------------------------------------------------------->

<link rel="stylesheet" href="<?php echo $AdminPath ?>vendor/slider/css/slider.css">
<link rel="stylesheet" href="<?php echo $AdminPath ?>vendor/chosen/chosen.min.css">
<link rel="stylesheet" href="<?php echo $AdminPath ?>vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">

<!-- Codemirror -->
<link rel="stylesheet" href="<?php echo $AdminPath ?>vendor/codemirror/lib/codemirror.css">

<!-- Bootstrap tags-->
<link rel="stylesheet" href="<?php echo $AdminPath ?>vendor/tagsinput/bootstrap-tagsinput.css">

<!-- Data Table styles -->
<link rel="stylesheet" href="<?php echo $AdminPath ?>vendor/datatable/extensions/datatable-bootstrap/css/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo $AdminPath ?>vendor/datatable/extensions/ColVis/css/dataTables.colVis.css">   





<!-- END Page Custom CSS ------------------------------------------------------------------------------------------->


<!-- App CSS-->
<link rel="stylesheet" href="<?php echo $AdminPath ?>app/css/app.css">
<!-- Modernizr JS Script-->
<script src="<?php echo $AdminPath ?>vendor/modernizr/modernizr.js" type="application/javascript"></script>

<?php

if ($DetectMobile->isMobile()){
    
}else{
echo '<!-- FastClick for mobiles  --> ';
echo '<script src="'.$AdminPath.'vendor/fastclick/fastclick.js" type="application/javascript"></script>';
}

?>

<link rel="stylesheet" href="<?php echo $AdminPath ?>app/css/wintermin-theme-c.css">

<link rel="stylesheet" href="<?php echo $AdminPath ?>WebCss/EditStyle.css">
<link rel="stylesheet" href="<?php echo $AdminPath ?>WebCss/EditStyle_<?php echo ADMIN_WEB_LANG ?>.css">


<script type="text/javascript" src="<?php echo $AdminPath ?>hany/jquery.tokeninput.js"></script>
<link rel="stylesheet" href="<?php echo $AdminPath ?>hany/token-input-facebook.css" type="text/css" />


<link rel="stylesheet" href="<?php echo $AdminPath ?>inc/MaxLength/jquery.maxlength.css">
<script src="<?php echo $AdminPath ?>inc/MaxLength/jquery.plugin.js"></script>
<script src="<?php echo $AdminPath ?>inc/MaxLength/jquery.maxlength.js"></script>


    
    
</head>