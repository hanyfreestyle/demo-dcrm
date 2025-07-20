<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$SectionName = "hotline";
$ThisTabelName = "c_leads";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;


if($AdminConfig['leads'] == '1'){
    $THESQL = "SELECT * FROM $ThisTabelName where hotline = '1' $orderby ";
    $THELINK = "view=".$view;
}else{
    $hotline_user  = $RowUsreInfo['user_id']  ;
    $THESQL = "SELECT * FROM $ThisTabelName where hotline = '1' and user_id  = '$hotline_user' $orderby ";
    $THELINK = "view=".$view;
}



$already = $db->H_Total_Count($THESQL);
if ($already > 0){

    if($ConfigP['datatabel'] != '1'){
        $VallOf_Arr = array('PageCount' => 'perpage_'.$SectionName, 'PageOrder' => "order_".$SectionName , 'OrderList' => $Order_ByList);
        ConfigElement_UpdateAjex($VallOf_Arr);
    }


    ///// Open_Header
    $TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'0', 'DataTabelID'=> $DataTabelId );

    TableOpen_Header($TaBelArr);



    Table_TH_Print('1',"ID","30");
    Table_TH_Print('1',$AdminLangFile['leads_date_add'],"60");
    Table_TH_Print(F_LEAD_TYPE,$AdminLangFile['customer_lead_type'],"100");
    Table_TH_Print(F_LEAD_SOURS,$AdminLangFile['customer_lead_sours'],"100");
    Table_TH_Print(F_LEAD_CAT,$AdminLangFile['hotline_ad_campaign'],"100");

    Table_TH_Print('1',$AdminLangFile['leads_c_name'],"100");
    Table_TH_Print('1',$AdminLangFile['leads_mobile'],"100");
    Table_TH_Print('1',$AdminLangFile['leads_email'],"100");

    Table_TH_Print($AdminConfig['leads'],$AdminLangFile['salesdep_user_name'],"100");
    #Table_TH_Print($AdminConfig['admin'],"","30");
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



        for($i = 0; $i < count($Name); $i++) {
            $id = $Name[$i]['id'];

            echo '<tr>';
            echo '<td>'.$Name[$i]['id'].'</td>';
            echo '<td>'.ConvertDateToCalender_2($Name[$i]['date_add']).'</td>';


            if(F_LEAD_TYPE == 1 ){
                $LeadType = GetNameFromID("fs_lead_type",$Name[$i]['lead_type'],$NamePrint);
                echo '<td>'.$LeadType.'</td>';
            }
            if( F_LEAD_SOURS  == 1){
                $Lead_sours = GetNameFromID("fs_lead_sours",$Name[$i]['lead_sours'],$NamePrint);
                echo '<td>'.$Lead_sours.'</td>';
            }

            if( F_LEAD_CAT  == 1){
                $LeadCat = GetNameFromID("config_data",$Name[$i]['lead_cat'],$NamePrint);
                echo '<td>'.$LeadCat.'</td>';
            }

            echo '<td>'.$Name[$i]['name'].'</td>';
            echo '<td>'.$Name[$i]['mobile'].'</td>';
            echo '<td>'.$Name[$i]['email'].'</td>';

            if($AdminConfig['leads']=='1'){
                $UserIName = GetNameFromID_Usrname($Name[$i]['user_id']);
                echo '<td align="center">'.$UserIName.'</td>';
            }


            if($AdminConfig['admin']=='1'){
          #      echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_edit'],"EditLead&id=".$id,"btn-info","fa-pencil").'</td>';
            }


            echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_delete'],"Dell&id=".$id,"btn-danger","fa-window-close").'</td>';
            echo '</tr>';
        }
    }



///// CloseTabel
    CloseTabel();


}else{
    Alert_NO_Content();
}



###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>
