<?php
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("id","id","sales_ticket","2");
$id = $row['id'];
extract($row);



Diar_Print_Close_Ticket_Top_Info($row);
 
 

#################################################################################################################################
###################################################    OPne Form
#################################################################################################################################

$ArrForm = array('FormName'=> 'country_city');
Form_Open($ArrForm);


$Arr = array("StartFrom" => '1',"Label" => 'on' , 'Ajex_01'=> 'onchange="GetArchivesPhoto()"' );
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['close_ticket_close_type'],"col-md-4","close_id",$Close_Ticket_State_Arr,"req","0",$Arr);

if(isset($_POST['close_id'])){
    echo '<div id="city">';
    $Cat_Id = $_POST['close_id'] ;
    if($Cat_Id == '1'){
        $SubCat = '3' ;
        $CatName = $AdminLangFile['close_ticket_c_type_3'] ;
    }elseif($Cat_Id == '2'){
        $SubCat = '4' ;
        $CatName = $AdminLangFile['close_ticket_c_type_4'] ;
    }else{
        $CatName =  $AdminLangFile['close_ticket_close_type_err'] ;
    }

    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> $SubCat);
    $Err[] = NF_PrintSelect_2018("Chosen",$CatName,"col-md-3","c_type_2","f_cust_subtype","req",0,$Arr);

    echo '</div>'  ;
}else{
    echo '<div id="city"></div>';
}




echo '<div style="clear: both!important;"></div>';
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['custserv_comment'],"des","0","0","req",$MoreS);



//hidden
echo '<input type="hidden" name="cust_id" value="'.$row['cust_id'].'" />';
echo '<input type="hidden" name="ticket_id" value="'.$row['id'].'" />';
echo '<input type="hidden" name="admin_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="ticket_cust" value="3" />';
echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
echo '<input type="hidden" name="ticket_date" value="'.$row['date_add'].'" />';

Form_Close_New("6","CloseReview");

if(isset($_POST['B1'])){
    if($Err != '1'){
        Vall($Err,"ChangeClose",$db,"1",$USER_PERMATION_Add);
    }
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();


?>
