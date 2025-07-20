<?php


TableOpen_Header($TaBelArr);



echo '<th class="TD_40">ID</th>';
echo '<th class="TD_120">'.$AdminLangFile['report_date_added'].'</th>';
if($view == 'CloseReview' or $Sction ==  'ClosedTicket' ){
    echo '<th class="TD_120">'.$Period_Lang.'</th>';
}
echo '<th class="TD_120">'.$AdminLangFile['report_customer_data'].'</th>';
echo '<th class="TD_120">'.$AdminLangFile['report_lead_type_t'].'</th>';
echo '<th class="TD_150" class="fx_notes">'.$AdminLangFile['salesdep_td_last_notes'].'</th>';
echo '<th class="TD_90">'.$AdminLangFile['report_employee_name_t'].'</th>';
if($view == 'CloseReview'){
    echo '<th width="50">'.$AdminLangFile['salesdep_reason_for_close'].'</th>';
}

Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");

///// TableClose_Header
TableClose_Header();



$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){

    if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
        $Name = $db->SelArr($THESQL);
    }else{
        $Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5);
    }


    $Lead_Type_Arr =  $db->SelArr("SELECT id,name,name_en FROM fs_lead_type");
    $Lead_Sours_Arr =  $db->SelArr("SELECT id,name,name_en FROM fs_lead_sours");
    $C_Type_Arr =  $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
    $C_Type2_Arr =  $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");
    $C_Closed_Arr =  $db->SelArr("SELECT id,name,name_en FROM fs_ticket_closed");

    for($i = 0; $i < count($Name); $i++) {
        $id = $Name[$i]['id'];
        $Id_Cust = $Name[$i]['cust_id'];
        $CustName = $db->H_SelectOneRow("select name,mobile,mobile_2 from customer where id = '$Id_Cust' ");
        $EmpnName =  GetNameFromID_User("tbl_user",$Name[$i]['user_id'],"name") ;

        $lead_type = findValue_FromArr($Lead_Type_Arr,"id",$Name[$i]['lead_type'],$NamePrint);
        $lead_sours = findValue_FromArr($Lead_Sours_Arr,"id",$Name[$i]['lead_sours'],$NamePrint);
        $c_type = findValue_FromArr($C_Type_Arr,"id",$Name[$i]['c_type'],$NamePrint);
        $c_type2 = findValue_FromArr($C_Type2_Arr,"id",$Name[$i]['c_type_2'],$NamePrint);
        $ClosedState = findValue_FromArr($C_Closed_Arr,"id",$Name[$i]['close_type'],$NamePrint);


        echo '<tr>';
        echo '<td>'.$Name[$i]['id'].'</td>';
        echo '<td>';
        echo ConvertDateToCalender_2($Name[$i]['date_add']);

        if($view == 'CloseReview' or $Sction ==  'ClosedTicket'){
            echo '<div class="td_line"></div>'.BR;
            echo $AdminLangFile['custserv_sales_close'].BR ;
            echo ConvertDateToCalender_2($Name[$i]['close_date']);
        }
        if( $Sction ==  'ClosedTicket'){
            echo '<div class="td_line"></div>'.BR;
            echo $AdminLangFile['custserv_customer_service_close'].BR ;
            echo ConvertDateToCalender_2($Name[$i]['close_date_2']);
        }
        echo '<div class="td_line"></div>'.BR;
        echo PrintFullTime($Name[$i]['date_time']);
        echo'</td>';




        if($view == 'CloseReview' or $Sction ==  'ClosedTicket'){
            echo '<td>';
            echo $AdminLangFile['custserv_sales_close'].BR ;
            echo Time_Ago_2($Name[$i]['close_date'],$Name[$i]['date_add']).BR;

            if( $Sction ==  'ClosedTicket'){
                echo '<div class="td_line"></div>';
                echo $AdminLangFile['custserv_customer_service_close'].BR ;

                echo Time_Ago_2($Name[$i]['close_date_2'],$Name[$i]['close_date']).BR;
            }

            echo '<div class="td_line"></div>';
            echo $AdminLangFile['report_last_follow_up_period'].BR ;
            echo Time_Ago_2(time(),$Name[$i]['date_time']).BR;
            echo'</td>';
        }


        echo '<td>';
        echo $CustName['name'] .BR;
        echo $CustName['mobile'] .BR;
        echo'</td>';


        echo '<td>';
        echo $lead_type.BR ;
        echo $lead_sours.BR ;
        echo '<div class="td_line"></div>';
        echo $c_type .BR;
        echo $c_type2 .BR;
        echo'</td>';




        echo '<td>'.nl2br($Name[$i]['notes']).'</td>';
        echo '<td>'.$EmpnName.'</td>';

        if($view == 'CloseReview'){
            echo '<td>'.$ClosedState.'</td>';
        }



        #Button_ListPage_TicketView($id,$Button_TicketView_Arr);
        echo  Button_TicketView_Fun($id."&Year=".$CruntYearData['Year'],$Button_TicketView_Arr);
        Button_ListPage_CustomerProfile($Name[$i]['cust_id'],$Button_CustomerProfile_Arr);


        echo '</tr>';
    }

}



///// CloseTabel
CloseTabel();


?>