<?php

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||| #  GetCruntYear
function GetCruntYear($Year,$SendArr=array()){
    global $BackUpTable_Arr ;
    $Year = intval($Year);
    $ThisYear = date("Y") ;
    $ThisYear = '2023';
/*
    echo $Year.BR;
    echo $ThisYear.BR;
*/


    if( $Year >= $ThisYear or $Year < 2018 ){
        $_SESSION['MainCruntYear'] = $ThisYear ;
        $DataArr = array(
            'Year'=>$ThisYear,
            "TicketTable"=>"sales_ticket",
            "DesTable"=>"sales_ticket_des",
        );
    }else{
        $_SESSION['MainCruntYear'] = $Year ;
        $DataArr = array(
            'Year'=>$Year,
            "TicketTable"=>"z_sales_ticket_".$Year,
            "DesTable"=>"z_sales_ticket_des_".$Year,
        );
    }
    return $DataArr ;
}



$BackUpTable_Arr = array(
    array('Year'=>"2018","TicketTable"=>"z_sales_ticket_2018","DesTable"=>"z_sales_ticket_des_2018"),
    array('Year'=>"2019","TicketTable"=>"z_sales_ticket_2019","DesTable"=>"z_sales_ticket_des_2019"),
    array('Year'=>"2020","TicketTable"=>"z_sales_ticket_2020","DesTable"=>"z_sales_ticket_des_2020"),
    array('Year'=>"2021","TicketTable"=>"z_sales_ticket_2021","DesTable"=>"z_sales_ticket_des_2021"),
    array('Year'=>"2022","TicketTable"=>"z_sales_ticket_2022","DesTable"=>"z_sales_ticket_des_2022"),
    array('Year'=>"2023","TicketTable"=>"sales_ticket","DesTable"=>"sales_ticket_des"),
);

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  AddFildeToTabel_2023
function AddFildeToTabel_2023($TabelName,$FildName,$FildName_2,$Type,$Count,$Null='1'){
    global $db ;
    $AfterLine = "";
    $Check_Arr = $db->H_SelectOneRow("SHOW COLUMNS FROM `$TabelName` LIKE '$FildName'");
    if(count((array)$Check_Arr)== '0'){

        if($Null == '1'){
            $PrintNull =  'NOT NULL ';
        }else{
            $PrintNull =  ' NULL ';
        }
        if($Type == 'int'){

            if($Null == '1'){
                $PrintType = ' int(11) NOT NULL ' ;
            }else{
                $PrintType = ' int(11) NULL DEFAULT '.intval($Count) ;
            }

        }elseif($Type == 'var'){
            $PrintType = " varchar($Count) collate utf8_unicode_ci $PrintNull ";
        }elseif($Type == 'text'){
            $PrintType = " text collate utf8_unicode_ci $PrintNull ";
        }
        if(trim($FildName_2) != ""){
            $AfterLine = "AFTER " . $FildName_2 ;
        }

        $sql = "ALTER TABLE $TabelName ADD $FildName $PrintType $AfterLine " ;
        $db->H_DELETE($sql);

    }else{
        echo "Filed ". $FildName ." Is Exists ".BR ;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  CreatBackUpTable
function CreatBackUpTable($Year,$SendArr=array()){
    global $db;

    $sales_ticket_TableName = "z_sales_ticket_".$Year;
    $sales_ticket_des_TableName = "z_sales_ticket_des_".$Year;

    $SQL_Line = "";
    $SQL_Line .= "CREATE TABLE `$sales_ticket_TableName` (";
    $SQL_Line .= "  `id` int(11) NOT NULL,";
    $SQL_Line .= "  `date_add` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `date_month` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `date_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `lead_sours` int(11) DEFAULT '0',";
    $SQL_Line .= "  `lead_type` int(11) DEFAULT '0',";
    $SQL_Line .= "  `lead_cat` int(11) DEFAULT '0',";
    $SQL_Line .= "  `ticket_cust` int(11) DEFAULT '0',";
    $SQL_Line .= "  `cust_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `user_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `notes` text COLLATE utf8_unicode_ci,";
    $SQL_Line .= "  `admin_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `cash_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `unit_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `date_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `bestcall_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `time_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `area_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `pro_area` text COLLATE utf8_unicode_ci,";
    $SQL_Line .= "  `follow_state` int(11) DEFAULT '0',";
    $SQL_Line .= "  `follow_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `follow_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `priority_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `c_type` int(11) DEFAULT '0',";
    $SQL_Line .= "  `c_type_2` int(11) DEFAULT '0',";
    $SQL_Line .= "  `visit_s` int(11) DEFAULT '0',";
    $SQL_Line .= "  `visit_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `visit_month` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `rev_s` int(11) DEFAULT '0',";
    $SQL_Line .= "  `rev_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `rev_month` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `rev_date_2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `cancel_s` int(11) DEFAULT '0',";
    $SQL_Line .= "  `cancel_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `cancel_month` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `contract_s` int(11) DEFAULT '0',";
    $SQL_Line .= "  `contract_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `contract_month` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `jop_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `kind_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `social_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `live_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `country_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `countrylive_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `city_id` int(11) DEFAULT '0',";
    $SQL_Line .= "  `state` int(11) DEFAULT '0',";
    $SQL_Line .= "  `close_follow` int(11) DEFAULT '0',";
    $SQL_Line .= "  `close_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `close_month` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `close_date_2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `close_month_2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line .= "  `close_type` int(11) DEFAULT '0',";
    $SQL_Line .= "  `close_review` int(11) DEFAULT '0',";
    $SQL_Line .= "  `contact_review` int(11) DEFAULT '0',";
    $SQL_Line .= "  `support_review` int(11) DEFAULT '0'";
    $SQL_Line .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; ";

    $Check_Arr = $db->H_SelectOneRow("SHOW TABLES LIKE '%$sales_ticket_TableName%'; ");
    if(count((array)$Check_Arr)== '0'){
        $db->H_DELETE($SQL_Line);
        $db->H_DELETE(" ALTER TABLE `$sales_ticket_TableName` ADD PRIMARY KEY (`id`); ");
        $db->H_DELETE(" ALTER TABLE `$sales_ticket_TableName` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT; ");

    }else{
        echo "Table ". $sales_ticket_TableName ." Is Exists ".BR ;
    }


    $SQL_Line_Des = "";

    $SQL_Line_Des .= "CREATE TABLE `$sales_ticket_des_TableName` (";
    $SQL_Line_Des .= "  `id` int(11) NOT NULL,";
    $SQL_Line_Des .= "  `cat_id` int(11) DEFAULT '0',";
    $SQL_Line_Des .= "  `cust_id` int(11) DEFAULT '0',";
    $SQL_Line_Des .= "  `date_add` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line_Des .= "  `ticket_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line_Des .= "  `date_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line_Des .= "  `date_month` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line_Des .= "  `follow_date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line_Des .= "  `follow_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line_Des .= "  `priority_id` int(11) DEFAULT '0',";
    $SQL_Line_Des .= "  `follow_type` int(11) DEFAULT '0',";
    $SQL_Line_Des .= "  `follow_state` int(11) DEFAULT '0',";
    $SQL_Line_Des .= "  `des` text COLLATE utf8_unicode_ci,";
    $SQL_Line_Des .= "  `user_id` int(11) DEFAULT '0',";
    $SQL_Line_Des .= "  `user_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,";
    $SQL_Line_Des .= "  `add_type` int(11) DEFAULT '0',";
    $SQL_Line_Des .= "  `count_type` int(11) DEFAULT '0'";
    $SQL_Line_Des .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;  ";

    $Check_Arr = $db->H_SelectOneRow("SHOW TABLES LIKE '%$sales_ticket_des_TableName%'; ");
    if(count((array)$Check_Arr)== '0'){
        $db->H_DELETE($SQL_Line_Des);
        $db->H_DELETE(" ALTER TABLE `$sales_ticket_des_TableName` ADD PRIMARY KEY (`id`), ADD KEY `cust_id` (`cust_id`), ADD KEY `cat_id` (`cat_id`), ADD KEY `date_add` (`date_add`); ");
        $db->H_DELETE(" ALTER TABLE `$sales_ticket_des_TableName` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT; ");

    }else{
        echo "Table ". $sales_ticket_des_TableName ." Is Exists ".BR ;
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	
function Diar_Print_ArchivedTicket_2023($Ticket_ID,$Custmer_ID,$MyArr=array()){
    global $db;
    global $BackUpTable_Arr;
    global $ALang ;
    global $Button_TicketView_Arr ;
    global $NamePrint ;

    $T_Ticket_State = $db->SelArr("SELECT id,name,name_en FROM fs_ticket_state");
    # print_r3($BackUpTable_Arr);

    $AllCount = '0';
    $PrintData = "";
    for ($i = 0; $i < count($BackUpTable_Arr); $i++) {
        $TicketTableName = $BackUpTable_Arr[$i]['TicketTable'];
        $SetYear = $BackUpTable_Arr[$i]['Year'];

        $THESQL =  "SELECT * FROM $TicketTableName WHERE cust_id = '$Custmer_ID' and id != $Ticket_ID " ;
        $CountOldTicket = $db->H_Total_Count($THESQL);
        if($CountOldTicket > '0'){
            $AllCount = $AllCount+$CountOldTicket;

            $Name = $db->SelArr($THESQL);
            for($x = 0; $x < count($Name); $x++) {
                $id = $Name[$x]['id'];
                $C_type =  GetNameFromID("f_cust_type",$Name[$x]['c_type'],$NamePrint) ;
                $C_type_2 =  GetNameFromID("f_cust_subtype",$Name[$x]['c_type_2'],$NamePrint) ;
                $EmpnName =  GetNameFromID_User("tbl_user",$Name[$x]['user_id'],"name") ;
                $CloseType =  GetNameFromID("fs_ticket_closed",$Name[$x]['close_type'],$NamePrint) ;

                $PrintData .= '<tr>';
                $PrintData .= '<td>'.$Name[$x]['id'].'</td>';
                $PrintData .= '<td>'.ConvertDateToCalender_2($Name[$x]['date_add']).'</td>';
                if($Name[$x]['close_date']){
                    $PrintData .= '<td>'.ConvertDateToCalender_2($Name[$x]['close_date']).'</td>';
                }else{
                    $PrintData .= '<td></td>';
                }
                $PrintData .= '<td>'.$CloseType.'</td>';
                $PrintData .= '<td>'.$C_type_2.'</td>';
                $PrintData .= '<td>'.$EmpnName.'</td>';
                $PrintData .= '<td>'.findValue_FromArr($T_Ticket_State,"id",$Name[$x]['state'],$NamePrint).'</td>';
                $PrintData .= Button_TicketView_Fun($id."&Year=".$SetYear,$Button_TicketView_Arr);
                $PrintData .= '</tr>';
            }
        }
    }

    if($AllCount > 0){
        echo '<div style="clear: both!important;"></div>';
        New_Print_Alert("2",$ALang['ticket_previous_tickets']);
        echo '<table id="MyCustmerx" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
        echo '<thead><tr>';
        Table_TH_Print('1',"ID","30");
        Table_TH_Print('1',$ALang['salesdep_date_add'],"100");
        Table_TH_Print('1',$ALang['ticket_closing_date'],"100");
        Table_TH_Print('1',$ALang['ticket_reason_for_closure'],"100");
        Table_TH_Print('1',$ALang['customer_c_type_sub'],"100");
        Table_TH_Print('1',$ALang['salesdep_user_name'],"100");
        Table_TH_Print('1',$ALang['ticket_crunt_t_state'],"100");
        Table_TH_Print('1',"","30");
        echo '</tr>';
        echo '</thead>';
        echo '<tbody> ';


        echo $PrintData ;

        echo '</tbody>';
        echo '</table>';
        echo '<div style="clear: both!important;"></div>';
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	
function Button_TicketView_Fun($TicketId,$ArrCome=array()){
    global $AdminPathHome ;
    global $ALang ;

    $Blank_Type = ArrIsset($ArrCome,"BlankType","0");
    $But_Titel = ArrIsset($ArrCome,"Titel",$ALang['mainform_view_des_but']);
    $But_Type = ArrIsset($ArrCome,"But_Type","2");
    $ViewLink  = ArrIsset($ArrCome,"ViewLink","ViewTicket");

    if($But_Type == 'Full_Url'){
        $Full_Url = ArrIsset($ArrCome,"Full_Url","");
        $Url =  $AdminPathHome.$Full_Url.$TicketId ;
    }else{
        $Url =  $ViewLink."&id=".$TicketId ;
    }

    $kk =  Table_TD_Print_2023('1',NF_PrintBut_TD($But_Type,$But_Titel,$Url,"btn-info","fa-search",$Blank_Type),"C");

    return $kk ;
}


function Table_TD_Print_2023($View,$Val,$Align="C",$Arr=""){
    $Style = "";
    if($View == '1'){
        if($Align == 'C' ){$Align = "center";} if($Align == 'R' ){$Align = "right";}    if($Align == 'L' ){$Align = "left";}
        if(isset($Arr['OtherStyle'])){
            $Style = $Arr['OtherStyle'] ;
        }

        $kk = '<td align="'.$Align.'" class="'.$Style.'" >'.$Val.'</td>';
        return $kk ;
    }
}


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
#||||||||||||||||||||||||||||||||||||||||||||| #  Text	



?>