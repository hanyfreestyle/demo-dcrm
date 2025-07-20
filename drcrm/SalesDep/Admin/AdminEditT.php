<?php
if(!defined('WEB_ROOT')) {	exit;}


if($AdminConfig['admin'] == '1'){

    $row = $db->H_CheckTheGet("id","id","sales_ticket","2");
    $ThisTicketId = $row['id'];
    $ThisCUstIDD =  $row['cust_id'];
    extract($row);


###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle." ".$id);




    Form_Open($ArrForm);



// hidden
    echo '<input type="hidden" name="ticket_id" value="'.$row['id'].'" />';
    echo '<input type="hidden" name="cust_id" value="'.$row['cust_id'].'" />';

    if( F_LEAD_TYPE == 1){
        $Arr = array("Label" => 'on',"Active" => '0');
        $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_lead_type'],"col-md-3","lead_type","fs_lead_type","req",$lead_type,$Arr);
        $RowCount = RowCountForLight_New($RowCount,"4");
    }

    if( F_LEAD_SOURS == 1){
        $Arr = array("Label" => 'on',"Active" => '0');
        $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_lead_sours'],"col-md-3","lead_sours","fs_lead_sours","req",$lead_sours,$Arr);
        $RowCount = RowCountForLight_New($RowCount,"4");
    }

    if(F_LEAD_CAT == 1){
        $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_LEAD_CAT);
        $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['hotline_ad_campaign'],"col-md-3","lead_cat","config_data","req",$lead_cat,$Arr);
        $RowCount = RowCountForLight_New($RowCount,"4");
    }



    Form_Close_New("2","List");

    if(isset($_POST['B1'])){
        if($Err != '1'){
            Vall($Err,"EditFromAdmin",$db,"1",$USER_PERMATION_Add);
        }
    }


}

function EditFromAdmin($db){
    $ThisIsTest = '0';
    $ticket_id = $_POST['ticket_id'];
    $cust_id = $_POST['cust_id'];

    $Ticket_Update_Full = array (
        'lead_type'=> Clean_Mypost($_POST['lead_type']) ,
        'lead_sours'=> Clean_Mypost($_POST['lead_sours']) ,
        'lead_cat'=> Clean_Mypost($_POST['lead_cat']) ,
    );

    $row_of_cust = $db->H_SelectOneRow("SELECT * FROM customer where  id = '$cust_id' ");

    if($ThisIsTest == '1'){
        print_r3($Ticket_Update_Full);
        if($row_of_cust['c_type'] != '1'){
            print_r3($Ticket_Update_Full);
        }

        echo $ticket_id .BR;
        echo $cust_id .BR;
    }else{
        $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update_Full,AUTO_UPDATE,"id = $ticket_id");
        if($row_of_cust['c_type'] != '1'){
            $add_server = $db->AutoExecute("customer",$Ticket_Update_Full,AUTO_UPDATE,"id = $cust_id");
        }
        Redirect_Page_2('index.php?view=ViewTicket&id='.$ticket_id);
    }
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>
