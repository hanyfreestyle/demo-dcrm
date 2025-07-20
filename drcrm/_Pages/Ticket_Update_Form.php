<script type="text/javascript">
$(document).ready(function(){
      $('.datetimepicker').on('change',function(){
        var follow_date = document.getElementById("follow_date").value;
        var userforcount = document.getElementById("userforcount").value;
        // alert (userforcount);
        if(follow_date){
            $.ajax({
                type:'POST',
                url:'Z_Ajax_CheckForCount.php',
                data:'getfolow='+follow_date+'&userforcount='+userforcount,
                success:function(html){
                   $('#city').html(html);
                 }
            }); 
            
          }else{
            $('#city').html();
         }
    });
});
</script>
<?php


$Arr = array("Label" => 'on',"ListType" => '2' );
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['ticket_priority_sel_name'],"col-md-2","priority_id",$Follow_Priority_Arr,"optin","0",$Arr);


$Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_FOLLOW_TYPE);    
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['salesdep_f_follow_type'],"col-md-3","follow_type","config_data","req","0",$Arr); 

if(CHOSEN_FOLLOW_UP == '1'){
$Arr = array("Label" => 'on',"ListType" => '2' );
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['salesdep_f_follow_state'],"col-md-2","follow_state",$Follow_State_Arr,"req","0",$Arr);
$ReqFollowUp = "";
}else{
echo '<input type="hidden" name="follow_state" value="1" />'; 
$ReqFollowUp = "required";
}



$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => $ReqFollowUp);
$Err[] = NF_PrintInput("Date2",$AdminLangFile['salesdep_f_follow_date'],"follow_date","0","0","option",$MoreS);

/*
$Arr = array("Label" => 'on',"ListType" => '2' ,"ChangePrintVall" => '1' );
$Err[] = NF_PrintSelect_2018("FromArr",$AdminLangFile['blue_follow_calltime'],"col-md-2","follow_time",$Follow_CallTime_Arr,"optin","0",$Arr);  

*/
$MoreS = array('Col' => "col-md-2",'Placeholder'=> "",'required' => '','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Time",$AdminLangFile['ticket_follow_calltime'],"follow_time","1","1","optin",$MoreS);




echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['salesdep_f_follow_des'],"des","1","0","req",$MoreS);
 
echo '<input type="hidden" name="cust_id" value="'.$row_ticket['cust_id'].'" />';
echo '<input type="hidden" name="ticket_id" value="'.$row_ticket['id'].'" />';
echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
echo '<input type="hidden" name="ticket_date" value="'.$row_ticket['date_add'].'" />';
echo '<div style="clear: both!important;"></div>';

$UserIdd = $row_ticket['user_id'];
$TodayIss = TimeForToday() ; 
$THESQL = "SELECT * FROM sales_ticket where state = '2' and follow_state = '1' and  follow_date =  $TodayIss  and user_id = $UserIdd ";

$already = $db->H_Total_Count($THESQL);
echo '<input type="hidden" id="userforcount"  value="'.$row_ticket['user_id'].'" type="text"/>';

$Mass = $AdminLangFile['salesdep_mass_follow_count_1']." ".$already ; 

echo '<div class="alert alert-inverse alert-dismissable Arr_Mass" id="city">';
echo $Mass ;
echo '</div>';


?>


