<?php
if(!defined('WEB_ROOT')) {	exit;}

$already = $db->H_Total_Count($THESQL);
if ($already > 0){

    Report_Block_Resulte($already);


    if($already > $ConfigP['datamax_cust'] ){
     $ConfigP['datatabel'] = "0";   
    }
    
    
    if($ConfigP['datatabel'] != '1'){
        $VallOf_Arr = array('PageCount' => 'perpage_'.$SectionName, 'PageOrder' => "order_".$SectionName , 'OrderList' => $Order_ByList);
        ConfigElement_UpdateAjex($VallOf_Arr);
    }
 

    
    ///// Open_Header
    $TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'0', 'DataTabelID'=> $DataTabelId );
    TableOpen_Header($TaBelArr);



    Table_TH_Print('1',"ID","50");
    Table_TH_Print('1',$AdminLangFile['customer_name'],"150");
    Table_TH_Print($ThisIsFilterPage,$AdminLangFile['customer_type'],"150");
    Table_TH_Print('1',$AdminLangFile['customer_c_type_sub'],"150");
    Table_TH_Print('1',$AdminLangFile['customer_profile_info'],"150");
    Table_TH_Print('1',"","30");
    Table_TH_Print('1',"","30");
    Table_TH_Print($AdminConfig['admin'],"","30");





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
            $C_Type = GetNameFromID("f_cust_subtype",$Name[$i]['c_type_2'],$NamePrint);

            if($ThisIsFilterPage == '1'){
                $C_Type_C = GetNameFromID("f_cust_type",$Name[$i]['c_type'],$NamePrint);
            } 


            echo '<tr>';

            Table_TD_Print('1',$Name[$i]['id'],"C");
            Table_TD_Print('1',$Name[$i]['name'],"R");
            Table_TD_Print($ThisIsFilterPage,$C_Type_C,"R");
            Table_TD_Print('1',$C_Type,"R");



            echo '<td>'.$Name[$i]['mobile'].BR;
            if($Name[$i]['mobile_2']){echo $Name[$i]['mobile_2'].BR;}
            if($Name[$i]['phone']){echo $Name[$i]['phone'].BR;}
            if($Name[$i]['email']){echo $Name[$i]['email'].BR;}
            echo '</td>';

            Table_TD_Print_Option('1',NF_PrintBut_TD('2',$AdminLangFile['mainform_edit'],"Edit&id=".$id,"btn-info","fa-pencil"),"C");
            Table_TD_Print_Option('1',NF_PrintBut_TD('2',$AdminLangFile['customer_profile'],"Profile&id=".$id,"btn-primary","fa-user"),"C");
            Table_TD_Print_Option($AdminConfig['admin'],NF_PrintBut_TD('2',$ALang['mainform_delete'],"DeleteCustomer&id=".$id,"btn-danger","fa-window-close"),"C");
            echo '</tr>';
        }
    }




///// CloseTabel
    CloseTabel();


}else{
    Alert_NO_Content();
}
?>