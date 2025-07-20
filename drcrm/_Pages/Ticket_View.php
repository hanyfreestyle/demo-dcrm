<?php
if(!defined('WEB_ROOT')) {	exit;}


if(isset($_GET['Year'])){
    $CruntYearData = GetCruntYear(intval($_GET['Year']));
    $TicketTable = $CruntYearData['TicketTable'];
    $DesTable  = $CruntYearData['DesTable'];
    
    $row = $db->H_CheckTheGet("id","id",$TicketTable,"2");
}else{

    $row = $db->H_CheckTheGet("id","id","sales_ticket","2");

    $DesTable = "sales_ticket_des";
}


###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle." ".$row['id']);

$MainArr = array(
    "Custmer_ID"=>$row['cust_id'],
    'ViewOldTicket'=>'1',
    "ViewCustomerInfo"=>'1',
    "AddMoreContact"=>'1',
    "ViewMoreContact"=>'1',
    "ViewTicketInfo"=>'1',
    "ViewTicket_Des"=>'1',
);


if($ContentPage_Arr['Mod']== 'SalesDep'){
    $TicketViewPageArr=$MainArr+array("DepartmentView"=> "Sales" ) ;

    if($row['state']=='5'){
        $Credentials['View'] = "1";
    }else{
        $Credentials = Credentials_For_Sales($row);
    }




}elseif($ContentPage_Arr['Mod']== 'ClosedTicket'){
#################################################################################################################################
###################################################    التذاكر المغلقة
#################################################################################################################################
    $TicketViewPageArr=$MainArr+array("DepartmentView"=> "Customers_Service" ) ;
    $Credentials = Credentials_For_CustService($row);

#################################################################################################################################
###################################################   تذاكر مغلقة للمراجعة
#################################################################################################################################
}elseif($ContentPage_Arr['Mod']== 'SalesFollow'){
    $TicketViewPageArr=$MainArr+array("DepartmentView"=> "Customers_Service" ) ;
//if($row['state']== '4'){$Credentials = Credentials_For_CustService($row);}
    if($row['state']== '4'){
        $Credentials = Credentials_For_CustService($row);
    }elseif($row['state']== '5'){
        $Credentials['View'] = "1";
    }


#################################################################################################################################
###################################################   العملاء
#################################################################################################################################
}elseif($ContentPage_Arr['Mod']== 'Customer'){
    $TicketViewPageArr=$MainArr+array("DepartmentView"=> "Customer" ) ;
    $Credentials['View'] = "1";

#################################################################################################################################
###################################################    صفحات التقرير
#################################################################################################################################
}elseif($ContentPage_Arr['Mod'] == 'Report'){
    if($AdminConfig['report_dell'] == '1'){
        $TicketViewPageArr=$MainArr+array("DepartmentView"=> "Reports" ) ;
    }else{
        $TicketViewPageArr = array("Custmer_ID"=>$row['cust_id'],"DepartmentView"=> "Reports" ,'ViewOldTicket'=>'1',"ViewCustomerInfo"=>'0',
            "AddMoreContact"=>'0',"ViewMoreContact"=>'0',"ViewTicketInfo"=>'0',"ViewTicket_Des"=>'1',);
    }
    $Credentials['View'] = "1";
}









if(isset($Credentials['View']) and  $Credentials['View']== '1' ){

    Diar_ViewTicket_Page($row,$TicketViewPageArr+array('DesTable'=>$DesTable));
}else{
    ErrMassPer();
}



###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
