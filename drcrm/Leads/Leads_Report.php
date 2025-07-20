<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$ThisWeek = ThisWeek();
$start_date = $ThisWeek['start'];
$end_date = $ThisWeek['end'];
if(isset($_POST['B1'])){
    $start_date = strtotime( $_POST['date_from']);
    $end_date = strtotime( $_POST['date_to']);
    if($end_date < $start_date  ){
        SendJavaErrMass($AdminLangFile['leads_date_err']);
        $ErrDate = '1' ;
    }else{
        $Countdayforloop =  CountDayForLoop($start_date,$end_date) ;
    }
}else{
    UnsetAllSession('date_from,date_to');
    $row['date_from'] = ConvertDateToCalender_3($start_date) ;
    $row['date_to'] = ConvertDateToCalender_3($end_date) ;
    $Countdayforloop =  CountDayForLoop($start_date,$end_date) ;
}


Form_Open($ArrForm);


$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("DateEdit",$AdminLangFile['leads_from_date'],"date_from","0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("DateEdit",$AdminLangFile['leads_to_date'],"date_to","0","0","option",$MoreS);

Empl_ListBox_Master("0","1");

Form_Close("4","List");

 

echo '<div style="clear: both!important;"></div>';

$TJiToday = TimeForToday();
$TotalCountT = "0";
//////   بداية العرض
if($ErrDate != '1'){
 

    if(isset($_POST['B1'])){
        if(intval($_POST['user_id']) == '0'){
            $ThisIsSQLloop = "SELECT * FROM tbl_user where sales = '1' and state = '1' ";
        }else{
            $FiterUserId  = intval($_POST['user_id']) ;
            $ThisIsSQLloop = "SELECT * FROM tbl_user where user_id = $FiterUserId ";
        }
    }else{
        $ThisIsSQLloop = "SELECT * FROM tbl_user where sales = '1' and state = '1' ";
    }


for ($i = 0; $i < $Countdayforloop ; $i++) {

    if($TJiToday == $start_date){
        $StyleFoMass = "4";
    }else{
        $StyleFoMass = "2";
    }
echo New_Print_Alert($StyleFoMass,GetARDate3($start_date));    
?>
    
    
<div class="panel panel-default">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover ArTabel">

<tbody>

<?php
$Name = $db->SelArr($ThisIsSQLloop);
for($x = 0; $x < count($Name); $x++) {
$user_id = $Name[$x]['user_id'];  
$already = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE date_add = '$start_date' and user_id  = '$user_id' ");
echo '<tr>';
echo '<td>'.$Name[$x]['name'].'</td>';
echo '<td align="center" class="CodeNumber">'.$already.'</td>';
echo '</tr>';
$TotalCountT = $TotalCountT+$already;
} 
?>                          
</tbody>
</table>
</div>
</div>

    
<?php    
$start_date = $start_date+86400 ;  
}    
    
    
}

echo '<div style="clear: both!important;"></div>';


echo New_Print_Alert("5",$AdminLangFile['leads_total']." ".$TotalCountT); 

    
##########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();   
?>
