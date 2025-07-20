<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;

require_once 'Inc_Header.php';	

?>
<body>
<?php
if(PRELOADER == '1'){
echo '<div id="preloader">';
echo '<div class="clear-loading loading-effect">';
echo '<img src="'.$AdminPath.'img/loading.gif" width="100" alt=""></div>';
echo '</div>';
}


echo '<div class="wrapper">  ';
if($ViewAdminTopMenu == '1'){
    require_once 'Inc_TopMenu.php';
}
require_once 'Inc_LeftMenu.php';
if($Contacts_Button == '1'){
    require_once 'Inc_Offsidebar.php';
}

?>
<section>
<div class="main-content">
<?php
User_Check_Password_Expird();
require_once '_AdminFileUpdate.php';
if($RowUsreInfo['pass_expird'] != '2'){
    if ($HomePage == 'Home'){
        require_once 'Alert_Home_Page.php';
        require_once $content;
    }else{
        require_once 'Alert_All_Page.php';
        require_once $Short_Menu;
    }
    require_once $content;
}else{
    Print_Change_Password_Form();
}
?>
</div>
<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
	
?>
<footer>&copy; 2017 - FreeStyle4u    <?php echo 'Page generated in '.$total_time.' seconds.';  ?></footer>
</section>
<div id="back-to-top"><a class="top arrow" href="#top"><i class="fa fa-chevron-up"></i></a></div>   
<?php

/*
if($Cust_AddMoreContact == '1'){
   // Diar_Print_AddMoreContact_Form($TicketViewPageArr);
}
 */
require_once 'Inc_Js.php';
?>

</body>

</html>