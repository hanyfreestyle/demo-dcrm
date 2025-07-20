<?php
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

### $ThisTabelName = "sales_ticket";

#print_r3($BackUpTable_Arr);
$CelCountForList = "col-md-12" ;




$SQLFiter = "SELECT id,close_type FROM $ThisTabelName WHERE state = '5' $UserPerm ";
$TotalCount = $db->H_Total_Count($SQLFiter);

if($TotalCount > 0){

    echo '<div class="col-md-3 ChartRight">';
    $Name = $db->H_SelArrOnlyRow($SQLFiter);
    $ConfigDataTabel = $db->H_SelArrOnlyRow("SELECT id,name,name_en FROM fs_ticket_closed ");

    $BLockName = $AdminLangFile['closedticket_totalcount'];
    $BLockName_ID = "ChartId";

    ReportBlockPrint($CelCountForList,$BLockName,intval($TotalCount),"fa-trash-o");

    $Jop_id =  GetChartVallFromArr_2018($Name,"close_type",$ConfigDataTabel);
    $Arr = array("Tabel"=> $Jop_id, "LIMIT" =>"10", "TotalCount" => $TotalCount );
    CharPrintArr($CelCountForList,$BLockName_ID,$BLockName,$Arr,"1");
    echo '</div>';


#################################################################################################################################
###################################################  Closed   1
#################################################################################################################################
    echo '<div class="col-md-3 ChartRight">';
    $SQLFiter = "SELECT id,c_type_2 FROM $ThisTabelName WHERE state = '5' and close_type = '1' $UserPerm ";
    $TotalCount = $db->H_Total_Count($SQLFiter) ;
    $Name = $db->H_SelArrOnlyRow($SQLFiter);
    $ConfigDataTabel = $db->H_SelArrOnlyRow("SELECT id,name,name_en FROM f_cust_subtype ");

    $BLockName = $AdminLangFile['custserv_closed_for_contracting'];
    $BLockName_ID = "ChartId_1";


    ReportBlockPrint($CelCountForList,$BLockName,intval($TotalCount),"fa-dollar","alert-success");

    if(intval($TotalCount)!= '0'){
        $Jop_id =  GetChartVallFromArr_2018($Name,"c_type_2",$ConfigDataTabel);
        $Arr = array("Tabel"=> $Jop_id, "LIMIT" =>"10", "TotalCount" => $TotalCount );
        CharPrintArr($CelCountForList,$BLockName_ID,$BLockName,$Arr,"1");
    }

    echo '</div>';


#################################################################################################################################
###################################################  Closed   2
#################################################################################################################################
    echo '<div class="col-md-3 ChartRight">';
    $SQLFiter = "SELECT id,c_type_2 FROM $ThisTabelName WHERE state = '5' and close_type = '2' $UserPerm ";
    $TotalCount = $db->H_Total_Count($SQLFiter) ;
    $Name = $db->H_SelArrOnlyRow($SQLFiter);
    $ConfigDataTabel = $db->H_SelArrOnlyRow("SELECT id,name,name_en FROM f_cust_subtype ");

    $BLockName = $AdminLangFile['custserv_closed_for_archiving'];
    $BLockName_ID = "ChartId_2";


    ReportBlockPrint($CelCountForList,$BLockName,intval($TotalCount),"fa-rotate-right","alert-info");

    if(intval($TotalCount)!= '0'){
        $Jop_id =  GetChartVallFromArr_2018($Name,"c_type_2",$ConfigDataTabel);
        $Arr = array("Tabel"=> $Jop_id, "LIMIT" =>"10", "TotalCount" => $TotalCount );
        CharPrintArr($CelCountForList,$BLockName_ID,$BLockName,$Arr,"1");
    }

    echo '</div>';




#################################################################################################################################
###################################################  Closed   3
#################################################################################################################################
    echo '<div class=" col-md-3 ChartRight">';
    $SQLFiter = "SELECT id,c_type_2 FROM $ThisTabelName WHERE state = '5' and close_type = '3' $UserPerm ";
    $TotalCount = $db->H_Total_Count($SQLFiter) ;
    $Name = $db->H_SelArrOnlyRow($SQLFiter);
    $ConfigDataTabel = $db->H_SelArrOnlyRow("SELECT id,name,name_en FROM f_cust_subtype ");

    $BLockName = $AdminLangFile['custserv_closed_for_loss'];
    $BLockName_ID = "ChartId_3";


    ReportBlockPrint($CelCountForList,$BLockName,intval($TotalCount),"fa-times","alert-warning");

    if(intval($TotalCount)!= '0'){
        $Jop_id =  GetChartVallFromArr_2018($Name,"c_type_2",$ConfigDataTabel);
        $Arr = array("Tabel"=> $Jop_id, "LIMIT" =>"10", "TotalCount" => $TotalCount );
        CharPrintArr($CelCountForList,$BLockName_ID,$BLockName,$Arr,"1");
    }

    echo '</div>';


}else{
    echo '<div style="clear: both!important;"></div>'.BR.BR;
    Alert_NO_Content();
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();



?>