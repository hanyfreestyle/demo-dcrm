<?php
$Report_period = ReportPeriod(2);
$Start_Date = $Report_period['start'];
$End_Date = $Report_period['end'];
$TodayIss = TimeForToday();
$UserPerm = "";


#################################################################################################################################
###################################################   تقرير الاحداث
#################################################################################################################################    
$SQLFiter = "SELECT id FROM sales_ticket where  date_add >= $Start_Date and date_add <= $End_Date  $UserSQlFilter";
$TotalCount = $db->H_Total_Count($SQLFiter);


echo '<div style="clear: both!important;"></div>';
echo New_Print_Alert("1", $AdminLangFile['report_events_report']);

echo '<div style="clear: both!important;"></div>';
$Line = '0';

$SQLFiter_55 = "SELECT id FROM sales_ticket where visit_s = '1' and visit_date >= $Start_Date and visit_date <= $End_Date  $UserSQlFilter";
$VisitReport = $db->H_Total_Count($SQLFiter_55);
if (intval($VisitReport)) {
    $Line = intval($VisitReport) . BR . " ( " . round(($VisitReport / $TotalCount) * 100, 0) . " % )";
    ReportBlockPrint("col-md-3", $AdminLangFile['report_number_of_visits'], $Line, "fa-car", "alert-info");
}


$SQLFiter_55 = "SELECT id FROM sales_ticket where rev_s = '1' and rev_date >= $Start_Date and rev_date <= $End_Date  $UserSQlFilter";
$RevReport = $db->H_Total_Count($SQLFiter_55);
if (intval($RevReport)) {
    $Line = intval($RevReport) . BR . " ( " . round(($RevReport / $TotalCount) * 100, 0) . " % )";
    ReportBlockPrint("col-md-3", $AdminLangFile['report_number_of_reservations'], $Line, "fa-calendar", "alert-warning");
}


$SQLFiter_55 = "SELECT id FROM sales_ticket where cancel_s = '1' and cancel_date >= $Start_Date and cancel_date <= $End_Date  $UserSQlFilter";
$CancelReport = $db->H_Total_Count($SQLFiter_55);
if (intval($CancelReport)) {
    $Line = intval($CancelReport) . BR . " ( " . round(($CancelReport / $TotalCount) * 100, 0) . " % )";
    ReportBlockPrint("col-md-3", $AdminLangFile['report_reservation_canceled'], $Line, "fa-trash-o");
}


$SQLFiter_55 = "SELECT id FROM sales_ticket where contract_s = '1' and contract_date >= $Start_Date and contract_date <= $End_Date  $UserSQlFilter";
$ContractReport = $db->H_Total_Count($SQLFiter_55);
if (intval($ContractReport)) {
    $Line = intval($ContractReport) . BR . " ( " . round(($ContractReport / $TotalCount) * 100, 0) . " % )";
    ReportBlockPrint("col-md-3", $AdminLangFile['report_number_of_contract'], $Line, "fa-dollar", "alert-success");
}



echo '<div style="clear: both!important;"></div>';
#################################################################################################################################
###################################################   تقرير الاحداث
################################################################################################################################# 


#################################################################################################################################
###################################################  تقرير التذاكر   
#################################################################################################################################    
//$SQLFiter = "SELECT * FROM sales_ticket where  date_add >= $Start_Date and date_add <= $End_Date  $UserSQlFilter";    
//$Name = $db->SelArr($SQLFiter);
$SQLFiter = "SELECT * FROM sales_ticket where date_add = '$TodayIss'  $UserPerm ";
$TotalCount = $db->H_Total_Count($SQLFiter);
$Name = $db->SelArr($SQLFiter);

echo '<div style="clear: both!important;"></div>';
echo New_Print_Alert("5", $AdminLangFile['report_report_ticket']);
ReportBlockPrint("col-md-3", $AdminLangFile['report_t_totalcount_new'], $TotalCount, "fa-hdd-o", "alert-inverse");
echo '<div style="clear: both!important;"></div>';
$TicketState = @assc_array_count_values($Name, "state");
if (!isset($TicketState['1'])) {
    $TicketState['1'] = 0;
}
if (!isset($TicketState['4'])) {
    $TicketState['4'] = 0;
}
if (!isset($TicketState['2'])) {
    $TicketState['2'] = 0;
}
if (!isset($TicketState['5'])) {
    $TicketState['5'] = 0;
}
ReportBlockPrint("col-md-3", $AdminLangFile['report_t_review'], intval($TicketState['1']), "fa-eye-slash", "alert-info");
ReportBlockPrint("col-md-3", $AdminLangFile['report_t_open'], intval($TicketState['2']), "fa-desktop", "alert-success");
ReportBlockPrint("col-md-3", $AdminLangFile['report_close_review'], intval($TicketState['4']), "fa-times", "alert-warning");
ReportBlockPrint("col-md-3", $AdminLangFile['report_close'], intval($TicketState['5']), "fa-trash-o");
echo '<div style="clear: both!important;"></div>';
#################################################################################################################################
###################################################  تقرير التذاكر   
#################################################################################################################################   


#################################################################################################################################
################################################### تقرير خدمة العملاء 
#################################################################################################################################   
echo '<div style="clear: both!important;"></div>';
echo New_Print_Alert("5", "تقرير خدمة العملاء ");

$CountUpdatingData = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and c_type = '2' and contact_review = '1'  ");
$CountAsked_assistant = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and c_type = '2' and support_review = '1'  ");
$CountClosed_tickets = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '4' ");

echo '<div style="clear: both!important;"></div>';
ReportBlockPrint("col-md-3", $AdminLangFile['custserv_updating_data'], intval($CountUpdatingData), "fa-file-text", "alert-info");
ReportBlockPrint("col-md-3", $AdminLangFile['custserv_asked_assistant'], intval($CountAsked_assistant), "fa-bell-o", "alert-success");
echo '<div style="clear: both!important;"></div>';

if ($CountClosed_tickets > 0) {
    $Closed_List = $db->SelArr("SELECT id,state,close_type FROM sales_ticket WHERE state = '4' ");
    $Closed_ListState = assc_array_count_values($Closed_List, "close_type");
    echo '<div style="clear: both!important;"></div>';
    if (!isset($Closed_ListState['1'])) {
        $Closed_ListState['1'] = 0;
    }
    if (!isset($Closed_ListState['2'])) {
        $Closed_ListState['2'] = 0;
    }
    if (!isset($Closed_ListState['3'])) {
        $Closed_ListState['3'] = 0;
    }
    ReportBlockPrint("col-md-3", $AdminLangFile['custserv_closed_tickets'], intval($CountClosed_tickets), "fa-trash-o");
    ReportBlockPrint("col-md-3", $AdminLangFile['custserv_closed_for_contracting'], intval($Closed_ListState['1']), "fa-dollar", "alert-success");
    ReportBlockPrint("col-md-3", $AdminLangFile['custserv_closed_for_archiving'], intval($Closed_ListState['2']), "fa-rotate-right", "alert-info");
    ReportBlockPrint("col-md-3", $AdminLangFile['custserv_closed_for_loss'], intval($Closed_ListState['3']), "fa-times", "alert-warning");

    echo '<div style="clear: both!important;"></div>';
}
#################################################################################################################################
################################################### تقرير خدمة العملاء 
#################################################################################################################################   


?>