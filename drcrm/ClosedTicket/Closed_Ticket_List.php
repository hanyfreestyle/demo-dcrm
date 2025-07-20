<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

require_once 'Closed_Ticket_Filter_Form.php';    

$SectionName = "closedticket";
#$ThisTabelName = "sales_ticket";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;





if(isset($_POST['B1_Fliter'])){
    $End_SQL_Line = Closed_Ticket_Fiter("close_date");
    $THESQL = "SELECT * FROM $ThisTabelName WHERE state = '5'  $End_SQL_Line $orderby";
    $THELINK = "view=".$view;
    $_SESSION['Closed_Ticket_SQL'] = $THESQL ;
}else{
    if(isset($_SESSION['Closed_Ticket_SQL'])){
        $THESQL = $_SESSION['Closed_Ticket_SQL'] ;
        $THELINK = "view=".$view;
    }else{
        $THESQL = "SELECT * FROM $ThisTabelName WHERE state = '5' and close_type = $CloseType $UserPerm $orderby";
        $THELINK = "view=".$view;
    }
}

$already = $db->H_Total_Count($THESQL);

if ($already > 0){

    if($already > $ConfigP['datamax_'.$SectionName]){
        $ConfigP['datatabel'] = '0';
    }


    Print_TotalCount_Block($already);
    
    if($ConfigP['datatabel'] != '1'){
    $VallOf = array('PageCount' => 'perpage_'.$SectionName, 'PageOrder' => "order_".$SectionName , 'OrderList' => $Order_ByList);
    UpdateConfigElement($VallOf);	
    }


    ///// Open_Header
    $TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'0', 'DataTabelID'=> $DataTabelId );
    
    require_once 'Closed_Ticket_List_Inc.php';   

}else{
    echo '<div style="clear: both!important;"></div>'.BR.BR;
    Alert_NO_Content();
}
 


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>