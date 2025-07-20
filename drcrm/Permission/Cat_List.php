<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);




$SectionName = "catconfig";
$ThisTabelName = "user_group";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;


$THESQL = "SELECT * FROM $ThisTabelName where id != '1' $orderby ";
$THELINK = "view=".$view;
$already = $db->H_Total_Count($THESQL);

if ($already > 0){


    if($already > $ConfigP['datamax_'.$SectionName]){
            $ConfigP['datatabel'] = '0';
    }

    

    if($ConfigP['datatabel'] != '1'){
        $VallOf_Arr = array('PageCount' => 'perpage_'.$SectionName, 'PageOrder' => "order_".$SectionName , 'OrderList' => $Order_ByList);
        ConfigElement_UpdateAjex($VallOf_Arr);
    }

    ///// Open_Header
    $TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'0', 'DataTabelID'=> $DataTabelId );

    TableOpen_Header($TaBelArr);    


    Table_TH_Print('1',"ID","30");
    Table_TH_Print('1',$ALang['users_cat_name'],"200");
    Table_TH_Print('1',$ALang['users_count'],"200");
    Table_TH_Print('1',"","50");
    Table_TH_Print('1',"","50");
    Table_TH_Print('1',"","50");
    Table_TH_Print('1',"","50");
   // Table_TH_Print('1',"","50");
        
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
$already = $db->H_Total_Count("SELECT * FROM user_permission WHERE group_id = '$id'");

if ($already <= '0'){
$GROUPSTATE = NF_PrintBut_TD('1',$AdminLangFile['users_active_cat'],"Cat_Active&id=".$id,"btn-inverse","fa-pause") ;
$GROUPSTATE2 = NF_PrintBut_TD('1',$AdminLangFile['users_active_cat'],"Cat_Active&id=".$id,"btn-inverse","fa-pause") ;
$GROUPSTATE3 = NF_PrintBut_TD('1',$AdminLangFile['users_active_cat'],"Cat_Active&id=".$id,"btn-inverse","fa-pause") ;
}else{
$GROUPSTATE = NF_PrintBut_TD('1',$AdminLangFile['users_cat_edit'],"Cat_Edit&id=".$id,"btn-info","fa-pencil");
$GROUPSTATE2 = NF_PrintBut_TD('1',$AdminLangFile['users_per'],"Cat_Permission&id=".$id,"btn-warning","fa-lock");
$GROUPSTATE3 = NF_PrintBut_TD('1',$AdminLangFile['users_dell_cat'],"Cat_Dell&id=".$id,"btn-danger","fa-window-close");
}

$CatState =  GroupStatePrint($Name[$i]['state']);
echo '<tr>';

Table_TD_Print('1',$Name[$i]['id'],"C");
Table_TD_Print('1',$Name[$i]['name'],"R");
Table_TD_Print('1',$Name[$i]['count'],"C");
Table_TD_Print('1',$GROUPSTATE,"C"); 
Table_TD_Print('1',$GROUPSTATE2,"C"); 
Table_TD_Print('1',$GROUPSTATE3,"C"); 
Table_TD_Print('1',$CatState,"C");
//Table_TD_Print('1',PrintCheckBox_New($id),"C");    
 

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
