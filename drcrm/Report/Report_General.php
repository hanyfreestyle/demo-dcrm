<?php
if (!defined('WEB_ROOT')) {
    exit;
}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


if (isset($_POST['B1_Fliter'])) {
    $Start_Date = strtotime($_POST['date_from']);
    $End_Date = strtotime($_POST['date_to']);

    if (intval($_POST['user_id']) == '0') {
        $UserSQlFilter = " ";
    } else {
        $UserSQlFilter = "and user_id = " . intval($_POST['user_id']);
    }

} else {
    UnsetAllSession('date_from,date_to');
    $Report_period = ReportPeriod($ConfigP['report_period']);
    $Start_Date = $Report_period['start'];
    $End_Date = $Report_period['end'];
    $row['date_from'] = ConvertDateToCalender_3($Start_Date);
    $row['date_to'] = ConvertDateToCalender_3($End_Date);

    $UserSQlFilter = "";
}


echo '<form class="FilterForm FilterFormStyle" method="POST" name="Filter" id="validate-form" data-parsley-validate >';

$MoreS = array('Col' => "col-md-4", 'Placeholder' => "", 'required' => 'required');
$Err[] = NF_PrintInput("DateEdit", $AdminLangFile['report_from_date'], "date_from", "0", "0", "option", $MoreS);

$MoreS = array('Col' => "col-md-4", 'Placeholder' => "", 'required' => 'required');
$Err[] = NF_PrintInput("DateEdit", $AdminLangFile['report_to_date'], "date_to", "0", "0", "option", $MoreS);


$Arr = array("Label" => 'on', "OtherIdd" => "user_id", "Filter_Filde" => "group_id", "Filter_Vall" => $ConfigP['sales_cat']);
$Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['report_employee_name'], "col-md-3", "user_id", "tbl_user", "option", 0, $Arr);


echo '<div style="clear: both!important;"></div>';


echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="' . $AdminLangFile['report_filter_but'] . '" />';
echo '</div>';

echo '</form>';


#################################################################################################################################
###################################################
#################################################################################################################################

