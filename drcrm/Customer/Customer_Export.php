<?php
if(!defined('WEB_ROOT')) {	exit;}

if($AdminConfig['admin'] == '1'){

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    OPen_Page($PageTitle);


    $SectionName = "cust";
    $ThisTabelName = "customer";
    $ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
    $PERpage = $ConfigP['perpage_'.$SectionName] ;
    $orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
    $DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;



    require_once '../_Pages/Customer_Inc_Filter.php' ;



    if(isset($_POST['B1_Fliter'])){
        $End_SQL_Line = CustmerSqlFiterLine();
        $THESQL = "SELECT * FROM customer where id != 0 $End_SQL_Line ";

        $ThisIsFilterPage = '1';

        $already = $db->H_Total_Count($THESQL);

        if($already > 0){

            Report_Block_Resulte($already);
            echo '<form name="myform" action="Customer_Export_ExportPage.php" method="post">';

            echo '<input type="hidden" name="sql_line" value="'.$THESQL.'" />';
            echo '<button type="submit"  name="Export_File" class="mb-sm btn btn-danger">'.$AdminLangFile['lppage_export'].'</button> ';
            echo '</form>';
            echo '<div style="clear: both!important;"></div>'.BR.BR;

        }


    }



}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>
 