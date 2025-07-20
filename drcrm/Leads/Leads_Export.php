<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

if($AdminConfig['leads_dell'] == '1'){

    if($CustType == 'All'){
    $SQL_Line =  "SELECT * FROM c_leads " ;  
    }else{
    $SQL_Line =  "SELECT * FROM c_leads where cust = '$CustType'  " ;        
    }

    $Already = $db->H_Total_Count($SQL_Line);
    
    if($Already > '0'){
    ReportBlockPrint("col-md-3",$AdminLangFile['report_totalcount'],$Already,"fa-hdd-o","alert-inverse");
    echo '<div style="clear: both!important;"></div> ';        


    echo '<form name="myform" action="Leads_Export_Page.php" method="post">';    
    echo '<input type="hidden" name="sql_line" value="'.$SQL_Line.'" />';
    echo '<button type="submit"  name="Export_File" class="mb-sm btn btn-danger">'.$AdminLangFile['lppage_export'].'</button> ';
    echo '</form>';  
    

    }else{
    Alert_NO_Content();     
    }


    
}



###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page(); 
?>
 