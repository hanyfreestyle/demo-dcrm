<?php
if(!defined('WEB_ROOT')) {	exit;}

#################################################################################################################################
###################################################    CustomerFastAdd
#################################################################################################################################
function CustomerFastAdd($db) {
    $Err = "";
    $Err_2 = "";
    $Err_Country = "";
    $ThisIsTest = '0';
    
    $Send_Data = Transfer_Data_Check_For_Repet($_POST);
    
    $server_data  = array ('id'=> NULL ,
        'date_add'=> TimeForToday() ,
        'date_time'=> time() ,
        'user_id'=>  $_POST['user_id'] ,

        'lead_sours'=> $_POST['lead_sours'] ,
        'lead_type'=> $_POST['lead_type'] ,
        'lead_cat'=> $_POST['lead_cat'] ,

        'name'=> Clean_Mypost($_POST['name']) ,
        'c_type'=> "5" ,
        'c_type_2'=> '1' ,

        'mobile'=> Clean_Mypost($_POST['mobile']) ,
        'state'=> "1" ,
        'notes'=> Clean_Mypost($_POST['notes']) ,
        'hotline'=> "1" ,
        'sales_man'=> $_POST['sales_man'] ,
        
        'ch_2'=> intval($Send_Data['ch_2'])  ,
        'id_1'=> intval($Send_Data['id_1'])  , 
        'id_2'=> intval($Send_Data['id_2'])  ,
        'id_3'=> intval($Send_Data['id_3'])  ,
            
    );


    $server_data = RemoveFildeFromArrWhenAdd ($server_data);


    if($Err != "1" and $Err_2 != '1' and $Err_Country != '1' ){
        if($ThisIsTest == 1){
            print_r3($server_data);
        }else{
            $db->AutoExecute("c_leads",$server_data,AUTO_INSERT);
            Redirect_Page_2('index.php?view=List');
        }
    }
}


#################################################################################################################################
###################################################
#################################################################################################################################
function CustomerFastEdit($db){
    $ThisIsTest = '0';
    $lead_id = $_POST['lead_id'];
    
    $Send_Data = Transfer_Data_Check_For_Repet($_POST,$lead_id);
    
    
    
    $Ticket_Update_Full = array (
        'lead_type'=> Clean_Mypost($_POST['lead_type']) ,
        'lead_sours'=> Clean_Mypost($_POST['lead_sours']) ,
        'lead_cat'=> Clean_Mypost($_POST['lead_cat']) ,
        'name'=> Clean_Mypost($_POST['name']) ,
        'mobile'=> Clean_Mypost($_POST['mobile']) ,
        'notes'=> Clean_Mypost($_POST['notes']) ,
        'ch'=> "0" ,
        'cust'=> "0" ,
        'ch_2'=> intval($Send_Data['ch_2'])  ,
        'id_1'=> intval($Send_Data['id_1'])  , 
        'id_2'=> intval($Send_Data['id_2'])  ,
        'id_3'=> intval($Send_Data['id_3'])  ,

    );


    if($ThisIsTest == '1'){
        print_r3($Ticket_Update_Full);
        echo $lead_id ;

    }else{
        $db->AutoExecute("c_leads",$Ticket_Update_Full,AUTO_UPDATE,"id = $lead_id");
        Redirect_Page_2('index.php?view=List');
    }
}
 
?>