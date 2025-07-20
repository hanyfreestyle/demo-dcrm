<?php
if (!defined('WEB_ROOT')) {
  exit;
}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$SectionName = "custsrv";
$ThisTabelName = "cust_ticket";
$ConfigP['datatabel'] = $ConfigP['datatabel_' . $SectionName];
$PERpage = $ConfigP['perpage_' . $SectionName];
$orderby = RterunOrder($ConfigP['order_' . $SectionName]);
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_' . $SectionName]);


if (isset($_POST['B1_Fliter'])) {
  $FliterReason = FilterReason($_POST['reason_id']);
  $DateFilteLine = DateFiterForm_2018();
  $THESQL = "SELECT * FROM $ThisTabelName where state = '1' $DateFilteLine $FliterReason  $UserPerm $orderby";
  $THELINK = "view=" . $view;
} else {
  $THESQL = "SELECT * FROM $ThisTabelName WHERE state = '1' $UserPerm ";
  $THELINK = "view=" . $view;
}


CustService_Ticket_Form_Filter();


$already = $db->H_Total_Count($THESQL);

if ($already > 0) {

///// Open_Header
  $TaBelArr = array ();
  TableOpen_Header($TaBelArr);

  Table_TH_Print('1', "ID", "30");
  Table_TH_Print('1', $AdminLangFile['salesdep_date_add'], "100");
  Table_TH_Print('1', $AdminLangFile['salesdep_customer_information'], "130");
  Table_TH_Print('1', $AdminLangFile['ticket_priority_sel_name'], "90");
  Table_TH_Print(CHOSEN_FOLLOW_UP, $AdminLangFile['salesdep_f_follow_state'], "70");
  Table_TH_Print('1', $AdminLangFile['ticket_t_reason'], "90");
  Table_TH_Print('1', $AdminLangFile['salesdep_td_last_notes'], "200");
  Table_TH_Print('1', $AdminLangFile['salesdep_user_name'], "90");
  Table_TH_Print('1', "", "20");
  Table_TH_Print('1', "", "20");

///// TableClose_Header
  TableClose_Header();


  if ($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1') {
    $Name = $db->SelArr($THESQL);
  } else {
    $Name = $db->SelArr($THESQL, true, $PERpage, PAGING_NEXT_PREV_NUM, $THELINK, 5);
  }


  for ($i = 0; $i < count($Name); $i++) {

    $id = $Name[$i]['id'];


    echo '<tr>';
    echo '<td>' . $Name[$i]['id'] . '</td>';

    echo '<td>';
    echo ConvertDateToCalender_2($Name[$i]['date_add']) . BR;
    echo '<div class="td_line"></div>';
    echo PrintFullTime($Name[$i]['date_time']);
    echo '</td>';

    echo '<td>';
    echo PrintCustomerInformation($Name[$i]['cust_id']);
    echo '</td>';

///// تفاصيل المتابعة
    echo '<td>';
    echo PrintFollowInformation($Name[$i]);
    echo '</td>';

    if (CHOSEN_FOLLOW_UP == '1') {
      echo '<td>' . Rterun_Follow_State_Arr_ForTabel($Name[$i]['follow_state']) . '</td>';
    }

    echo '<td>';
    echo findValue_FromArr($T_ARRAY_CONFIG_DATA, "id", $Name[$i]['reason_id'], $NamePrint) . BR;
    echo '</td>';

    echo '<td class="TD_200" >' . nl2br($Name[$i]['notes']) . '</td>';


    $EmpnName = findValue_FromArr($T_ARRAY_USERS_NAME, "user_id", $Name[$i]['user_id'], "name");
    echo '<td>' . $EmpnName . '</td>';
    echo '<td align="center">' . NF_PrintBut_TD('Full_Url', $AdminLangFile['customer_profile'],
        $AdminPathHome . "Customer/index.php?view=Profile&id=" . $Name[$i]['cust_id'], "btn-primary", "fa-user") . '</td>';


    echo '<td align="center">' . NF_PrintBut_TD('2', $AdminLangFile['salesdep_view_but'], "CustViewTicket&id=" . $id, "btn-info", "fa-search", "0") . '</td>';


    echo '</tr>';

  }


///// CloseTabel
  CloseTabel();


} else {
  Alert_NO_Content();
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>