if ($End_Date < $Start_Date) {
    echo '<div style="clear: both!important;"></div>';
    New_Print_Alert("4", $AdminLangFile['leads_date_err']);
    $ErrDate = '1';
} else {

    if (isset($_POST['B1_Fliter'])) {
        $Countdayforloop = CountDayForLoop_Confirm($_POST['date_from'], $_POST['date_to']);
    } else {
        $Countdayforloop = "";
    }

    if ($Countdayforloop < MAXIMUM_DAYS) {

## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التجميع


        $SQLFiter = "SELECT id FROM sales_ticket where date_add >= $Start_Date and date_add <= $End_Date  $UserSQlFilter";
        $TotalCount = $db->H_Total_Count($SQLFiter);

        if ($TotalCount > '0') {


            $Name = $db->SelArr($SQLFiter);


            $Countdayforloop = CountDayForLoop($Start_Date, $End_Date);

## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   الايكون
            echo '<div style="clear: both!important;"></div>';
            ReportBlockPrint("col-md-3", $AdminLangFile['report_number_of_tickets'], $TotalCount, "fa-hdd-o", "alert-inverse");
            ReportBlockPrint("col-md-3", $AdminLangFile['report_the_number_of_days'], $Countdayforloop, "fa-hdd-o", "alert-inverse");
///ReportBlockPrint("col-md-3",$AdminLangFile['report_totalcount'],$UserCount,"fa-hdd-o","alert-inverse");

            echo '<div style="clear: both!important;"></div>';


## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التقرير الاول


            echo '<div style="clear: both!important;"></div>';
            echo New_Print_Alert("1", $AdminLangFile['report_events_report']);

            echo '<div style="clear: both!important;"></div>';

            $SQLFiter_55 = "SELECT id FROM sales_ticket where visit_s = '1' and visit_date >= $Start_Date and visit_date <= $End_Date  $UserSQlFilter";
            $VisitReport = $db->H_Total_Count($SQLFiter_55);
            $Line = intval($VisitReport) . BR . " ( " . round(($VisitReport / $TotalCount) * 100, 0) . " % )";
            ReportBlockPrint("col-md-3", $AdminLangFile['report_number_of_visits'], $Line, "fa-car", "alert-info");


            $SQLFiter_55 = "SELECT id FROM sales_ticket where rev_s = '1' and rev_date >= $Start_Date and rev_date <= $End_Date  $UserSQlFilter";
            $RevReport = $db->H_Total_Count($SQLFiter_55);
            $Line = intval($RevReport) . BR . " ( " . round(($RevReport / $TotalCount) * 100, 0) . " % )";
            ReportBlockPrint("col-md-3", $AdminLangFile['report_number_of_reservations'], $Line, "fa-calendar", "alert-warning");

            $SQLFiter_55 = "SELECT id FROM sales_ticket where cancel_s = '1' and cancel_date >= $Start_Date and cancel_date <= $End_Date  $UserSQlFilter";
            $CancelReport = $db->H_Total_Count($SQLFiter_55);
            $Line = intval($CancelReport) . BR . " ( " . round(($CancelReport / $TotalCount) * 100, 0) . " % )";
            ReportBlockPrint("col-md-3", $AdminLangFile['report_reservation_canceled'], $Line, "fa-trash-o");

            $SQLFiter_55 = "SELECT id FROM sales_ticket where contract_s = '1' and contract_date >= $Start_Date and contract_date <= $End_Date  $UserSQlFilter";
            $ContractReport = $db->H_Total_Count($SQLFiter_55);
            $Line = intval($ContractReport) . BR . " ( " . round(($ContractReport / $TotalCount) * 100, 0) . " % )";
            ReportBlockPrint("col-md-3", $AdminLangFile['report_number_of_contract'], $Line, "fa-dollar", "alert-success");

            echo '<div style="clear: both!important;"></div>';


## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   Chart 1
            $data = array();

            $ChartLoop = $db->SelArr("SELECT * FROM fs_report_chart where cat_id = 't_visits' ");
            for ($i = 0; $i < count($ChartLoop); $i++) {


                $Start_Date_Print = $Start_Date;
                $TotalCount = "0";
                $MonthData_Send = array();
                for ($x = 1; $x <= $Countdayforloop; $x++) {

                    $DateFiter = $ChartLoop[$i]['f_date'];
                    $already = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE $DateFiter = '$Start_Date_Print' $UserSQlFilter ");
                    $MonthData = array(ConvertDateToCalender_chart($Start_Date_Print), $already);
                    array_push($MonthData_Send, $MonthData);
                    $Start_Date_Print = ($Start_Date_Print + 86400);
                    $TotalCount = $TotalCount + $already;
                }
                $NewData = array(
                    'label' => $ChartLoop[$i][$NamePrint] . " " . $TotalCount,
                    'color' => $ChartLoop[$i]['color'],
                    'data' => $MonthData_Send
                );
                array_push($data, $NewData);
            }


            $fp = fopen('json/' . $ThSisUser . '_visits.json', 'w');
            fwrite($fp, json_encode($data));
            fclose($fp);

            echo '<div class="row">';
            echo '<div class="col-lg-12">';
            echo '<div data-source="json/' . $ThSisUser . '_visits.json" class="chart-line flot-chart"></div>';
            echo '</div>';
            echo '</div>';

        } else {
            echo '<div style="clear: both!important;"></div>';
            echo '<div class="alert alert-danger alert_danger_ar ">' . $AdminLangFile['mainform_alert_no_content'] . '</div>';
        }


        $Countdayforloop = CountDayForLoop($Start_Date, $End_Date);


#################################################################################################################################
###################################################
#################################################################################################################################
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   Chart 2

        echo '<div style="clear: both!important;"></div>' . BR . BR;
        echo '<div style="clear: both!important;"></div>';
        New_Print_Alert("1", $AdminLangFile['report_followup_report']);


#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ التذاكر الجديدة
        $Arr_NewTickets = array();
        $Start_Date_Print = $Start_Date;
        $TotalCount = "0";
        $MonthData_Send = array();
        for ($x = 1; $x <= $Countdayforloop; $x++) {
            $already = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE date_add = '$Start_Date_Print' $UserSQlFilter ");
            $MonthData = array(ConvertDateToCalender_chart($Start_Date_Print), $already);
            array_push($MonthData_Send, $MonthData);
            $Start_Date_Print = ($Start_Date_Print + 86400);
            $TotalCount = $TotalCount + $already;
        }
        $NewData_01 = array(
            'label' => $AdminLangFile['report_new_ticket'] . " " . $TotalCount,
            'color' => "#5ab1ef",
            'data' => $MonthData_Send
        );

        array_push($Arr_NewTickets, $NewData_01);
        $fp = fopen('json/' . $ThSisUser . '_tickets.json', 'w');
        fwrite($fp, json_encode($Arr_NewTickets));
        fclose($fp);

        echo '<div class="row">';
        echo '<div class="col-lg-12">';
        echo '<div data-source="json/' . $ThSisUser . '_tickets.json" class="chart-line flot-chart"></div>';
        echo '</div>';
        echo '</div>';
        echo '<div style="clear: both!important;"></div>' . BR . BR;
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ التذاكر الجديدة


#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ عدد المتابعات
        $Arr_Follow = array();
        $Start_Date_Print = $Start_Date;
        $TotalCount = "0";
        $MonthData_Send = array();
        for ($x = 1; $x <= $Countdayforloop; $x++) {
            $SQL = "SELECT id FROM sales_ticket_des WHERE count_type = '2' and  date_add = '$Start_Date_Print' $UserSQlFilter ";
            $already = $db->H_Total_Count($SQL);
            $MonthData = array(ConvertDateToCalender_chart($Start_Date_Print), $already);
            array_push($MonthData_Send, $MonthData);
            $Start_Date_Print = ($Start_Date_Print + 86400);
            $TotalCount = $TotalCount + $already;
        }
        $NewData_02 = array(
            'label' => $AdminLangFile['report_followup'] . " " . $TotalCount,
            'color' => "#f35839",
            'data' => $MonthData_Send
        );
        array_push($Arr_Follow, $NewData_02);


        $fp = fopen('json/' . $ThSisUser . '_follow.json', 'w');
        fwrite($fp, json_encode($Arr_Follow));
        fclose($fp);


        echo '<div class="row">';
        echo '<div class="col-lg-12">';
        echo '<div data-source="json/' . $ThSisUser . '_follow.json" class="chart-line flot-chart"></div>';
        echo '</div>';
        echo '</div>';
        echo '<div style="clear: both!important;"></div>' . BR . BR;

#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ عدد المتابعات


#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$  عدد العملاء

        $Arr_CustCount = array();
        $Start_Date_Print = $Start_Date;
        $TotalCount = "0";
        $MonthData_Send = array();
        for ($x = 1; $x <= $Countdayforloop; $x++) {

            $HetSQl = "SELECT * FROM sales_ticket_des WHERE count_type = '2' and date_add = '$Start_Date_Print' $UserSQlFilter ";
            $already = $db->H_Total_Count($HetSQl);
            if ($already > '0') {
                $Name = $db->SelArr($HetSQl);
                $VisitReport = assc_array_count_values($Name, "cat_id");
                $already_Send = count($VisitReport);
            } else {
                $already_Send = "0";
            }
            $MonthData = array(ConvertDateToCalender_chart($Start_Date_Print), $already_Send);
            array_push($MonthData_Send, $MonthData);
            $Start_Date_Print = ($Start_Date_Print + 86400);
            $TotalCount = $TotalCount + $already_Send;
        }
        $NewData_03 = array(
            'label' => $AdminLangFile['report_clients'] . " " . $TotalCount,
            'color' => "#7cbf62",
            'data' => $MonthData_Send
        );
        array_push($Arr_CustCount, $NewData_03);


        $fp = fopen('json/' . $ThSisUser . '_custcount.json', 'w');
        fwrite($fp, json_encode($Arr_CustCount));
        fclose($fp);


        echo '<div class="row">';
        echo '<div class="col-lg-12">';
        echo '<div data-source="json/' . $ThSisUser . '_custcount.json" class="chart-line flot-chart"></div>';
        echo '</div>';
        echo '</div>';

        echo '<div style="clear: both!important;"></div>' . BR . BR;
#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$  عدد العملاء


        $AllData = array();
        array_push($AllData, $NewData_01);
        array_push($AllData, $NewData_02);
        array_push($AllData, $NewData_03);

        $fp = fopen('json/' . $ThSisUser . '_all_case.json', 'w');
        fwrite($fp, json_encode($AllData));
        fclose($fp);


        echo '<div class="row">';
        echo '<div class="col-lg-12">';
        echo '<div data-source="json/' . $ThSisUser . '_all_case.json" class="chart-line flot-chart"></div>';
        echo '</div>';
        echo '</div>';

    } else {
        New_Print_Alert("4", $AdminLangFile['mainform_max_day_err_01'] . " " . MAXIMUM_DAYS . " " . $AdminLangFile['mainform_max_day_err_02']);
    }

}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
